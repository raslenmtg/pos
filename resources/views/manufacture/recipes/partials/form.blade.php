<div class="row">
    <div class="col-sm-4">
        <div class="form-group">
            {!! Form::label('name', __('manufacture.recipe_name') . ':*') !!}
            {!! Form::text('name', $recipe->name ?? null, ['class' => 'form-control', 'required']) !!}
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            {!! Form::label('finished_variation_id', __('manufacture.finished_product') . ':*') !!}
            {!! Form::select('finished_variation_id', $variations, $recipe->finished_variation_id ?? null, ['class' => 'form-control select2', 'required', 'placeholder' => __('messages.please_select')]) !!}
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            {!! Form::label('yield_quantity', __('manufacture.yield_quantity') . ':*') !!}
            {!! Form::text('yield_quantity', isset($recipe) ? @num_format($recipe->yield_quantity) : 1, ['class' => 'form-control input_number', 'required']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <h4>@lang('manufacture.ingredients')</h4>
        <table class="table table-bordered" id="ingredient_table">
            <thead>
                <tr>
                    <th>@lang('manufacture.ingredient')</th>
                    <th>@lang('manufacture.quantity_per_batch')</th>
                    <th>@lang('manufacture.wastage_percent')</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @php
                    $ingredient_rows = old('ingredient_variation_id') ? count(old('ingredient_variation_id')) : (isset($recipe) ? $recipe->ingredients->count() : 1);
                @endphp
                @for($i = 0; $i < $ingredient_rows; $i++)
                    @php
                        $row = isset($recipe) && isset($recipe->ingredients[$i]) ? $recipe->ingredients[$i] : null;
                        $old_var = old('ingredient_variation_id.' . $i, $row->variation_id ?? null);
                        $old_qty = old('ingredient_qty.' . $i, isset($row) ? $row->quantity_per_batch : null);
                        $old_waste = old('ingredient_wastage.' . $i, isset($row) ? $row->wastage_percent : 0);
                    @endphp
                    <tr>
                        <td>{!! Form::select('ingredient_variation_id[]', $variations, $old_var, ['class' => 'form-control select2', 'required']) !!}</td>
                        <td>{!! Form::text('ingredient_qty[]', $old_qty, ['class' => 'form-control input_number', 'required']) !!}</td>
                        <td>{!! Form::text('ingredient_wastage[]', $old_waste, ['class' => 'form-control input_number']) !!}</td>
                        <td><button type="button" class="tw-dw-btn tw-dw-btn-xs tw-dw-btn-outline tw-dw-btn-error remove_ingredient_row"><i class="fa fa-trash"></i></button></td>
                    </tr>
                @endfor
            </tbody>
        </table>
        <button type="button" class="tw-dw-btn tw-dw-btn-sm tw-dw-btn-primary tw-text-white" id="add_ingredient_row">@lang('messages.add')</button>
    </div>
</div>

<div class="row">
    <div class="col-sm-8">
        <div class="form-group">
            {!! Form::label('instructions', __('manufacture.instructions') . ':') !!}
            {!! Form::textarea('instructions', $recipe->instructions ?? null, ['class' => 'form-control', 'rows' => 3]) !!}
        </div>
    </div>
    @if(isset($recipe))
        <div class="col-sm-4">
            <div class="form-group">
                <label>
                    {!! Form::checkbox('is_active', 1, (bool) $recipe->is_active, ['class' => 'input-icheck']) !!}
                    @lang('manufacture.is_active')
                </label>
            </div>
        </div>
    @endif
</div>

