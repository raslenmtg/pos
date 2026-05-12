@extends('layouts.app')
@section('title', __('manufacture.all_recipes'))

@section('content')
<section class="content-header">
    <h1 class="tw-text-xl md:tw-text-3xl tw-font-bold tw-text-black">@lang('manufacture.all_recipes')</h1>
</section>

<section class="content">
    @component('components.widget', ['class' => 'box-primary'])
        @slot('tool')
            @if(auth()->user()->can('product.create') || auth()->user()->can('purchase.create'))
                <a class="tw-dw-btn tw-dw-btn-primary tw-text-white pull-right" href="{{ route('manufacture.recipes.create') }}">
                    @lang('manufacture.add_recipe')
                </a>
            @endif
        @endslot

        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>@lang('messages.action')</th>
                        <th>@lang('manufacture.recipe_name')</th>
                        <th>@lang('manufacture.finished_product')</th>
                        <th>@lang('manufacture.yield_quantity')</th>
                        <th>@lang('manufacture.ingredients')</th>
                        <th>@lang('manufacture.status')</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recipes as $recipe)
                        <tr>
                            <td>
                                <a class="tw-dw-btn tw-dw-btn-xs tw-dw-btn-outline tw-dw-btn-primary" href="{{ route('manufacture.recipes.edit', $recipe->id) }}">
                                    @lang('messages.edit')
                                </a>
                                <form action="{{ route('manufacture.recipes.destroy', $recipe->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="tw-dw-btn tw-dw-btn-xs tw-dw-btn-outline tw-dw-btn-error" onclick="return confirm('@lang('messages.sure')')">
                                        @lang('messages.delete')
                                    </button>
                                </form>
                            </td>
                            <td>{{ $recipe->name }}</td>
                            <td>{{ optional($recipe->finishedVariation)->full_name }}</td>
                            <td>{{ @format_quantity($recipe->yield_quantity) }}</td>
                            <td>{{ $recipe->ingredients->count() }}</td>
                            <td>{{ $recipe->is_active ? __('manufacture.is_active') : __('manufacture.inactive') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">@lang('messages.no_data')</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{ $recipes->links() }}
    @endcomponent
</section>
@stop

