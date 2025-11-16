/**
 * POS Thermal Printer Integration
 * Handles client-side printing for SaaS multi-tenant environment
 */

(function() {
    'use strict';

    // Initialize thermal printer when DOM is ready
    let thermalPrinter = null;
    let isPrinterConnected = false;
    let selectedDevice = null; // Store the selected device
    const PRINTER_STORAGE_KEY = 'thermal_printer_device';

    // Wait for ThermalPrinterClient to be available
    function initThermalPrinter() {
        if (typeof ThermalPrinterClient !== 'undefined') {
            thermalPrinter = new ThermalPrinterClient();
            // Try to restore previously selected printer
            restoreSavedPrinter();
        }
    }

    /**
     * Restore previously selected printer from localStorage
     */
    function restoreSavedPrinter() {
        try {
            const savedDeviceId = localStorage.getItem(PRINTER_STORAGE_KEY);
            if (savedDeviceId && navigator.bluetooth) {
                // Try to get the device from browser's paired devices
                navigator.bluetooth.getDevices().then(devices => {
                    const device = devices.find(d => d.id === savedDeviceId);
                    if (device) {
                        selectedDevice = device;
                    }
                }).catch(err => {
                    console.log('Could not restore saved printer:', err);
                });
            }
        } catch (error) {
            console.log('Error restoring printer:', error);
        }
    }

    /**
     * Save selected printer to localStorage
     */
    function savePrinterDevice(device) {
        try {
            if (device && device.id) {
                localStorage.setItem(PRINTER_STORAGE_KEY, device.id);
                selectedDevice = device;
            }
        } catch (error) {
            console.log('Error saving printer:', error);
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
     * Handle thermal client-side printing - Silent mode with device persistence
     */
    function handleThermalClientPrint(response) {
        if (!thermalPrinter) {
            printHTML(response.html_content);
            return;
        }

        // Try to connect using saved device first
        connectAndPrint(response)
            .catch(function(error) {
                console.error('Thermal printing error:', error);
                isPrinterConnected = false;
                // Silent fallback to HTML printing
                printHTML(response.html_content);
            });
    }

    /**
     * Connect to printer and print - handles device persistence
     */
    function connectAndPrint(response) {
        return new Promise(function(resolve, reject) {
            // Try to get previously paired device from browser
            if (navigator.bluetooth && navigator.bluetooth.getDevices) {
                const savedDeviceId = localStorage.getItem(PRINTER_STORAGE_KEY);

                if (savedDeviceId) {
                    navigator.bluetooth.getDevices()
                        .then(function(devices) {
                            const device = devices.find(d => d.id === savedDeviceId);
                            if (device && device.gatt) {
                                return connectToDevice(device, response);
                            } else {
                                // Device not found in paired list, try fresh connection
                                return tryAutoConnect(response);
                            }
                        })
                        .then(resolve)
                        .catch(function(error) {
                            console.log('Failed to use saved device:', error);
                            localStorage.removeItem(PRINTER_STORAGE_KEY);
                            return tryAutoConnect(response);
                        })
                        .then(resolve)
                        .catch(reject);
                } else {
                    // No saved device, use autoConnect
                    tryAutoConnect(response).then(resolve).catch(reject);
                }
            } else {
                // Web Bluetooth API not available or getDevices not supported
                tryAutoConnect(response).then(resolve).catch(reject);
            }
        });
    }

    /**
     * Connect to specific device and print
     */
    function connectToDevice(device, response) {
        return device.gatt.connect()
            .then(function(server) {
                isPrinterConnected = true;
                thermalPrinter.device = device;
                thermalPrinter.server = server;
                selectedDevice = device;

                const design = response.receipt_data.design || 'slim';
                if (design === 'slim2') {
                    return thermalPrinter.printSlim2Invoice(response.receipt_data);
                } else {
                    return thermalPrinter.printSlimInvoice(response.receipt_data);
                }
            })
            .then(function() {
                if (device.gatt.connected) {
                    device.gatt.disconnect();
                }
                isPrinterConnected = false;
                savePrinterDevice(device);
            });
    }

    /**
     * Try auto connect and save the device for future use
     */
    function tryAutoConnect(response) {
        return thermalPrinter.autoConnect()
            .then(function() {
                isPrinterConnected = true;

                // Save the device that was just connected
                if (thermalPrinter.device) {
                    savePrinterDevice(thermalPrinter.device);
                }

                // Detect receipt design and call appropriate function
                // slim = 80mm (48 chars), slim2 = 58mm (32 chars)
                const design = response.receipt_data.design || 'slim';
                if (design === 'slim2') {
                    return thermalPrinter.printSlim2Invoice(response.receipt_data);
                } else {
                    return thermalPrinter.printSlimInvoice(response.receipt_data);
                }
            })
            .then(function() {
                thermalPrinter.disconnect();
                isPrinterConnected = false;
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
       if (response.html_content && response.html_content !== '') {
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


    // Export for global access
    window.thermalPrinterClient = function() {
        return thermalPrinter;
    };

})();

