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
    function initThermalPrinter(retryCount) {
        retryCount = retryCount || 0;

        if (typeof ThermalPrinterClient !== 'undefined') {
            try {
                thermalPrinter = new ThermalPrinterClient();
            } catch (error) {
                thermalPrinter = null;
            }
        } else {
            // ThermalPrinterClient not loaded yet, retry up to 5 times
            if (retryCount < 5) {
                setTimeout(function() {
                    initThermalPrinter(retryCount + 1);
                }, 100);
            }
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
            // Silent error handling
        }
    }

    // Initialize on page load - wait for both DOM and all scripts
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function() {
            // Give ThermalPrinterClient script time to fully execute
            setTimeout(initThermalPrinter, 50);
        });
    } else if (document.readyState === 'interactive') {
        // DOM is ready but scripts might still be loading
        setTimeout(initThermalPrinter, 50);
    } else {
        // Everything is loaded (document.readyState === 'complete')
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
            .then(function() {
                // Print successful
            })
            .catch(function(error) {
                isPrinterConnected = false;

                // Check if user cancelled the device selection
                if (error && (error.name === 'NotFoundError' ||
                              (error.message && (error.message.includes('cancel') || error.message.includes('Cancel'))))) {
                    // User cancelled - no fallback
                    return;
                }

                // Fall back to HTML printing for real errors
                printHTML(response.html_content);
            });
    }

    /**
     * Connect to printer and print - handles device persistence
     */
    function connectAndPrint(response) {
        return new Promise(function(resolve, reject) {
            // Check if Web Bluetooth is available
            if (!navigator.bluetooth) {
                reject(new Error('Web Bluetooth not supported'));
                return;
            }

            // Check if we can use getDevices API (Chrome 85+)
            const savedDeviceId = localStorage.getItem(PRINTER_STORAGE_KEY);

            if (savedDeviceId && typeof navigator.bluetooth.getDevices === 'function') {
                navigator.bluetooth.getDevices()
                    .then(function(devices) {
                        if (devices.length === 0) {
                            localStorage.removeItem(PRINTER_STORAGE_KEY);
                            return tryAutoConnect(response);
                        }

                        const device = devices.find(d => d.id === savedDeviceId);
                        if (device) {
                            // Check if device is still valid
                            if (device.gatt) {
                                return connectToDevice(device, response);
                            } else {
                                localStorage.removeItem(PRINTER_STORAGE_KEY);
                                return tryAutoConnect(response);
                            }
                        } else {
                            localStorage.removeItem(PRINTER_STORAGE_KEY);
                            return tryAutoConnect(response);
                        }
                    })
                    .then(resolve)
                    .catch(function(error) {
                        // Clear saved device and show picker
                        localStorage.removeItem(PRINTER_STORAGE_KEY);
                        return tryAutoConnect(response).then(resolve).catch(reject);
                    });
            } else {
                if (savedDeviceId) {
                    localStorage.removeItem(PRINTER_STORAGE_KEY);
                }
                // No saved device or API not supported, use autoConnect
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
                if (device.gatt && device.gatt.connected) {
                    device.gatt.disconnect();
                }
                isPrinterConnected = false;
                savePrinterDevice(device);
            })
            .catch(function(error) {
                isPrinterConnected = false;
                if (device.gatt && device.gatt.connected) {
                    device.gatt.disconnect();
                }
                // Re-throw to propagate error up
                throw error;
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

    // Export function to clear/forget saved printer
    window.forgetThermalPrinter = function() {
        localStorage.removeItem(PRINTER_STORAGE_KEY);
        selectedDevice = null;
        return true;
    };

})();

