<?php

namespace App\Http\Controllers;

use App\BusinessLocation;
use App\Category;
use App\Exports\InventaireCountSheetExport;
use App\Inventory;
use App\InventoryLine;
use App\Transaction;
use App\VariationLocationDetails;
use App\Utils\ModuleUtil;
use App\Utils\ProductUtil;
use App\Utils\TransactionUtil;
use Datatables;
use DB;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class InventaireController extends Controller
{
    protected $productUtil;

    protected $transactionUtil;

    protected $moduleUtil;

    public function __construct(ProductUtil $productUtil, TransactionUtil $transactionUtil, ModuleUtil $moduleUtil)
    {
        $this->productUtil = $productUtil;
        $this->transactionUtil = $transactionUtil;
        $this->moduleUtil = $moduleUtil;
    }

    public function index(Request $request)
    {
        if (! auth()->user()->can('purchase.view') && ! auth()->user()->can('purchase.create') && ! auth()->user()->can('view_own_purchase')) {
            abort(403, 'Unauthorized action.');
        }

        if ($request->ajax()) {
            $business_id = $request->session()->get('user.business_id');
            $query = Inventory::join('business_locations AS BL', 'inventories.location_id', '=', 'BL.id')
                ->leftJoin('users as u', 'inventories.created_by', '=', 'u.id')
                ->where('inventories.business_id', $business_id)
                ->select(
                    'inventories.id',
                    'inventories.inventory_date',
                    'inventories.ref_no',
                    'BL.name as location_name',
                    'inventories.notes',
                    DB::raw("CONCAT(COALESCE(u.surname, ''),' ',COALESCE(u.first_name, ''),' ',COALESCE(u.last_name,'')) as added_by")
                );

            $permitted_locations = auth()->user()->permitted_locations();
            if ($permitted_locations != 'all') {
                $query->whereIn('inventories.location_id', $permitted_locations);
            }

            if (! auth()->user()->can('purchase.view') && auth()->user()->can('view_own_purchase')) {
                $query->where('inventories.created_by', $request->session()->get('user.id'));
            }

            $start_date = $request->get('start_date');
            $end_date = $request->get('end_date');
            if (! empty($start_date) && ! empty($end_date)) {
                $query->whereBetween(DB::raw('date(inventories.inventory_date)'), [$start_date, $end_date]);
            }

            $location_id = $request->get('location_id');
            if (! empty($location_id)) {
                $query->where('inventories.location_id', $location_id);
            }

            $product_id = $request->get('product_id');
            if (! empty($product_id)) {
                $query->whereExists(function ($sub_query) use ($product_id) {
                    $sub_query->select(DB::raw(1))
                        ->from('inventory_lines as il')
                        ->whereColumn('il.inventory_id', 'inventories.id')
                        ->where('il.product_id', $product_id);
                });
            }

            return Datatables::of($query)
                ->addColumn('action', function ($row) {
                    $html =
                        '<div class="btn-group"><button type="button" class="tw-dw-btn tw-dw-btn-xs tw-dw-btn-outline  tw-dw-btn-info tw-w-max dropdown-toggle" data-toggle="dropdown" aria-expanded="false">'.__('messages.actions').'<span class="caret"></span><span class="sr-only">Toggle Dropdown</span></button><ul class="dropdown-menu dropdown-menu-left" role="menu">';

                    $html .= '<button type="button" data-href="'.action([\App\Http\Controllers\InventaireController::class, 'show'], [$row->id]).'" class="tw-dw-btn tw-dw-btn-xs tw-dw-btn-outline tw-dw-btn-primary btn-modal" data-container=".view_modal"><i class="fa fa-eye" aria-hidden="true"></i> '. __('messages.view') .'</button>';


                    $html .= ' <a href="'.action([\App\Http\Controllers\InventaireController::class, 'edit'], [$row->id]).'" class="tw-dw-btn tw-dw-btn-xs tw-dw-btn-outline tw-dw-btn-success"><i class="fa fa-edit" aria-hidden="true"></i> '. __('messages.edit') .'</a>';



                    $html .= ' <button type="button" data-href="'.action([\App\Http\Controllers\InventaireController::class, 'destroy'], [$row->id]).'" class="tw-dw-btn tw-dw-btn-xs tw-dw-btn-outline tw-dw-btn-error delete_inventory"><i class="fa fa-trash" aria-hidden="true"></i> '. __('messages.delete') .'</button>';
                    $html .= '</ul></div>';

                    return $html;
                })
                ->editColumn('inventory_date', '{{@format_datetime($inventory_date)}}')
                ->rawColumns(['action'])
                ->make(true);
        }

        $business_id = $request->session()->get('user.business_id');
        $business_locations = BusinessLocation::forDropdown($business_id, true);

        return view('inventaire.index')->with(compact('business_locations'));
    }

    public function create(Request $request)
    {
        if (! auth()->user()->can('purchase.create')) {
            abort(403, 'Unauthorized action.');
        }

        $business_id = $request->session()->get('user.business_id');

        $business_locations = BusinessLocation::forDropdown($business_id);
        $categories = Category::forDropdown($business_id, 'product');

        return view('inventaire.create')->with(compact('business_locations', 'categories'));
    }

    public function store(Request $request)
    {
        if (! auth()->user()->can('purchase.create')) {
            abort(403, 'Unauthorized action.');
        }

        try {
            $business_id = $request->session()->get('user.business_id');
            if (! $this->moduleUtil->isSubscribed($business_id)) {
                return $this->moduleUtil->expiredResponse(action([\App\Http\Controllers\InventaireController::class, 'index']));
            }

            DB::beginTransaction();

            $user_id = $request->session()->get('user.id');
            $location_id = $request->input('location_id');
            $products = (array) $request->input('products', []);

            $inventory_date = ! empty($request->input('inventory_date')) ?
                $this->productUtil->uf_date($request->input('inventory_date'), true) :
                now()->format('Y-m-d H:i:s');

            $inventory_data = [
                'business_id' => $business_id,
                'location_id' => $location_id,
                'ref_no' => $request->input('ref_no') ?: $this->generateInventoryReference(),
                'inventory_date' => $inventory_date,
                'notes' => $request->input('additional_notes'),
                'status' => 'final',
                'created_by' => $user_id,
            ];

            $prepared_lines = $this->prepareInventoryLines($products, $business_id, $location_id);
            if ($prepared_lines->isEmpty()) {
                DB::rollBack();

                return redirect()
                    ->back()
                    ->withInput()
                    ->with('status', [
                        'success' => 0,
                        'msg' => __('inventaire.no_products_to_save'),
                    ]);
            }

            $inventory = Inventory::create($inventory_data);
            $inventory->lines()->createMany($prepared_lines->toArray());

            $adjustment_transaction_id = $this->createLinkedAdjustmentTransaction(
                $inventory,
                $prepared_lines,
                $request->session()->get('business.accounting_method')
            );
            $inventory->stock_adjustment_transaction_id = $adjustment_transaction_id;
            $inventory->save();

            DB::commit();

            return redirect()
                ->route('inventaire.index')
                ->with('status', [
                    'success' => 1,
                    'msg' => __('inventaire.created_successfully'),
                ]);
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::emergency('File:'.$e->getFile().'Line:'.$e->getLine().'Message:'.$e->getMessage());

            $msg = trans('messages.something_went_wrong');
            if (get_class($e) == \App\Exceptions\PurchaseSellMismatch::class) {
                $msg = $e->getMessage();
            }

            return redirect()
                ->back()
                ->withInput()
                ->with('status', [
                    'success' => 0,
                    'msg' => $msg,
                ]);
        }
    }

    public function show($id)
    {
        if (! auth()->user()->can('purchase.view') && ! auth()->user()->can('view_own_purchase')) {
            abort(403, 'Unauthorized action.');
        }

        $business_id = request()->session()->get('user.business_id');
        $inventory = Inventory::where('business_id', $business_id)
            ->with(['location', 'createdBy', 'lines', 'lines.variation', 'lines.variation.product', 'lines.variation.product_variation'])
            ->findOrFail($id);

        return view('inventaire.show')->with(compact('inventory'));
    }

    public function edit($id)
    {
        if (! auth()->user()->can('purchase.create')) {
            abort(403, 'Unauthorized action.');
        }

        $business_id = request()->session()->get('user.business_id');
        $inventory = Inventory::where('business_id', $business_id)
            ->with(['lines'])
            ->findOrFail($id);

        $business_locations = BusinessLocation::forDropdown($business_id);
        $categories = Category::forDropdown($business_id, 'product');
        $line_products = $this->buildLineProductsForView($inventory->lines);

        return view('inventaire.edit')->with(compact('inventory', 'business_locations', 'categories', 'line_products'));
    }

    public function update(Request $request, $id)
    {
        if (! auth()->user()->can('purchase.create')) {
            abort(403, 'Unauthorized action.');
        }

        $business_id = $request->session()->get('user.business_id');
        $inventory = Inventory::where('business_id', $business_id)->with('lines')->findOrFail($id);

        try {
            DB::beginTransaction();

            $user_id = $request->session()->get('user.id');
            $new_location_id = $request->input('location_id');
            $products = (array) $request->input('products', []);

            $prepared_lines = $this->prepareInventoryLines($products, $business_id, $new_location_id);
            if ($prepared_lines->isEmpty()) {
                DB::rollBack();

                return redirect()
                    ->back()
                    ->withInput()
                    ->with('status', [
                        'success' => 0,
                        'msg' => __('inventaire.no_products_to_save'),
                    ]);
            }

            $this->reverseAndDeleteLinkedAdjustment(
                $inventory->stock_adjustment_transaction_id,
                $inventory->location_id
            );

            $inventory_date = ! empty($request->input('inventory_date')) ?
                $this->productUtil->uf_date($request->input('inventory_date'), true) :
                $inventory->inventory_date;

            $inventory->location_id = $new_location_id;
            $inventory->ref_no = $request->input('ref_no') ?: $inventory->ref_no;
            $inventory->inventory_date = $inventory_date;
            $inventory->notes = $request->input('additional_notes');
            $inventory->updated_by = $user_id;
            $inventory->save();

            $inventory->lines()->delete();
            $inventory->lines()->createMany($prepared_lines->toArray());

            $new_transaction_id = $this->createLinkedAdjustmentTransaction(
                $inventory,
                $prepared_lines,
                $request->session()->get('business.accounting_method')
            );
            $inventory->stock_adjustment_transaction_id = $new_transaction_id;
            $inventory->save();

            DB::commit();

            return redirect()
                ->route('inventaire.index')
                ->with('status', [
                    'success' => 1,
                    'msg' => __('inventaire.updated_successfully'),
                ]);
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::emergency('File:'.$e->getFile().'Line:'.$e->getLine().'Message:'.$e->getMessage());

            return redirect()
                ->back()
                ->withInput()
                ->with('status', [
                    'success' => 0,
                    'msg' => __('messages.something_went_wrong'),
                ]);
        }
    }

    public function destroy($id)
    {
        if (! auth()->user()->can('purchase.delete')) {
            abort(403, 'Unauthorized action.');
        }

        try {
            if (request()->ajax()) {
                $business_id = request()->session()->get('user.business_id');
                $inventory = Inventory::where('business_id', $business_id)->findOrFail($id);

                DB::beginTransaction();
                $this->reverseAndDeleteLinkedAdjustment(
                    $inventory->stock_adjustment_transaction_id,
                    $inventory->location_id
                );
                $inventory->delete();
                DB::commit();

                return [
                    'success' => 1,
                    'msg' => __('inventaire.deleted_successfully'),
                ];
            }
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::emergency('File:'.$e->getFile().'Line:'.$e->getLine().'Message:'.$e->getMessage());
        }

        return [
            'success' => 0,
            'msg' => __('messages.something_went_wrong'),
        ];
    }

    public function getProductRow(Request $request)
    {
        if (! auth()->user()->can('purchase.create')) {
            abort(403, 'Unauthorized action.');
        }

        if ($request->ajax()) {
            $row_index = (int) $request->input('row_index', 0);
            $variation_id = $request->input('variation_id');
            $location_id = $request->input('location_id');
            $business_id = $request->session()->get('user.business_id');

            $product = $this->productUtil->getDetailsFromVariation($variation_id, $business_id, $location_id, false);
            $product->qty_available = $this->getLocationStock($variation_id, $location_id);
            $product->theoretical_qty = $product->qty_available;
            $product->real_qty = $product->qty_available;

            return view('inventaire.partials.product_table_row')
                ->with(compact('product', 'row_index'));
        }
    }

    public function getProductsByCategory(Request $request)
    {
        if (! auth()->user()->can('purchase.create')) {
            abort(403, 'Unauthorized action.');
        }

        if ($request->ajax()) {
            $business_id = $request->session()->get('user.business_id');
            $location_id = $request->input('location_id');
            $category_id = $request->input('category_id');
            $sub_category_id = $request->input('sub_category_id');
            $row_index = (int) $request->input('row_index', 0);

            $query = DB::table('variations')
                ->join('products as p', 'variations.product_id', '=', 'p.id')
                ->join('product_variations as pv', 'variations.product_variation_id', '=', 'pv.id')
                ->leftJoin('variation_location_details as vld', function ($join) use ($location_id) {
                    $join->on('variations.id', '=', 'vld.variation_id');
                    if (! empty($location_id)) {
                        $join->where('vld.location_id', $location_id);
                    }
                })
                ->leftJoin('units as u', 'p.unit_id', '=', 'u.id')
                ->where('p.business_id', $business_id)
                ->whereNull('variations.deleted_at')
                ->where('p.is_inactive', 0)
                ->where('p.type', '!=', 'modifier');

            if (! empty($category_id)) {
                $query->where('p.category_id', $category_id);
            }
            if (! empty($sub_category_id)) {
                $query->where('p.sub_category_id', $sub_category_id);
            }

            $products = $query->select(
                DB::raw("IF(pv.is_dummy = 0, CONCAT(p.name, ' (', pv.name, ':', variations.name, ')'), p.name) AS product_name"),
                'p.id as product_id',
                'variations.id as variation_id',
                'variations.sub_sku',
                'u.short_name as unit',
                'u.allow_decimal as unit_allow_decimal',
                DB::raw('COALESCE(vld.qty_available, 0) as qty_available'),
                DB::raw('(SELECT purchase_price_inc_tax FROM purchase_lines WHERE variation_id = variations.id ORDER BY id DESC LIMIT 1) as last_purchased_price')
            )
            ->groupBy('variations.id')
            ->orderBy('p.name', 'asc')
            ->get();

            $html = '';
            foreach ($products as $product) {
                $product->theoretical_qty = $product->qty_available;
                $product->real_qty = $product->qty_available;
                $html .= view('inventaire.partials.product_table_row')
                    ->with([
                        'product' => $product,
                        'row_index' => $row_index,
                    ])
                    ->render();
                ++$row_index;
            }

            return response()->json([
                'html' => $html,
                'next_row_index' => $row_index,
                'total_products' => $products->count(),
            ]);
        }
    }

    public function exportExcel(Request $request)
    {
        if (! auth()->user()->can('purchase.create')) {
            abort(403, 'Unauthorized action.');
        }

        $rows = $this->getCountSheetRows($request);
        if ($rows->isEmpty()) {
            return redirect()
                ->back()
                ->with('status', [
                    'success' => 0,
                    'msg' => __('inventaire.no_products_selected_for_export'),
                ]);
        }

        $filename = 'inventaire-count-sheet-'.now()->format('Y-m-d').'.xlsx';

        return Excel::download(new InventaireCountSheetExport($rows->toArray()), $filename);
    }

    public function exportPdf(Request $request)
    {
        if (! auth()->user()->can('purchase.create')) {
            abort(403, 'Unauthorized action.');
        }

        $rows = $this->getCountSheetRows($request);
        if ($rows->isEmpty()) {
            return redirect()
                ->back()
                ->with('status', [
                    'success' => 0,
                    'msg' => __('inventaire.no_products_selected_for_export'),
                ]);
        }

        $location_name = null;
        $location_id = $request->input('location_id');
        if (! empty($location_id)) {
            $location_name = BusinessLocation::find($location_id)?->name;
        }

        $html = view('inventaire.exports.count_sheet_pdf')
            ->with(compact('rows', 'location_name'))
            ->render();

        $mpdf = $this->getMpdf();
        $output_file_name = 'inventaire-count-sheet-'.now()->format('Y-m-d').'.pdf';
        $mpdf->SetTitle($output_file_name);
        $mpdf->WriteHTML($html);
        $mpdf->Output($output_file_name, 'I');
    }

    protected function getCountSheetRows(Request $request)
    {
        $inventory_id = $request->input('inventory_id');
        if (! empty($inventory_id)) {
            $business_id = $request->session()->get('user.business_id');

            return InventoryLine::join('inventories as i', 'inventory_lines.inventory_id', '=', 'i.id')
                ->join('variations', 'inventory_lines.variation_id', '=', 'variations.id')
                ->join('products as p', 'inventory_lines.product_id', '=', 'p.id')
                ->join('product_variations as pv', 'variations.product_variation_id', '=', 'pv.id')
                ->leftJoin('units as u', 'p.unit_id', '=', 'u.id')
                ->where('i.business_id', $business_id)
                ->where('inventory_lines.inventory_id', $inventory_id)
                ->select(
                    DB::raw("IF(pv.is_dummy = 0, CONCAT(p.name, ' (', pv.name, ':', variations.name, ')'), p.name) AS product_name"),
                    'variations.sub_sku',
                    'u.short_name as unit'
                )
                ->orderBy('p.name')
                ->get();
        }

        $variation_ids = $request->input('variation_ids', []);
        if (is_string($variation_ids)) {
            $decoded = json_decode($variation_ids, true);
            $variation_ids = is_array($decoded) ? $decoded : [];
        }
        $variation_ids = collect($variation_ids)->map(function ($id) {
            return (int) $id;
        })->filter()->unique()->values()->all();

        if (empty($variation_ids)) {
            return collect([]);
        }

        $business_id = $request->session()->get('user.business_id');

        return DB::table('variations')
            ->join('products as p', 'variations.product_id', '=', 'p.id')
            ->join('product_variations as pv', 'variations.product_variation_id', '=', 'pv.id')
            ->leftJoin('units as u', 'p.unit_id', '=', 'u.id')
            ->where('p.business_id', $business_id)
            ->whereIn('variations.id', $variation_ids)
            ->select(
                DB::raw("IF(pv.is_dummy = 0, CONCAT(p.name, ' (', pv.name, ':', variations.name, ')'), p.name) AS product_name"),
                'variations.sub_sku',
                'u.short_name as unit'
            )
            ->orderBy('p.name')
            ->get();
    }

    protected function prepareInventoryLines(array $products, $business_id, $location_id)
    {
        $line_by_variation = [];
        foreach ($products as $product) {
            $variation_id = isset($product['variation_id']) ? (int) $product['variation_id'] : 0;
            $product_id = isset($product['product_id']) ? (int) $product['product_id'] : 0;
            if (empty($variation_id) || empty($product_id)) {
                continue;
            }

            $theoretical_qty = null;
            if (isset($product['theoretical_qty']) && $product['theoretical_qty'] !== '') {
                $theoretical_qty = (float) $this->productUtil->num_uf($product['theoretical_qty']);
            }
            if (is_null($theoretical_qty)) {
                $theoretical_qty = $this->getLocationStock($variation_id, $location_id);
            }

            $real_qty = isset($product['real_qty']) && $product['real_qty'] !== '' ?
                (float) $this->productUtil->num_uf($product['real_qty']) :
                $theoretical_qty;

            $difference_qty = round($real_qty - $theoretical_qty, 4);
            $product_details = $this->productUtil->getDetailsFromVariation($variation_id, $business_id, $location_id, false);
            $unit_price = (float) ($product_details->last_purchased_price ?? 0);

            $line_by_variation[$variation_id] = [
                'product_id' => $product_id,
                'variation_id' => $variation_id,
                'theoretical_qty' => $theoretical_qty,
                'real_qty' => $real_qty,
                'difference_qty' => $difference_qty,
                'unit_price' => $unit_price,
            ];
        }

        return collect(array_values($line_by_variation));
    }

    protected function createLinkedAdjustmentTransaction(Inventory $inventory, $prepared_lines, $accounting_method)
    {
        $difference_lines = collect($prepared_lines)->filter(function ($line) {
            return (float) $line['difference_qty'] != 0;
        })->values();

        if ($difference_lines->isEmpty()) {
            return null;
        }

        $stock_adjustment_data = [
            'type' => 'stock_adjustment',
            'business_id' => $inventory->business_id,
            'created_by' => $inventory->updated_by ?: $inventory->created_by,
            'location_id' => $inventory->location_id,
            'adjustment_type' => 'Ajustement',
            'additional_notes' => $inventory->notes,
            'total_amount_recovered' => 0,
            'transaction_date' => $inventory->inventory_date,
        ];

        $ref_count = $this->productUtil->setAndGetReferenceCount('stock_adjustment');
        $stock_adjustment_data['ref_no'] = $inventory->ref_no;
        $stock_adjustment_data['final_total'] = collect($difference_lines)->sum(function ($line) {
            return (-1 * $line['difference_qty']) * $line['unit_price'];
        });

        $stock_adjustment = Transaction::create($stock_adjustment_data);

        $adjustment_lines = [];
        foreach ($difference_lines as $line) {
            $line_qty = round(-1 * $line['difference_qty'], 4);
            $adjustment_lines[] = [
                'product_id' => $line['product_id'],
                'variation_id' => $line['variation_id'],
                'quantity' => $line_qty,
                'unit_price' => $line['unit_price'],
            ];

            $this->productUtil->decreaseProductQuantity(
                $line['product_id'],
                $line['variation_id'],
                $inventory->location_id,
                $line_qty
            );
        }

        $created_lines = $stock_adjustment->stock_adjustment_lines()->createMany($adjustment_lines);
        $positive_lines = collect($created_lines)->filter(function ($line) {
            return (float) $line->quantity > 0;
        })->values();

        if ($positive_lines->isNotEmpty()) {
            $business = [
                'id' => $inventory->business_id,
                'accounting_method' => $accounting_method,
                'location_id' => $inventory->location_id,
            ];
            $this->transactionUtil->mapPurchaseSell($business, $positive_lines, 'stock_adjustment');
        }

        $this->transactionUtil->activityLog($stock_adjustment, 'added', null, [], false);

        return $stock_adjustment->id;
    }

    protected function reverseAndDeleteLinkedAdjustment($transaction_id, $location_id)
    {
        if (empty($transaction_id)) {
            return;
        }

        $transaction = Transaction::where('id', $transaction_id)
            ->where('type', 'stock_adjustment')
            ->with('stock_adjustment_lines')
            ->first();
        if (empty($transaction)) {
            return;
        }

        $line_ids = [];
        foreach ($transaction->stock_adjustment_lines as $line) {
            $revert_qty = -1 * (float) $line->quantity;
            $this->productUtil->decreaseProductQuantity(
                $line->product_id,
                $line->variation_id,
                $location_id,
                $revert_qty
            );
            $line_ids[] = $line->id;
        }

        if (! empty($line_ids)) {
            $this->transactionUtil->mapPurchaseQuantityForDeleteStockAdjustment($line_ids);
        }

        $transaction->delete();
    }

    protected function buildLineProductsForView($lines)
    {
        $variation_ids = collect($lines)->pluck('variation_id')->unique()->values()->all();
        if (empty($variation_ids)) {
            return collect([]);
        }

        $details = DB::table('variations')
            ->join('products as p', 'variations.product_id', '=', 'p.id')
            ->join('product_variations as pv', 'variations.product_variation_id', '=', 'pv.id')
            ->leftJoin('units as u', 'p.unit_id', '=', 'u.id')
            ->whereIn('variations.id', $variation_ids)
            ->select(
                DB::raw("IF(pv.is_dummy = 0, CONCAT(p.name, ' (', pv.name, ':', variations.name, ')'), p.name) AS product_name"),
                'p.id as product_id',
                'variations.id as variation_id',
                'variations.sub_sku',
                'u.short_name as unit',
                'u.allow_decimal as unit_allow_decimal'
            )
            ->get()
            ->keyBy('variation_id');

        $line_products = collect([]);
        foreach ($lines as $line) {
            if (! isset($details[$line->variation_id])) {
                continue;
            }
            $product = $details[$line->variation_id];
            $product->theoretical_qty = $line->theoretical_qty;
            $product->real_qty = $line->real_qty;
            $line_products->push($product);
        }

        return $line_products;
    }

    protected function getLocationStock($variation_id, $location_id)
    {
        if (empty($location_id)) {
            return 0;
        }

        return (float) (VariationLocationDetails::where('variation_id', $variation_id)
            ->where('location_id', $location_id)
            ->value('qty_available') ?? 0);
    }

    protected function generateInventoryReference()
    {
        return 'INV-'.now()->format('Ymd');
    }
}

