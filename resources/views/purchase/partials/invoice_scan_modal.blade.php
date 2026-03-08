<!-- Invoice OCR Scan Modal -->
<div class="modal fade" id="invoice_scan_modal" tabindex="-1" role="dialog" aria-labelledby="invoiceScanModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="invoiceScanModalLabel">
                    <i class="fa fa-magic text-primary"></i>
                    Importer les produits avec l'intelligence artificielle
                </h4>
            </div>
            <div class="modal-body">
                <!-- Step 1: Upload -->
                <div id="ocr_step_upload">
                    <div class="form-group">
                        <label>Importer la facture</label>
                        <input type="file" id="ocr_invoice_file" accept=".jpg,.jpeg,.png,.webp,.pdf" class="form-control">
                    </div>
                    <div class="text-center">
                        <button type="button" id="ocr_upload_btn" class="tw-dw-btn tw-dw-btn-primary tw-text-white">
                            <i class="fa fa-upload"></i> Scanner avec IA
                        </button>
                    </div>
                    <div id="ocr_upload_spinner" class="text-center" style="display:none; margin-top:15px;">
                        <i class="fa fa-spinner fa-spin fa-2x"></i>
                        <p>Analyse en cours...</p>
                    </div>
                </div>

                <!-- Step 2: Review Table -->
                <div id="ocr_step_review" style="display:none;">
                    <div class="table-responsive">
                        <table class="table table-bordered table-condensed table-striped" id="ocr_review_table">
                            <thead>
                                <tr>
                                    <th>Désignation facture</th>
                                    <th>Produit correspondant</th>
                                    <th>Quantité </th>
                                    <th>Prix</th>
                                    <th>Remise (%)</th>
                                    <th>Fiabilité</th>
                                </tr>
                            </thead>
                            <tbody id="ocr_review_tbody"></tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">@lang('messages.cancel')</button>
                <button type="button" id="ocr_confirm_btn" class="tw-dw-btn tw-dw-btn-success tw-text-white" style="display:none;">
                    <i class="fa fa-check"></i> Inserer les produits
                </button>
            </div>
        </div>
    </div>
</div>
