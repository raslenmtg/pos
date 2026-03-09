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
            body { background: white; padding: 0; }
            .print-btn { display: none; }
            .page { box-shadow: none; }
            @page { size: A4; margin: 0; }
        }
    </style>
</head>
<body>

<button class="print-btn" onclick="window.print()">🖨️ Imprimer</button>

<div class="page">
    <!-- px coords * 0.6261 for x, * 0.6372 for y -->

    <div class="t" style="left:269px; top:36px;">nabeul</div>
    <div class="t" style="left:164px; top:47px;">11/03/2026</div>
    <div class="t" style="left:264px; top:47px;">09/03/2026</div>

    <div class="t" style="left:152px; top:75px;">12</div>
    <div class="t" style="left:182px; top:75px;">345</div>
    <div class="t" style="left:225px; top:75px;">6789123456789</div>
    <div class="t" style="left:336px; top:75px;">20</div>
    <div class="t" style="left:403px; top:74px;">1 200,000 DT</div>

    <div class="t" style="left:403px; top:117px;">1 200,000 DT</div>
    <div class="t" style="left:240px; top:123px;">PACO</div>
    <div class="t" style="left:201px; top:141px;">mille deux cents dinars.</div>

    <div class="t" style="left:33px;  top:171px;">nabeul</div>
    <div class="t" style="left:104px; top:171px;">09/03/2026</div>
    <div class="t" style="left:183px; top:171px;">11/03/2026</div>

    <div class="t" style="left:19px;  top:203px;">12</div>
    <div class="t" style="left:41px;  top:203px;">345</div>
    <div class="t" style="left:94px;  top:203px;">6789123456789</div>
    <div class="t" style="left:200px; top:203px;">20</div>
    <div class="t" style="left:376px; top:203px;">ATTIJARI BANK</div>
    <div class="t" style="left:387px; top:212px;">hammem lif</div>

    <div class="t" style="left:255px; top:218px;">EL CAPO</div>
    <div class="t" style="left:225px; top:228px;">Hammem lif, ben arous</div>
    <div class="t" style="left:277px; top:239px;">8010</div>
</div>

</body>
</html>