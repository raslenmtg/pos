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
            console.log('✓ Thermal printer client initialized');

            // Check API support
            if (navigator.bluetooth) {
                console.log('✓ Web Bluetooth API is supported');
                if (typeof navigator.bluetooth.getDevices === 'function') {
                    console.log('✓ navigator.bluetooth.getDevices() is supported');
                } else {
                    console.warn('✗ navigator.bluetooth.getDevices() NOT supported - will show picker every time');
                }
            } else {
                console.error('✗ Web Bluetooth API NOT supported in this browser');
            }

            // Check if there's a saved device
            const savedId = localStorage.getItem(PRINTER_STORAGE_KEY);
            if (savedId) {
                console.log('ℹ Found saved printer device ID:', savedId.substring(0, 20) + '...');
            } else {
                console.log('ℹ No saved printer device');
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
            console.log('⚠ Thermal printer not initialized, falling back to HTML');
            printHTML(response.html_content);
            return;
        }

        console.log('━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━');
        console.log('📄 NEW PRINT REQUEST');
        console.log('━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━');

        // Try to connect using saved device first
        connectAndPrint(response)
            .then(function() {
                console.log('✓✓✓ BLUETOOTH PRINT SUCCESSFUL ✓✓✓');
            })
            .catch(function(error) {
                console.error('✗✗✗ BLUETOOTH PRINT FAILED ✗✗✗');
                console.error('Error type:', error.name || 'Unknown');
                console.error('Error message:', error.message || error);
                isPrinterConnected = false;

                // Check if user cancelled the device selection
                if (error && (error.name === 'NotFoundError' ||
                              (error.message && (error.message.includes('cancel') || error.message.includes('Cancel'))))) {
                    console.log('ℹ User cancelled - no fallback, waiting for next attempt');
                    return;
                }

                // Fall back to HTML printing for real errors
                console.log('→ Falling back to HTML printing');
                printHTML(response.html_content);
            });
    }

    /**
     * Connect to printer and print - handles device persistence
     */
    function connectAndPrint(response) {
        return new Promise(function(resolve, reject) {
            console.log('connectAndPrint called');

            // Check if Web Bluetooth is available
            if (!navigator.bluetooth) {
                console.error('Web Bluetooth API not available in this browser');
                reject(new Error('Web Bluetooth not supported'));
                return;
            }

            // Check if we can use getDevices API (Chrome 85+)
            const savedDeviceId = localStorage.getItem(PRINTER_STORAGE_KEY);
            console.log('Saved device ID:', savedDeviceId);

            if (savedDeviceId && typeof navigator.bluetooth.getDevices === 'function') {
                console.log('Attempting to retrieve saved device via getDevices()...');
                navigator.bluetooth.getDevices()
                    .then(function(devices) {
                        console.log('getDevices() returned', devices.length, 'paired device(s)');

                        if (devices.length === 0) {
                            console.log('No paired devices found, clearing saved ID and showing picker');
                            localStorage.removeItem(PRINTER_STORAGE_KEY);
                            return tryAutoConnect(response);
                        }

                        const device = devices.find(d => d.id === savedDeviceId);
                        if (device) {
                            console.log('Found saved device:', device.name || device.id);
                            // Check if device is still valid
                            if (device.gatt) {
                                return connectToDevice(device, response);
                            } else {
                                console.log('Device has no GATT, clearing and showing picker');
                                localStorage.removeItem(PRINTER_STORAGE_KEY);
                                return tryAutoConnect(response);
                            }
                        } else {
                            console.log('Saved device not in paired list, clearing and showing picker');
                            localStorage.removeItem(PRINTER_STORAGE_KEY);
                            return tryAutoConnect(response);
                        }
                    })
                    .then(resolve)
                    .catch(function(error) {
                        console.error('getDevices() or connection failed:', error.name, error.message);
                        // Clear saved device and show picker
                        localStorage.removeItem(PRINTER_STORAGE_KEY);
                        return tryAutoConnect(response).then(resolve).catch(reject);
                    });
            } else {
                if (savedDeviceId) {
                    console.log('getDevices() not supported but have saved device - clearing and showing picker');
                    localStorage.removeItem(PRINTER_STORAGE_KEY);
                }
                console.log('No saved device or getDevices not supported, showing picker');
                // No saved device or API not supported, use autoConnect
                tryAutoConnect(response).then(resolve).catch(reject);
            }
        });
    }

    /**
     * Connect to specific device and print
     */
    function connectToDevice(device, response) {
        console.log('Attempting GATT connection to:', device.name || device.id);

        return device.gatt.connect()
            .then(function(server) {
                console.log('GATT connected successfully');
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
                console.log('Print completed, disconnecting...');
                if (device.gatt && device.gatt.connected) {
                    device.gatt.disconnect();
                }
                isPrinterConnected = false;
                savePrinterDevice(device);
            })
            .catch(function(error) {
                console.error('connectToDevice failed:', error.name, error.message);
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
        console.log('Thermal printer forgotten. Next print will show device picker.');
        return true;
    };

})();

