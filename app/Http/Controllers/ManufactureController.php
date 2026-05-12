<?php

namespace App\Http\Controllers;

use App\BusinessLocation;
use App\MfgRecipe;
use App\MfgWorkOrder;
use App\TransactionSellLinesPurchaseLines;
use App\Services\ManufacturingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ManufactureController extends Controller
{
    protected $manufacturingService;

    public function __construct(ManufacturingService $manufacturingService)
    {
        $this->manufacturingService = $manufacturingService;
    }

    public function index(Request $request)
    {
        if (! auth()->user()->can('purchase.view') && ! auth()->user()->can('view_own_purchase') && ! auth()->user()->can('purchase.create')) {
            abort(403, 'Unauthorized action.');
        }

        $business_id = $request->session()->get('user.business_id');
        $query = MfgWorkOrder::where('business_id', $business_id)
            ->with(['recipe.finishedVariation', 'location'])
            ->latest('id');

        if (! auth()->user()->can('purchase.view') && auth()->user()->can('view_own_purchase')) {
            $query->where('created_by', $request->session()->get('user.id'));
        }

        $work_orders = $query->paginate(20);

        return view('manufacture.work_orders.index', compact('work_orders'));
    }

    public function create(Request $request)
    {
        if (! auth()->user()->can('purchase.create')) {
            abort(403, 'Unauthorized action.');
        }

        $business_id = $request->session()->get('user.business_id');
        $business_locations = BusinessLocation::forDropdown($business_id);
        $recipes = MfgRecipe::where('business_id', $business_id)
            ->where('is_active', 1)
            ->with('finishedVariation')
            ->orderBy('name')
            ->get();

        return view('manufacture.work_orders.create', compact('business_locations', 'recipes'));
    }

    public function store(Request $request)
    {
        if (! auth()->user()->can('purchase.create')) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'recipe_id' => 'required|integer',
            'location_id' => 'required|integer',
            'planned_output_qty' => 'required|numeric|min:0.0001',
            'overhead_cost' => 'nullable|numeric|min:0',
            'wastage_cost' => 'nullable|numeric|min:0',
        ]);

        $business_id = $request->session()->get('user.business_id');
        $recipe = MfgRecipe::where('business_id', $business_id)
            ->with(['ingredients', 'finishedVariation'])
            ->findOrFail($request->input('recipe_id'));

        if ($recipe->ingredients->isEmpty()) {
            return back()->withInput()->with('status', [
                'success' => 0,
                'msg' => __('manufacture.recipe_has_no_ingredients'),
            ]);
        }

        $planned_output_qty = (float) $request->input('planned_output_qty');
        $ratio = $planned_output_qty / max((float) $recipe->yield_quantity, 0.0001);

        $work_order = MfgWorkOrder::create([
            'business_id' => $business_id,
            'location_id' => $request->input('location_id'),
            'recipe_id' => $recipe->id,
            'ref_no' => $this->generateWorkOrderRef($business_id),
            'status' => 'draft',
            'started_at' => now(),
            'planned_output_qty' => $planned_output_qty,
            'produced_output_qty' => 0,
            'overhead_cost' => $request->input('overhead_cost', 0),
            'wastage_cost' => $request->input('wastage_cost', 0),
            'notes' => $request->input('notes'),
            'created_by' => $request->session()->get('user.id'),
        ]);

        $ingredients = [];
        foreach ($recipe->ingredients as $ingredient) {
            $base_qty = (float) $ingredient->quantity_per_batch * $ratio;
            $required_qty = $base_qty + ($base_qty * ((float) $ingredient->wastage_percent / 100));
            $ingredients[] = [
                'product_id' => $ingredient->product_id,
                'variation_id' => $ingredient->variation_id,
                'quantity_per_batch' => $ingredient->quantity_per_batch,
                'required_quantity' => $required_qty,
                'wastage_percent' => $ingredient->wastage_percent,
                'consumed_quantity' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        $work_order->ingredients()->createMany($ingredients);

        return redirect()->route('manufacture.index')->with('status', [
            'success' => 1,
            'msg' => __('manufacture.work_order_created_successfully'),
        ]);
    }

    public function show(Request $request, $id)
    {
        if (! auth()->user()->can('purchase.view') && ! auth()->user()->can('view_own_purchase') && ! auth()->user()->can('purchase.create')) {
            abort(403, 'Unauthorized action.');
        }

        $business_id = $request->session()->get('user.business_id');
        $work_order = MfgWorkOrder::where('business_id', $business_id)
            ->with(['recipe.finishedVariation', 'ingredients.variation.product', 'location', 'consumptionTransaction', 'productionTransaction'])
            ->findOrFail($id);

        return view('manufacture.work_orders.show', compact('work_order'));
    }

    public function complete(Request $request, $id)
    {
        if (! auth()->user()->can('purchase.create')) {
            abort(403, 'Unauthorized action.');
        }

        $business_id = $request->session()->get('user.business_id');
        $work_order = MfgWorkOrder::where('business_id', $business_id)
            ->with(['recipe.finishedVariation', 'ingredients'])
            ->findOrFail($id);

        if ($work_order->status !== 'draft') {
            return back()->with('status', [
                'success' => 0,
                'msg' => __('manufacture.only_draft_can_be_completed'),
            ]);
        }

        $result = $this->manufacturingService->completeWorkOrder(
            $work_order,
            $request->session()->get('user.id'),
            $request->session()->get('business.accounting_method')
        );

        return redirect()->route('manufacture.show', $work_order->id)->with('status', $result);
    }

    public function destroy(Request $request, $id)
    {
        if (! auth()->user()->can('purchase.delete')) {
            abort(403, 'Unauthorized action.');
        }

        $business_id = $request->session()->get('user.business_id');
        $work_order = MfgWorkOrder::where('business_id', $business_id)->findOrFail($id);

        if ($work_order->status !== 'draft') {
            return back()->with('status', [
                'success' => 0,
                'msg' => __('manufacture.only_draft_can_be_deleted'),
            ]);
        }

        $work_order->delete();

        return redirect()->route('manufacture.index')->with('status', [
            'success' => 1,
            'msg' => __('manufacture.work_order_deleted_successfully'),
        ]);
    }

    public function report(Request $request)
    {
        if (! auth()->user()->can('purchase.view') && ! auth()->user()->can('view_own_purchase') && ! auth()->user()->can('purchase.create')) {
            abort(403, 'Unauthorized action.');
        }

        $business_id = $request->session()->get('user.business_id');
        $query = MfgWorkOrder::where('business_id', $business_id)
            ->with(['recipe.finishedVariation', 'location'])
            ->where('status', 'completed')
            ->latest('completed_at');

        if (! auth()->user()->can('purchase.view') && auth()->user()->can('view_own_purchase')) {
            $query->where('created_by', $request->session()->get('user.id'));
        }

        $work_orders = $query->paginate(20);
        $summary = MfgWorkOrder::where('business_id', $business_id)
            ->where('status', 'completed')
            ->select(
                DB::raw('COUNT(*) as total_orders'),
                DB::raw('COALESCE(SUM(produced_output_qty),0) as total_output_qty'),
                DB::raw('COALESCE(SUM(total_ingredient_cost),0) as total_ingredient_cost'),
                DB::raw('COALESCE(SUM(overhead_cost),0) as total_overhead_cost'),
                DB::raw('COALESCE(SUM(wastage_cost),0) as total_wastage_cost'),
                DB::raw('COALESCE(SUM(total_cost),0) as total_cost')
            )
            ->first();

        // mapping traceability metric (how much ingredient consumption was mapped to purchase lines).
        $mapped_rows = TransactionSellLinesPurchaseLines::join('transaction_sell_lines as tsl', 'transaction_sell_lines_purchase_lines.sell_line_id', '=', 'tsl.id')
            ->join('transactions as t', 'tsl.transaction_id', '=', 't.id')
            ->where('t.business_id', $business_id)
            ->where('t.type', 'production_sell')
            ->count();

        return view('manufacture.work_orders.report', compact('work_orders', 'summary', 'mapped_rows'));
    }

    private function generateWorkOrderRef($business_id)
    {
        $count = MfgWorkOrder::where('business_id', $business_id)
            ->whereDate('created_at', now()->toDateString())
            ->count() + 1;

        return 'OF-' . now()->format('Ymd') . '-' . str_pad((string) $count, 4, '0', STR_PAD_LEFT);
    }
}

