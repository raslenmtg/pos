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
        <div class="row mb-12 pos-page-wrap">
            <div class="col-md-12 tw-pt-0 tw-mb-14 pos-page-inner">
                <div class="row tw-flex lg:tw-flex-row md:tw-flex-col sm:tw-flex-col tw-flex-col tw-items-start md:tw-gap-4 pos-main-grid">
                    {{-- <div class="@if (empty($pos_settings['hide_product_suggestion'])) col-md-7 @else col-md-10 col-md-offset-1 @endif no-padding pr-12"> --}}
                    <div class="tw-px-3 tw-w-full  lg:tw-px-0 lg:tw-pr-0 @if(empty($pos_settings['hide_product_suggestion'])) lg:tw-w-[60%] @else lg:tw-w-[100%] @endif pos-cart-column">

                        <div class="tw-shadow-[rgba(17,_17,_26,_0.1)_0px_0px_16px] tw-rounded-2xl tw-bg-white tw-mb-2 md:tw-mb-8 tw-p-2 pos-cart-card">

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
                        <div class="md:tw-no-padding tw-w-full lg:tw-w-[40%] tw-px-5 pos-products-column">
                            <div class="pos-catalog-card">@include('sale_pos.partials.pos_sidebar')</div>
                        </div>
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
.pos-modern{--pos-ink:#172033;--pos-muted:#718096;--pos-border:#e7ecf3;--pos-bg:#f5f7fb;background:var(--pos-bg);padding-bottom:18px}
.pos-modern .pos-page-wrap,.pos-modern .pos-page-inner{margin-left:0;margin-right:0}
.pos-modern .pos-main-grid{display:grid!important;grid-template-columns:minmax(0,1.12fr) minmax(380px,.88fr);gap:16px;margin:0;align-items:stretch}
.pos-modern .pos-cart-column,.pos-modern .pos-products-column{width:100%!important;padding-left:0!important;padding-right:0!important}
.pos-modern .pos-cart-card,.pos-modern .pos-catalog-card{border:1px solid var(--pos-border);box-shadow:0 8px 28px rgba(25,42,70,.07)!important;border-radius:16px!important;background:#fff}
.pos-modern .pos-cart-card{padding:16px!important;height:calc(100vh - 205px);min-height:590px;display:flex;flex-direction:column;overflow:hidden}
.pos-modern .pos-cart-card .box-body{padding:0!important;height:100%;display:flex;flex-direction:column;min-height:0}
.pos-modern .pos-catalog-card{height:calc(100vh - 205px);min-height:590px;overflow:hidden;padding:14px}
.pos-modern .pos-catalog-card #product_list_body{overflow-y:auto;max-height:calc(100vh - 315px);padding:2px}
.pos-modern .pos-catalog-card .eq-height-row{margin-left:-5px;margin-right:-5px}
.pos-modern .pos-catalog-card .eq-height-row>[class*=col-]{padding:5px}
.pos-modern .pos-toolbar{margin:0 -4px 12px}
.pos-modern .pos-toolbar>[class*=col-]{padding:0 5px}
.pos-modern .pos-toolbar .form-group{margin-bottom:0}
.pos-modern .pos-toolbar .input-group{width:100%}
.pos-modern .pos-toolbar .form-control,.pos-modern .pos-toolbar .select2-container .select2-selection--single{height:46px;border:1px solid var(--pos-border);border-radius:10px;box-shadow:none;background:#fbfcfe}
.pos-modern .pos-toolbar .input-group-addon,.pos-modern .pos-toolbar .input-group-btn .btn{height:46px;border:1px solid var(--pos-border);background:#fff}
.pos-modern .pos-toolbar .input-group-addon{border-radius:10px 0 0 10px;color:#64748b}
.pos-modern .pos-toolbar .input-group-btn:last-child .btn{border-radius:0 10px 10px 0}
.pos-modern #search_product{font-size:15px;font-weight:500}
.pos-modern #search_product::placeholder{color:#9aa5b5}
.pos-modern .pos_form_totals{margin-top:auto;border-top:1px solid var(--pos-border);padding-top:10px}
.pos-modern .pos_form_totals table{margin-bottom:0;background:#f8fafc;border:1px solid var(--pos-border);border-radius:12px;overflow:hidden}
.pos-modern .pos_form_totals td{border-top:0!important;padding:10px 12px!important;color:var(--pos-muted)}
.pos-modern .pos_form_totals b{color:#4a5568}
.pos-modern .pos_form_totals .price_total,.pos-modern .pos_form_totals #total_discount,.pos-modern .pos_form_totals #order_tax,.pos-modern .pos_form_totals #shipping_charges_amount{color:var(--pos-ink)}
.pos-modern #pos-finalize,.pos-modern .pos-express-finalize[data-pay_method=cash]{border-radius:10px!important;min-height:46px;box-shadow:0 5px 14px rgba(31,78,216,.16)}
.pos-modern .pos-form-actions{border:1px solid var(--pos-border);border-radius:14px!important;box-shadow:0 8px 24px rgba(25,42,70,.09)!important;margin:0 10px;position:sticky;bottom:8px;z-index:1050}
.pos-modern .pos-form-actions button{transition:all .15s ease}
.pos-modern .pos-form-actions button:hover{transform:translateY(-1px)}
.pos-modern .pos-form-actions>div{min-height:66px}
.pos-modern .pos-total{padding:8px 14px;border-left:1px solid var(--pos-border)}
.pos-modern #total_payable{color:#087f5b!important}
.pos-modern #pos-form-table{border-collapse:separate;border-spacing:0 6px;margin-top:-4px}
.pos-modern #pos-form-table thead th{border:0;color:#8a95a6;font-size:11px;text-transform:uppercase;letter-spacing:.05em;font-weight:700;background:#f8fafc;padding:9px 8px}
.pos-modern #pos-form-table tbody tr.product_row{background:#fff;box-shadow:0 2px 9px rgba(25,42,70,.05)}
.pos-modern #pos-form-table tbody tr.product_row td{border-top:1px solid var(--pos-border);border-bottom:1px solid var(--pos-border);padding:8px;vertical-align:middle}
.pos-modern #pos-form-table tbody tr.product_row td:first-child{border-left:1px solid var(--pos-border);border-radius:10px 0 0 10px}
.pos-modern #pos-form-table tbody tr.product_row td:last-child{border-right:1px solid var(--pos-border);border-radius:0 10px 10px 0}
.pos-modern .product_row img{border:1px solid #edf1f6!important;border-radius:9px!important}
.pos-modern .product_row .input-number{max-width:130px;margin:auto}
.pos-modern .product_row .input-number .btn{border-color:var(--pos-border);background:#fff;height:38px}
.pos-modern .product_row .pos_quantity{height:38px;border-color:var(--pos-border);text-align:center;font-weight:700;box-shadow:none}
.pos-modern .product_row .pos_line_total_text{font-weight:700;color:var(--pos-ink)}
.pos-modern .product_row .pos_remove_row{display:inline-flex;align-items:center;justify-content:center;width:34px;height:34px;border-radius:9px;background:#fff1f2}
.pos-modern .pos-catalog-card .btn,.pos-modern .pos-catalog-card label{min-height:44px}
.pos-modern .pos-catalog-card .tw-dw-drawer-content label{border-radius:10px!important;box-shadow:none;background:#f7f9fc!important;color:#334155!important;border:1px solid var(--pos-border)}
@media(max-width:1199px) and (min-width:769px){.pos-modern .pos-main-grid{grid-template-columns:minmax(0,1fr) minmax(330px,.72fr)}.pos-modern .pos-cart-card,.pos-modern .pos-catalog-card{min-height:540px;height:calc(100vh - 190px)}}
@media(max-width:768px){.pos-modern{padding:0 0 72px}.pos-modern .pos-main-grid{display:block!important}.pos-modern .pos-cart-card{height:auto;min-height:0;max-height:none;overflow:visible;padding:10px!important;border-radius:12px!important;box-shadow:none!important}.pos-modern .pos-products-column{display:none}.pos-modern .pos-toolbar{margin-bottom:8px}.pos-modern .pos-toolbar>[class*=col-]{width:100%;margin-bottom:8px}.pos-modern .pos-toolbar .form-control,.pos-modern .pos-toolbar .input-group-addon,.pos-modern .pos-toolbar .input-group-btn .btn{height:48px}.pos-modern .pos_form_totals{margin-top:10px}.pos-modern .pos_form_totals td{display:table-cell;font-size:12px;padding:8px 6px!important}.pos-modern .pos-form-actions{position:fixed;left:8px;right:8px;bottom:8px;margin:0;border-radius:14px!important}.pos-modern .pos-form-actions>div{min-height:58px;padding:7px 8px!important}.pos-modern .pos-form-actions button{min-height:42px}#mobile_product_suggestion_modal .modal-dialog{width:100%;margin:0;height:100%}#mobile_product_suggestion_modal .modal-content{min-height:100vh;border:0;border-radius:0}#mobile_product_suggestion_modal .modal-body{padding:10px;overflow-y:auto}#mobile_product_suggestion_modal .modal-header{padding:10px 14px;border-bottom:1px solid var(--pos-border)}.pos-modern #pos-form-table{font-size:12px}.pos-modern #pos-form-table thead th:nth-child(n+4),.pos-modern #pos-form-table tbody td:nth-child(n+4){display:none}.pos-modern #pos-form-table tbody tr.product_row td{padding:6px 5px}.pos-modern .product_row img{width:44px!important;height:44px!important}.pos-modern .product_row .input-number{max-width:112px}}
</style>
    <!-- include module css -->
    @if (!empty($pos_module_data))
        @foreach ($pos_module_data as $key => $value)
            @if (!empty($value['module_css_path']))
                @includeIf($value['module_css_path'])
            @endif
        @endforeach
    @endif
@stop
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
