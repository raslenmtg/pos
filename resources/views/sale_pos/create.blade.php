@extends('layouts.app')

@section('title', __('sale.pos_sale'))

@section('content')
    <section class="content no-print pos-modern">
        <input type="hidden" id="amount_rounding_method" value="{{ $pos_settings['amount_rounding_method'] ?? '' }}">
        @if (!empty($pos_settings['allow_overselling']))
            <input type="hidden" id="is_overselling_allowed">
        @endif
        @if (session('business.enable_rp') == 1)
            <input type="hidden" id="reward_point_enabled">
        @endif
        @if ($business_details->enable_timbre)
            <input type="hidden" id="timbre_value" value="{{ $business_details->timbre_value }}">
        @endif
        @php
            $is_discount_enabled = $pos_settings['disable_discount'] != 1 ? true : false;
            $is_rp_enabled = session('business.enable_rp') == 1 ? true : false;
        @endphp
        {!! Form::open([
            'url' => action([\App\Http\Controllers\SellPosController::class, 'store']),
            'method' => 'post',
            'id' => 'add_pos_sell_form',
        ]) !!}
        @csrf
        <div class="pos-shell">
            <header class="pos-shell-header">
    <div class="pos-top-left">
        <div class="pos-location"><span>Location:</span><strong>{{ $default_location->name ?? '-' }}</strong></div>
        <div class="pos-date">{{ $default_datetime ?? now()->format('m/d/Y H:i') }} <i class="far fa-calendar-alt"></i></div>
    </div>
    <div class="pos-top-actions">
        <button type="button" class="pos-tool-btn" title="Back"><i class="fas fa-chevron-left"></i></button>
        <button type="button" class="pos-tool-btn" title="Undo"><i class="fas fa-undo"></i></button>
        <button type="button" class="pos-tool-btn" title="Pause"><i class="fas fa-pause"></i></button>
        <button type="button" class="pos-tool-btn pos-tool-green" title="Register"><i class="fas fa-briefcase"></i></button>
        <button type="button" class="pos-tool-btn pos-tool-danger" title="Close"><i class="fas fa-power-off"></i></button>
        <button type="button" class="pos-tool-btn" title="Calculator"><i class="fas fa-calculator"></i></button>
        <button type="button" class="pos-tool-btn" title="Fullscreen"><i class="fas fa-expand"></i></button>
        <button type="button" class="pos-tool-btn" title="Display"><i class="fas fa-desktop"></i></button>
        <button type="button" class="pos-expense-btn" data-toggle="modal" data-target="#expense_modal"><i class="fas fa-minus-circle"></i> Add Expense</button>
        <button type="button" class="pos-mobile-products" data-toggle="modal" data-target="#mobile_product_suggestion_modal"><i class="fas fa-th-large"></i><span>Products</span></button>
        <button type="button" class="pos-header-icon" data-toggle="modal" data-target="#recent_transactions_modal"><i class="fas fa-history"></i></button>
    </div>
</header><div class="pos-workspace">
                
                    {{-- <div class="@if (empty($pos_settings['hide_product_suggestion'])) col-md-7 @else col-md-10 col-md-offset-1 @endif no-padding pr-12"> --}}
                    <div class="pos-cart-panel">

                        <div class="pos-cart-card">

                            {{-- <div class="box box-solid mb-12 @if (!isMobile()) mb-40 @endif"> --}}
                                <div class="box-body pb-0">
                                    {!! Form::hidden('location_id', $default_location->id ?? null, [
                                        'id' => 'location_id',
                                        'data-receipt_printer_type' => !empty($default_location->receipt_printer_type)
                                            ? $default_location->receipt_printer_type
                                            : 'browser',
                                        'data-default_payment_accounts' => $default_location->default_payment_accounts ?? '',
                                    ]) !!}
                                    <!-- sub_type -->
                                    {!! Form::hidden('sub_type', isset($sub_type) ? $sub_type : null) !!}
                                    <input type="hidden" id="item_addition_method"
                                        value="{{ $business_details->item_addition_method }}">
                                    @include('sale_pos.partials.pos_form')

                                    @include('sale_pos.partials.pos_form_totals')

                                    @include('sale_pos.partials.payment_modal')

                                    @if (empty($pos_settings['disable_suspend']))
                                        @include('sale_pos.partials.suspend_note_modal')
                                    @endif

                                    @if (empty($pos_settings['disable_recurring_invoice']))
                                        @include('sale_pos.partials.recurring_invoice_modal')
                                    @endif
                                </div>
                            {{-- </div> --}}
                        </div>
                    </div>
                    @if (empty($pos_settings['hide_product_suggestion']) && !isMobile())
                        <aside class="pos-products-panel"><div class="pos-catalog-card"><div class="pos-catalog-header"><div><span class="pos-section-eyebrow">CATALOG</span><h2>Products</h2></div></div>@include("sale_pos.partials.pos_sidebar")</div></aside>
                    @endif
                </div>
            </div>
        </div>
        @include('sale_pos.partials.pos_form_actions')
        {!! Form::close() !!}
    </section>

    <!-- This will be printed -->
    <section class="invoice print_section" id="receipt_section">
    </section>
    <div class="modal fade contact_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
        @include('contact.create', ['quick_add' => true])
    </div>
    @if (empty($pos_settings['hide_product_suggestion']) && isMobile())
        @include('sale_pos.partials.mobile_product_suggestions')
    @endif
    <!-- /.content -->
    <div class="modal fade register_details_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
    </div>
    <div class="modal fade close_register_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
    </div>
    <!-- quick product modal -->
    <div class="modal fade quick_add_product_modal" tabindex="-1" role="dialog" aria-labelledby="modalTitle"></div>

    <div class="modal fade" id="expense_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
    </div>

    @include('sale_pos.partials.configure_search_modal')

    @include('sale_pos.partials.recent_transactions_modal')

    @include('sale_pos.partials.weighing_scale_modal')

@stop
@section('css')
<style>
:root{--pos-bg:#eef2f6;--pos-surface:#fff;--pos-ink:#182230;--pos-muted:#748093;--pos-line:#e3e8ef;--pos-success:#0d8a62}
.pos-modern{background:var(--pos-bg);min-height:calc(100vh - 50px);padding:14px;color:var(--pos-ink)}
.pos-shell{max-width:1900px;margin:auto}
.pos-shell-header{height:70px;background:#fff;border:1px solid var(--pos-line);border-radius:14px;padding:0 16px 0 18px;display:flex;align-items:center;justify-content:space-between;box-shadow:0 4px 18px rgba(24,34,48,.05);margin-bottom:14px}
.pos-branding{display:flex;align-items:center;gap:11px}.pos-brand-mark{width:40px;height:40px;border-radius:11px;background:#182230;color:#fff;display:flex;align-items:center;justify-content:center}.pos-kicker,.pos-section-eyebrow{font-size:9px;font-weight:800;letter-spacing:.13em;color:#96a0af}.pos-branding h1{font-size:18px;line-height:1;margin:3px 0 0;font-weight:750}.pos-context{display:flex;align-items:center;gap:15px}.pos-context-item{display:flex;align-items:center;gap:8px}.pos-context-item small{display:block;font-size:8px;font-weight:800;letter-spacing:.1em;color:#9aa4b2}.pos-context-item strong{display:block;font-size:12px;margin-top:2px}.pos-context-icon{width:32px;height:32px;border:1px solid var(--pos-line);border-radius:9px;display:flex;align-items:center;justify-content:center;color:#5c6878}.pos-context-divider{height:28px;width:1px;background:var(--pos-line)}.pos-mobile-products{display:none;height:38px;border:1px solid var(--pos-line);background:#fff;border-radius:9px;color:#3157d5;padding:0 10px;font-size:11px;font-weight:700}.pos-mobile-products i{margin-right:4px}
.pos-header-icon{width:38px;height:38px;border:1px solid var(--pos-line);background:#fff;border-radius:9px;color:#526071}
.pos-workspace{display:grid;grid-template-columns:minmax(480px,.9fr) minmax(560px,1.35fr);gap:14px;align-items:stretch}.pos-cart-panel,.pos-products-panel{min-width:0}.pos-cart-card,.pos-catalog-card{background:#fff;border:1px solid var(--pos-line);border-radius:14px;box-shadow:0 5px 22px rgba(24,34,48,.055)}.pos-cart-card{height:calc(100vh - 150px);min-height:620px;padding:16px;display:flex;flex-direction:column;overflow:hidden}.pos-cart-card .box-body{height:100%;min-height:0;display:flex;flex-direction:column;padding:0!important}.pos-catalog-card{height:calc(100vh - 150px);min-height:620px;padding:14px;overflow:hidden;display:flex;flex-direction:column}.pos-catalog-header{display:flex;justify-content:space-between;align-items:center;padding:2px 3px 13px;border-bottom:1px solid var(--pos-line);margin-bottom:11px}.pos-catalog-header h2{font-size:17px;margin:3px 0 0;font-weight:750}
.pos-modern .pos-toolbar{display:grid;grid-template-columns:minmax(190px,.72fr) minmax(300px,1.28fr);gap:9px;margin:0 0 13px}.pos-modern .pos-toolbar>[class*=col-]{width:auto!important;padding:0;margin:0}.pos-modern .pos-toolbar .form-group{margin:0}.pos-modern .pos-toolbar .input-group{width:100%;display:flex}.pos-modern .pos-toolbar .input-group-addon,.pos-modern .pos-toolbar .input-group-btn .btn,.pos-modern .pos-toolbar .form-control,.pos-modern .pos-toolbar .select2-container .select2-selection--single{height:46px;border-color:var(--pos-line);background:#f8fafc;box-shadow:none}.pos-modern .pos-toolbar .input-group-addon{min-width:43px;display:flex;align-items:center;justify-content:center;border-radius:9px 0 0 9px;color:#657286}.pos-modern .pos-toolbar .input-group-btn .btn{background:#fff;border-radius:0;border-left:0}.pos-modern .pos-toolbar .input-group-btn:last-child .btn:last-child{border-radius:0 9px 9px 0}.pos-modern #customer_id,.pos-modern #search_product{font-size:13px;font-weight:600}.pos-modern #search_product{background:#fff}.pos-modern #search_product::placeholder{color:#a2abb7}
.pos-modern .pos_product_div{height:100%;min-height:0;display:flex;flex-direction:column}.pos-modern #pos_table{width:100%;margin:0;border:0!important;border-collapse:separate;border-spacing:0 6px;table-layout:fixed}.pos-modern #pos_table thead th{background:#f7f9fb;border:0!important;color:#8b96a6;font-size:9px!important;text-transform:uppercase;letter-spacing:.08em;font-weight:800;padding:9px 8px!important}.pos-modern #pos_table tbody tr.product_row td{border-top:1px solid var(--pos-line)!important;border-bottom:1px solid var(--pos-line)!important;border-left:0!important;border-right:0!important;padding:8px 7px!important;vertical-align:middle}.pos-modern #pos_table tbody tr.product_row td:first-child{border-left:1px solid var(--pos-line)!important;border-radius:10px 0 0 10px}.pos-modern #pos_table tbody tr.product_row td:last-child{border-right:1px solid var(--pos-line)!important;border-radius:0 10px 10px 0}.pos-modern #pos_table tbody tr.product_row:hover td{background:#fbfcff}.pos-modern #pos_table img{border-radius:8px!important;border:1px solid #edf0f4!important}.pos-modern .product_row .input-number{max-width:125px;margin:auto}.pos-modern .product_row .input-number .btn,.pos-modern .product_row .pos_quantity{height:34px;border-color:var(--pos-line);background:#fff;box-shadow:none}.pos-modern .product_row .pos_quantity{text-align:center;font-weight:750}.pos-modern .product_row .pos_line_total_text{font-weight:800;color:#253244}.pos-modern .product_row .pos_remove_row{width:32px;height:32px;border:0;border-radius:8px;background:#fff1f2;color:#cf4550;display:inline-flex;align-items:center;justify-content:center}
.pos-modern .pos_form_totals{margin-top:auto;padding-top:11px;border-top:1px solid var(--pos-line)}.pos-modern .pos_form_totals table{width:100%;margin:0;border:0;background:#f8fafc;border-radius:10px}.pos-modern .pos_form_totals td{border:0!important;padding:8px 10px!important;color:var(--pos-muted);font-size:11px}.pos-modern .pos_form_totals b{font-size:11px!important;color:#697588}.pos-modern .pos_form_totals .price_total,.pos-modern #total_discount,.pos-modern #order_tax,.pos-modern #shipping_charges_amount{font-weight:750;color:#273345}
.pos-modern .pos-form-actions{margin:0!important;border:0!important;border-top:1px solid var(--pos-line)!important;border-radius:0!important;background:#fff!important;box-shadow:none!important;position:static!important}.pos-modern .pos-form-actions>div{min-height:70px;padding:10px 0!important}.pos-modern .pos-form-actions button{border-radius:9px!important;min-height:40px}.pos-modern .pos-form-actions .pos-total{border-left:1px solid var(--pos-line);padding-left:16px}.pos-modern #total_payable{color:var(--pos-success)!important;font-size:20px!important}.pos-modern #pos-finalize{background:#182230!important}.pos-modern .pos-express-finalize[data-pay_method=cash]{background:var(--pos-success)!important}
.pos-modern .pos-catalog-card #product_list_body{flex:1;min-height:0;overflow-y:auto;padding:1px 2px 12px}.pos-modern .pos-catalog-card .eq-height-row{margin:0 -5px}.pos-modern .pos-catalog-card .eq-height-row>[class*=col-]{padding:5px}.pos-modern .pos-catalog-card .tw-dw-card{border:1px solid var(--pos-line)!important;border-radius:11px!important;box-shadow:none!important;background:#fff!important;transition:.15s}.pos-modern .pos-catalog-card .tw-dw-card:hover{border-color:#b8c5df!important;box-shadow:0 6px 16px rgba(49,87,213,.09)!important;transform:translateY(-1px)}.pos-modern .pos-catalog-card .tw-dw-card-body{padding:10px!important}.pos-modern .pos-catalog-card .tw-dw-drawer-content label{height:40px!important;min-height:40px!important;border-radius:9px!important;background:#f7f9fc!important;border:1px solid var(--pos-line)!important;color:#445164!important;box-shadow:none!important}.pos-modern .pos-catalog-card .tw-dw-drawer-content label.tw-bg-gradient-to-r{background:#f7f9fc!important;color:#445164!important}
@media(max-width:1200px) and (min-width:769px){.pos-workspace{grid-template-columns:minmax(400px,.85fr) minmax(430px,1fr)}.pos-modern{padding:10px}.pos-cart-card,.pos-catalog-card{min-height:560px;height:calc(100vh - 130px)}.pos-modern .pos-toolbar{grid-template-columns:1fr}}
.pos-modern .pos-product-card{height:184px;border:1px solid var(--pos-line);border-radius:12px;background:#fff;overflow:hidden;cursor:pointer;display:flex;flex-direction:column;transition:transform .15s,box-shadow .15s,border-color .15s}.pos-modern .pos-product-card:hover{transform:translateY(-2px);box-shadow:0 8px 20px rgba(24,34,48,.09);border-color:#c6d0e0}.pos-modern .pos-product-image{height:108px;width:100%;background-color:#fafbfd;border-bottom:1px solid #eef1f5}.pos-modern .pos-product-info{padding:8px 9px;min-width:0}.pos-modern .pos-product-name{font-size:11px;font-weight:700;line-height:1.25;color:#263345;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}.pos-modern .pos-product-name span{font-weight:600;color:#687587}.pos-modern .pos-product-sku{font-size:9px;color:#99a3b0;margin-top:3px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}.pos-modern .pos-product-meta{display:flex;justify-content:space-between;align-items:center;gap:5px;margin-top:6px;font-size:9px;color:#8490a0}.pos-modern .pos-product-meta strong{font-size:10px;color:#3157d5}.pos-modern .pos-empty-products{height:220px;display:flex;flex-direction:column;align-items:center;justify-content:center;color:#8792a1;gap:5px}.pos-modern .pos-empty-products i{font-size:30px;color:#bdc5d0;margin-bottom:4px}.pos-modern .pos-empty-products strong{color:#596678}.pos-modern .pos-empty-products span{font-size:11px}.pos-modern #product_category_div,.pos-modern #product_brand_div{padding:0 4px!important}.pos-modern .pos-catalog-card .tw-dw-drawer-content{width:100%}.pos-modern .pos-catalog-card .tw-dw-drawer-content label{font-size:11px!important;font-weight:700!important}.pos-modern .pos-catalog-card .tw-dw-drawer-content label svg{margin-right:3px}.pos-modern .pos-catalog-card .tw-dw-drawer-side .tw-dw-menu{background:#fff}.pos-modern .pos-catalog-card .tw-dw-drawer-side .tw-dw-card{min-height:70px}.pos-modern #featured_products_box{margin:0}.pos-modern #feature_product_div{display:none!important}
@media(max-width:768px){.pos-mobile-products{display:block}.pos-modern{padding:7px 7px 84px;min-height:100vh}.pos-shell-header{height:56px;border-radius:11px;padding:0 10px;margin-bottom:8px}.pos-brand-mark{width:34px;height:34px;border-radius:9px;font-size:14px}.pos-branding{gap:8px}.pos-kicker{font-size:7px}.pos-branding h1{font-size:15px}.pos-context-item:not(:first-child),.pos-context-divider{display:none}.pos-context{gap:6px}.pos-context-item small{display:none}.pos-context-item strong{font-size:10px;max-width:85px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}.pos-context-icon{width:30px;height:30px}.pos-header-icon{width:32px;height:32px}.pos-workspace{display:block}.pos-cart-card{height:auto;min-height:0;padding:9px;border-radius:11px;overflow:visible}.pos-cart-card .box-body{height:auto}.pos-products-panel{display:none}.pos-modern .pos-toolbar{display:flex;flex-direction:column;gap:7px;margin-bottom:9px}.pos-modern .pos-toolbar>[class*=col-]{width:100%!important}.pos-modern .pos-toolbar .form-control,.pos-modern .pos-toolbar .input-group-addon,.pos-modern .pos-toolbar .input-group-btn .btn{height:46px}.pos-modern #pos_table{font-size:11px}.pos-modern #pos_table thead th{padding:7px 4px!important;font-size:8px!important}.pos-modern #pos_table thead th:nth-child(3),.pos-modern #pos_table tbody td:nth-child(3),.pos-modern #pos_table thead th:nth-child(4),.pos-modern #pos_table tbody td:nth-child(4){display:none}.pos-modern #pos_table tbody tr.product_row td{padding:7px 4px!important}.pos-modern #pos_table img{width:38px!important;height:38px!important}.pos-modern .product_row .input-number{max-width:105px}.pos-modern .pos_form_totals{padding-top:8px}.pos-modern .pos_form_totals td{padding:6px 5px!important;font-size:10px}.pos-modern .pos-form-actions{position:fixed!important;left:7px;right:7px;bottom:7px;z-index:1100;border:1px solid var(--pos-line)!important;border-radius:12px!important;box-shadow:0 7px 24px rgba(24,34,48,.15)!important}.pos-modern .pos-form-actions>div{min-height:62px;padding:7px!important}.pos-modern .pos-form-actions .pos-total{padding-left:8px;border:0}.pos-modern #total_payable{font-size:16px!important}.pos-modern .pos-form-actions button{min-height:40px;font-size:10px!important}#mobile_product_suggestion_modal .modal-dialog{width:100%;height:100%;margin:0}#mobile_product_suggestion_modal .modal-content{height:100%;border:0;border-radius:0}#mobile_product_suggestion_modal .modal-body{padding:10px;overflow-y:auto}}

/* POS reference layout - desktop + touch responsive */
.pos-modern{
    --ref-bg:#f1f3f6; --ref-border:#dfe4ea; --ref-text:#243142;
    --ref-muted:#718096; --ref-primary:#5865d8; --ref-green:#36bf8a;
    background:var(--ref-bg)!important; padding:6px 7px 78px!important;
}
.pos-modern .pos-shell{max-width:none;width:100%}
.pos-modern .pos-shell-header{
    height:52px!important; margin:0 0 5px!important; padding:0 9px 0 14px!important;
    border-radius:10px!important; border:1px solid #e1e5eb!important;
    box-shadow:0 2px 9px rgba(25,35,50,.08)!important;
}
.pos-modern .pos-brand-mark{display:none!important}
.pos-modern .pos-branding{gap:8px!important}
.pos-modern .pos-kicker{display:none!important}
.pos-modern .pos-branding h1{font-size:14px!important;font-weight:700!important;margin:0!important}
.pos-modern .pos-branding:before{content:"Location:";font-size:12px;font-weight:700;color:#18212d;margin-right:2px}
.pos-modern .pos-context{margin-left:auto;gap:7px!important}
.pos-modern .pos-context-item{height:42px;padding:0 10px;background:#fff;border:0;border-radius:7px}
.pos-modern .pos-context-item:first-child{display:none!important}
.pos-modern .pos-context-item:nth-of-type(2){background:#5d68db;color:#fff}
.pos-modern .pos-context-item:nth-of-type(2) .pos-context-icon{display:none}
.pos-modern .pos-context-item:nth-of-type(2) small{display:none}
.pos-modern .pos-context-item:nth-of-type(2) strong{color:#fff;font-size:11px}
.pos-modern .pos-context-divider{display:none}
.pos-modern .pos-mobile-products{height:38px!important}
.pos-modern .pos-header-icon{width:40px!important;height:40px!important;background:#fff;border:1px solid #e0e5eb;border-radius:7px!important}
.pos-modern .pos-workspace{
    display:grid!important;grid-template-columns:minmax(0,60%) minmax(0,40%)!important;
    gap:5px!important;align-items:stretch!important;
}
.pos-modern .pos-cart-card,.pos-modern .pos-catalog-card{
    height:calc(100vh - 134px)!important;min-height:0!important;
    border-radius:10px!important;border:1px solid #dfe4ea!important;
    box-shadow:0 1px 5px rgba(20,30,45,.05)!important;
}
.pos-modern .pos-cart-card{padding:6px!important}
.pos-modern .pos-catalog-card{padding:5px!important}
.pos-modern .pos-cart-card .box-body{height:100%!important}
.pos-modern .pos-catalog-header{
    height:42px;padding:0 4px!important;margin:0!important;border:0!important;
}
.pos-modern .pos-catalog-header>div{display:none!important}
.pos-modern .pos-catalog-action{display:none!important}
.pos-modern .pos-toolbar{
    display:grid!important;grid-template-columns:300px minmax(0,1fr)!important;
    gap:7px!important;margin:0 0 5px!important;
}
.pos-modern .pos-toolbar>[class*=col-]{padding:0!important}
.pos-modern .pos-toolbar .form-control,
.pos-modern .pos-toolbar .input-group-addon,
.pos-modern .pos-toolbar .input-group-btn .btn,
.pos-modern .pos-toolbar .select2-selection--single{
    height:36px!important;background:#fff!important;border:1px solid #d6dde6!important;
    box-shadow:none!important;font-size:12px!important;
}
.pos-modern .pos-toolbar .input-group-addon{min-width:34px!important}
.pos-modern .pos-toolbar .input-group-btn .btn{min-width:36px!important}
.pos-modern .pos_product_div{height:calc(100% - 41px)!important;display:flex!important}
.pos-modern #pos_table{border-spacing:0!important;table-layout:fixed!important}
.pos-modern #pos_table thead th{
    height:30px!important;padding:5px 6px!important;background:#f7f9fb!important;
    color:#8793a3!important;border:0!important;font-size:9px!important;
    text-transform:uppercase!important;letter-spacing:.05em!important;
}
.pos-modern #pos_table tbody tr.product_row td{
    height:58px!important;padding:5px 6px!important;background:#fff!important;
    border-bottom:1px solid #e7ebf0!important;border-top:0!important;
}
.pos-modern #pos_table tbody tr.product_row td:first-child,
.pos-modern #pos_table tbody tr.product_row td:last-child{border-left:0!important;border-right:0!important;border-radius:0!important}
.pos-modern #pos_table tbody tr.product_row:hover td{background:#fbfcfe!important}
.pos-modern #pos_table img{width:34px!important;height:34px!important;border:0!important;border-radius:4px!important}
.pos-modern .product_row .input-number{max-width:120px!important}
.pos-modern .product_row .input-number .btn,
.pos-modern .product_row .pos_quantity{height:34px!important;border-color:#ccd5df!important}
.pos-modern .product_row .pos_line_total_text{font-weight:700!important}
.pos-modern .product_row .pos_remove_row{width:28px!important;height:28px!important;background:#ffe9e8!important}
.pos-modern .pos_form_totals{
    margin-top:auto!important;padding:0!important;border-top:1px solid #dfe4ea!important;
}
.pos-modern .pos_form_totals>div{padding:0!important}
.pos-modern .pos_form_totals table{
    border:0!important;border-radius:0!important;background:#fff!important;
}
.pos-modern .pos_form_totals td{
    padding:6px 9px!important;font-size:10px!important;border:0!important;
}
.pos-modern .pos_form_totals tr:first-child td{
    background:#f7f9fb!important;border-right:1px solid #e1e6ec!important;
}
.pos-modern .pos_form_totals tr:first-child td:last-child{border-right:0!important}
.pos-modern .pos_form_totals tr:nth-child(2) td{border-top:1px solid #e7ebf0!important}
.pos-modern .pos-form-actions{
    position:fixed!important;left:7px!important;right:7px!important;bottom:0!important;
    z-index:1050!important;height:65px!important;margin:0!important;padding:0!important;
    background:#fff!important;border:1px solid #dfe4ea!important;border-radius:10px 10px 0 0!important;
    box-shadow:0 -2px 10px rgba(20,30,45,.08)!important;
}
.pos-modern .pos-form-actions>div{
    height:64px!important;min-height:0!important;padding:5px 9px!important;
    flex-direction:row!important;overflow:visible!important;
}
.pos-modern .pos-form-actions>div>div:nth-child(2){
    order:1!important;display:flex!important;align-items:center!important;gap:15px!important;
}
.pos-modern .pos-form-actions>div>div:nth-child(1){display:none!important}
.pos-modern .pos-form-actions>div>div:nth-child(3){margin-left:auto!important}
.pos-modern .pos-form-actions button{
    min-height:40px!important;border-radius:7px!important;font-size:11px!important;
    padding:5px 13px!important;box-shadow:none!important;
}
.pos-modern .pos-form-actions>div>div:nth-child(2) button:not(#pos-finalize):not(.pos-express-finalize){background:transparent!important}
.pos-modern .pos-form-actions #pos-finalize{background:#203b59!important;width:155px!important}
.pos-modern .pos-form-actions .pos-express-finalize[data-pay_method=cash){background:#3bbd88!important;width:155px!important}
.pos-modern .pos-form-actions .pos-total{
    display:flex!important;align-items:center!important;gap:10px!important;
    margin-left:auto!important;padding:0 20px!important;border-left:1px solid #e2e6eb!important;
}
.pos-modern .pos-form-actions .pos-total>div{font-size:9px!important;line-height:1.2!important}
.pos-modern .pos-form-actions #total_payable{font-size:20px!important}
.pos-modern .pos-form-actions #recent-transactions{
    height:40px!important;border-radius:20px!important;padding:0 22px!important;
    background:#646ee4!important;
}
/* catalog controls become three compact tabs like the reference */
.pos-modern .pos-catalog-card .tw-mb-1{
    display:grid!important;grid-template-columns:repeat(3,1fr)!important;gap:6px!important;
    margin:0 0 6px!important;
}
.pos-modern #product_category_div,.pos-modern #product_brand_div{padding:0!important;width:auto!important}
.pos-modern #product_category_div label,.pos-modern #product_brand_div label{
    height:36px!important;min-height:36px!important;width:100%!important;
    border-radius:18px!important;background:#fff!important;color:#39475a!important;
    border:1px solid #e0e5eb!important;box-shadow:0 1px 3px rgba(20,30,45,.04)!important;
    font-size:11px!important;font-weight:700!important;
}
.pos-modern #product_category_div label{color:#39475a!important}
.pos-modern #product_category_div label svg,.pos-modern #product_brand_div label svg{
    width:15px!important;height:15px!important;stroke:#5d68db!important;
}
.pos-modern #feature_product_div{
    display:block!important;width:auto!important;padding:0!important;margin:0!important;
}
.pos-modern #show_featured_products{
    display:block!important;width:100%!important;height:36px!important;
    border:1px solid #e0e5eb!important;border-radius:18px!important;background:#fff!important;
    color:#39475a!important;font-size:11px!important;font-weight:700!important;
}
.pos-modern #product_list_body{padding:0!important;overflow-y:auto!important}
.pos-modern .pos-catalog-card .eq-height-row{margin:0 -3px!important}
.pos-modern .pos-catalog-card .eq-height-row>[class*=col-]{padding:3px!important}
.pos-modern .pos-product-card{
    height:137px!important;border:1px solid #e0e5eb!important;border-radius:8px!important;
    box-shadow:none!important;background:#fff!important;
}
.pos-modern .pos-product-card:hover{transform:none!important;box-shadow:0 3px 10px rgba(30,40,60,.08)!important}
.pos-modern .pos-product-image{height:78px!important;background-color:#fff!important;border-bottom:1px solid #f0f2f5!important}
.pos-modern .pos-product-info{padding:5px 7px!important}
.pos-modern .pos-product-name{font-size:10px!important;text-align:center!important}
.pos-modern .pos-product-sku{font-size:9px!important;text-align:center!important}
.pos-modern .pos-product-meta{font-size:8px!important;margin-top:2px!important}
.pos-modern .pos-product-meta strong{font-size:9px!important}
@media(max-width:1100px) and (min-width:769px){
 .pos-modern .pos-workspace{grid-template-columns:55% 45%!important}
 .pos-modern .pos-toolbar{grid-template-columns:1fr!important}
}
@media(max-width:768px){
 .pos-modern{padding:4px 4px 72px!important}
 .pos-modern .pos-shell-header{height:48px!important;margin-bottom:4px!important}
 .pos-modern .pos-context-item:nth-of-type(2){height:36px!important}
 .pos-modern .pos-workspace{display:block!important}
 .pos-modern .pos-cart-card{height:auto!important;min-height:calc(100vh - 124px)!important}
 .pos-modern .pos-products-panel{display:none!important}
 .pos-modern .pos-toolbar{display:grid!important;grid-template-columns:1fr!important;gap:5px!important}
 .pos-modern .pos-toolbar .form-control,.pos-modern .pos-toolbar .input-group-addon,.pos-modern .pos-toolbar .input-group-btn .btn{height:42px!important}
 .pos-modern .pos_product_div{height:auto!important}
 .pos-modern #pos_table thead th:nth-child(3),.pos-modern #pos_table tbody td:nth-child(3),
 .pos-modern #pos_table thead th:nth-child(4),.pos-modern #pos_table tbody td:nth-child(4){display:none!important}
 .pos-modern #pos_table tbody tr.product_row td{height:55px!important;padding:4px!important}
 .pos-modern .pos-form-actions{left:4px!important;right:4px!important;height:62px!important}
 .pos-modern .pos-form-actions>div{height:61px!important;padding:4px!important}
 .pos-modern .pos-form-actions>div>div:nth-child(2){gap:4px!important;overflow-x:auto!important;max-width:72%!important}
 .pos-modern .pos-form-actions button{min-width:72px!important;padding:4px 8px!important;font-size:9px!important}
 .pos-modern .pos-form-actions #pos-finalize{width:auto!important;min-width:105px!important}
 .pos-modern .pos-form-actions .pos-express-finalize[data-pay_method=cash]{width:auto!important;min-width:85px!important}
 .pos-modern .pos-form-actions .pos-total{display:none!important}
 .pos-modern .pos-form-actions>div>div:nth-child(3){display:block!important}
 .pos-modern .pos-form-actions #recent-transactions{font-size:9px!important;padding:0 10px!important}
 .pos-modern .pos-mobile-products{display:block!important}
}
</style>.pos-modern .pos-top-left{display:flex;align-items:center;gap:30px}.pos-modern .pos-location{display:flex;align-items:center;gap:12px;font-size:12px}.pos-modern .pos-location span{font-weight:700;color:#18212d}.pos-modern .pos-location strong{font-weight:400;color:#2e3b4b}.pos-modern .pos-date{height:42px;min-width:153px;padding:0 13px;border-radius:7px;background:#5d68db;color:#fff;display:flex;align-items:center;justify-content:space-between;font-size:11px;font-weight:700}.pos-modern .pos-top-actions{display:flex;align-items:center;gap:7px;margin-left:auto}.pos-modern .pos-tool-btn{width:40px;height:40px;border:1px solid #dfe5ec;background:#fff;border-radius:7px;color:#526174;display:flex;align-items:center;justify-content:center}.pos-modern .pos-tool-green{color:#15966a}.pos-modern .pos-tool-danger{color:#e64c55}.pos-modern .pos-expense-btn{height:40px;padding:0 15px;border:1px solid #dfe5ec;background:#fff;border-radius:7px;font-size:12px;font-weight:700;color:#202b39}.pos-modern .pos-expense-btn i{margin-right:6px;color:#253040}.pos-modern .pos-mobile-products{display:none}.pos-modern .pos-branding{display:none!important}.pos-modern .pos-context{display:none!important}.pos-modern .pos-header-icon{width:40px;height:40px}.pos-modern .pos-form-actions .pos-express-finalize[data-pay_method="cash"]{background:#3bbd88!important;width:155px!important}
@media(max-width:900px){.pos-modern .pos-tool-btn:nth-child(-n+5){display:none}.pos-modern .pos-expense-btn{display:none}.pos-modern .pos-top-left{gap:8px}.pos-modern .pos-location strong{max-width:100px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap}.pos-modern .pos-date{min-width:130px}}
@media(max-width:768px){.pos-modern .pos-shell-header{padding:0 6px!important}.pos-modern .pos-top-left{gap:5px}.pos-modern .pos-location{font-size:10px;gap:5px}.pos-modern .pos-date{height:36px;min-width:112px;padding:0 8px;font-size:9px}.pos-modern .pos-top-actions{gap:4px}.pos-modern .pos-tool-btn:nth-child(n){display:none}.pos-modern .pos-header-icon{display:flex!important;width:32px;height:32px}.pos-modern .pos-mobile-products{display:block!important;height:32px!important;padding:0 7px!important}.pos-modern .pos-workspace{grid-template-columns:1fr!important}}</style>
@section('javascript')
    <!-- HTML5 QR Code Scanner -->
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>

    <script src="{{ asset('js/pos.js?v=' . $asset_v) }}"></script>
    <script src="{{ asset('js/product.js?v=' . $asset_v) }}"></script>
    <script src="{{ asset('js/opening_stock.js?v=' . $asset_v) }}"></script>
    @include('sale_pos.partials.keyboard_shortcuts')
    <!-- include module js -->
    @if (!empty($pos_module_data))
        @foreach ($pos_module_data as $key => $value)
            @if (!empty($value['module_js_path']))
                @includeIf($value['module_js_path'], ['view_data' => $value['view_data']])
            @endif
        @endforeach
    @endif

    <!-- QR Code Scanner Modal -->
    <div class="modal fade" id="qrScannerModal" tabindex="-1" role="dialog" aria-labelledby="qrScannerModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div style="display: flex;justify-content: space-between;">
                    <h4 class="modal-title" id="qrScannerModalLabel">QR Code & Barcode Scanner</h4>
                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal" aria-label="Close">
                        <i class="fa fa-times"></i>
                    </button>
                    </div>
                </div>
                <div class="modal-body">
                    <div id="qr-scanner-container" style="width: 100%;"></div>
                  
                </div>
            </div>
        </div>
    </div>

    <script>
        let html5Qrcode = null;
        let isScanning = false;
        let scanCooldown = false;
        let lastScannedCode = '';

        $(document).ready(function() {
            $('#qr_scan_btn').click(function() {
                $('#qrScannerModal').modal('show');
                setTimeout(function() {
                    initQRScanner();
                }, 300);
            });

            $('#qrScannerModal').on('hidden.bs.modal', function() {
                stopQRScanner();
            });
        });

        function initQRScanner() {
            if (isScanning) return;

            try {
                html5Qrcode = new Html5Qrcode("qr-scanner-container");

                Html5Qrcode.getCameras().then(devices => {
                    if (devices && devices.length) {
                        let cameraId = devices[0].id;
                        // Use back camera if available
                        const backCamera = devices.find(device =>
                            device.label.toLowerCase().includes('back') ||
                            device.label.toLowerCase().includes('rear') ||
                            device.label.toLowerCase().includes('environment')
                        );
                        if (backCamera) {
                            cameraId = backCamera.id;
                        }

                        html5Qrcode.start(
                            cameraId,
                            {
                                fps: 10,
                                qrbox: function(viewfinderWidth, viewfinderHeight) {
                                    // Make qrbox wider for barcode scanning
                                    let widthPercentage = 0.7; // 80% of width
                                    let heightPercentage = 0.3; // 30% of height
                                    return {
                                        width: Math.floor(viewfinderWidth * widthPercentage),
                                        height: Math.floor(viewfinderHeight * heightPercentage)
                                    };
                                },
                                aspectRatio: 1.0,
                                supportedScanTypes: [Html5QrcodeScanType.SCAN_TYPE_CAMERA],

                            },
                            onScanSuccess
                        ).then(() => {
                            isScanning = true;
                        }).catch(err => {
                            console.error('Failed to start scanner:', err);
                            alert('permission du camera est désactivé');
                        });
                    } else {
                        alert('Aucun camera');
                    }
                }).catch(err => {
                    console.error('Failed to get cameras:', err);
                    alert('Error accessing camera. Please check permissions.');
                });

            } catch (error) {
                console.error('QR Scanner initialization error:', error);
                alert('Error initializing QR scanner. Please make sure camera permissions are granted.');
            }
        }

        function onScanSuccess(decodedText, decodedResult) {
            // Check if we're in cooldown period or same code was just scanned
            if (scanCooldown || lastScannedCode === decodedText) {
                return;
            }

            // Set cooldown to prevent multiple scans
            scanCooldown = true;
            lastScannedCode = decodedText;

            // Set the scanned text in the search product input
            $('#search_product').val(decodedText);

            // Trigger the search product functionality
            $('#search_product').trigger('input');

            // Play success beep sound
            try {
                const successAudio = document.getElementById('success-audio');
                if (successAudio) {
                    successAudio.currentTime = 0; // Reset to start
                    successAudio.play();
                }
            } catch (error) {
                console.log('Could not play beep sound:', error);
            }

            // Reset cooldown after 2 seconds
            setTimeout(() => {
                scanCooldown = false;
                lastScannedCode = '';
            }, 2000);
        }

        function stopQRScanner() {
            if (html5Qrcode && isScanning) {
                try {
                    html5Qrcode.stop().then(() => {
                        html5Qrcode.clear();
                        $('#qr-result').hide();
                        isScanning = false;
                    }).catch(err => {
                        console.error('Error stopping scanner:', err);
                        isScanning = false;
                    });
                } catch (error) {
                    console.error('Error stopping QR scanner:', error);
                    isScanning = false;
                }
            }
        }
    </script>
    <script src="{{ asset('js/thermal-printer-client.js?v=' . $asset_v) }}"></script>
    <script src="{{ asset('js/pos-thermal-print.js?v=' . $asset_v) }}"></script>
@endsection
