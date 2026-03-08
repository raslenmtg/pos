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
        no_file:       {!! json_encode('Importer une facture.') !!},
        no_items:      {!! json_encode('Aucun produit trouvé') !!},
        error:         {!! json_encode(__('messages.something_went_wrong')) !!},
        items_added:   {!! json_encode("Produits ajoutés") !!},
        please_select: {!! json_encode("Veuillez sélectionner") !!},
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
                var rData = result.data;
                ocrExtractedItems = rData.items;

                // 1. Fill Invoice Date & Reference
                if (rData.invoice_date) {
                    $('#transaction_date').data('DateTimePicker').date(moment(rData.invoice_date));
                }
                if (rData.ref_no) {
                    $('#ref_no').val(rData.ref_no);
                }

                // 2. Handle Supplier
                if (!$('#supplier_id').val()) {
                    if (rData.matched_supplier_id) {
                        var $supplierSelect = $('#supplier_id');
                        var supId = rData.matched_supplier_id.toString();

                        // Check if option already exists
                        if ($supplierSelect.find("option[value='" + supId + "']").length) {
                            $supplierSelect.val(supId).trigger('change');
                        } else {
                            // Create a DOM Option and pre-select.
                            var newOption = new Option(rData.matched_supplier_name, supId, true, true);
                            $supplierSelect.append(newOption).trigger('change');
                        }

                        // Trigger Select2 specific event just in case
                        $supplierSelect.trigger({
                            type: 'select2:select',
                            params: {
                                data: { id: supId, text: rData.matched_supplier_name }
                            }
                        });

                        toastr.success('Fournisseur identifié: ' + rData.matched_supplier_name);
                    } else if (rData.supplier && (rData.supplier.name || rData.supplier.tax_number)) {
                        toastr.info('Fournisseur non trouvé. Ouverture de la création...');

                        $(document).one('shown.bs.modal', '.contact_modal', function() {
                            var form = $(this).find('form');
                            var s = rData.supplier;

                            // 1. Select 'Business' type
                            form.find('input[name="contact_type_radio"][value="business"]').prop('checked', true).trigger('change');

                            // 2. Fill fields based on correct input names
                            if (s.name) form.find('input[name="supplier_business_name"]').val(s.name);
                            if (s.tax_number) form.find('input[name="tax_number"]').val(s.tax_number);
                            if (s.mobile) form.find('input[name="mobile"]').val(s.mobile);
                            if (s.email) form.find('input[name="email"]').val(s.email);
                            if (s.city) form.find('input[name="city"]').val(s.city);
                            if (s.address_line_1) form.find('input[name="address_line_1"]').val(s.address_line_1);
                            if (s.zip_code) form.find('input[name="zip_code"]').val(s.zip_code);
                            if (s.state) form.find('input[name="state"]').val(s.state);
                            if (s.country) form.find('input[name="country"]').val(s.country);
                        });

                        $('.add_new_supplier').trigger('click');
                    }
                }

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

            var productSelect = '<div class="input-group" style="width:100%"><select class="form-control ocr-product-select" data-index="' + index + '">';
            productSelect += '<option value="">-- ' + __ocr_trans.please_select + ' --</option>';
            if (item.product_id) {
                productSelect += '<option value="' + item.product_id + '" data-variation-id="' + (item.variation_id || '') + '" selected>' + escapeHtml(item.product_name || '') + '</option>';
            }
            productSelect += '</select>';
            if (!item.product_id) {
                productSelect += '<span class="input-group-btn">';
                productSelect += '<button type="button" class="btn btn-primary btn-flat ocr-quick-add" data-name="' + escapeHtml(item.ocr_text || '') + '" title="Ajouter"><i class="fa fa-plus"></i></button>';
                productSelect += '</span>';
            }
            productSelect += '</div>';

            var row = '<tr data-index="' + index + '">'
                + '<td>' + escapeHtml(item.ocr_text || '') + '</td>'
                + '<td>' + productSelect + '</td>'
                + '<td><input type="number" class="form-control ocr-qty-input" value="' + (item.quantity || 1) + '" min="0.01" step="0.01"></td>'
                + '<td><input type="number" class="form-control ocr-price-input" value="' + (item.unit_price || 0) + '" min="0" step="0.01"></td>'
                + '<td><input type="number" class="form-control ocr-discount-input" value="' + (item.line_discount || 0) + '" min="0" step="0.01"></td>'
                + '<td><span class="label label-' + badgeClass + '">' + confidence + '</span></td>'
                + '</tr>';

            tbody.append(row);
        });
    }

    // Quick Add Product Handler
    var currentOcrRowIndex = null;
    $(document).on('click', '.ocr-quick-add', function() {
        var tr = $(this).closest('tr');
        currentOcrRowIndex = tr.data('index');
        var itemIndex = tr.data('index');
        var itemData = ocrExtractedItems[itemIndex] || {};

        var name = $(this).data('name');
        var sku  = itemData.sku || '';
        var price = itemData.unit_price || '';
        var tax   = itemData.tax_rate || '';

        var container = $('.quick_add_product_modal');
        var url = '/products/quick_add?product_name=' + encodeURIComponent(name);

        $.ajax({
            url: url,
            dataType: 'html',
            success: function(result) {
                container.html(result).modal('show');

                // Wait for modal 'shown' event to ensure all elements (including Select2) are ready
                container.one('shown.bs.modal', function() {
                    // Fix z-index stacking
                    container.css('z-index', 1600);
                    container.css('overflow-y', 'auto');
                    $('.modal-backdrop').last().css('z-index', 1590);

                    // Pre-fill SKU
                    if(sku) {
                        container.find('input[name="sku"]').val(sku);
                    }

                    // Pre-fill Tax
                    if(tax) {
                        var foundTax = false;
                        var tVal = parseInt(tax);
                        container.find('select#tax option').each(function() {
                            var text = $(this).text();
                            if (text.indexOf(tVal) !== -1) {
                                container.find('select#tax').val($(this).val()).trigger('change');
                                foundTax = true;
                                return false;
                            }
                        });
                    }

                    // Pre-fill Price
                    if(price) {
                        var pVal = parseFloat(price);

                        // User requested filling single_dpp_inc_tax
                        // We also fill single_dpp (Exc Tax) because typically invoices show HT (Exc Tax)
                        // Triggering change on single_dpp (Exc Tax) is usually safer if we assume the OCR extracted HT price.
                        // However, strictly following request to target single_dpp_inc_tax id.

                        var dppIncInput = container.find('input#single_dpp_inc_tax');

                        if(dppIncInput.length > 0) {
                            dppIncInput.val(pVal);
                            // Trigger change on dpp (Exc Tax) to calculate Inc Tax based on the Tax Rule
                            dppIncInput.trigger('change');
                        }

                    }
                });

                var form = container.find('form#quick_add_product_form');
                form.on('submit', function(e) {
                    e.preventDefault();
                    e.stopImmediatePropagation();

                    var data = $(this).serialize();
                    $.ajax({
                        method: 'POST',
                        url: $(this).attr('action'),
                        dataType: 'json',
                        data: data,
                        success: function(result) {
                            if (result.success) {
                                toastr.success(result.msg);
                                container.modal('hide');

                                if (currentOcrRowIndex !== null) {
                                    var row = $('#ocr_review_tbody tr[data-index="' + currentOcrRowIndex + '"]');
                                    var select = row.find('.ocr-product-select');

                                    var pName = result.product.name + ' - ' + (result.product.sku || '');
                                    var pId   = result.product.id;
                                    var vId   = '';
                                    if(result.product.variations && result.product.variations.length > 0) {
                                        vId = result.product.variations[0].id;
                                    }

                                    var newOption = new Option(pName, pId, true, true);
                                    $(newOption).attr('data-variation-id', vId);

                                    select.append(newOption).trigger('change');

                                    row.find('.ocr-quick-add').closest('.input-group-btn').remove();
                                }
                            } else {
                                toastr.error(result.msg);
                            }
                        }
                    });
                });
            }
        });
    });

    $('#ocr_confirm_btn').on('click', function () {
        var btn = $(this);
        btn.prop('disabled', true);

        var confirmedItems = [];
        $('#ocr_review_tbody tr').each(function () {
            var index       = $(this).data('index');
            var baseItem    = ocrExtractedItems[index] || {};
            var productSel  = $(this).find('.ocr-product-select');
            var productId   = productSel.val() ? parseInt(productSel.val()) : null;
            var variationId = productSel.find(':selected').data('variation-id') || null;
            var qty         = parseFloat($(this).find('.ocr-qty-input').val()) || 1;
            var price       = parseFloat($(this).find('.ocr-price-input').val()) || 0;
            var discount    = parseFloat($(this).find('.ocr-discount-input').val()) || 0;

            confirmedItems.push({
                ocr_text:     baseItem.ocr_text || '',
                product_id:   productId,
                variation_id: variationId,
                quantity:     qty,
                unit_price:   price,
                line_discount: discount,
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
                btn.prop('disabled', false);
                if (response.success) {
                    $('#invoice_scan_modal').modal('hide');
                    addOcrItemsToPurchaseForm(response.items);
                    toastr.success(__ocr_trans.items_added);
                }
            },
            error: function (xhr) {
                btn.prop('disabled', false);
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
                    if (item.line_discount) {
                        $rows.find('input.inline_discounts').val(item.line_discount);
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
