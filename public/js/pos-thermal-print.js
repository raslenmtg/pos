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
            handleThermalClientPrint(response); // Pass entire response (includes receipt_data and html_content)
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
    function handleThermalClientPrint(response) {
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
                return thermalPrinter.printSlim2Invoice(response.receipt_data);
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
                        // Fall back to HTML printing using actual slim2 template
                        printHTML(response.html_content);
                    }
                });
            });
    }

    /**
     * Fallback HTML printing - uses actual slim2 template
     */
    function printHTML(html_content) {
        // Use the actual slim2 template HTML from server
        if (html_content) {
            $('#receipt_section').html(html_content);
            __currency_convert_recursively($('#receipt_section'));
            __print_receipt('receipt_section');
        }
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

