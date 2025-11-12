/**
 * Client-Side Thermal Printer Service
 * Supports: USB, Bluetooth, Network printers from browser
 * Works on: Desktop (Chrome, Edge) and Mobile (Chrome Android)
 */

class ThermalPrinterClient {
    constructor() {
        this.device = null;
        this.characteristic = null;
        this.encoder = new TextEncoder();
        this.ESC = '\x1B';
        this.GS = '\x1D';
    }

    /**
     * Check if Web Bluetooth API is supported
     */
    isBluetoothSupported() {
        return 'bluetooth' in navigator;
    }

    /**
     * Check if USB printing is supported (via WebUSB)
     */
    isUSBSupported() {
        return 'usb' in navigator;
    }

    /**
     * Auto-detect and connect to printer
     * For mobile: Uses Bluetooth
     * For desktop: Uses Bluetooth or USB
     */
    async autoConnect() {
        // Try Bluetooth first (works on mobile and desktop)
        if (this.isBluetoothSupported()) {
            try {
                await this.connectBluetooth();
                return true;
            } catch (error) {
                console.log('Bluetooth connection failed:', error);
            }
        }

        // Try USB on desktop
        if (this.isUSBSupported()) {
            try {
                await this.connectUSB();
                return true;
            } catch (error) {
                console.log('USB connection failed:', error);
            }
        }

        throw new Error('No printer connection method available. Please enable Bluetooth or use Chrome browser.');
    }

    /**
     * Connect to Bluetooth printer (Works on Mobile & Desktop)
     * Supports: RPP02N, RPP300, and other ESC/POS Bluetooth printers
     */
    async connectBluetooth() {
        try {
            console.log('Requesting Bluetooth printer...');

            // Request Bluetooth device with Serial Port Profile
            this.device = await navigator.bluetooth.requestDevice({
                filters: [
                    { services: ['000018f0-0000-1000-8000-00805f9b34fb'] }, // ESC/POS Service
                    { namePrefix: 'RPP' }, // RPP02N, RPP300, etc.
                    { namePrefix: 'BlueTooth Printer' },
                    { namePrefix: 'Printer' },
                    { namePrefix: 'POS' },
                ],
                optionalServices: [
                    '000018f0-0000-1000-8000-00805f9b34fb', // ESC/POS
                    '49535343-fe7d-4ae5-8fa9-9fafd205e455', // SPP
                    '0000ff00-0000-1000-8000-00805f9b34fb', // Generic
                ]
            });

            console.log('Connecting to GATT Server...');
            const server = await this.device.gatt.connect();

            console.log('Getting service...');
            const service = await this.getService(server);

            console.log('Getting characteristic...');
            this.characteristic = await this.getCharacteristic(service);

            console.log('Bluetooth printer connected successfully!');
            return true;
        } catch (error) {
            console.error('Bluetooth connection error:', error);
            throw error;
        }
    }

    /**
     * Get appropriate service UUID
     */
    async getService(server) {
        const serviceUUIDs = [
            '000018f0-0000-1000-8000-00805f9b34fb', // ESC/POS
            '49535343-fe7d-4ae5-8fa9-9fafd205e455', // SPP
            '0000ff00-0000-1000-8000-00805f9b34fb', // Generic
        ];

        for (const uuid of serviceUUIDs) {
            try {
                return await server.getPrimaryService(uuid);
            } catch (e) {
                continue;
            }
        }

        // If no specific service found, try to get any service
        const services = await server.getPrimaryServices();
        if (services.length > 0) {
            return services[0];
        }

        throw new Error('No compatible service found');
    }

    /**
     * Get write characteristic
     */
    async getCharacteristic(service) {
        const characteristicUUIDs = [
            '00002af1-0000-1000-8000-00805f9b34fb', // ESC/POS Write
            '49535343-8841-43f4-a8d4-ecbe34729bb3', // SPP Write
            '0000ff01-0000-1000-8000-00805f9b34fb', // Generic Write
        ];

        for (const uuid of characteristicUUIDs) {
            try {
                return await service.getCharacteristic(uuid);
            } catch (e) {
                continue;
            }
        }

        // Try to find any writable characteristic
        const characteristics = await service.getCharacteristics();
        for (const char of characteristics) {
            if (char.properties.write || char.properties.writeWithoutResponse) {
                return char;
            }
        }

        throw new Error('No writable characteristic found');
    }

    /**
     * Connect to USB printer (Desktop only)
     */
    async connectUSB() {
        try {
            const device = await navigator.usb.requestDevice({
                filters: [
                    { classCode: 7 } // Printer class
                ]
            });

            await device.open();
            await device.selectConfiguration(1);
            await device.claimInterface(0);

            this.usbDevice = device;
            this.usbEndpoint = device.configuration.interfaces[0].alternate.endpoints.find(
                e => e.direction === 'out'
            );

            console.log('USB printer connected successfully!');
            return true;
        } catch (error) {
            console.error('USB connection error:', error);
            throw error;
        }
    }

    /**
     * Print invoice in slim2 format
     */
    async printSlim2Invoice(receiptData) {
        try {
            let commands = [];

            // Initialize printer
            commands.push(this.cmd_init());

            // Header - Business name (centered, double width)
            commands.push(this.cmd_align('center'));
            commands.push(this.cmd_size('large'));
            commands.push(this.cmd_text(receiptData.business_name + '\n'));
            commands.push(this.cmd_size('normal'));

            // Business details
            if (receiptData.location_custom_field1) {
                commands.push(this.cmd_text(receiptData.location_custom_field1 + '\n'));
            }
            if (receiptData.location_custom_field2) {
                commands.push(this.cmd_text(receiptData.location_custom_field2 + '\n'));
            }
            if (receiptData.location_custom_field3) {
                commands.push(this.cmd_text(receiptData.location_custom_field3 + '\n'));
            }
            if (receiptData.location_custom_field4) {
                commands.push(this.cmd_text(receiptData.location_custom_field4 + '\n'));
            }

            commands.push(this.cmd_feed(1));

            // Invoice details (left aligned)
            commands.push(this.cmd_align('left'));
            commands.push(this.cmd_text('Invoice: ' + receiptData.invoice_no + '\n'));
            commands.push(this.cmd_text('Date: ' + receiptData.invoice_date + '\n'));

            if (receiptData.customer_name) {
                commands.push(this.cmd_text('Customer: ' + receiptData.customer_name + '\n'));
            }
            if (receiptData.customer_tax_number) {
                commands.push(this.cmd_text('Tax No: ' + receiptData.customer_tax_number + '\n'));
            }

            commands.push(this.cmd_feed(1));
            commands.push(this.cmd_text(this.repeat('-', 32) + '\n'));

            // Items header
            commands.push(this.cmd_text(this.pad('Item', 16) + this.pad('Qty', 6) + this.pad('Price', 10, 'right') + '\n'));
            commands.push(this.cmd_text(this.repeat('-', 32) + '\n'));

            // Print items
            if (receiptData.lines && receiptData.lines.length > 0) {
                receiptData.lines.forEach(line => {
                    const itemName = this.truncate(line.name || line.product_name || '', 16);
                    const qty = String(line.quantity || '0');
                    const price = this.formatCurrency(line.line_total || 0, receiptData.currency);

                    commands.push(this.cmd_text(
                        this.pad(itemName, 16) +
                        this.pad(qty, 6) +
                        this.pad(price, 10, 'right') + '\n'
                    ));

                    if (line.variation) {
                        commands.push(this.cmd_text('  ' + this.truncate(line.variation, 30) + '\n'));
                    }
                });
            }

            commands.push(this.cmd_text(this.repeat('-', 32) + '\n'));

            // Totals (right aligned)
            commands.push(this.cmd_align('right'));

            if (receiptData.subtotal) {
                commands.push(this.cmd_text('Subtotal: ' + this.formatCurrency(receiptData.subtotal, receiptData.currency) + '\n'));
            }

            if (receiptData.discount_amount && receiptData.discount_amount > 0) {
                commands.push(this.cmd_text('Discount: ' + this.formatCurrency(receiptData.discount_amount, receiptData.currency) + '\n'));
            }

            if (receiptData.tax_amount && receiptData.tax_amount > 0) {
                commands.push(this.cmd_text('Tax: ' + this.formatCurrency(receiptData.tax_amount, receiptData.currency) + '\n'));
            }

            if (receiptData.shipping_charges && receiptData.shipping_charges > 0) {
                commands.push(this.cmd_text('Shipping: ' + this.formatCurrency(receiptData.shipping_charges, receiptData.currency) + '\n'));
            }

            // Total (bold)
            commands.push(this.cmd_bold(true));
            commands.push(this.cmd_text('TOTAL: ' + this.formatCurrency(receiptData.total || 0, receiptData.currency) + '\n'));
            commands.push(this.cmd_bold(false));

            commands.push(this.cmd_align('left'));
            commands.push(this.cmd_text(this.repeat('-', 32) + '\n'));

            // Payment details
            if (receiptData.payments && receiptData.payments.length > 0) {
                receiptData.payments.forEach(payment => {
                    const method = payment.method || 'Cash';
                    const amount = this.formatCurrency(payment.amount || 0, receiptData.currency);
                    commands.push(this.cmd_text('Payment (' + method + '): ' + amount + '\n'));
                });
            }

            commands.push(this.cmd_feed(1));

            // Footer (centered)
            commands.push(this.cmd_align('center'));
            if (receiptData.footer_text) {
                commands.push(this.cmd_text(receiptData.footer_text + '\n'));
            }
            if (receiptData.invoice_url) {
                commands.push(this.cmd_text(receiptData.invoice_url + '\n'));
            }

            commands.push(this.cmd_feed(2));
            commands.push(this.cmd_text('Thank You!\n'));
            commands.push(this.cmd_feed(3));

            // Cut paper
            commands.push(this.cmd_cut());

            // Send all commands to printer
            await this.sendCommands(commands);

            console.log('Invoice printed successfully!');
            return true;
        } catch (error) {
            console.error('Printing error:', error);
            throw error;
        }
    }

    /**
     * Send commands to printer
     */
    async sendCommands(commands) {
        const data = commands.join('');
        const encoded = this.encoder.encode(data);

        if (this.characteristic) {
            // Bluetooth printing - send in chunks
            const chunkSize = 20; // Bluetooth MTU limit
            for (let i = 0; i < encoded.length; i += chunkSize) {
                const chunk = encoded.slice(i, i + chunkSize);
                await this.characteristic.writeValue(chunk);
                await this.delay(50); // Small delay between chunks
            }
        } else if (this.usbDevice) {
            // USB printing
            await this.usbDevice.transferOut(this.usbEndpoint.endpointNumber, encoded);
        } else {
            throw new Error('No printer connected');
        }
    }

    // ESC/POS Commands
    cmd_init() { return this.ESC + '@'; }
    cmd_align(align) {
        const alignments = { left: 0, center: 1, right: 2 };
        return this.ESC + 'a' + String.fromCharCode(alignments[align] || 0);
    }
    cmd_size(size) {
        const sizes = { normal: 0, large: 17, xlarge: 34 };
        return this.GS + '!' + String.fromCharCode(sizes[size] || 0);
    }
    cmd_bold(enable) {
        return this.ESC + 'E' + (enable ? '\x01' : '\x00');
    }
    cmd_text(text) { return text; }
    cmd_feed(lines) { return this.ESC + 'd' + String.fromCharCode(lines); }
    cmd_cut() { return this.GS + 'V' + '\x00'; }

    // Helper functions
    pad(str, length, align = 'left') {
        str = String(str);
        if (str.length >= length) return str.substr(0, length);
        const padding = ' '.repeat(length - str.length);
        return align === 'right' ? padding + str : str + padding;
    }

    truncate(str, length) {
        str = String(str);
        return str.length > length ? str.substr(0, length - 3) + '...' : str;
    }

    repeat(char, times) {
        return char.repeat(times);
    }

    formatCurrency(amount, currency) {
        const symbol = currency.symbol || '$';
        const decimal = currency.decimal_separator || '.';
        const thousand = currency.thousand_separator || ',';

        const formatted = Number(amount).toFixed(2);
        const parts = formatted.split('.');
        parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, thousand);

        return symbol + parts.join(decimal);
    }

    delay(ms) {
        return new Promise(resolve => setTimeout(resolve, ms));
    }

    /**
     * Disconnect from printer
     */
    disconnect() {
        if (this.device && this.device.gatt.connected) {
            this.device.gatt.disconnect();
        }
        if (this.usbDevice) {
            this.usbDevice.close();
        }
        this.device = null;
        this.characteristic = null;
        this.usbDevice = null;
    }
}

// Export for use in application
window.ThermalPrinterClient = ThermalPrinterClient;

