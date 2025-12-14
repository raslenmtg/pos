@php
    $totals = ['taxable_value' => 0];
@endphp
<style>
    @media print {
        .furl{
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            text-align: center;
            font-size: 12px;
            color: #333;
        }

        /* Allow page breaks in tables but not in rows */
        table { page-break-inside: auto; }
        tr { page-break-inside: avoid; page-break-after: auto; }

        /* Repeat table headers on each page */
        thead { display: table-header-group; }
        tfoot { display: table-footer-group; }

        /* Keep specific sections together */
        .no-break { page-break-inside: avoid !important; }

        /* Items table can break naturally */
        .items-table { page-break-inside: auto; }
        .items-table tbody tr { page-break-inside: avoid; }

        /* Prevent page breaks in critical sections */
        .invoice-header { page-break-after: avoid; }
        .customer-info { page-break-after: avoid; }

        /* Entire bottom section cannot break */
        .no-break-section {
            page-break-inside: avoid !important;
            break-inside: avoid !important;
            page-break-before: auto;
            display: block;
        }
        .no-break-section * {
            page-break-inside: avoid !important;
            break-inside: avoid !important;
        }
        @page {
            size: A4;
            margin: 8mm;
        }

        body {
            zoom: 0.7;
        }


    }
</style>
<table class="print-scale" style="width:100%; color: #000000 !important; font-family: 'Times New Roman', serif; border-collapse: collapse;">
    <tbody>
    <td style="width: 100%; padding-bottom: 10px; border-bottom: 1px solid #000;">
        <table style="width:100%; border-collapse: collapse;">
            <tr>
                <!-- LOGO (LEFT) -->
                <td style="width: 20%; vertical-align: middle; text-align: left;">
                    @if(!empty($receipt_details->logo))
                        <img src="{{$receipt_details->logo}}" style="max-width: 180px; max-height: 100px;">
                    @endif
                </td>

                <!-- CENTER TEXT -->
                <td style="width: 60%; text-align: center; line-height: 15px;">
                    @if(empty($receipt_details->letter_head))
                        @if(!empty($receipt_details->header_text))
                            <div style="margin-bottom: 6px;">{!! $receipt_details->header_text !!}</div>
                        @endif

                        @php
                            $sub_headings = implode('<br/>', array_filter([
                                $receipt_details->sub_heading_line1,
                                $receipt_details->sub_heading_line2,
                                $receipt_details->sub_heading_line3,
                                $receipt_details->sub_heading_line4,
                                $receipt_details->sub_heading_line5
                            ]));
                        @endphp

                        @if(!empty($sub_headings))
                            <div style="margin-bottom: 8px;">{!! $sub_headings !!}</div>
                        @endif
                    @endif

                    <div style="font-weight: bold; font-size: 24px; margin-top: 8px;">
                        {!! $receipt_details->invoice_no_prefix !!} {{$receipt_details->invoice_no}}
                    </div>
                </td>

                <!-- EMPTY RIGHT (BALANCE) -->
                <td style="width: 20%;"></td>
            </tr>
        </table>
    </td>


    <tr>
        <td style="padding: 10px 0;" class="customer-info">
            <!-- business information here -->
            <table style="width: 100%; border-collapse: collapse;">
                <tr>
                    <td style="width: 50%; vertical-align: top; padding-right: 15px;">
                        <!-- Left Column - Business Info -->
                        @if(empty($receipt_details->letter_head))
                            <!-- Shop & Location Name  -->
                            <div style="margin-bottom: 15px;">
                                @if(!empty($receipt_details->display_name))
                                    <div style="font-weight: bold; font-size: 18px;">{{$receipt_details->display_name}}</div>
                                @endif
                                @if(!empty($receipt_details->address))
                                    <div>{!! $receipt_details->address !!}</div>
                                @endif
                                @if(!empty($receipt_details->contact))
                                    <div>{!! $receipt_details->contact !!}</div>
                                @endif
                                @if(!empty($receipt_details->website))
                                    <div>{{ $receipt_details->website }}</div>
                                @endif
                                @if(!empty($receipt_details->tax_info1))
                                    <div>{{ $receipt_details->tax_label1 }} {{ $receipt_details->tax_info1 }}</div>
                                @endif
                                @if(!empty($receipt_details->tax_info2))
                                    <div>{{ $receipt_details->tax_label2 }} {{ $receipt_details->tax_info2 }}</div>
                                @endif
                                @if(!empty($receipt_details->location_custom_fields))
                                    <div>{{ $receipt_details->location_custom_fields }}</div>
                                @endif
                            </div>
                        @endif

                        <!-- Table information-->
                        @if(!empty($receipt_details->table_label) || !empty($receipt_details->table))
                            <div style="margin-bottom: 5px;">
                                @if(!empty($receipt_details->table_label))
                                    <strong>{!! $receipt_details->table_label !!}</strong>
                                @endif
                                {{$receipt_details->table}}
                            </div>
                        @endif
                    </td>

                    <td style="width: 50%; vertical-align: top; border-left: 1px solid #000; padding-left: 15px;">
                        <div>
                                <strong>Client: </strong>
                            @if(!empty($receipt_details->customer_info))
                                {!! $receipt_details->customer_info !!}
                            @endif
                            @if(!empty($receipt_details->client_id))
                                <br/>
                                <strong>Code client:</strong> {{ $receipt_details->client_id }}
                            @endif
                            @if(!empty($receipt_details->customer_tax_number))
                                <br/>
                                <strong>M.F:</strong> {{ $receipt_details->customer_tax_number }}
                            @endif
                            @if(!empty($receipt_details->customer_custom_fields))
                                <br/>{!! $receipt_details->customer_custom_fields !!}
                            @endif
                            @if(!empty($receipt_details->sales_person))
                                <br/>
                                <strong>{{ $receipt_details->sales_person_label }}</strong> {{ $receipt_details->sales_person }}
                            @endif
                            @if(!empty($receipt_details->commission_agent))
                                <br/>
                                <strong>{{ $receipt_details->commission_agent_label }}</strong> {{ $receipt_details->commission_agent }}
                            @endif
                            <br/>{{$receipt_details->date_label}}:&nbsp; {{$receipt_details->invoice_date}}
                        </div>

                        @if(!empty($receipt_details->sell_custom_field_1_value))
                            <div style="text-align: right; margin-bottom: 5px;">
									<span style="float: left;">
										{{$receipt_details->sell_custom_field_1_label}}
									</span>
                                {{$receipt_details->sell_custom_field_1_value ?? ''}}
                            </div>
                        @endif
                        @if(!empty($receipt_details->sell_custom_field_2_value))
                            <div style="text-align: right; margin-bottom: 5px;">
									<span style="float: left;">
										{{$receipt_details->sell_custom_field_2_label}}
									</span>
                                {{$receipt_details->sell_custom_field_2_value ?? ''}}
                            </div>
                        @endif
                        @if(!empty($receipt_details->sell_custom_field_3_value))
                            <div style="text-align: right; margin-bottom: 5px;">
									<span style="float: left;">
										{{$receipt_details->sell_custom_field_3_label}}
									</span>
                                {{$receipt_details->sell_custom_field_3_value ?? ''}}
                            </div>
                        @endif
                        @if(!empty($receipt_details->sell_custom_field_4_value))
                            <div style="text-align: right; margin-bottom: 15px;">
									<span style="float: left;">
										{{$receipt_details->sell_custom_field_4_label}}
									</span>
                                {{$receipt_details->sell_custom_field_4_value ?? ''}}
                            </div>
                        @endif
                    </td>
                </tr>
            </table>

            @if(!empty($receipt_details->shipping_custom_field_1_label) || !empty($receipt_details->shipping_custom_field_2_label))
                <table style="width: 100%; margin: 10px 0;">
                    <tr>
                        <td style="width: 50%;">
                            @if(!empty($receipt_details->shipping_custom_field_1_label))
                                <strong>{!!$receipt_details->shipping_custom_field_1_label!!} :</strong> {!!$receipt_details->shipping_custom_field_1_value ?? ''!!}
                            @endif
                        </td>
                        <td style="width: 50%;">
                            @if(!empty($receipt_details->shipping_custom_field_2_label))
                                <strong>{!!$receipt_details->shipping_custom_field_2_label!!}:</strong> {!!$receipt_details->shipping_custom_field_2_value ?? ''!!}
                            @endif
                        </td>
                    </tr>
                </table>
            @endif

            @if(!empty($receipt_details->shipping_custom_field_3_label) || !empty($receipt_details->shipping_custom_field_4_label))
                <table style="width: 100%; margin: 10px 0;">
                    <tr>
                        <td style="width: 50%;">
                            @if(!empty($receipt_details->shipping_custom_field_3_label))
                                <strong>{!!$receipt_details->shipping_custom_field_3_label!!} :</strong> {!!$receipt_details->shipping_custom_field_3_value ?? ''!!}
                            @endif
                        </td>
                        <td style="width: 50%;">
                            @if(!empty($receipt_details->shipping_custom_field_4_label))
                                <strong>{!!$receipt_details->shipping_custom_field_4_label!!}:</strong> {!!$receipt_details->shipping_custom_field_4_value ?? ''!!}
                            @endif
                        </td>
                    </tr>
                </table>
            @endif

            @if(!empty($receipt_details->shipping_custom_field_5_label))
                <div style="margin: 10px 0;">
                    @if(!empty($receipt_details->shipping_custom_field_5_label))
                        <strong>{!!$receipt_details->shipping_custom_field_5_label!!} :</strong> {!!$receipt_details->shipping_custom_field_5_value ?? ''!!}
                    @endif
                </div>
            @endif

            @if(!empty($receipt_details->sale_orders_invoice_no) || !empty($receipt_details->sale_orders_invoice_date))
                <table style="width: 100%; margin: 10px 0;">
                    <tr>
                        <td style="width: 50%;">
                            <strong>@lang('restaurant.order_no'):</strong> {!!$receipt_details->sale_orders_invoice_no ?? ''!!}
                        </td>
                        <td style="width: 50%;">
                            <strong>@lang('lang_v1.order_dates'):</strong> {!!$receipt_details->sale_orders_invoice_date ?? ''!!}
                        </td>
                    </tr>
                </table>
            @endif

            <div style="margin: 10px 0;">
                @includeIf('sale_pos.receipts.partial.common_repair_invoice')
            </div>

            <!-- Items Table -->
            <table style="width: 100%; border-collapse: collapse; margin: 15px 0; border: 1px solid #000;" class="items-table">
                <thead>
                <tr style="background-color: #f0f0f0 !important; font-size: 12px; font-weight: bold;" class="text-center">
                    <td style="border: 1px solid #000; padding: 5px;">#</td>
                    <td style="border: 1px solid #000; padding: 5px; text-align: left;" width="35%">Désignation</td>
                    <td style="border: 1px solid #000; padding: 5px; text-align: right;">Qté</td>
                    <td style="border: 1px solid #000; padding: 5px; text-align: right;">P.U HT</td>
                    <td style="border: 1px solid #000; padding: 5px; text-align: right;">TVA</td>
                    <td style="border: 1px solid #000; padding: 5px; text-align: right;">P.U TTC</td>
                    <td style="border: 1px solid #000; padding: 5px;width: 20px">Remise</td>
                    <td style="border: 1px solid #000; padding: 5px; text-align: right;">TOTAL TTC</td>
                </tr>
                </thead>
                <tbody>
                @foreach($receipt_details->lines as $line)
                    <tr>
                        <td style="border: 1px solid #000; padding: 5px; text-align: center;">
                            {{$loop->iteration}}
                        </td>
                        <td style="border: 1px solid #000; padding: 5px; text-align: left; word-break: break-all;">
                            {{$line['name']}} {{$line['product_variation']}} {{$line['variation']}}
                            @if(!empty($line['sub_sku'])), {{$line['sub_sku']}} @endif @if(!empty($line['brand'])), {{$line['brand']}} @endif
                            @if(!empty($line['product_description']))
                                <small>
                                    {!!$line['product_description']!!}
                                </small>
                            @endif
                            @if(!empty($line['sell_line_note']))
                                <br/>
                                <small style="color: #555;">
                                    {!!$line['sell_line_note']!!}
                                </small>
                            @endif
                            @if(!empty($line['product_expiry'])), {{$line['product_expiry_label']}}:  {{$line['product_expiry']}} @endif

                            @if(!empty($line['warranty_name'])) <br/><small>{{$line['warranty_name']}} </small>@endif @if(!empty($line['warranty_exp_date'])) <small>- {{@format_date($line['warranty_exp_date'])}} </small>@endif
                            @if(!empty($line['warranty_description'])) <small> {{$line['warranty_description'] ?? ''}}</small>@endif

                            @if($receipt_details->show_base_unit_details && $line['quantity'] && $line['base_unit_multiplier'] !== 1)
                                <br/><small>
                                    1 {{$line['units']}} = {{$line['base_unit_multiplier']}} {{$line['base_unit_name']}} <br/>
                                    {{$line['base_unit_price']}} x {{$line['orig_quantity']}} = {{$line['line_total']}}
                                </small>
                            @endif
                        </td>
                        <td style="border: 1px solid #000; padding: 5px; text-align: right;">
                            {{$line['quantity_uf']}}
                        </td>
                        <td style="border: 1px solid #000; padding: 5px; text-align: right;">
                            {{$line['unit_price_exc_tax']!='0.000'?$line['unit_price_exc_tax']:'-'}}
                        </td>
                        <td style="border: 1px solid #000; padding: 5px; text-align: right;">
                            {{empty($line['tax_percent'])?'-':$line['tax_percent'].'%'}}
                        </td>
                        <td style="border: 1px solid #000; padding: 5px; text-align: right;">
                            {{$line['unit_price_before_discount']}}
                        </td>
                        <td style="border: 1px solid #000; padding: 5px; text-align: right;">
                            @if(!empty($line['line_discount_percent']))
                                {{$line['line_discount_percent']}}%
                            @else
                                {{$line['total_line_discount']!='0.000'?$line['total_line_discount']:'' }}
                            @endif
                        </td>
                        <td style="border: 1px solid #000; padding: 5px; text-align: right;">
                            {{$line['line_total']}}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="no-break-section">
                <!-- Payment and Totals Section -->
                <table style="width: 100%; border-collapse: collapse; margin: 15px 0;" class="totals-section no-break">
                    <tr>
                        <td style="width: 40%; vertical-align: top; padding-right: 15px;">
                            <!-- tax -->
                            @if(!empty($receipt_details->taxes))
                                <table style="width: 90%; border-collapse: collapse; border: 1px solid #000; margin: 10px 0;">
                                    <tr>
                                        <th colspan="2" style="border: 1px solid #000; padding: 8px; text-align: center; background-color: #f0f0f0 !important;">TVA</th>
                                    </tr>
                                    @foreach($receipt_details->taxes as $key => $val)
                                        <tr>
                                            <td style="border: 1px solid #000; padding: 5px; text-align: center;"><strong>{{$key}}</strong></td>
                                            <td style="border: 1px solid #000; padding: 5px; text-align: center;">{{$val}}</td>
                                        </tr>
                                    @endforeach
                                </table>
                            @else
                                @if(!empty($receipt_details->payments))
                                    <table style="width: fit-content; padding-top:10px; border-collapse: collapse; border: 1px solid #000;" class="payment-section no-break">
                                        <thead>
                                        <tr style="background-color: #f0f0f0 !important;">
                                            <th style="border: 1px solid #000; padding: 5px;">Méthode paiement</th>
                                            <th style="border: 1px solid #000; padding: 5px;">Montant</th>
                                            <th style="border: 1px solid #000; padding: 5px;">Date</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($receipt_details->payments as $payment)
                                            <tr>
                                                <td style="border: 1px solid #000; padding: 5px;">{{$payment['method']}}</td>
                                                <td style="border: 1px solid #000; padding: 5px;">{{$payment['amount']}}</td>
                                                <td style="border: 1px solid #000; padding: 5px;">{{$payment['date']}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                @endif
                            @endif
                        </td>

                        <td style="width: 60%; vertical-align: top; padding-left: 15px; text-align: -webkit-right;">
                            <!-- Totals -->
                            <table style="width: 70%; border-collapse: collapse; border: 1px solid #000;">
                                <tbody>
                                <tr>
                                    <td style="border: 1px solid #000; padding: 5px;">Total HT</td>
                                    <td style="border: 1px solid #000; padding: 5px; text-align: right;">{{$receipt_details->subtotal_exc_tax}}</td>
                                </tr>

                                @if( !empty($receipt_details->total_line_discount) )
                                    <tr>
                                        <td style="border: 1px solid #000; padding: 5px;">{!! $receipt_details->line_discount_label !!}</td>
                                        <td style="border: 1px solid #000; padding: 5px; text-align: right;">(-) {{$receipt_details->total_line_discount}}</td>
                                    </tr>
                                @endif

                                <tr>
                                    <td style="border: 1px solid #000; padding: 5px;">Sous-total TTC</td>
                                    <td style="border: 1px solid #000; padding: 5px; text-align: right;">{{$receipt_details->subtotal}}</td>
                                </tr>

                                <!-- Shipping Charges -->
                                @if(!empty($receipt_details->shipping_charges))
                                    <tr>
                                        <td style="border: 1px solid #000; padding: 5px;">{!! $receipt_details->shipping_charges_label !!}</td>
                                        <td style="border: 1px solid #000; padding: 5px; text-align: right;">{{$receipt_details->shipping_charges}}</td>
                                    </tr>
                                @endif

                                <!-- Packing Charges -->
                                @if(!empty($receipt_details->packing_charge))
                                    <tr>
                                        <td style="border: 1px solid #000; padding: 5px;">{!! $receipt_details->packing_charge_label !!}</td>
                                        <td style="border: 1px solid #000; padding: 5px; text-align: right;">{{$receipt_details->packing_charge}}</td>
                                    </tr>
                                @endif

                                <!-- Discount -->
                                @if( !empty($receipt_details->discount) )
                                    <tr>
                                        <td style="border: 1px solid #000; padding: 5px;">{!! $receipt_details->discount_label !!}</td>
                                        <td style="border: 1px solid #000; padding: 5px; text-align: right;">(-) {{$receipt_details->discount}}</td>
                                    </tr>
                                @endif

                                @if( !empty($receipt_details->additional_expenses) )
                                    @foreach($receipt_details->additional_expenses as $key => $val)
                                        <tr>
                                            <td style="border: 1px solid #000; padding: 5px;">{{$key}}:</td>
                                            <td style="border: 1px solid #000; padding: 5px; text-align: right;">(+) {{$val}}</td>
                                        </tr>
                                    @endforeach
                                @endif

                                @if( !empty($receipt_details->reward_point_label) )
                                    <tr>
                                        <td style="border: 1px solid #000; padding: 5px;">{!! $receipt_details->reward_point_label !!}</td>
                                        <td style="border: 1px solid #000; padding: 5px; text-align: right;">(-) {{$receipt_details->reward_point_amount}}</td>
                                    </tr>
                                @endif

                                @if(!empty($receipt_details->group_tax_details))
                                    @foreach($receipt_details->group_tax_details as $key => $value)
                                        <tr>
                                            <td style="border: 1px solid #000; padding: 5px;">{!! $key !!}</td>
                                            <td style="border: 1px solid #000; padding: 5px; text-align: right;">{{$value}}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    @if( !empty($receipt_details->tax) )
                                        <tr>
                                            <td style="border: 1px solid #000; padding: 5px;">{!! $receipt_details->tax_label !!}</td>
                                            <td style="border: 1px solid #000; padding: 5px; text-align: right;">{{$receipt_details->tax}}</td>
                                        </tr>
                                    @endif
                                @endif

                                <tr>
                                    <th style="border: 1px solid #000; padding: 8px; background-color: #d0d0d0 !important">Total TTC</th>
                                    <td style="border: 1px solid #000; padding: 8px; text-align: right; background-color: #d0d0d0 !important"><strong>{{$receipt_details->total}}</strong></td>
                                </tr>
                                </tbody>
                            </table>
                            @if(!empty($receipt_details->total_in_words))
                                <p class="total-in-words" style="margin-top:10px; text-align:end;">Arrêté la présente {!! $receipt_details->invoice_heading !!} à la somme de : {{$receipt_details->total_in_words}}.</p>
                            @endif
                        </td>
                    </tr>
                </table>

                <!-- Payment Details -->
                @if(!empty($receipt_details->payments)&&!empty($receipt_details->taxes))
                    <table style="width: fit-content; padding-top:10px; border-collapse: collapse; border: 1px solid #000;" class="payment-section no-break">
                        <thead>
                        <tr style="background-color: #f0f0f0 !important;">
                            <th style="border: 1px solid #000; padding: 5px;">Méthode paiement</th>
                            <th style="border: 1px solid #000; padding: 5px;">Montant</th>
                            <th style="border: 1px solid #000; padding: 5px;">Date</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($receipt_details->payments as $payment)
                            <tr>
                                <td style="border: 1px solid #000; padding: 5px;">{{$payment['method']}}</td>
                                <td style="border: 1px solid #000; padding: 5px;">{{$payment['amount']}}</td>
                                <td style="border: 1px solid #000; padding: 5px;">{{$payment['date']}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif

                @if(!empty($receipt_details->additional_notes))
                    <div style="margin: 15px 0; padding: 10px; border: 1px solid #000;">
                        <strong>Additional Notes:</strong>
                        <p>{!! nl2br($receipt_details->additional_notes) !!}</p>
                    </div>
                @endif

                @if(!empty($receipt_details->footer_text))
                    <div style="width:100%; text-align: center; margin-top:5px; margin-bottom:5px; display:flex; justify-content:center">
                        {!! $receipt_details->footer_text !!}
                    </div>
                @endif
                @if( $receipt_details->show_qr_code)
                    <div style="width: 100%; text-align: center; display:flex; justify-content:center">
                        @if($receipt_details->show_qr_code && !empty($receipt_details->qr_code_text))
                            <img style="max-width: 100px;" src="data:image/png;base64,{{DNS2D::getBarcodePNG($receipt_details->qr_code_text, 'QRCODE', 3, 3, [39, 48, 54])}}">
                        @endif
                    </div>
                @endif
            </div>
        </td>
    </tr>
    </tbody>
</table>
<div class="furl">
    www.simplexgestion.tn
</div>