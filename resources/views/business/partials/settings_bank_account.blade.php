{{-- Bank account settings for bill of exchange --}}
<div class="pos-tab-content">
    <div class="row">
        <div class="col-md-12">
            <h4 class="tw-font-bold" style="margin-bottom:12px;">
                <i class="fas fa-university"></i>
                Comptes bancaires (Lettre de change)
            </h4>
        </div>


        {{-- Add new account button --}}
        <div class="col-md-12" style="margin-bottom:10px;">
            <button type="button" class="btn btn-primary btn-sm" id="btn_show_create_account">
                <i class="fa fa-plus"></i> Nouveau compte
            </button>
        </div>

        {{-- Accounts table --}}
        <div class="col-md-10">
            <table class="table table-bordered table-striped table-condensed" id="bank_accounts_table">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Numéro de compte (RIB)</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($business_accounts as $acc)
                    <tr id="bank_acc_row_{{ $acc->id }}">
                        <td>{{ $acc->name }}</td>
                        <td>{{ $acc->account_number }}</td>
                        <td>
                            @if($acc->is_closed)
                                <span class="label label-danger">Fermé</span>
                            @else
                                <span class="label label-success">Actif</span>
                            @endif
                        </td>
                        <td>
                            <button type="button" class="btn btn-xs btn-info btn-edit-account"
                                data-id="{{ $acc->id }}"
                                data-name="{{ $acc->name }}"
                                data-number="{{ $acc->account_number }}"
                                data-closed="{{ $acc->is_closed }}">
                                <i class="fa fa-edit"></i> Modifier
                            </button>
                            <button type="button" class="btn btn-xs btn-danger btn-delete-account"
                                data-id="{{ $acc->id }}">
                                <i class="fa fa-trash"></i> Supprimer
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr id="bank_acc_empty_row"><td colspan="4" class="text-center text-muted">Aucun compte bancaire enregistré.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>{{-- .row --}}
</div>{{-- .pos-tab-content --}}

{{-- ── CREATE modal ─────────────────────────────────────────── --}}
<div class="modal fade" id="modal_create_account" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><i class="fa fa-plus-circle"></i> Nouveau compte bancaire</h4>
            </div>
            <div class="modal-body">
                <div id="create_acc_alert"></div>
                <div class="form-group">
                    <label>Nom <span class="text-danger">*</span></label>
                    <input type="text" id="create_acc_name" class="form-control" placeholder="ex: STB">
                </div>
                <div class="form-group">
                    <label>Numéro de compte (RIB) <span class="text-danger">*</span></label>
                    <input type="text" id="create_acc_number" class="form-control" placeholder="ex: 01002003123456789012">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-success" id="btn_save_new_account">
                    <i class="fa fa-save"></i> Enregistrer
                </button>
            </div>
        </div>
    </div>
</div>

{{-- ── EDIT modal ────────────────────────────────────────────── --}}
<div class="modal fade" id="modal_edit_account" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><i class="fa fa-edit"></i> Modifier le compte bancaire</h4>
            </div>
            <div class="modal-body">
                <div id="edit_acc_alert"></div>
                <input type="hidden" id="edit_acc_id">
                <div class="form-group">
                    <label>Nom <span class="text-danger">*</span></label>
                    <input type="text" id="edit_acc_name" class="form-control">
                </div>
                <div class="form-group">
                    <label>Numéro de compte (RIB) <span class="text-danger">*</span></label>
                    <input type="text" id="edit_acc_number" class="form-control">
                </div>
                <div class="form-group">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" id="edit_acc_closed" value="1">
                            Compte fermé
                        </label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-primary" id="btn_update_account">
                    <i class="fa fa-save"></i> Mettre à jour
                </button>
            </div>
        </div>
    </div>
</div>


@section('javascript')
    <script type="text/javascript">
        $(document).ready( function(){

        /* ── Open create modal ─────────────────────────────── */
        $(document).on('click', '#btn_show_create_account', function () {
            $('#create_acc_name, #create_acc_number').val('');
            $('#create_acc_alert').html('');
            $('#modal_create_account').modal('show');
        });

        /* ── Save new account ──────────────────────────────── */
        $(document).on('click', '#btn_save_new_account', function () {
            var name   = $.trim($('#create_acc_name').val());
            var number = $.trim($('#create_acc_number').val());

            if (!name || !number) {
                $('#create_acc_alert').html('<div class="alert alert-danger">Le nom et le numéro de compte sont obligatoires.</div>');
                return;
            }

            var $btn = $(this).prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i>');

            $.ajax({
                url: '{{ url("account/account") }}',
                type: 'POST',
                dataType: 'json',
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                data: { _token: '{{ csrf_token() }}', name: name, account_number: number, opening_balance: 0 },
                success: function (response) {
                    if (response.success) {
                        /* Add row to table */
                        $('#bank_acc_empty_row').remove();
                        var html = '<tr id="bank_acc_row_' + response.account_id + '">'
                            + '<td>' + $('<div>').text(name).html() + '</td>'
                            + '<td>' + $('<div>').text(number).html() + '</td>'
                            + '<td><span class="label label-success">Actif</span></td>'
                            + '<td>'
                            + '<button type="button" class="btn btn-xs btn-info btn-edit-account" data-id="' + response.account_id + '" data-name="' + $('<div>').text(name).html() + '" data-number="' + $('<div>').text(number).html() + '" data-closed="0"><i class="fa fa-edit"></i> Modifier</button> '
                            + '<button type="button" class="btn btn-xs btn-danger btn-delete-account" data-id="' + response.account_id + '"><i class="fa fa-trash"></i> Supprimer</button>'
                            + '</td></tr>';
                        $('#bank_accounts_table tbody').append(html);


                        $('#create_acc_alert').html('<div class="alert alert-success"><i class="fa fa-check"></i> Compte créé avec succès.</div>');
                        setTimeout(function () { $('#modal_create_account').modal('hide'); }, 1200);
                    } else {
                        $('#create_acc_alert').html('<div class="alert alert-danger">' + response.msg + '</div>');
                    }
                },
                error: function () {
                    $('#create_acc_alert').html('<div class="alert alert-danger">Erreur lors de la création.</div>');
                },
                complete: function () {
                    $btn.prop('disabled', false).html('<i class="fa fa-save"></i> Enregistrer');
                }
            });
        });

        /* ── Open edit modal ────────────────────────────────── */
        $(document).on('click', '.btn-edit-account', function () {
            var id     = $(this).data('id');
            var name   = $(this).data('name');
            var number = $(this).data('number');
            var closed = parseInt($(this).data('closed'));

            $('#edit_acc_id').val(id);
            $('#edit_acc_name').val(name);
            $('#edit_acc_number').val(number);
            $('#edit_acc_closed').prop('checked', closed === 1);
            $('#edit_acc_alert').html('');
            $('#modal_edit_account').modal('show');
        });

        /* ── Update account ─────────────────────────────────── */
        $(document).on('click', '#btn_update_account', function () {
            var id     = $('#edit_acc_id').val();
            var name   = $.trim($('#edit_acc_name').val());
            var number = $.trim($('#edit_acc_number').val());
            var closed = $('#edit_acc_closed').is(':checked') ? 1 : 0;

            if (!name || !number) {
                $('#edit_acc_alert').html('<div class="alert alert-danger">Le nom et le numéro de compte sont obligatoires.</div>');
                return;
            }

            var $btn = $(this).prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i>');

            $.ajax({
                url: '{{ url("account/simple-update") }}/' + id,
                type: 'POST',
                dataType: 'json',
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                data: { _token: '{{ csrf_token() }}', name: name, account_number: number, is_closed: closed },
                success: function (response) {
                    if (response.success) {
                        /* Update row in table */
                        var $row = $('#bank_acc_row_' + id);
                        $row.find('td:eq(0)').text(name);
                        $row.find('td:eq(1)').text(number);
                        $row.find('td:eq(2)').html(closed
                            ? '<span class="label label-danger">Fermé</span>'
                            : '<span class="label label-success">Actif</span>');
                        /* Update edit button data */
                        $row.find('.btn-edit-account')
                            .data('name', name)
                            .data('number', number)
                            .data('closed', closed);


                        $('#edit_acc_alert').html('<div class="alert alert-success"><i class="fa fa-check"></i> Compte mis à jour.</div>');
                        setTimeout(function () { $('#modal_edit_account').modal('hide'); }, 1200);
                    } else {
                        $('#edit_acc_alert').html('<div class="alert alert-danger">' + response.msg + '</div>');
                    }
                },
                error: function () {
                    $('#edit_acc_alert').html('<div class="alert alert-danger">Erreur lors de la mise à jour.</div>');
                },
                complete: function () {
                    $btn.prop('disabled', false).html('<i class="fa fa-save"></i> Mettre à jour');
                }
            });
        });

        /* ── Delete account ─────────────────────────────────── */
        $(document).on('click', '.btn-delete-account', function () {
            var id  = $(this).data('id');
            var $tr = $(this).closest('tr');

            if (!confirm('Supprimer ce compte bancaire ?')) return;

            $.ajax({
                url: '{{ url("account/account") }}/' + id,
                type: 'POST',
                dataType: 'json',
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                data: { _token: '{{ csrf_token() }}', _method: 'DELETE' },
                success: function (response) {
                    if (response.success) {
                        $tr.remove();
                        if ($('#bank_accounts_table tbody tr').length === 0) {
                            $('#bank_accounts_table tbody').append(
                                '<tr id="bank_acc_empty_row"><td colspan="4" class="text-center text-muted">Aucun compte bancaire enregistré.</td></tr>'
                            );
                        }
                    } else {
                        alert(response.msg);
                    }
                },
                error: function () {
                    alert('Erreur lors de la suppression.');
                }
            });
        });

    });
</script>
@endsection
