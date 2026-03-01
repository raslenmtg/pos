<script type="text/javascript">
$(document).ready(function () {
    var ocrExtractedItems = [];

    // Sync invoice_scan_btn disabled state with location_id (same rule as search_product)
    function toggleInvoiceScanBtn() {
        if ($('#location_id').val()) {
            $('#invoice_scan_btn').prop('disabled', false);
        } else {
            $('#invoice_scan_btn').prop('disabled', true);
        }
    }
    $(document).on('change', '#location_id', function () {
        toggleInvoiceScanBtn();
    });

    var __ocr_trans = {
        no_file:       {!! json_encode(__('purchase.ocr_no_file_selected')) !!},
        no_items:      {!! json_encode(__('purchase.ocr_no_items_found')) !!},
        error:         {!! json_encode(__('messages.something_went_wrong')) !!},
        items_added:   {!! json_encode(__('purchase.ocr_items_added')) !!},
        please_select: {!! json_encode(__('messages.please_select')) !!},
    };

    $('#invoice_scan_modal').on('show.bs.modal', function () {
        $('#ocr_step_upload').show();
        $('#ocr_step_review').hide();
        $('#ocr_confirm_btn').hide();
        $('#ocr_invoice_file').val('');
        $('#ocr_review_tbody').empty();
        ocrExtractedItems = [];
    });

    $('#ocr_upload_btn').on('click', function () {
        var fileInput = document.getElementById('ocr_invoice_file');
        if (!fileInput.files.length) {
            toastr.error(__ocr_trans.no_file);
            return;
        }

        var supplierId = $('#supplier_id').val();
        var formData = new FormData();
        formData.append('invoice_file', fileInput.files[0]);
        if (supplierId) {
            formData.append('supplier_id', supplierId);
        }

        $('#ocr_upload_btn').prop('disabled', true);
        $('#ocr_upload_spinner').show();

        fetch('{{ route("invoice-scans.upload") }}', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'X-Requested-With': 'XMLHttpRequest'
                // Content-Type intentionally omitted — browser sets multipart/form-data with boundary
            }
        })
        .then(function(r) {
            return r.json().then(function(data) { return { ok: r.ok, data: data }; });
        })
        .then(function(result) {
            $('#ocr_upload_btn').prop('disabled', false);
            $('#ocr_upload_spinner').hide();

            if (result.ok && result.data.success && result.data.items.length > 0) {
                ocrExtractedItems = result.data.items;
                renderOcrReviewTable(ocrExtractedItems);
                $('#ocr_step_upload').hide();
                $('#ocr_step_review').show();
                $('#ocr_confirm_btn').show();
            } else {
                var msg = result.data.message || __ocr_trans.no_items;
                toastr.warning(msg);
            }
        })
        .catch(function() {
            $('#ocr_upload_btn').prop('disabled', false);
            $('#ocr_upload_spinner').hide();
            toastr.error(__ocr_trans.error);
        });
    });

    function renderOcrReviewTable(items) {
        var tbody = $('#ocr_review_tbody');
        tbody.empty();

        $.each(items, function (index, item) {
            var confidence = item.confidence ? Math.round(item.confidence * 100) + '%' : '0%';
            var badgeClass = item.confidence >= 0.8 ? 'success' : (item.confidence >= 0.5 ? 'warning' : 'danger');

            var productSelect = '<select class="form-control ocr-product-select" data-index="' + index + '">';
            productSelect += '<option value="">-- ' + __ocr_trans.please_select + ' --</option>';
            if (item.product_id) {
                productSelect += '<option value="' + item.product_id + '" data-variation-id="' + (item.variation_id || '') + '" selected>' + escapeHtml(item.product_name || '') + '</option>';
            }
            productSelect += '</select>';

            var row = '<tr data-index="' + index + '">'
                + '<td>' + escapeHtml(item.ocr_text || '') + '</td>'
                + '<td>' + productSelect + '</td>'
                + '<td><input type="number" class="form-control ocr-qty-input" value="' + (item.quantity || 1) + '" min="0.01" step="0.01"></td>'
                + '<td><input type="number" class="form-control ocr-price-input" value="' + (item.unit_price || 0) + '" min="0" step="0.01"></td>'
                + '<td><span class="label label-' + badgeClass + '">' + confidence + '</span></td>'
                + '</tr>';

            tbody.append(row);
        });
    }

    $('#ocr_confirm_btn').on('click', function () {
        var confirmedItems = [];
        $('#ocr_review_tbody tr').each(function () {
            var index       = $(this).data('index');
            var baseItem    = ocrExtractedItems[index] || {};
            var productSel  = $(this).find('.ocr-product-select');
            var productId   = productSel.val() ? parseInt(productSel.val()) : null;
            var variationId = productSel.find(':selected').data('variation-id') || null;
            var qty         = parseFloat($(this).find('.ocr-qty-input').val()) || 1;
            var price       = parseFloat($(this).find('.ocr-price-input').val()) || 0;

            confirmedItems.push({
                ocr_text:     baseItem.ocr_text || '',
                product_id:   productId,
                variation_id: variationId,
                quantity:     qty,
                unit_price:   price,
            });
        });

        var postData = {
            _token:      '{{ csrf_token() }}',
            supplier_id: $('#supplier_id').val(),
            items:       confirmedItems,
        };

        $.ajax({
            url: '{{ route("invoice-scans.confirm") }}',
            type: 'POST',
            data: postData,
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            success: function (response) {
                if (response.success) {
                    $('#invoice_scan_modal').modal('hide');
                    addOcrItemsToPurchaseForm(response.items);
                    toastr.success(__ocr_trans.items_added);
                }
            },
            error: function (xhr) {
                toastr.error(__ocr_trans.error);
            }
        });
    });

    function addOcrItemsToPurchaseForm(items) {
        $.each(items, function (i, item) {
            if (!item.product_id) return;
            var row_count = $('#row_count').val();
            var location_id = $('#location_id').val();
            var supplier_id = $('#supplier_id').val();
            var data = {
                product_id:   item.product_id,
                variation_id: item.variation_id || 0,
                row_count:    row_count,
                location_id:  location_id,
                supplier_id:  supplier_id,
                _token:       '{{ csrf_token() }}'
            };

            $.ajax({
                method: 'POST',
                url: '/purchases/get_purchase_entry_row',
                dataType: 'html',
                data: data,
                success: function (html) {
                    var currentRowCount = $('#row_count').val();
                    var $rows = $(html);
                    if (item.unit_price) {
                        $rows.find('.purchase_unit_cost_without_discount').val(item.unit_price);
                    }
                    if (item.quantity) {
                        $rows.find('.purchase_quantity').val(item.quantity);
                    }
                    append_purchase_lines($rows, currentRowCount, true);
                },
            });
        });
    }

    function escapeHtml(text) {
        return $('<div>').text(text).html();
    }
});
</script>
