@extends('layouts.guest')
@section('title', __('purchase.view_payments'))

@section('content')
<style>
    @media print {
        .no-print {
            display: none !important;
        }
    }
    .payment-print-container {
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
        background: #fff;
        font-family: Arial, sans-serif;
        color: #333;
    }
    .company-details {
        float: left;
        width: 60%;
    }
    .document-title {
        float: right;
        width: 40%;
        text-align: right;
    }
    .document-title h1 {
        margin: 0 0 10px 0;
        font-size: 22px;
        text-transform: uppercase;
        color: #333;
        font-weight: bold;
    }
    .reference-info p {
        margin: 2px 0;
        font-size: 14px;
    }
    .recipient-section {
        margin-top: 20px;
        margin-bottom: 30px;
        border: 1px solid #ccc;
        padding: 15px;
        width: 45%;
        float: right;
        background-color: #fcfcfc;
    }
    .payment-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
        font-size: 13px;
    }
    .payment-table th, .payment-table td {
        border: 1px solid #ddd;
        padding: 10px;
        text-align: left;
    }
    .payment-table th {
        background-color: #f2f2f2;
        font-weight: bold;
        text-transform: uppercase;
        font-size: 12px;
    }
    .text-right {
        text-align: right;
    }
    .clearfix::after {
        content: "";
        clear: both;
        display: table;
    }
    .btn-primary {
        color: #fff;
        background-color: #337ab7;
        border-color: #2e6da4;
        display: inline-block;
        padding: 6px 12px;
        margin-bottom: 0;
        font-size: 14px;
        font-weight: 400;
        line-height: 1.42857143;
        text-align: center;
        white-space: nowrap;
        vertical-align: middle;
        cursor: pointer;
        border: 1px solid transparent;
        border-radius: 4px;
        text-decoration: none;
    }
</style>

<div class="payment-print-container">
    <div class="text-right no-print" style="margin-bottom: 20px;">
        <button class="btn-primary" onclick="window.print();"><i class="fa fa-print"></i> @lang('messages.print')</button>
    </div>

    <div class="clearfix">
        <div class="company-details">
            @include('transaction_payment.payment_business_details')
        </div>
        <div class="document-title">
            <h1>@lang('purchase.view_payments')</h1>
            <div class="reference-info">
                <p><strong>@lang('messages.date'):</strong> {{ @format_date($transaction->transaction_date) }}</p>
                @if(in_array($transaction->type, ['purchase', 'expense', 'purchase_return', 'payroll']))
                    <p><strong>@lang('purchase.ref_no'):</strong> {{ $transaction->ref_no }}</p>
                @elseif(in_array($transaction->type, ['sell', 'sell_return']))
                    <p><strong>@lang('sale.invoice_no'):</strong> {{ $transaction->invoice_no }}</p>
                @endif
                 <p><strong>@lang('purchase.payment_status'):</strong> {{ __('lang_v1.' . $transaction->payment_status) }}</p>
            </div>
        </div>
    </div>

    <div class="clearfix">
        <div class="recipient-section">
            <strong>Client:</strong><br>
            <div style="margin-top: 5px;">
                @if($transaction->type == 'payroll')
                     <strong>{{ $transaction->transaction_for->user_full_name }}</strong>
                    @if(!empty($transaction->transaction_for->address))
                        <br>{{$transaction->transaction_for->address}}
                    @endif
                    @if(!empty($transaction->transaction_for->contact_number))
                        <br>@lang('contact.mobile'): {{$transaction->transaction_for->contact_number}}
                    @endif
                    @if(!empty($transaction->transaction_for->email))
                        <br>@lang('business.email'): {{$transaction->transaction_for->email}}
                    @endif
                @else
                    <strong>{{ $transaction->contact->name }}</strong>
                    <br>
                    {!! $transaction->contact->contact_address !!}
                    @if(!empty($transaction->contact->tax_number))
                        <br>@lang('contact.tax_no'): {{$transaction->contact->tax_number}}
                    @endif
                    @if(!empty($transaction->contact->mobile))
                        <br>@lang('contact.mobile'): {{$transaction->contact->mobile}}
                    @endif
                    @if(!empty($transaction->contact->email))
                        <br>@lang('business.email'): {{$transaction->contact->email}}
                    @endif
                @endif
            </div>
        </div>
    </div>

    <table class="payment-table">
        <thead>
            <tr>
                <th>@lang('messages.date')</th>
                <th>@lang('purchase.ref_no')</th>
                <th>@lang('purchase.payment_method')</th>
                <th>@lang('purchase.payment_note')</th>
                <th class="text-right">@lang('purchase.amount')</th>
            </tr>
        </thead>
        <tbody>
            @php
                $total_amount = 0;
            @endphp
            @forelse ($payments as $payment)
                @php
                    $total_amount += $payment->amount;
                @endphp
                <tr>
                    <td>{{ @format_datetime($payment->paid_on) }}</td>
                    <td>
                        @if($payment->method == 'bank_transfer')
                            {{ $payment->bank_account_number }}
                        @elseif($payment->method == 'custom_pay_1')
                            {{ $payment->transaction_no }}
                        @elseif($payment->method == 'card')
                            {{ $payment->card_transaction_number }}
                        @else
                            {{ $payment->payment_ref_no }}
                        @endif
                    </td>
                    <td>{{ $payment_types[$payment->method] ?? '' }}</td>
                    <td>{{ $payment->note }}</td>
                    <td class="text-right">
                        @format_currency($payment->amount)
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="{{ $accounts_enabled ? 6 : 5 }}" class="text-center">@lang('purchase.no_records_found')</td>
                </tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr style="background-color: #f9f9f9; font-weight: bold;">
                <td colspan="4" class="text-right">@lang('sale.total'):</td>
                <td class="text-right">
                    @format_currency($total_amount)
                </td>
            </tr>
        </tfoot>
    </table>

    <div class="clearfix" style="margin-top: 40px; padding-top: 10px;">
        <div style="float: right; width: 30%; border-top: 1px solid #000; text-align: center; padding-top: 5px;">
             @lang('lang_v1.authorized_signatory')
        </div>
    </div>
</div>
@endsection

