<?php

namespace App\Http\Controllers;

use App\MfgRecipe;
use App\Variation;
use Illuminate\Http\Request;

class ManufactureRecipeController extends Controller
{
    public function index(Request $request)
    {
        if (! auth()->user()->can('product.view') && ! auth()->user()->can('purchase.view')) {
            abort(403, 'Unauthorized action.');
        }

        $business_id = $request->session()->get('user.business_id');
        $recipes = MfgRecipe::where('business_id', $business_id)
            ->with(['finishedVariation', 'ingredients'])
            ->latest('id')
            ->paginate(20);

        return view('manufacture.recipes.index', compact('recipes'));
    }

    public function create(Request $request)
    {
        if (! auth()->user()->can('product.create') && ! auth()->user()->can('purchase.create')) {
            abort(403, 'Unauthorized action.');
        }

        $business_id = $request->session()->get('user.business_id');
        $variations = $this->variationDropdown($business_id);

        return view('manufacture.recipes.create', compact('variations'));
    }

    public function store(Request $request)
    {
        if (! auth()->user()->can('product.create') && ! auth()->user()->can('purchase.create')) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'finished_variation_id' => 'required|integer',
            'yield_quantity' => 'required|numeric|min:0.0001',
            'ingredient_variation_id' => 'required|array|min:1',
            'ingredient_variation_id.*' => 'required|integer',
            'ingredient_qty.*' => 'required|numeric|min:0.0001',
            'ingredient_wastage.*' => 'nullable|numeric|min:0',
        ]);

        $business_id = $request->session()->get('user.business_id');
        $finished_variation = Variation::where('id', $request->input('finished_variation_id'))
            ->whereHas('product', function ($query) use ($business_id) {
                $query->where('business_id', $business_id);
            })
            ->firstOrFail();

        $recipe = MfgRecipe::create([
            'business_id' => $business_id,
            'name' => $request->input('name'),
            'finished_product_id' => $finished_variation->product_id,
            'finished_variation_id' => $finished_variation->id,
            'yield_quantity' => $request->input('yield_quantity'),
            'is_active' => 1,
            'instructions' => $request->input('instructions'),
            'created_by' => $request->session()->get('user.id'),
        ]);

        $ingredient_ids = $request->input('ingredient_variation_id');
        $ingredient_qtys = $request->input('ingredient_qty');
        $ingredient_wastage = $request->input('ingredient_wastage', []);

        $rows = [];
        foreach ($ingredient_ids as $index => $variation_id) {
            $variation = Variation::where('id', $variation_id)
                ->whereHas('product', function ($query) use ($business_id) {
                    $query->where('business_id', $business_id);
                })
                ->first();

            if (empty($variation)) {
                continue;
            }

            $rows[] = [
                'product_id' => $variation->product_id,
                'variation_id' => $variation->id,
                'quantity_per_batch' => $ingredient_qtys[$index] ?? 0,
                'wastage_percent' => $ingredient_wastage[$index] ?? 0,
                'sort_order' => $index,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        if (empty($rows)) {
            $recipe->delete();

            return back()->withInput()->with('status', [
                'success' => 0,
                'msg' => __('manufacture.recipe_has_no_ingredients'),
            ]);
        }

        $recipe->ingredients()->createMany($rows);

        return redirect()->route('manufacture.recipes.index')->with('status', [
            'success' => 1,
            'msg' => __('manufacture.recipe_created_successfully'),
        ]);
    }

    public function edit(Request $request, $id)
    {
        if (! auth()->user()->can('product.create') && ! auth()->user()->can('purchase.create')) {
            abort(403, 'Unauthorized action.');
        }

        $business_id = $request->session()->get('user.business_id');
        $recipe = MfgRecipe::where('business_id', $business_id)
            ->with('ingredients')
            ->findOrFail($id);

        $variations = $this->variationDropdown($business_id);

        return view('manufacture.recipes.edit', compact('recipe', 'variations'));
    }

    public function update(Request $request, $id)
    {
        if (! auth()->user()->can('product.create') && ! auth()->user()->can('purchase.create')) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'finished_variation_id' => 'required|integer',
            'yield_quantity' => 'required|numeric|min:0.0001',
            'ingredient_variation_id' => 'required|array|min:1',
            'ingredient_variation_id.*' => 'required|integer',
            'ingredient_qty.*' => 'required|numeric|min:0.0001',
            'ingredient_wastage.*' => 'nullable|numeric|min:0',
        ]);

        $business_id = $request->session()->get('user.business_id');
        $recipe = MfgRecipe::where('business_id', $business_id)->findOrFail($id);
        $finished_variation = Variation::where('id', $request->input('finished_variation_id'))
            ->whereHas('product', function ($query) use ($business_id) {
                $query->where('business_id', $business_id);
            })
            ->firstOrFail();

        $recipe->update([
            'name' => $request->input('name'),
            'finished_product_id' => $finished_variation->product_id,
            'finished_variation_id' => $finished_variation->id,
            'yield_quantity' => $request->input('yield_quantity'),
            'is_active' => $request->has('is_active') ? 1 : 0,
            'instructions' => $request->input('instructions'),
        ]);

        $recipe->ingredients()->delete();
        $ingredient_ids = $request->input('ingredient_variation_id');
        $ingredient_qtys = $request->input('ingredient_qty');
        $ingredient_wastage = $request->input('ingredient_wastage', []);

        $rows = [];
        foreach ($ingredient_ids as $index => $variation_id) {
            $variation = Variation::where('id', $variation_id)
                ->whereHas('product', function ($query) use ($business_id) {
                    $query->where('business_id', $business_id);
                })
                ->first();

            if (empty($variation)) {
                continue;
            }

            $rows[] = [
                'product_id' => $variation->product_id,
                'variation_id' => $variation->id,
                'quantity_per_batch' => $ingredient_qtys[$index] ?? 0,
                'wastage_percent' => $ingredient_wastage[$index] ?? 0,
                'sort_order' => $index,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        $recipe->ingredients()->createMany($rows);

        return redirect()->route('manufacture.recipes.index')->with('status', [
            'success' => 1,
            'msg' => __('manufacture.recipe_updated_successfully'),
        ]);
    }

    public function destroy(Request $request, $id)
    {
        if (! auth()->user()->can('product.delete') && ! auth()->user()->can('purchase.delete')) {
            abort(403, 'Unauthorized action.');
        }

        $business_id = $request->session()->get('user.business_id');
        $recipe = MfgRecipe::where('business_id', $business_id)->findOrFail($id);

        if ($recipe->work_orders()->count() > 0) {
            return back()->with('status', [
                'success' => 0,
                'msg' => __('manufacture.recipe_used_in_work_orders'),
            ]);
        }

        $recipe->delete();

        return redirect()->route('manufacture.recipes.index')->with('status', [
            'success' => 1,
            'msg' => __('manufacture.recipe_deleted_successfully'),
        ]);
    }

    private function variationDropdown($business_id)
    {
        return Variation::join('products', 'variations.product_id', '=', 'products.id')
            ->leftJoin('product_variations as pv', 'variations.product_variation_id', '=', 'pv.id')
            ->where('products.business_id', $business_id)
            ->whereNull('variations.deleted_at')
            ->select(
                'variations.id',
                'products.name as product_name',
                'variations.name as variation_name',
                'pv.name as template_name',
                'variations.sub_sku'
            )
            ->orderBy('products.name')
            ->get()
            ->mapWithKeys(function ($row) {
                $name = $row->product_name;
                if (! empty($row->template_name) && $row->template_name !== 'DUMMY') {
                    $name .= ' - ' . $row->template_name;
                }
                if (! empty($row->variation_name) && $row->variation_name !== 'DUMMY') {
                    $name .= ' - ' . $row->variation_name;
                }
                if (! empty($row->sub_sku)) {
                    $name .= ' (' . $row->sub_sku . ')';
                }

                return [$row->id => $name];
            });
    }
}

