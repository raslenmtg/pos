@extends('layouts.app')
@section('title', __('manufacture.add_recipe'))

@section('content')
<section class="content-header">
    <h1 class="tw-text-xl md:tw-text-3xl tw-font-bold tw-text-black">@lang('manufacture.add_recipe')</h1>
</section>

<section class="content">
    {!! Form::open(['url' => route('manufacture.recipes.store'), 'method' => 'post', 'id' => 'mfg_recipe_form']) !!}
    @component('components.widget', ['class' => 'box-primary'])
        @include('manufacture.recipes.partials.form')
        <div class="row">
            <div class="col-sm-12 text-center">
                <button type="submit" class="tw-dw-btn tw-dw-btn-primary tw-text-white">@lang('messages.save')</button>
            </div>
        </div>
    @endcomponent
    {!! Form::close() !!}
</section>
@stop

@section('javascript')
<script>
    function ingredientRowHtml() {
        var options = @json($variations);
        var select = '<select name="ingredient_variation_id[]" class="form-control select2" required>';
        Object.keys(options).forEach(function(key){ select += '<option value="'+key+'">'+options[key]+'</option>'; });
        select += '</select>';
        return '<tr><td>'+select+'</td><td><input type="text" name="ingredient_qty[]" class="form-control input_number" required></td><td><input type="text" name="ingredient_wastage[]" class="form-control input_number" value="0"></td><td><button type="button" class="tw-dw-btn tw-dw-btn-xs tw-dw-btn-outline tw-dw-btn-error remove_ingredient_row"><i class="fa fa-trash"></i></button></td></tr>';
    }
    $(document).on('click', '#add_ingredient_row', function(){ $('#ingredient_table tbody').append(ingredientRowHtml()); $('.select2').select2(); });
    $(document).on('click', '.remove_ingredient_row', function(){ if ($('#ingredient_table tbody tr').length > 1) { $(this).closest('tr').remove(); } });
</script>
@endsection

