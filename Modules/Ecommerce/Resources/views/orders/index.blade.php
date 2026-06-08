@extends('layouts.app')

@section('title', 'Commandes en ligne')

@section('content')
<section class="content-header">
    <h1>Commandes en ligne </h1>
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-shopping-bag"></i> Liste des commandes en ligne</h3>
                </div>
                <div class="box-body">
                    <table class="table table-bordered table-striped" id="ecom_orders_table">
                        <thead>
                            <tr>
                                <th>Référence</th>
                                <th>Client</th>
                                <th>Total</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Order Detail Modal -->
<div class="modal fade" id="order_detail_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><i class="fa fa-eye"></i> Détail de la commande</h4>
            </div>
            <div class="modal-body" id="order_detail_content">
                <div class="text-center"><i class="fa fa-spinner fa-spin fa-2x"></i></div>
            </div>
        </div>
    </div>
</div>

<!-- Finalize Order Modal -->
<div class="modal fade" id="finalize_order_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light-green">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" style="color:#fff;"><i class="fa fa-check-circle"></i> Finaliser la commande</h4>
            </div>
            <div class="modal-body">
                <p>Sélectionnez le statut d'expédition pour cette commande:</p>
                <div class="form-group">
                    <select id="finalize_shipping_status" class="form-control">
                        @foreach($shipping_statuses as $key => $label)
                            <option value="{{ $key }}" {{ $key === 'ordered' ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="callout callout-info" style="margin-top:12px;">
                    <i class="fa fa-info-circle"></i>
                    Le fiche client sera mise à jour avec les informations de la commande.
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-success" id="btn_confirm_finalize">
                    <i class="fa fa-check"></i> Confirmer la commande
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')
<script>
$(function () {
    var table = $('#ecom_orders_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route("ecom.orders.index") }}',
        columns: [
            { data: 'ref_no', name: 'transactions.ref_no' },
            { data: 'customer', name: 'contacts.name', orderable: false },
            { data: 'total', name: 'transactions.final_total' },
            { data: 'date', name: 'transactions.created_at' },
            { data: 'actions', name: 'actions', orderable: false, searchable: false },
        ],
        order: [[3, 'desc']]
    });

    // Show detail modal
    $(document).on('click', '.btn-show-order', function () {
        var id = $(this).data('id');
        $('#order_detail_content').html('<div class="text-center" style="padding:40px"><i class="fa fa-spinner fa-spin fa-2x"></i></div>');
        $('#order_detail_modal').modal('show');
        $.get('{{ route("ecom.orders.index") }}/' + id, function (html) {
            $('#order_detail_content').html(html);
        });
    });

    // Open finalize modal
    var current_order_id = null;
    $(document).on('click', '.btn-finalize-order', function () {
        current_order_id = $(this).data('id');
        $('#finalize_order_modal').modal('show');
    });

    // Confirm finalize
    $('#btn_confirm_finalize').on('click', function () {
        if (! current_order_id) return;
        var shipping = $('#finalize_shipping_status').val();
        var btn = $(this).prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> En cours...');

        $.ajax({
            url: '{{ url("ecom/online-orders") }}/' + current_order_id + '/finalize',
            method: 'POST',
            data: { _token: '{{ csrf_token() }}', shipping_status: shipping },
            success: function (res) {
                if (res.success) {
                    $('#finalize_order_modal').modal('hide');
                    table.ajax.reload();
                    toastr.success(res.message || 'Commande finalisée.');
                } else {
                    toastr.error(res.message || 'Erreur.');
                }
            },
            error: function (xhr) {
                toastr.error('Erreur serveur: ' + (xhr.responseJSON ? xhr.responseJSON.message : xhr.statusText));
            },
            complete: function () {
                btn.prop('disabled', false).html('<i class="fa fa-check"></i> Confirmer la finalisation');
                current_order_id = null;
            }
        });
    });
});
</script>
@endsection
