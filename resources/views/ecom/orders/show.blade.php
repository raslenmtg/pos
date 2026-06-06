<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title">
                <i class="fa fa-shopping-cart"></i> Commande {{ $order->order_number }}
            </h4>
        </div>
        <div class="modal-body">
            <div class="row">
                {{-- Client Info --}}
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading"><strong><i class="fa fa-user"></i> Informations client</strong></div>
                        <div class="panel-body">
                            <p><strong>Nom :</strong> {{ $order->customer_name }}</p>
                            <p><strong>Téléphone :</strong> {{ $order->customer_phone }}</p>
                            <p><strong>Adresse :</strong> {{ $order->customer_address }}</p>
                            @if($order->customer_city)
                            <p><strong>Ville :</strong> {{ $order->customer_city }}</p>
                            @endif
                            @if($order->customer_notes)
                            <p><strong>Notes :</strong> {{ $order->customer_notes }}</p>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Order Info --}}
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading"><strong><i class="fa fa-info-circle"></i> Statut</strong></div>
                        <div class="panel-body">
                            <p><strong>Statut commande :</strong> {!! $order->status_label !!}</p>
                            <p><strong>Expédition :</strong> {!! $order->shipping_status_label !!}</p>
                            <p><strong>Date :</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>
                            @if($order->contact_id)
                            <p><strong>Client POS :</strong> <span class="label label-success"><i class="fa fa-check"></i> Créé</span></p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- Items --}}
            <div class="panel panel-default">
                <div class="panel-heading"><strong><i class="fa fa-list"></i> Articles commandés</strong></div>
                <div class="panel-body p-0">
                    <table class="table table-condensed mb-0">
                        <thead>
                            <tr>
                                <th>Produit</th>
                                <th class="text-center">Qté</th>
                                <th class="text-right">Prix unitaire</th>
                                <th class="text-right">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->items as $item)
                            <tr>
                                <td>{{ $item['name'] }}</td>
                                <td class="text-center">{{ $item['qty'] }}</td>
                                <td class="text-right">{{ number_format($item['price'], 3) }} TND</td>
                                <td class="text-right">{{ number_format($item['price'] * $item['qty'], 3) }} TND</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="3" class="text-right">Total</th>
                                <th class="text-right">{{ number_format($order->subtotal, 3) }} TND</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            {{-- Actions --}}
            <div class="row">
                {{-- Update Status --}}
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading"><strong><i class="fa fa-pencil"></i> Mettre à jour le statut</strong></div>
                        <div class="panel-body">
                            <form id="update_status_form">
                                @csrf
                                <div class="form-group">
                                    <label>Statut commande</label>
                                    <select name="status" class="form-control">
                                        @foreach($order_statuses as $key => $label)
                                        <option value="{{ $key }}" {{ $order->status === $key ? 'selected' : '' }}>{{ $label }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Statut expédition</label>
                                    <select name="shipping_status" class="form-control">
                                        <option value="">— Aucun —</option>
                                        @foreach($shipping_statuses as $key => $label)
                                        <option value="{{ $key }}" {{ $order->shipping_status === $key ? 'selected' : '' }}>{{ $label }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="button" class="tw-dw-btn tw-dw-btn-primary" id="btn_update_status"
                                    data-url="{{ route('ecom.orders.status', $order->id) }}">
                                    <i class="fa fa-save"></i> Enregistrer
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- Create Contact --}}
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading"><strong><i class="fa fa-user-plus"></i> Client POS</strong></div>
                        <div class="panel-body">
                            @if($order->contact_id)
                                <div class="alert alert-success">
                                    <i class="fa fa-check-circle"></i> Ce client existe déjà dans le système POS.
                                </div>
                            @else
                                <p class="text-muted">Créer une fiche client POS depuis cette commande :</p>
                                <button type="button" class="tw-dw-btn tw-dw-btn-success" id="btn_create_contact"
                                    data-url="{{ route('ecom.orders.createContact', $order->id) }}">
                                    <i class="fa fa-user-plus"></i> Créer le client
                                </button>
                                <div id="contact_result" class="mt-2"></div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="tw-dw-btn" data-dismiss="modal">Fermer</button>
        </div>
    </div>
</div>

<script>
$('#btn_update_status').on('click', function() {
    var url = $(this).data('url');
    var data = $('#update_status_form').serialize();
    $.post(url, data, function(res) {
        if (res.success) {
            toastr.success(res.msg);
        } else {
            toastr.error(res.msg);
        }
    });
});

$('#btn_create_contact').on('click', function() {
    var url = $(this).data('url');
    $.post(url, {_token: '{{ csrf_token() }}'}, function(res) {
        if (res.success) {
            toastr.success(res.msg);
            $('#btn_create_contact').prop('disabled', true).html('<i class="fa fa-check"></i> Client créé');
        } else {
            toastr.error(res.msg);
        }
    });
});
</script>
