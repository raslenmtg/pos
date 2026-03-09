<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@lang('lang_v1.payment_receipt') — {{ $single_payment_line->payment_ref_no }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --ink:       #1a202c;
            --soft:      #4a5568;
            --muted:     #718096;
            --accent:    #1a56a4;
            --accent-lt: #dbeafe;
            --border:    #cbd5e0;
            --bg:        #f1f5f9;
            --white:     #ffffff;
            --green:     #166534;
            --green-bg:  #dcfce7;
            --green-bd:  #86efac;
        }

        /* ── Screen wrapper ── */
        body {
            font-family: 'Inter', Arial, sans-serif;
            background: var(--bg);
            color: var(--ink);
            font-size: 11px;
            line-height: 1.45;
            padding: 24px 16px;
        }

        /* ── Toolbar (screen only) ── */
        .toolbar {
            max-width: 560px;
            margin: 0 auto 14px;
            display: flex;
            gap: 8px;
            justify-content: flex-end;
        }
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 6px 14px;
            border-radius: 5px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            border: none;
            text-decoration: none;
            line-height: 1;
        }
        .btn-print { background: var(--accent); color: #fff; }
        .btn-close { background: var(--white); color: var(--soft); border: 1px solid var(--border); }
        .btn:hover { opacity: .85; }

        /* ── Receipt card — half-page width ── */
        .receipt {
            max-width: 560px;          /* ~half A4 width on screen */
            margin: 0 auto;
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 8px;
            box-shadow: 0 3px 14px rgba(0,0,0,.09);
            overflow: hidden;
        }

        /* Coloured top strip */
        .topbar {
            height: 5px;
            background: linear-gradient(90deg, var(--accent) 0%, #60a5fa 100%);
        }

        /* ── HEADER: logo left, title right ── */
        .r-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            padding: 14px 18px 10px;
            border-bottom: 1px solid var(--border);
            gap: 12px;
        }
        .r-header .logo    { max-height: 44px; max-width: 130px; display: block; margin-bottom: 5px; }
        .r-header .biz-name { font-size: 13px; font-weight: 700; color: var(--ink); }
        .r-header .biz-sub  { font-size: 9.5px; color: var(--muted); margin-top: 1px; line-height: 1.5; }

        .r-header .doc-right { text-align: right; flex-shrink: 0; }
        .r-header .doc-title {
            font-size: 16px;
            font-weight: 700;
            color: var(--accent);
            text-transform: uppercase;
            letter-spacing: -.3px;
            line-height: 1;
            margin-bottom: 5px;
        }
        .badge-paid {
            display: inline-block;
            padding: 2px 9px;
            border-radius: 20px;
            font-size: 9px;
            font-weight: 700;
            letter-spacing: .4px;
            text-transform: uppercase;
            background: var(--green-bg);
            color: var(--green);
            border: 1px solid var(--green-bd);
            margin-bottom: 5px;
        }
        .doc-meta { font-size: 9.5px; color: var(--muted); line-height: 1.7; }
        .doc-meta strong { color: var(--soft); }

        /* ── BODY: two columns, parties + details side by side ── */
        .r-body {
            display: grid;
            grid-template-columns: 1fr 1fr;
            border-bottom: 1px solid var(--border);
        }
        .r-col {
            padding: 10px 18px;
        }
        .r-col + .r-col { border-left: 1px solid var(--border); }

        .col-title {
            font-size: 8.5px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .9px;
            color: var(--muted);
            margin-bottom: 6px;
            padding-bottom: 4px;
            border-bottom: 1px dashed var(--border);
        }

        /* Contact / party info */
        .party-name   { font-size: 11px; font-weight: 600; color: var(--ink); margin-bottom: 2px; }
        .party-detail { font-size: 9.5px; color: var(--soft); line-height: 1.55; }

        /* KV rows */
        .kv { width: 100%; border-collapse: collapse; }
        .kv td { padding: 2.5px 0; font-size: 10px; vertical-align: top; }
        .kv td:first-child { color: var(--muted); width: 48%; padding-right: 4px; }
        .kv td:last-child  { color: var(--ink); font-weight: 500; }

        /* ── AMOUNT banner ── */
        .r-amount {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 9px 18px;
            background: var(--accent-lt);
            border-bottom: 1px solid var(--border);
        }
        .r-amount .lbl { font-size: 9.5px; font-weight: 600; color: var(--accent); text-transform: uppercase; letter-spacing: .4px; }
        .r-amount .val { font-size: 20px; font-weight: 700; color: var(--accent); letter-spacing: -.5px; }

        /* ── NOTE ── */
        .r-note {
            padding: 7px 18px;
            border-bottom: 1px solid var(--border);
            font-size: 9.5px;
            color: var(--soft);
        }
        .r-note strong { color: var(--muted); text-transform: uppercase; font-size: 8.5px; letter-spacing: .5px; margin-right: 4px; }

        /* ── FOOTER ── */
        .r-footer {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            padding: 9px 18px 12px;
        }
        .r-footer .footer-note { font-size: 9px; color: var(--muted); max-width: 55%; line-height: 1.5; }
        .sig-box { text-align: center; }
        .sig-line { border-top: 1px solid var(--soft); width: 110px; margin-bottom: 3px; }
        .sig-lbl  { font-size: 8.5px; color: var(--muted); }

        /* ── PRINT ── */
        @media print {
            @page {
                size: A5 landscape;   /* half-page: 210 × 148 mm */
                margin: 8mm;
            }
            .toolbar  { display: none !important; }
            body      { background: #fff; padding: 0; font-size: 10px; }
            .receipt  { max-width: 100%; box-shadow: none; border: none; border-radius: 0; }
            .topbar        { print-color-adjust: exact; -webkit-print-color-adjust: exact; }
            .r-amount      { print-color-adjust: exact; -webkit-print-color-adjust: exact; }
            .badge-paid    { print-color-adjust: exact; -webkit-print-color-adjust: exact; }
        }
    </style>
</head>
<body>

{{-- Screen toolbar --}}{{--
<div class="toolbar">
    <button class="btn btn-print" onclick="window.print()">
        <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="currentColor" viewBox="0 0 16 16">
            <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
            <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z"/>
        </svg>
        @lang('messages.print')
    </button>
    <button class="btn btn-close" onclick="window.close()">@lang('messages.close')</button>
</div>--}}

<div class="receipt">
    <div class="topbar"></div>

    {{-- HEADER --}}
    <div class="r-header">
        <div class="header-left">
            @if(!empty($transaction) && !empty($transaction->business->logo) && file_exists(public_path('uploads/business_logos/'.$transaction->business->logo)))
                <img class="logo" src="{{ asset('uploads/business_logos/'.$transaction->business->logo) }}" alt="">
            @endif
            @if(!empty($transaction))
                <div class="biz-name">{{ $transaction->business->name }}</div>
                @if(!empty($transaction->location))
                    <div class="biz-sub">
                        @if(!empty($transaction->location->landmark)){{ $transaction->location->landmark }} — @endif
                        {{ implode(', ', array_filter([$transaction->location->city ?? null, $transaction->location->state ?? null, $transaction->location->country ?? null])) }}
                        @if(!empty($transaction->business->tax_number_1)) &nbsp;|&nbsp; {{ $transaction->business->tax_label_1 }}: {{ $transaction->business->tax_number_1 }}@endif
                    </div>
                @endif
            @endif
        </div>

        <div class="doc-right">
            <div class="doc-title">@lang('lang_v1.payment_receipt')</div>
            <div class="badge-paid">&#10003;&nbsp;@lang('lang_v1.paid')</div>
            <div class="doc-meta">
                <strong>@lang('purchase.ref_no'):</strong> {{ $single_payment_line->payment_ref_no ?? '—' }}<br>
                <strong>@lang('lang_v1.paid_on'):</strong> {{ @format_datetime($single_payment_line->paid_on) }}
                @if(!empty($transaction))
                    @if(in_array($transaction->type, ['sell','sell_return']))
                        <br><strong>@lang('sale.invoice_no'):</strong> {{ $transaction->invoice_no }}
                    @elseif(in_array($transaction->type, ['purchase','expense','purchase_return','payroll','hms_booking']))
                        <br><strong>@lang('purchase.ref_no')#:</strong> {{ $transaction->ref_no }}
                    @endif
                @endif
            </div>
        </div>
    </div>

    {{-- AMOUNT banner --}}
    <div class="r-amount">
        <div class="lbl">@lang('purchase.amount') @lang('lang_v1.paid')</div>
        <div class="val">@format_currency($single_payment_line->amount)</div>
    </div>

    {{-- BODY: contact | payment details --}}
    <div class="r-body">

        {{-- LEFT: contact --}}
        <div class="r-col">
            @if(!empty($transaction))
                @if(in_array($transaction->type, ['purchase','purchase_return']))
                    <div class="col-title">@lang('purchase.supplier')</div>
                    @if(!empty($transaction->contact))
                        <div class="party-name">{{ $transaction->contact->supplier_business_name ?? $transaction->contact->name }}</div>
                        <div class="party-detail">
                            {{ $transaction->contact->name }}<br>
                            {!! $transaction->contact->contact_address !!}
                            @if(!empty($transaction->contact->tax_number))<br>@lang('contact.tax_no'): {{ $transaction->contact->tax_number }}@endif
                            @if(!empty($transaction->contact->mobile))<br>{{ $transaction->contact->mobile }}@endif
                        </div>
                    @endif
                @elseif($transaction->type == 'payroll' && !empty($transaction->transaction_for))
                    <div class="col-title">@lang('lang_v1.payroll_for')</div>
                    <div class="party-name">{{ $transaction->transaction_for->user_full_name }}</div>
                    <div class="party-detail">
                        @if(!empty($transaction->transaction_for->address)){{ $transaction->transaction_for->address }}<br>@endif
                        @if(!empty($transaction->transaction_for->contact_number)){{ $transaction->transaction_for->contact_number }}<br>@endif
                        @if(!empty($transaction->transaction_for->email)){{ $transaction->transaction_for->email }}@endif
                    </div>
                @else
                    <div class="col-title">@lang('contact.customer')</div>
                    @if(!empty($transaction->contact))
                        <div class="party-name">{{ $transaction->contact->name }}</div>
                        <div class="party-detail">
                            {!! $transaction->contact->contact_address !!}
                            @if(!empty($transaction->contact->tax_number))<br>@lang('contact.tax_no'): {{ $transaction->contact->tax_number }}@endif
                            @if(!empty($transaction->contact->mobile))<br>{{ $transaction->contact->mobile }}@endif
                        </div>
                    @endif
                @endif
            @endif
        </div>

        {{-- RIGHT: payment method + transaction details --}}
        <div class="r-col">
            <div class="col-title">@lang('lang_v1.payment_method') / @lang('purchase.ref_no')</div>
            <table class="kv">
                <tr>
                    <td>@lang('lang_v1.payment_method')</td>
                    <td>{{ $payment_types[$single_payment_line->method] ?? $single_payment_line->method }}</td>
                </tr>
                @if($single_payment_line->method == 'card' && !empty($single_payment_line->card_transaction_number))
                <tr><td>@lang('lang_v1.card_transaction_number')</td><td>{{ $single_payment_line->card_transaction_number }}</td></tr>
                @endif
                @if($single_payment_line->method == 'cheque' && !empty($single_payment_line->cheque_number))
                <tr><td>@lang('lang_v1.cheque_number')</td><td>{{ $single_payment_line->cheque_number }}</td></tr>
                @endif
                @if($single_payment_line->method == 'bank_transfer' && !empty($single_payment_line->bank_account_number))
                <tr><td>@lang('lang_v1.bank_account_no')</td><td>{{ $single_payment_line->bank_account_number }}</td></tr>
                @endif
                @if(in_array($single_payment_line->method, ['custom_pay_1','custom_pay_2','custom_pay_3']) && !empty($single_payment_line->transaction_no))
                <tr><td>@lang('lang_v1.transaction_number')</td><td>{{ $single_payment_line->transaction_no }}</td></tr>
                @endif
                @if($single_payment_line->method == 'custom_pay_1' && !empty($single_payment_line->due_date))
                <tr><td>@lang('lang_v1.traite_date_echeance')</td><td>{{ @format_date($single_payment_line->due_date) }}</td></tr>
                @endif
                @if(!empty($transaction))
                    <tr><td colspan="2" style="padding-top:5px;"></td></tr>
                    @if(in_array($transaction->type, ['sell','sell_return']))
                    <tr><td>@lang('sale.invoice_no')</td><td>{{ $transaction->invoice_no }}</td></tr>
                    @endif
                    @if(in_array($transaction->type, ['purchase','expense','purchase_return','payroll','hms_booking']))
                    <tr><td>@lang('purchase.ref_no')#</td><td>{{ $transaction->ref_no }}</td></tr>
                    @endif
                    <tr>
                        <td>@lang('purchase.payment_status')</td>
                        <td>{{ __('lang_v1.'.$transaction->payment_status) }}</td>
                    </tr>
                    <tr>
                        <td>@lang('sale.total_amount')</td>
                        <td><strong>@format_currency($transaction->final_total)</strong></td>
                    </tr>
                @endif
            </table>
        </div>
    </div>

    {{-- NOTE (optional) --}}
    @if(!empty($single_payment_line->note))
    <div class="r-note">
        <strong>@lang('purchase.payment_note'):</strong> {{ $single_payment_line->note }}
    </div>
    @endif

    {{-- FOOTER --}}
    <div class="r-footer">
        <div class="footer-note">@lang('lang_v1.payment_receipt_footer_note')</div>
        <div class="sig-box">
            <div class="sig-line"></div>
            <div class="sig-lbl">@lang('lang_v1.authorized_signatory')</div>
        </div>
    </div>
</div>

</body>
</html>

