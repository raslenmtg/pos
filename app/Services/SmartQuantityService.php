<?php

namespace App\Services;

use App\TransactionSellLine;
use App\VariationLocationDetails;
use App\PurchaseLine;
use App\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class SmartQuantityService
{
    /**
     * Get products with low stock based on sales velocity and days threshold
     *
     * @param int|null $business_id Filter by specific business (optional)
     * @param int $days_threshold Days remaining before stock rupture (default: 7)
     * @param int|null $location_id Filter by specific location (optional)
     * @return array Array of low stock products with details
     */
    public function getLowStockProducts($business_id = null, $days_threshold = 15, $location_id = null)
    {
        // Get all product variations with their stock levels
        $variationStocks = VariationLocationDetails::query()
            ->join('variations', 'variation_location_details.variation_id', '=', 'variations.id')
            ->join('products', 'variations.product_id', '=', 'products.id')
            ->when($business_id, fn($q) => $q->where('products.business_id', $business_id))
            ->when($location_id, fn($q) => $q->where('variation_location_details.location_id', $location_id))
            ->groupBy('variation_location_details.variation_id')
            ->select('variation_location_details.variation_id as variation_id', DB::raw('SUM(variation_location_details.qty_available) as current_stock'))
            ->having('current_stock', '>', 0)
            ->get();

        $low_stock_products = [];

        foreach ($variationStocks as $stock) {
            $variation_id = $stock->variation_id;
            $current_stock = $stock->current_stock;

            // Get daily velocity for this variation
            $daily_velocity = $this->getDailyVelocity($variation_id);

            // Skip if no sales velocity (no stock movement)
            if ($daily_velocity <= 0) {
                continue;
            }

            // Calculate days remaining
            $days_remaining = $current_stock / $daily_velocity;

            // Check if below threshold
            if ($days_remaining <= $days_threshold) {
                // Calculate reorder quantity (30 days supply minus current stock)
                $reorder_qty = max(0, ($daily_velocity * 30) - $current_stock);

                // Get best supplier
                $supplier = $this->getBestSupplier($variation_id);

                // Get product variation details
                $variation = DB::table('variations')
                    ->join('products', 'variations.product_id', '=', 'products.id')
                    ->where('variations.id', $variation_id)
                    ->select('products.name as product_name', 'variations.id as variation_id', 'variations.name as variation_name')
                    ->first();

                if ($variation) {
                    $low_stock_products[] = [
                        'product_name' => $variation->product_name . ($variation->variation_name ? " ({$variation->variation_name})" : ''),
                        'variation_id' => $variation_id,
                        'current_stock' => round($current_stock, 2),
                        'daily_velocity' => round($daily_velocity, 2),
                        'days_remaining' => round($days_remaining, 1),
                        'reorder_qty' => round($reorder_qty, 2),
                        'supplier' => $supplier,
                    ];
                }
            }
        }

        // Sort by days_remaining (most urgent first)
        usort($low_stock_products, fn($a, $b) => $a['days_remaining'] <=> $b['days_remaining']);

        return $low_stock_products;
    }

    /**
     * Calculate daily sales velocity for a product variation (last 90 days)
     *
     * @param int $variation_id Product variation ID
     * @return float Daily velocity (average units sold per day)
     */
    public function getDailyVelocity($variation_id)
    {
        $ninety_days_ago = Carbon::now()->subDays(90);

        $daily_sales_data = TransactionSellLine::query()
            ->join('transactions', 'transaction_sell_lines.transaction_id', '=', 'transactions.id')
            ->where('variation_id', $variation_id)
            ->where('transactions.type', 'sell')
            ->where('transactions.transaction_date', '>=', $ninety_days_ago)
            ->select(
                DB::raw('DATE(transactions.transaction_date) as date'),
                DB::raw('SUM(transaction_sell_lines.quantity) as total_quantity')
            )
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        $total_quantity_sold = $daily_sales_data->sum('total_quantity');
        $days_elapsed = 90;
        if ($total_quantity_sold == 0) {
            return 0;
        }

        if ($daily_sales_data->count() < 20) {
            return 0;
        }
        $ten_days_ago = \Carbon\Carbon::now()->subDays(10)->toDateString();
        $last_sale_date = $daily_sales_data->last()->date;

        if ($last_sale_date < $ten_days_ago) {
            return 0;
        }

        // Calculate multiple fallback options
        return $this->calculateSmartFallbackFromData($daily_sales_data, $ninety_days_ago);

     /*   $nixtla_api_key = env('NIXTLA_API_KEY');
            try {
                $sales_dict = $daily_sales_data->pluck('total_quantity', 'date')->toArray();

                // Build df array: [{ds: "2024-01-01", y: 0.0}, ...]
                $df = [];
                $current_date = clone $ninety_days_ago;
                for ($i = 0; $i < $days_elapsed; $i++) {
                    $date_str = $current_date->format('Y-m-d');
                    $df[] = [
                        'ds' => $date_str,
                        'y'  => isset($sales_dict[$date_str]) ? (float)$sales_dict[$date_str] : 0.0,
                    ];
                    $current_date->addDay();
                }

                $response = \Illuminate\Support\Facades\Http::withHeaders([
                    'Authorization' => 'Bearer ' . $nixtla_api_key,
                    'Content-Type' => 'application/json',
                    'Accept'       => 'application/json',
                ])->timeout(30)->post('https://api.nixtla.io/timegpt', [  // ✅ correct endpoint
                    'df'   => $df,   // ✅ correct body shape
                    'h'    => 10,
                    'freq' => 'D',
                    'clean_ex_first' => true
                ]);

                if ($response->successful()) {
                    $prediction_data = $response->json();

                    // Nixtla returns: {"data": {"forecast": {"ds": [...], "TimeGPT": [...]}}}
                    $forecasts = $prediction_data['value'] ?? null;

                    if (!empty($forecasts) && is_array($forecasts)) {
                        $predicted_average = array_sum($forecasts) / count($forecasts);
                        return max(0, $predicted_average);
                    }

                    // Log unexpected response shape for debugging
                    \Illuminate\Support\Facades\Log::warning('Nixtla unexpected response shape: ' . $response->body());
                } else {
                    \Illuminate\Support\Facades\Log::warning('Nixtla API Error: ' . $response->body());
                 ///   return 0;
                }
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error('Nixtla API Exception: ' . $e->getMessage());
            }*/


       /// return $this->calculateFallbackVelocity($values, $daily_sales_data->count());
    }

    /**
     * Find the best supplier for a product variation (lowest unit price in last 6 months)
     *
     * @param int $variation_id Product variation ID
     * @return array|null Supplier details with unit price, or null if no supplier found
     */
    public function getBestSupplier($variation_id)
    {
        $six_months_ago = Carbon::now()->subMonths(6);

        $best_purchase = DB::table('purchase_lines')
            ->join('transactions', 'purchase_lines.transaction_id', '=', 'transactions.id')
            ->join('contacts', 'transactions.contact_id', '=', 'contacts.id')
            ->where('purchase_lines.variation_id', $variation_id)
            ->where('transactions.transaction_date', '>=', $six_months_ago)
            ->where('transactions.type', 'purchase')
            ->select(
                'contacts.id as supplier_id',
                'contacts.name as supplier_name',
                'contacts.mobile',
                'contacts.email',
                DB::raw('MIN(purchase_lines.purchase_price_inc_tax) as unit_price'),
                'purchase_lines.transaction_id'
            )
            ->groupBy('contacts.id', 'contacts.name', 'contacts.mobile', 'contacts.email', 'purchase_lines.transaction_id')
            ->orderBy('unit_price', 'asc')
            ->first();

        if ($best_purchase) {
            return [
                'supplier_id' => $best_purchase->supplier_id,
                'supplier_name' => $best_purchase->supplier_name,
                'mobile' => $best_purchase->mobile,
                'email' => $best_purchase->email,
                'unit_price' => round($best_purchase->unit_price, 2),
            ];
        }

        return null;
    }
    /**
     * Calculate smart fallback that learns each merchant's pattern
     */
    private function calculateSmartFallbackFromData($daily_sales_data, $start_date): float
    {
        // Get full time series
        $time_series = $this->prepareTimeSeries($daily_sales_data, $start_date);
        $values = array_values($time_series);
        $timestamps = array_keys($time_series);

        // Get sales data
        $sales_on_sales_days = $daily_sales_data->pluck('total_quantity')->toArray();
        $sales_dates = $daily_sales_data->pluck('date')->toArray();

        $total_sales = array_sum($sales_on_sales_days);
        $non_zero_days = count($sales_on_sales_days);

        if ($total_sales == 0) {
            return 0;
        }

        // ========== Detect merchant's business pattern ==========

        // 1. Detect which days they're closed (consistent zero days)
        $day_patterns = [];
        $current_date = clone $start_date;

        for ($i = 0; $i < count($values); $i++) {
            $day_of_week = $current_date->dayOfWeek; // 0=Sun, 1=Mon, etc.
            $value = $values[$i];

            if (!isset($day_patterns[$day_of_week])) {
                $day_patterns[$day_of_week] = ['total' => 0, 'count' => 0, 'zeros' => 0];
            }

            $day_patterns[$day_of_week]['total'] += $value;
            $day_patterns[$day_of_week]['count']++;

            if ($value == 0) {
                $day_patterns[$day_of_week]['zeros']++;
            }

            $current_date->addDay();
        }

        // Detect closed days (80%+ zeros)
        $closed_days = [];
        $open_days = [];

        foreach ($day_patterns as $day => $pattern) {
            $zero_percentage = $pattern['zeros'] / $pattern['count'];
            $avg_when_open = $pattern['total'] / ($pattern['count'] - $pattern['zeros']);

            if ($zero_percentage >= 0.8) {
                $closed_days[] = $day;
                $day_patterns[$day]['status'] = 'closed';
            } else {
                $open_days[] = $day;
                $day_patterns[$day]['status'] = 'open';
                $day_patterns[$day]['avg_when_open'] = $avg_when_open;
            }
        }

        // 2. Detect anomalies (statistical outliers)
        $all_sales = $sales_on_sales_days;
        sort($all_sales);
        $q1 = $all_sales[floor(count($all_sales) * 0.25)];
        $q3 = $all_sales[floor(count($all_sales) * 0.75)];
        $iqr = $q3 - $q1;
        $upper_bound = $q3 + ($iqr * 1.5);

        $normal_sales = array_filter($sales_on_sales_days, function($sale) use ($upper_bound) {
            return $sale <= $upper_bound;
        });

        $anomaly_sales = array_filter($sales_on_sales_days, function($sale) use ($upper_bound) {
            return $sale > $upper_bound;
        });

        $normal_avg = !empty($normal_sales) ? array_sum($normal_sales) / count($normal_sales) : 1;

        // 3. Calculate recent trend (last 30 days vs previous 30 days)
        $recent_values = array_slice($values, -30);
        $older_values = array_slice($values, -60, 30);

        $recent_avg = array_sum($recent_values) / 30;
        $older_avg = array_sum($older_values) / 30;

        $trend = ($recent_avg - $older_avg) / max(0.01, $older_avg);

        \Illuminate\Support\Facades\Log::info('Merchant Pattern Detection', [
            'closed_days' => $closed_days,
            'open_days' => $open_days,
            'normal_avg' => round($normal_avg, 2),
            'anomaly_count' => count($anomaly_sales),
            'anomaly_percentage' => round((count($anomaly_sales) / count($sales_on_sales_days)) * 100, 1) . '%',
            'recent_avg' => round($recent_avg, 2),
            'older_avg' => round($older_avg, 2),
            'trend' => round($trend * 100, 1) . '%',
            'upper_bound' => round($upper_bound, 2),
        ]);

        // 4. Calculate velocity based on merchant's pattern

        // Method 1: Average on open days only (most accurate)
        $open_day_avg = $this->calculateOpenDayAverage($values, $timestamps, $closed_days);

        // Method 2: Normalized daily average (accounting for closed days)
        $open_days_count = 90 - (count($closed_days) * (90 / 7));
        $normalized_avg = $total_sales / $open_days_count;

        // Method 3: Recent open day average (last 30 days, open days only)
        $recent_open_avg = $this->calculateRecentOpenDayAverage($values, $timestamps, $closed_days, 30);

        // Method 4: Weighted by trend
        if ($trend > 0.1) {
            $trend_adjusted = $recent_open_avg * (1 + min(0.3, $trend));
        } elseif ($trend < -0.1) {
            $trend_adjusted = $recent_open_avg * (1 + max(-0.3, $trend));
        } else {
            $trend_adjusted = $recent_open_avg;
        }

        $velocity_options = [
            'open_day_avg' => $open_day_avg,
            'normalized_avg' => $normalized_avg,
            'recent_open_avg' => $recent_open_avg,
            'trend_adjusted' => $trend_adjusted,
            'conservative' => min($open_day_avg, $recent_open_avg),
        ];

        \Illuminate\Support\Facades\Log::info('Velocity Options', array_map(function($v) {
            return round($v, 2);
        }, $velocity_options));

        // Select strategy based on merchant's pattern
        if (count($anomaly_sales) / count($sales_on_sales_days) > 0.2) {
            // Many anomalies - use normal average (filtered)
            $final_velocity = $normal_avg;
            $reason = "many_anomalies_using_normal_avg";
        } elseif ($trend < -0.2) {
            // Declining trend - be conservative
            $final_velocity = $velocity_options['conservative'];
            $reason = "declining_trend_conservative";
        } elseif ($trend > 0.2) {
            // Increasing trend - be optimistic
            $final_velocity = $velocity_options['trend_adjusted'];
            $reason = "increasing_trend_optimistic";
        } else {
            // Stable pattern - use open day average
            $final_velocity = $velocity_options['open_day_avg'];
            $reason = "stable_pattern_open_day_avg";
        }

        \Illuminate\Support\Facades\Log::info('Final Velocity Decision', [
            'reason' => $reason,
            'final_velocity' => round($final_velocity, 2),
            'merchant_pattern' => [
                'closed_days' => $closed_days,
                'avg_on_open_days' => round($open_day_avg, 2),
                'has_anomalies' => count($anomaly_sales) > 0,
                'trend' => round($trend * 100, 1) . '%',
            ],
        ]);

        return max(0.1, $final_velocity);
    }

    /**
     * Calculate average on open days only
     */
    private function calculateOpenDayAverage(array $values, array $timestamps, array $closed_days): float
    {
        $open_day_values = [];
        $current_date = null;

        foreach ($timestamps as $index => $date) {
            $day_of_week = Carbon::parse($date)->dayOfWeek;

            if (!in_array($day_of_week, $closed_days)) {
                $open_day_values[] = $values[$index];
            }
        }

        return !empty($open_day_values) ? array_sum($open_day_values) / count($open_day_values) : 0;
    }

    /**
     * Calculate recent open day average
     */
    private function calculateRecentOpenDayAverage(array $values, array $timestamps, array $closed_days, int $days): float
    {
        $recent_values = array_slice($values, -$days);
        $recent_timestamps = array_slice($timestamps, -$days);

        $open_day_values = [];

        foreach ($recent_timestamps as $index => $date) {
            $day_of_week = Carbon::parse($date)->dayOfWeek;

            if (!in_array($day_of_week, $closed_days)) {
                $open_day_values[] = $recent_values[$index];
            }
        }

        return !empty($open_day_values) ? array_sum($open_day_values) / count($open_day_values) : 0;
    }

    /**
     * Prepare continuous daily time series
     */
    private function prepareTimeSeries($daily_sales_data, $start_date): array
    {
        $sales_dict = $daily_sales_data->pluck('total_quantity', 'date')->toArray();
        $time_series = [];

        $current_date = clone $start_date;
        for ($i = 0; $i < 90; $i++) {
            $date_str = $current_date->format('Y-m-d');
            $time_series[$date_str] = isset($sales_dict[$date_str]) ? (float)$sales_dict[$date_str] : 0.0;
            $current_date->addDay();
        }

        return $time_series;
    }
}
