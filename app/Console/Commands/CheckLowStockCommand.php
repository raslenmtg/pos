<?php

namespace App\Console\Commands;

use App\Business;
use App\User;
use App\Notifications\LowStockNotification;
use App\Services\SmartQuantityService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Notification;

class CheckLowStockCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:low-stock';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check for low stock products and send notifications to relevant users';

    /**
     * The SmartQuantityService instance.
     *
     * @var SmartQuantityService
     */
    protected $smartQuantityService;

    /**
     * Create a new command instance.
     *
     * @param SmartQuantityService $smartQuantityService
     */
    public function __construct(SmartQuantityService $smartQuantityService)
    {
        parent::__construct();
        $this->smartQuantityService = $smartQuantityService;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $businesses = Business::where('is_active', true)->get();

        foreach ($businesses as $business) {
            $this->processBusinessLowStock($business);
        }

        return 0;
    }

    /**
     * Process low stock products for a specific business.
     *
     * @param Business $business
     * @return void
     */
    protected function processBusinessLowStock(Business $business)
    {

        // Get low stock products for this business
        $lowStockProducts = $this->smartQuantityService->getLowStockProducts(
            $business->id,
          15
        );

        // Get users with permission to view/manage stock in this business
        $notifiableUsers = $this->getNotifiableUsers($business);

        if ($notifiableUsers->isEmpty()) {
            $this->warn("No users with stock notification permissions in {$business->name}");
            return;
        }

        // Send notifications for each low stock product
        foreach ($lowStockProducts as $productData) {
            $this->sendLowStockNotification($productData, $notifiableUsers, $business);
        }
    }

    /**
     * Get users who should receive low stock notifications.
     *
     * @param Business $business
     * @return \Illuminate\Database\Eloquent\Collection
     */
    protected function getNotifiableUsers(Business $business)
    {
        return User::where('business_id', $business->id)
            ->get()
            ->filter(function ($user) {
                return $user->can('purchase.create');
            });
    }

    /**
     * Send low stock notification to users.
     *
     * @param array $productData
     * @param \Illuminate\Database\Eloquent\Collection $users
     * @param Business $business
     * @return void
     */
    protected function sendLowStockNotification($productData, $users, Business $business)
    {
        try {
            Notification::send($users, new LowStockNotification(
                intval($productData['product_name']),
                $productData['current_stock'],
                intval($productData['days_remaining']),
                intval($productData['reorder_qty']),
                $productData['variation_id'] ?? null,
                $productData['supplier']['supplier_id'] ?? null
            ));
        } catch (\Exception $e) {
            $this->error("Error sending notification for product: " . json_encode($productData));
            $this->error("Error: " . $e->getMessage());
        }
    }
}
