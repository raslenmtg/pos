<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Traite</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { background: #ccc; display: flex; flex-direction: column; align-items: center; padding: 20px; font-family: Arial, sans-serif; }
        .print-btn { margin-bottom: 12px; padding: 10px 24px; background: #1a73e8; color: white; border: none; border-radius: 6px; font-size: 14px; cursor: pointer; }
        .page {
            position: relative;
            width: 500.87px;
            height: 330px;
            background: white;
            box-shadow: 0 4px 20px rgba(0,0,0,0.3);
            font-family: Arial, sans-serif;
            font-size: 8pt;
            color: black;
        }
        .t { position: absolute; white-space: nowrap; }

        @media print {
            html, body { background: white; padding: 0; margin: 0; }
            .print-btn { display: none; }
            .page {
                box-shadow: none;
                zoom: 1.5;
            }
            @page { size: auto; margin: 0; }
        }
    </style>
</head>
<body>

@php
    $location = $transaction->location ?? null;
    $contact  = $transaction->contact  ?? null;
    $business = $transaction->business ?? null;

    // City
    $city = $location->city ?? ($business->locations->first()->city ?? '');

    // Dates
    $emission_date = !empty($payment->paid_on)
        ? \Carbon\Carbon::parse($payment->paid_on)->format('d/m/Y') : '';
    $echeance_date = !empty($payment->due_date)
        ? \Carbon\Carbon::parse($payment->due_date)->format('d/m/Y') : '';

    // Default values so variables are always defined
    $rib_raw    = '';
    $rib_bank   = '';
    $rib_branch = '';
    $rib_acc    = '';
    $rib_key    = '';
    $bank_name  = '';
    $bank_branch = '';

    if (in_array($transaction->type, ['sell', 'sell_return'])) {
    $beneficiary = $business->name ?? '';
     if($contact->contact_type=='business')
     $drawer_name   = $contact->supplier_business_name ?? '';
     else
     $drawer_name   = $contact->name ?? '';

    $drawer_address = trim($contact->city ?? '');
    $drawer_zip     = $contact->zip_code ?? '';

    } else{

    if (!empty($business_account)) {
        $rib_raw   = preg_replace('/\s+/', '', $business_account->account_number ?? '');
        $bank_name = $business_account->name ?? '';
    } else {
        $rib_raw   = preg_replace('/\s+/', '', $payment->bank_account_number ?? '');
        $bank_name = trim(explode('-', $payment->note ?? '', 2)[0] ?? '');
    }
    $bank_branch = '';

    // Split 20-digit RIB: [2 bank][3 branch][13 account][2 key]
    $rib_bank   = strlen($rib_raw) >= 2  ? substr($rib_raw, 0,  2)  : $rib_raw;
    $rib_branch = strlen($rib_raw) >= 5  ? substr($rib_raw, 2,  3)  : '';
    $rib_acc    = strlen($rib_raw) >= 18 ? substr($rib_raw, 5,  13) : (strlen($rib_raw) > 5 ? substr($rib_raw, 5) : '');
    $rib_key    = strlen($rib_raw) >= 20 ? substr($rib_raw, 18, 2)  : '';

    if($contact->contact_type=='business')
     $beneficiary   = $contact->supplier_business_name ?? '';
     else
     $beneficiary   = $contact->name ?? '';
    $drawer_name= $business->name ?? '';
    $drawer_address = trim($location->city ?? '');
    $drawer_zip     = $location->zip_code ?? '';

    }
    $amount_formatted = '#' . number_format((float)$payment->amount, 3, ',', ' ') . '# DT';

@endphp

<button class="print-btn" onclick="window.print()">🖨 Imprimer</button>

<div class="page">
    <!-- px coords * 0.6261 for x, * 0.6372 for y (scaled x1.3) -->

    <div class="t" style="left:269px; top:36px;">{{ $city }}</div>
    <div class="t" style="left:164px; top:47px;">{{ $emission_date }}</div>
    <div class="t" style="left:264px; top:47px;">{{ $echeance_date }}</div>

    <div class="t" style="left:152px; top:75px;">{{ $rib_bank??'' }}</div>
    <div class="t" style="left:182px; top:75px;">{{ $rib_branch??'' }}</div>
    <div class="t" style="left:225px; top:75px;">{{ $rib_acc??'' }}</div>
    <div class="t" style="left:336px; top:75px;">{{ $rib_key??'' }}</div>
    <div class="t" style="left:403px; top:74px;">{{ $amount_formatted }}</div>

    <div class="t" style="left:42px; top:115px;">{{ $beneficiary }}</div>
    <div class="t" style="left:403px; top:117px;">{{ $amount_formatted }}</div>
    <div class="t" style="left:240px; top:123px;">{{ $beneficiary }}</div>
    <div class="t" style="left:100px; top:141px;">{{ $amount_in_words }}</div>

    <div class="t" style="left:25px;  top:171px;">{{ $city }}</div>
    <div class="t" style="left:104px; top:171px;">{{ $emission_date }}</div>
    <div class="t" style="left:183px; top:171px;">{{ $echeance_date }}</div>

    <div class="t" style="left:19px;  top:203px;">{{ $rib_bank }}</div>
    <div class="t" style="left:41px;  top:203px;">{{ $rib_branch }}</div>
    <div class="t" style="left:94px;  top:203px;">{{ $rib_acc }}</div>
    <div class="t" style="left:200px; top:203px;">{{ $rib_key }}</div>
    <div class="t" style="left:376px; top:203px;">{{ $bank_name }}</div>
    <div class="t" style="left:387px; top:212px;">{{ $bank_branch }}</div>

    <div class="t" style="left:255px; top:218px;">{{ $drawer_name }}</div>
    <div class="t" style="left:225px; top:228px;">{{ $drawer_address }}</div>
    <div class="t" style="left:277px; top:239px;">{{ $drawer_zip }}</div>
</div>

</body>
</html>

