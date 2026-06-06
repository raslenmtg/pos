@extends('layouts.app')
@section('title', 'Commandes en ligne')

@section('content')
<section class="content-header no-print">
    <h1 class="tw-text-xl md:tw-text-3xl tw-font-bold tw-text-black">
        <i class="fa fa-shopping-cart"></i> Commandes en ligne
    </h1>
</section>

<section class="content no-print">
    @component('components.widget', ['class' => 'box-primary'])
    @slot('tool')
    <div class="box-tools">
        @if($business->ecom_slug)
        <a href="{{ route('online_store.index', $business->ecom_slug) }}" target="_blank" class="tw-dw-btn tw-dw-btn-sm tw-dw-btn-success">
            <i class="fa fa-external-link"></i> Voir ma boutique
        </a>
        @else
        <a href="{{ action([\App\Http\Controllers\BusinessController::class, 'getBusinessSettings']) }}" class="tw-dw-btn tw-dw-btn-sm tw-dw-btn-warning">
            <i class="fa fa-cog"></i> Configurer le slug de boutique
        </a>
        @endif
    </div>
    @endslot

    <div class="table-responsive">
        <table class="table table-bordered table-striped" id="online_orders_table" width="100%">
            <thead>
                <tr>
                    <th>N° Commande</th>
                    <th>Date</th>
                    <th>Client</th>
                    <th>Téléphone</th>
                    <th>Ville</th>
                    <th>Total</th>
                    <th>Statut</th>
                    <th>Expédition</th>
                    <th>Actions</th>
                </tr>
            </thead>
        </table>
    </div>
    @endcomponent
</section>

<div class="modal fade view_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel"></div>
@endsection

@section('javascript')
<script>
$(document).ready(function () {
    var table = $('#online_orders_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route("ecom.orders.index") }}',
        columns: [
            { data: 'order_number', name: 'order_number' },
            { data: 'created_at', name: 'created_at' },
            { data: 'customer_name', name: 'customer_name' },
            { data: 'customer_phone', name: 'customer_phone' },
            { data: 'customer_city', name: 'customer_city' },
            { data: 'subtotal', name: 'subtotal' },
            { data: 'status', name: 'status' },
            { data: 'shipping_status', name: 'shipping_status' },
            { data: 'action', name: 'action', orderable: false, searchable: false },
        ],
        order: [[1, 'desc']],
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/fr-FR.json'
        }
    });

    $(document).on('click', '.btn-modal', function(e) {
        e.preventDefault();
        var href = $(this).data('href');
        var container = $(this).data('container');
        $.ajax({
            url: href,
            success: function(result) {
                $(container).html(result).modal('show');
            }
        });
    });
});
</script>
@endsection
