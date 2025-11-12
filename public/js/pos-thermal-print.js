/**
 * POS Thermal Printer Integration
 * Handles client-side printing for SaaS multi-tenant environment
 */

(function() {
    'use strict';

    // Initialize thermal printer when DOM is ready
    let thermalPrinter = null;
    let isPrinterConnected = false;

    // Wait for ThermalPrinterClient to be available
    function initThermalPrinter() {
        if (typeof ThermalPrinterClient !== 'undefined') {
            thermalPrinter = new ThermalPrinterClient();
            console.log('Thermal Printer Client initialized');
        }
    }

    // Initialize on page load
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initThermalPrinter);
    } else {
        initThermalPrinter();
    }

    // Override the existing pos_print function
    const original_pos_print = window.pos_print;

    window.pos_print = function(response) {
        // Check if this is client-side thermal printing
        if (response.print_type === 'thermal_client' && response.receipt_data) {
            handleThermalClientPrint(response.receipt_data);
        } else if (original_pos_print) {
            // Fall back to original print function
            original_pos_print(response);
        } else {
            // Legacy printing
            handleLegacyPrint(response);
        }
    };

    /**
     * Handle thermal client-side printing
     */
    function handleThermalClientPrint(receiptData) {
        if (!thermalPrinter) {
            toastr.error('Thermal printer service not initialized');
            return;
        }

        // Show connecting message
        showPrinterStatus('Connecting to thermal printer...');

        // Try to connect and print
        thermalPrinter.autoConnect()
            .then(function() {
                isPrinterConnected = true;
                showPrinterStatus('Printing invoice...');
                return thermalPrinter.printSlim2Invoice(receiptData);
            })
            .then(function() {
                showPrinterStatus('Invoice printed successfully!', 'success');
                thermalPrinter.disconnect();
                isPrinterConnected = false;
            })
            .catch(function(error) {
                console.error('Thermal printing error:', error);
                isPrinterConnected = false;

                // Show helpful error message
                let errorMsg = 'Failed to print: ' + error.message;

                if (error.message.includes('Bluetooth')) {
                    errorMsg += '<br><br><strong>Tips for Bluetooth printing:</strong><br>';
                    errorMsg += '• Make sure Bluetooth is enabled<br>';
                    errorMsg += '• Printer is paired with your device<br>';
                    errorMsg += '• Use Chrome browser (required for Bluetooth printing)<br>';
                    errorMsg += '• Click "Print" button again and select your printer';
                } else if (error.message.includes('USB')) {
                    errorMsg += '<br><br><strong>Tips for USB printing:</strong><br>';
                    errorMsg += '• Check USB cable connection<br>';
                    errorMsg += '• Printer is powered ON<br>';
                    errorMsg += '• Use Chrome browser for USB printing';
                }

                showPrinterStatus(errorMsg, 'error');

                // Ask if user wants to try browser print instead
                swal({
                    title: 'Thermal Printer Not Found',
                    text: 'Would you like to print using your browser instead?',
                    icon: 'warning',
                    buttons: ['Cancel', 'Browser Print'],
                    dangerMode: false
                }).then(function(useBrowserPrint) {
                    if (useBrowserPrint) {
                        // Fall back to HTML printing
                        printHTML(receiptData);
                    }
                });
            });
    }

    /**
     * Fallback HTML printing
     */
    function printHTML(receiptData) {
        // Generate HTML receipt
        let html = generateHTMLReceipt(receiptData);

        if (html) {
            $('#receipt_section').html(html);
            __currency_convert_recursively($('#receipt_section'));
            __print_receipt('receipt_section');
        }
    }

    /**
     * Generate HTML receipt from receipt data
     */
    function generateHTMLReceipt(data) {
        let html = '<div class="receipt-print">';
        html += '<div style="text-align: center; font-weight: bold; font-size: 18px;">' + (data.business_name || '') + '</div>';
        html += '<div style="text-align: center;">' + (data.location_custom_field1 || '') + '</div>';
        html += '<div style="text-align: center;">' + (data.location_custom_field2 || '') + '</div>';
        html += '<hr>';
        html += '<div><strong>Invoice:</strong> ' + (data.invoice_no || '') + '</div>';
        html += '<div><strong>Date:</strong> ' + (data.invoice_date || '') + '</div>';

        if (data.customer_name) {
            html += '<div><strong>Customer:</strong> ' + data.customer_name + '</div>';
        }

        html += '<hr>';
        html += '<table style="width:100%">';
        html += '<thead><tr><th>Item</th><th>Qty</th><th>Price</th></tr></thead>';
        html += '<tbody>';

        if (data.lines && data.lines.length > 0) {
            data.lines.forEach(function(line) {
                html += '<tr>';
                html += '<td>' + (line.name || line.product_name || '') + '</td>';
                html += '<td>' + (line.quantity || 0) + '</td>';
                html += '<td style="text-align:right">' + formatCurrency(line.line_total || 0, data.currency) + '</td>';
                html += '</tr>';
            });
        }

        html += '</tbody></table>';
        html += '<hr>';
        html += '<div style="text-align:right"><strong>TOTAL: ' + formatCurrency(data.total || 0, data.currency) + '</strong></div>';
        html += '<hr>';
        html += '<div style="text-align:center">Thank You!</div>';
        html += '</div>';

        return html;
    }

    /**
     * Format currency helper
     */
    function formatCurrency(amount, currency) {
        const symbol = currency.symbol || '$';
        const decimal = currency.decimal_separator || '.';
        const thousand = currency.thousand_separator || ',';

        const formatted = Number(amount).toFixed(2);
        const parts = formatted.split('.');
        parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, thousand);

        return symbol + parts.join(decimal);
    }

    /**
     * Legacy print handling
     */
    function handleLegacyPrint(response) {
        if (response.print_type === 'printer') {
            // Server-side printer
            let data = response;
            data.type = 'print-receipt';
            if (socket && socket.readyState === 1) {
                socket.send(JSON.stringify(data));
            } else {
                initializeSocket();
                setTimeout(function() {
                    socket.send(JSON.stringify(data));
                }, 700);
            }
        } else if (response.html_content && response.html_content !== '') {
            // Browser printing
            let currentTitle = document.title;
            if (response.print_title) {
                document.title = response.print_title;
            }

            $('#receipt_section').html(response.html_content);
            __currency_convert_recursively($('#receipt_section'));

            setTimeout(function() {
                window.print();
                document.title = currentTitle;
            }, 1000);
        }
    }

    /**
     * Show printer status to user
     */
    function showPrinterStatus(message, type) {
        type = type || 'info';

        if (type === 'success') {
            toastr.success(message);
        } else if (type === 'error') {
            toastr.error(message, 'Printing Error', {
                timeOut: 8000,
                closeButton: true,
                progressBar: true
            });
        } else {
            toastr.info(message, 'Printer Status', {
                timeOut: 3000
            });
        }
    }

    /**
     * Add manual connect button to POS interface
     */
    function addManualConnectButton() {
        // Only add if slim2 design is available
        if ($('#pos-finalize').length > 0) {
            let button = $('<button>')
                .attr('type', 'button')
                .attr('id', 'connect-thermal-printer')
                .attr('class', 'btn btn-info btn-flat')
                .attr('title', 'Connect Thermal Printer')
                .html('<i class="fa fa-print"></i> Connect Printer')
                .css({
                    'margin-left': '5px'
                });

            button.on('click', function() {
                if (!thermalPrinter) {
                    toastr.error('Thermal printer service not initialized');
                    return;
                }

                $(this).prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Connecting...');

                thermalPrinter.autoConnect()
                    .then(function() {
                        isPrinterConnected = true;
                        toastr.success('Thermal printer connected successfully!');
                        $('#connect-thermal-printer')
                            .prop('disabled', false)
                            .removeClass('btn-info')
                            .addClass('btn-success')
                            .html('<i class="fa fa-check"></i> Printer Connected');
                    })
                    .catch(function(error) {
                        isPrinterConnected = false;
                        toastr.error('Failed to connect: ' + error.message);
                        $('#connect-thermal-printer')
                            .prop('disabled', false)
                            .html('<i class="fa fa-print"></i> Connect Printer');
                    });
            });

            // Add button next to finalize button
            $('#pos-finalize').after(button);
        }
    }

    // Add button when document is ready
    $(document).ready(function() {
        setTimeout(addManualConnectButton, 1000);
    });

    // Export for global access
    window.thermalPrinterClient = function() {
        return thermalPrinter;
    };

})();

