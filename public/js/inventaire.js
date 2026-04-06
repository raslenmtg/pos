function inventaire_product_row(variation_id) {
    var row_index = parseInt($('#product_row_index').val());
    var location_id = $('select#location_id').val();
    $.ajax({
        method: 'POST',
        url: '/inventaire/get_product_row',
        data: { row_index: row_index, variation_id: variation_id, location_id: location_id },
        dataType: 'html',
        success: function(result) {
            append_inventaire_rows(result);
            $('#product_row_index').val(row_index + 1);
        },
    });
}

function append_inventaire_rows(rows_html) {
    var rows = $('<tbody>' + rows_html + '</tbody>').find('tr');
    rows.each(function() {
        var variation_id = $(this).data('variation_id');
        if ($('table#inventaire_product_table tbody tr[data-variation_id="' + variation_id + '"]').length == 0) {
            $('table#inventaire_product_table tbody').append($(this));
            update_inventaire_row($('table#inventaire_product_table tbody tr[data-variation_id="' + variation_id + '"]'));
        }
    });
}

function update_inventaire_row(tr) {
    var real_qty = parseFloat(__read_number(tr.find('input.real_quantity')));
    if (isNaN(real_qty)) {
        real_qty = 0;
    }
    var theoretical_qty = parseFloat(tr.find('.theoretical_qty_text').data('value'));
    if (isNaN(theoretical_qty)) {
        theoretical_qty = 0;
    }
    var difference = real_qty - theoretical_qty;
    var difference_text = tr.find('.difference_qty_text');
    difference_text.text(__number_f(difference));
    difference_text.removeClass('text-success text-danger');
    if (difference > 0) {
        difference_text.addClass('text-success');
    } else if (difference < 0) {
        difference_text.addClass('text-danger');
    }
}

function get_selected_variation_ids_for_export() {
    var variation_ids = [];
    $('table#inventaire_product_table tbody tr').each(function() {
        variation_ids.push(parseInt($(this).data('variation_id')));
    });
    return variation_ids;
}

function refresh_inventaire_table() {
    if ($('#inventaire_table').length == 0 || typeof inventaire_table === 'undefined') {
        return;
    }

    var location_id = $('#inventaire_location_filter').val();
    var product_id = $('#inventaire_product_filter').val();
    var start = $('#inventaire_date_filter')
        .data('daterangepicker')
        .startDate.format('YYYY-MM-DD');
    var end = $('#inventaire_date_filter')
        .data('daterangepicker')
        .endDate.format('YYYY-MM-DD');

    inventaire_table.ajax
        .url(
            '/inventaire?location_id=' +
                (location_id || '') +
                '&product_id=' +
                (product_id || '') +
                '&start_date=' +
                start +
                '&end_date=' +
                end
        )
        .load();
}

$(document).ready(function() {
    if ($('#search_product_for_inventaire').length > 0) {
        $('#search_product_for_inventaire')
            .autocomplete({
                source: function(request, response) {
                    $.getJSON(
                        '/products/list',
                        { location_id: $('#location_id').val(), term: request.term, check_qty: false, 'search_fields[]': ['name', 'sku'] },
                        response
                    );
                },
                minLength: 2,
                response: function(event, ui) {
                    if (ui.content.length == 0) {
                        swal(LANG.no_products_found);
                    }
                },
                select: function(event, ui) {
                    $(this).val(null);
                    inventaire_product_row(ui.item.variation_id);
                },
            })
            .autocomplete('instance')._renderItem = function(ul, item) {
            var string = '<div>' + item.name;
            if (item.type == 'variable') {
                string += '-' + item.variation;
            }
            string += ' (' + item.sub_sku + ') </div>';
            return $('<li>')
                .append(string)
                .appendTo(ul);
        };
    }

    if ($('select#location_id').length > 0 && $('select#location_id').val()) {
        $('#search_product_for_inventaire').removeAttr('disabled');
    }

    $('select#location_id').change(function() {
        if ($(this).val()) {
            $('#search_product_for_inventaire').removeAttr('disabled');
        } else {
            $('#search_product_for_inventaire').attr('disabled', 'disabled');
        }

        $('table#inventaire_product_table tbody').html('');
        $('#product_row_index').val(0);
    });

    $('table#inventaire_product_table tbody tr').each(function() {
        update_inventaire_row($(this));
    });

    $(document).on('change', 'input.real_quantity', function() {
        update_inventaire_row($(this).closest('tr'));
    });

    $(document).on('click', '.remove_inventaire_product_row', function() {
        swal({
            title: LANG.sure,
            icon: 'warning',
            buttons: true,
            dangerMode: true,
        }).then(willDelete => {
            if (willDelete) {
                $(this)
                    .closest('tr')
                    .remove();
            }
        });
    });

    $(document).on('change', '#category_id', function() {
        var cat = $(this).val();
        $.ajax({
            method: 'POST',
            url: '/products/get_sub_categories',
            dataType: 'html',
            data: { cat_id: cat },
            success: function(result) {
                if (result) {
                    $('#sub_category_id').html(result);
                }
            },
        });
    });

    $('#add_category_products').on('click', function() {
        var location_id = $('#location_id').val();
        var category_id = $('#category_id').val();
        var sub_category_id = $('#sub_category_id').val();
        var row_index = parseInt($('#product_row_index').val());

        if (!location_id) {
            toastr.warning(LANG.select_location);
            return;
        }
        if (!category_id) {
            toastr.warning(LANG.please_select);
            return;
        }

        $.ajax({
            method: 'POST',
            url: '/inventaire/get_products_by_category',
            dataType: 'json',
            data: {
                location_id: location_id,
                category_id: category_id,
                sub_category_id: sub_category_id,
                row_index: row_index,
            },
            success: function(result) {
                append_inventaire_rows(result.html);
                $('#product_row_index').val(result.next_row_index);
            },
        });
    });

    $('#add_all_products').on('click', function() {
        var location_id = $('#location_id').val();
        var row_index = parseInt($('#product_row_index').val());

        if (!location_id) {
            toastr.warning(LANG.select_location);
            return;
        }

        $.ajax({
            method: 'POST',
            url: '/inventaire/get_products_by_category',
            dataType: 'json',
            data: {
                location_id: location_id,
                category_id: '',
                sub_category_id: '',
                row_index: row_index,
            },
            success: function(result) {
                append_inventaire_rows(result.html);
                $('#product_row_index').val(result.next_row_index);
            },
        });
    });

    if ($('#inventory_date').length > 0) {
        $('#inventory_date').datetimepicker({
            format: moment_date_format + ' ' + moment_time_format,
            ignoreReadonly: true,
        });
    }

    $('form#inventaire_form').validate();
    $('form#inventaire_form').on('submit', function(e) {
        if ($('table#inventaire_product_table tbody').find('.inventaire_product_row').length <= 0) {
            e.preventDefault();
            toastr.warning(LANG.no_products_added);
            return false;
        }
    });

    $('#export_inventaire_excel').on('click', function() {
        var variation_ids = get_selected_variation_ids_for_export();
        if (variation_ids.length == 0) {
            toastr.warning(LANG.no_products_added);
            return false;
        }
        $('#export_excel_location_id').val($('#location_id').val());
        $('#export_excel_variation_ids').val(JSON.stringify(variation_ids));
        $('#inventaire_export_excel_form').submit();
    });

    $('#export_inventaire_pdf').on('click', function() {
        var variation_ids = get_selected_variation_ids_for_export();
        if (variation_ids.length == 0) {
            toastr.warning(LANG.no_products_added);
            return false;
        }
        $('#export_pdf_location_id').val($('#location_id').val());
        $('#export_pdf_variation_ids').val(JSON.stringify(variation_ids));
        $('#inventaire_export_pdf_form').submit();
    });

    if ($('#inventaire_table').length > 0) {
        $('#inventaire_product_filter').select2({
            ajax: {
                url: '/products/list-no-variation',
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        term: params.term || '',
                    };
                },
                processResults: function(data) {
                    return { results: data };
                },
            },
            minimumInputLength: 1,
            placeholder: LANG.all,
            allowClear: true,
        });

        if ($('#inventaire_date_filter').length == 1) {
            $('#inventaire_date_filter').daterangepicker(dateRangeSettings, function(start, end) {
                $('#inventaire_date_filter span').html(
                    start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format)
                );
                refresh_inventaire_table();
            });
            $('#inventaire_date_filter span').html(
                $('#inventaire_date_filter')
                    .data('daterangepicker')
                    .startDate.format(moment_date_format) +
                    ' ~ ' +
                    $('#inventaire_date_filter')
                        .data('daterangepicker')
                        .endDate.format(moment_date_format)
            );
        }

        inventaire_table = $('#inventaire_table').DataTable({
            processing: true,
            serverSide: true,
            fixedHeader: false,
            ajax: '/inventaire',
            columnDefs: [
                {
                    targets: 0,
                    orderable: false,
                    searchable: false,
                },
            ],
            aaSorting: [[1, 'desc']],
            columns: [
                { data: 'action', name: 'action' },
                { data: 'inventory_date', name: 'inventories.inventory_date' },
                { data: 'ref_no', name: 'inventories.ref_no' },
                { data: 'location_name', name: 'BL.name' },
                { data: 'notes', name: 'inventories.notes' },
                { data: 'added_by', name: 'u.first_name' },
            ],
        });

        $('#inventaire_location_filter, #inventaire_product_filter').on('change', function() {
            refresh_inventaire_table();
        });

        $(document).on('click', 'button.delete_inventory', function() {
            swal({
                title: LANG.sure,
                icon: 'warning',
                buttons: true,
                dangerMode: true,
            }).then(willDelete => {
                if (willDelete) {
                    var href = $(this).data('href');
                    $.ajax({
                        method: 'DELETE',
                        url: href,
                        dataType: 'json',
                        success: function(result) {
                            if (result.success) {
                                toastr.success(result.msg);
                                inventaire_table.ajax.reload();
                            } else {
                                toastr.error(result.msg);
                            }
                        },
                    });
                }
            });
        });
    }
});

