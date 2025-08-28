<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@lang('lang_v1.account_summary')</title>
    <style>
        /* CSS for a clean, professional, print-friendly design */
        body {
            font-family: 'Helvetica', sans-serif;
            color: #333;
            font-size: 12px;
            line-height: 1.4;
        }
        .ledger-container {
            width: 100%;
            margin: 0 auto;
        }
        /* Header section */
        .header {
            display: table;
            width: 100%;
            margin-bottom: 30px;
        }
        .header-left, .header-right {
            display: table-cell;
            width: 50%;
            vertical-align: top;
        }
        .header-right {
            text-align: right;
        }
        .header-center {
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            color: #000;
        }
        .header-left strong {
            font-size: 14px;
        }
        /* Client and Business Info */
        .party-info {
            margin-bottom: 30px;
            padding: 15px;
            border: 1px solid #e9e9e9;
            border-radius: 5px;
        }
        .party-info h3 {
            margin-top: 0;
            margin-bottom: 10px;
            font-size: 14px;
            border-bottom: 1px solid #e9e9e9;
            padding-bottom: 5px;
        }
        /* Summary Boxes */
        .summary-box {
            margin-bottom: 20px;
            border: 1px solid #e9e9e9;
            border-radius: 5px;
            padding: 15px;
            background-color: #f9f9f9;
        }
        .summary-box h3 {
            margin-top: 0;
            margin-bottom: 10px;
            font-size: 14px;
        }
        .summary-table {
            width: 100%;
        }
        .summary-table td {
            padding: 5px 0;
        }
        .summary-table .align-right {
            text-align: right;
        }
        /* Main Ledger Table */
        .ledger-table-container {
            margin-top: 30px;
        }
        .ledger-table {
            width: 100%;
            border-collapse: collapse;
        }
        .ledger-table th, .ledger-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .ledger-table thead th {
            background-color: #f2f2f2;
            font-weight: bold;
            text-align: center;
        }
        .ledger-table .align-right {
            text-align: right;
        }
        /* General Utilities */
        .text-center {
            text-align: center;
        }
        .word-wrap {
            word-wrap: break-word;
        }
    </style>
</head>
<body>

<div class="ledger-container">

    <div class="header">
		  <div class="header-center">
            <h1>@lang('lang_v1.account_summary')</h1>
        </div>
        <div class="header-left word-wrap">
            <strong>{{$contact->business->name}}</strong><br>
            @if(!empty($location))
                {!! $location->location_address !!}
            @else
                {!! $contact->business->business_address !!}
            @endif
        </div>
      
    </div>

    <div class="party-info">
        <h3>Client</h3>
        <div class="word-wrap">
            {{$contact->name}}
            <br>@lang('contact.mobile'): {{$contact->mobile}}
            <br> {!! $contact->contact_address !!}
            @if(!empty($contact->tax_number)) <br>@lang('contact.tax_no'): {{$contact->tax_number}} @endif
        </div>
    </div>

    <div class="summary-box">
        <h3>@lang('lang_v1.summary_for_period')</h3>
        <b>{{$ledger_details['start_date']}} @lang('lang_v1.to') {{$ledger_details['end_date']}}</b>
        <table class="summary-table">
            {{-- Original commented-out lines are preserved --}}
            {{-- <tr class="summary_hidden">
                    <td>@lang('lang_v1.opening_balance')</td>
                    <td class="align-right">@format_currency($ledger_details['beginning_balance'])</td>
                </tr> --}}
            @if( $contact->type == 'supplier' || $contact->type == 'both')
                <tr>
                    <td>@lang('report.total_purchase')</td>
                    <td class="align-right">@format_currency($ledger_details['total_purchase'])</td>
                </tr>
            @endif
            @if( $contact->type == 'customer' || $contact->type == 'both')
                <tr>
                    <td>@lang('lang_v1.total_invoice')</td>
                    <td class="align-right">@format_currency($ledger_details['total_invoice'])</td>
                </tr>
            @endif
            <tr>
                <td>@lang('sale.total_paid')</td>
                <td class="align-right">@format_currency($ledger_details['total_paid'])</td>
            </tr>
            @if($ledger_details['ledger_discount'] > 0)
                <tr>
                    <td>@lang('lang_v1.ledger_discount')</td>
                    <td class="align-right">@format_currency($ledger_details['ledger_discount'])</td>
                </tr>
            @endif
        </table>
    </div>

    <div class="summary-box">
        <h3>@lang('lang_v1.overall_summary')</h3>
        <table class="summary-table">
            @if( $contact->type == 'supplier' || $contact->type == 'both')
                <tr>
                    <td>@lang('report.total_purchase')</td>
                    <td class="align-right">@format_currency($ledger_details['all_total_purchase'])</td>
                </tr>
            @endif
            @if( $contact->type == 'customer' || $contact->type == 'both')
                <tr>
                    <td>@lang('lang_v1.total_invoice')</td>
                    <td class="align-right">@format_currency($ledger_details['all_total_invoice'])</td>
                </tr>
            @endif
            @if( $contact->type == 'customer' || $contact->type == 'both')
                <tr>
                    <td>@lang('sale.total_paid')</td>
                    <td class="align-right">@format_currency($ledger_details['all_invoice_paid'])</td>
                </tr>
            @endif
            @if( $contact->type == 'supplier' || $contact->type == 'both')
                <tr>
                    <td>@lang('sale.total_paid')</td>
                    <td class="align-right">@format_currency($ledger_details['all_purchase_paid'])</td>
                </tr>
            @endif
            <tr>
                <td><strong>@lang('lang_v1.balance_due')</strong></td>
                <td class="align-right"><strong>@format_currency($ledger_details['all_balance_due'])</strong></td>
            </tr>
        </table>
    </div>

    <div class="ledger-table-container">
        <p class="text-center"><strong>@lang('lang_v1.ledger_table_heading', ['start_date' => $ledger_details['start_date'], 'end_date' => $ledger_details['end_date']])</strong></p>
        <table class="ledger-table" id="ledger_table">
            <thead>
                <tr>
                    <th width="18%">@lang('lang_v1.date')</th>
                    <th width="9%">N°</th>
                    <th width="8%">@lang('lang_v1.type')</th>
                    <th width="8%">@lang('sale.location')</th>
                    <th width="7%">Status</th>
                    <th width="10%">@lang('account.debit')</th>
                    <th width="10%">@lang('account.credit')</th>
                    <th width="8%">M.P</th>
                    <th width="12%">@lang('report.others')</th>
                </tr>
            </thead>
            <tbody>
                @foreach($ledger_details['ledger'] as $data)

                    @if($data['type'] == 'Opening Balance')
                        @continue
                    @endif

                    <tr>
                        <td>{{@format_datetime($data['date'])}}</td>
                        <td>{{$data['ref_no']}}</td>
                        <td>{{$data['type']}}</td>
                        <td>{{$data['location']}}</td>
                        <td>{{$data['payment_status']}}</td>
                        <td class="align-right">@if($data['debit'] != '') @format_currency($data['debit']) @endif</td>
                        <td class="align-right">@if($data['credit'] != '') @format_currency($data['credit']) @endif</td>
                        <td>{{$data['payment_method']}}</td>
                        <td>
                            {!! $data['others'] !!}

                            {{-- DESIGN CHANGE: These buttons are not for printing. We hide them. --}}
                            {{-- You can pass a variable like $for_pdf=true from your controller to hide them --}}
                            @if(empty($for_pdf))
                                @if(!empty($is_admin) && !empty($data['transaction_id']) && $data['transaction_type'] == 'ledger_discount')
                                    <br>
                                    <button type="button" class="tw-dw-btn tw-dw-btn-outline tw-dw-btn-xs tw-dw-btn-error delete_ledger_discount" data-href="{{action([\App\Http\Controllers\LedgerDiscountController::class, 'destroy'], ['ledger_discount' => $data['transaction_id']])}}"><i class="fas fa-trash"></i></button>
                                    <button type="button" class="tw-dw-btn tw-dw-btn-xs tw-dw-btn-outline tw-dw-btn-primary btn-modal" data-href="{{action([\App\Http\Controllers\LedgerDiscountController::class, 'edit'], ['ledger_discount' => $data['transaction_id']])}}" data-container="#edit_ledger_discount_modal"><i class="fas fa-edit"></i></button>
                                @endif
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>

</body>
</html>