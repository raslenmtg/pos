<div class="row">
    <div class="col-sm-6">
        <h5 style="margin-top:0;font-weight:700;"><i class="fa fa-user"></i> Informations client</h5>
        <table class="table table-condensed">
            <tr><td style="width:120px;color:#888;">Nom</td><td><strong>{{ $info['customer_name'] ?? ($contact->name ?? '—') }}</strong></td></tr>
            <tr><td style="color:#888;">Téléphone</td><td>{{ $info['customer_phone'] ?? ($contact->mobile ?? '—') }}</td></tr>
            <tr><td style="color:#888;">Adresse</td><td>{{ $info['customer_address'] ?? ($contact->address_line_1 ?? '—') }}</td></tr>
        </table>
    </div>
    <div class="col-sm-6">
        <h5 style="margin-top:0;font-weight:700;"><i class="fa fa-info-circle"></i> Détails commande</h5>
        <table class="table table-condensed">
            <tr><td style="width:120px;color:#888;">Référence</td><td><strong>{{ $transaction->ref_no }}</strong></td></tr>
            <tr><td style="color:#888;">Date</td><td>{{ $transaction->created_at->format('d/m/Y H:i') }}</td></tr>
            <tr><td style="color:#888;">Expédition</td>
                <td>
                    @php
                        $colors = ['ordered'=>'info','packed'=>'warning','shipped'=>'primary','delivered'=>'success','cancelled'=>'danger'];
                        $sc = $colors[$transaction->shipping_status] ?? 'default';
                    @endphp
                    @if($transaction->shipping_status)
                        <span class="label label-{{ $sc }}">{{ $shipping_statuses[$transaction->shipping_status] ?? $transaction->shipping_status }}</span>
                    @else
                        <em class="text-muted">Non défini</em>
                    @endif
                </td>
            </tr>
        </table>
    </div>
</div>

<h5 style="font-weight:700;border-top:1px solid #eee;padding-top:16px;"><i class="fa fa-list"></i> Articles commandés</h5>
<table class="table table-bordered table-condensed">
    <thead style="background:#f8f9fa;">
        <tr>
            <th>Produit</th>
            <th>Variante</th>
            <th class="text-right">Prix unit.</th>
            <th class="text-right">Qté</th>
            <th class="text-right">Sous-total</th>
        </tr>
    </thead>
    <tbody>
        @foreach($transaction->sell_lines as $line)
        <tr>
            <td>{{ $line->product->name ?? 'Produit supprimé' }}</td>
            <td>
                @php $vname = optional($line->variations->first())->name ?? ''; @endphp
                {{ $vname && $vname !== 'DUMMY' ? $vname : '—' }}
            </td>
            <td class="text-right">{{ number_format($line->unit_price_inc_tax, 2) }} DT</td>
            <td class="text-right">{{ (int)$line->quantity }}</td>
            <td class="text-right"><strong>{{ number_format($line->unit_price_inc_tax * $line->quantity, 2) }} DT</strong></td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td colspan="4" class="text-right"><strong>Total</strong></td>
            <td class="text-right"><strong style="color:#1a73e8;font-size:16px;">{{ number_format($transaction->final_total, 2) }} DT</strong></td>
        </tr>
    </tfoot>
</table>
