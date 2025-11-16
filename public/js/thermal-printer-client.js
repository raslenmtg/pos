/**
 * Client-Side Thermal Printer Service for SaaS POS
 * Supports: Bluetooth (Mobile/Desktop), USB (Desktop)
 * Compatible: RPP02N, RPP300, ESC/POS printers
 */

class ThermalPrinterClient {
    constructor() {
        this.device = null;
        this.characteristic = null;
        this.encoder = new TextEncoder();
        this.ESC = '\x1B';
        this.GS = '\x1D';
    }

    isBluetoothSupported() {
        return 'bluetooth' in navigator;
    }

    isUSBSupported() {
        return 'usb' in navigator;
    }

    async autoConnect() {
        if (this.isBluetoothSupported()) {
            try {
                await this.connectBluetooth();
                return true;
            } catch (error) {
                console.log('Bluetooth connection failed:', error);
            }
        }

        if (this.isUSBSupported()) {
            try {
                await this.connectUSB();
                return true;
            } catch (error) {
                console.log('USB connection failed:', error);
            }
        }

        throw new Error('No printer connection available. Enable Bluetooth or use Chrome browser.');
    }

    async connectBluetooth() {
        try {
            this.device = await navigator.bluetooth.requestDevice({
                filters: [
                    { services: ['000018f0-0000-1000-8000-00805f9b34fb'] },
                    { namePrefix: 'RPP' },
                    { namePrefix: 'BlueTooth Printer' },
                    { namePrefix: 'Printer' },
                    { namePrefix: 'POS' },
                ],
                optionalServices: [
                    '000018f0-0000-1000-8000-00805f9b34fb',
                    '49535343-fe7d-4ae5-8fa9-9fafd205e455',
                    '0000ff00-0000-1000-8000-00805f9b34fb',
                ]
            });

            const server = await this.device.gatt.connect();
            const service = await this.getService(server);

            this.characteristic = await this.getCharacteristic(service);

            return true;
        } catch (error) {
            console.error('Bluetooth connection error:', error);
            throw error;
        }
    }

    async getService(server) {
        const serviceUUIDs = [
            '000018f0-0000-1000-8000-00805f9b34fb',
            '49535343-fe7d-4ae5-8fa9-9fafd205e455',
            '0000ff00-0000-1000-8000-00805f9b34fb',
        ];

        for (const uuid of serviceUUIDs) {
            try {
                return await server.getPrimaryService(uuid);
            } catch (e) {
                continue;
            }
        }

        const services = await server.getPrimaryServices();
        if (services.length > 0) {
            return services[0];
        }

        throw new Error('No compatible service found');
    }

    async getCharacteristic(service) {
        const characteristicUUIDs = [
            '00002af1-0000-1000-8000-00805f9b34fb',
            '49535343-8841-43f4-a8d4-ecbe34729bb3',
            '0000ff01-0000-1000-8000-00805f9b34fb',
        ];

        for (const uuid of characteristicUUIDs) {
            try {
                return await service.getCharacteristic(uuid);
            } catch (e) {
                continue;
            }
        }

        const characteristics = await service.getCharacteristics();
        for (const char of characteristics) {
            if (char.properties.write || char.properties.writeWithoutResponse) {
                return char;
            }
        }

        throw new Error('No writable characteristic found');
    }

    async connectUSB() {
        try {
            const device = await navigator.usb.requestDevice({
                filters: [{ classCode: 7 }]
            });

            await device.open();
            await device.selectConfiguration(1);
            await device.claimInterface(0);

            this.usbDevice = device;
            this.usbEndpoint = device.configuration.interfaces[0].alternate.endpoints.find(
                e => e.direction === 'out'
            );

            return true;
        } catch (error) {
            console.error('USB connection error:', error);
            throw error;
        }
    }

    /**
     * Print invoice in slim format for 80mm thermal printer (48 characters width)
     */
    async printSlimInvoice(receiptData) {
        try {
            let commands = [];

            // Initialize printer
            commands.push(this.cmd_init());

            // ============ HEADER SECTION (Centered) ============
            commands.push(this.cmd_align('center'));

            // Header text
            if (receiptData.header_text) {
                commands.push(this.cmd_bold(true));
                commands.push(this.cmd_text(this.stripHtml(receiptData.header_text) + '\n'));
                commands.push(this.cmd_bold(false));
            }

            // Business name (Large)
            if (receiptData.display_name) {
                commands.push(this.cmd_size('large'));
                commands.push(this.cmd_bold(true));
                commands.push(this.cmd_text(receiptData.display_name + '\n'));
                commands.push(this.cmd_bold(false));
                commands.push(this.cmd_size('normal'));
            }

            // Address
            if (receiptData.address) {
                commands.push(this.cmd_text(this.stripHtml(receiptData.address) + '\n'));
            }

            // Contact & Website
            let contactLine = '';
            if (receiptData.contact) {
                contactLine += this.stripHtml(receiptData.contact);
            }
            if (receiptData.contact && receiptData.website) {
                contactLine += ', ';
            }
            if (receiptData.website) {
                contactLine += receiptData.website;
            }
            if (contactLine) {
                commands.push(this.cmd_text(contactLine + '\n'));
            }

            // Location custom fields
            if (receiptData.location_custom_fields) {
                commands.push(this.cmd_text(receiptData.location_custom_fields + '\n'));
            }

            // Sub heading lines
            if (receiptData.sub_heading_line1) {
                commands.push(this.cmd_text(receiptData.sub_heading_line1 + '\n'));
            }
            if (receiptData.sub_heading_line2) {
                commands.push(this.cmd_text(receiptData.sub_heading_line2 + '\n'));
            }
            if (receiptData.sub_heading_line3) {
                commands.push(this.cmd_text(receiptData.sub_heading_line3 + '\n'));
            }
            if (receiptData.sub_heading_line4) {
                commands.push(this.cmd_text(receiptData.sub_heading_line4 + '\n'));
            }
            if (receiptData.sub_heading_line5) {
                commands.push(this.cmd_text(receiptData.sub_heading_line5 + '\n'));
            }

            // Invoice number (Bold)
            commands.push(this.cmd_feed(1));
            commands.push(this.cmd_bold(true));
            let invoiceLabel = receiptData.invoice_no_prefix ;
            commands.push(this.cmd_text(this.stripHtml(invoiceLabel) + ' ' + receiptData.invoice_no + '\n'));
            commands.push(this.cmd_bold(false));

            // ============ INFO SECTION (Left aligned) ============
            commands.push(this.cmd_align('left'));
            commands.push(this.cmd_feed(1));

            // Date
            commands.push(this.cmd_text('Date: ' + receiptData.invoice_date + '\n'));

            // Sales Person
            if (receiptData.sales_person) {
                const label = receiptData.sales_person_label;
                commands.push(this.cmd_text(label + ': ' + receiptData.sales_person + '\n'));
            }

            // Commission Agent
            if (receiptData.commission_agent) {
                const label = receiptData.commission_agent_label ;
                commands.push(this.cmd_text(label + ': ' + receiptData.commission_agent + '\n'));
            }

            // Sell custom fields 1-4
            if (receiptData.sell_custom_field_1_value) {
                const label = receiptData.sell_custom_field_1_label ;
                commands.push(this.cmd_text(this.stripHtml(label) + ': ' + receiptData.sell_custom_field_1_value + '\n'));
            }
            if (receiptData.sell_custom_field_2_value) {
                const label = receiptData.sell_custom_field_2_label ;
                commands.push(this.cmd_text(this.stripHtml(label) + ': ' + receiptData.sell_custom_field_2_value + '\n'));
            }
            if (receiptData.sell_custom_field_3_value) {
                const label = receiptData.sell_custom_field_3_label ;
                commands.push(this.cmd_text(this.stripHtml(label) + ': ' + receiptData.sell_custom_field_3_value + '\n'));
            }
            if (receiptData.sell_custom_field_4_value) {
                const label = receiptData.sell_custom_field_4_label ;
                commands.push(this.cmd_text(this.stripHtml(label) + ': ' + receiptData.sell_custom_field_4_value + '\n'));
            }

            // Client info
            if (receiptData.customer_info) {
                commands.push(this.cmd_text('Client: ' + this.stripHtml(receiptData.customer_info) + '\n'));
            }

            // Client ID (Code client)
            if (receiptData.client_id) {
                commands.push(this.cmd_text('Code client: ' + receiptData.client_id + '\n'));
            }

            // Customer tax number (M.F)
            if (receiptData.customer_tax_number) {
                commands.push(this.cmd_text('M.F: ' + receiptData.customer_tax_number + '\n'));
            }

            // Customer custom fields
            if (receiptData.customer_custom_fields) {
                commands.push(this.cmd_text(this.stripHtml(receiptData.customer_custom_fields) + '\n'));
            }

            // Customer reward points
            if (receiptData.customer_rp_label) {
                commands.push(this.cmd_text(receiptData.customer_rp_label + ': ' + receiptData.customer_total_rp + '\n'));
            }

            // Shipping custom fields 1-5
            if (receiptData.shipping_custom_field_1_label && receiptData.shipping_custom_field_1_value) {
                commands.push(this.cmd_text(this.stripHtml(receiptData.shipping_custom_field_1_label) + ': ' + this.stripHtml(receiptData.shipping_custom_field_1_value) + '\n'));
            }
            if (receiptData.shipping_custom_field_2_label && receiptData.shipping_custom_field_2_value) {
                commands.push(this.cmd_text(this.stripHtml(receiptData.shipping_custom_field_2_label) + ': ' + this.stripHtml(receiptData.shipping_custom_field_2_value) + '\n'));
            }
            if (receiptData.shipping_custom_field_3_label && receiptData.shipping_custom_field_3_value) {
                commands.push(this.cmd_text(this.stripHtml(receiptData.shipping_custom_field_3_label) + ': ' + this.stripHtml(receiptData.shipping_custom_field_3_value) + '\n'));
            }
            if (receiptData.shipping_custom_field_4_label && receiptData.shipping_custom_field_4_value) {
                commands.push(this.cmd_text(this.stripHtml(receiptData.shipping_custom_field_4_label) + ': ' + this.stripHtml(receiptData.shipping_custom_field_4_value) + '\n'));
            }
            if (receiptData.shipping_custom_field_5_label && receiptData.shipping_custom_field_5_value) {
                commands.push(this.cmd_text(this.stripHtml(receiptData.shipping_custom_field_5_label) + ': ' + this.stripHtml(receiptData.shipping_custom_field_5_value) + '\n'));
            }

            // ============ PRODUCTS TABLE (80mm width - 48 chars) ============
            commands.push(this.cmd_feed(1));
            commands.push(this.cmd_text(this.repeat('-', 48) + '\n'));

            // Print items
            if (receiptData.lines && receiptData.lines.length > 0) {
                receiptData.lines.forEach(line => {
                    // Product name with SKU, brand, cat_code
                    let productLine = line.name || '';

                    commands.push(this.cmd_text(this.truncate(productLine, 48) + '\n'));

                    // Base unit details if available
                    if (receiptData.show_base_unit_details && line.base_unit_multiplier && line.base_unit_multiplier !== 1) {
                        commands.push(this.cmd_text('  1 ' + line.units + ' = ' + line.base_unit_multiplier + ' ' + line.base_unit_name + '\n'));
                    }

                    // Quantity x Price = Total (wider format for 80mm)
                    if (!receiptData.hide_price) {
                        let qtyLine = '  ' + line.quantity + ' x ' + line.unit_price_before_discount;
                        if (line.total_line_discount && line.total_line_discount != 0) {
                            qtyLine += ' - ' + line.total_line_discount;
                        }
                        commands.push(this.cmd_text(this.pad(qtyLine, 33) + this.pad(line.line_total, 15, 'right') + '\n'));
                    } else {
                        commands.push(this.cmd_text('  Qty: ' + line.quantity + '\n'));
                    }

                    // Modifiers (if any)
                    if (line.modifiers && line.modifiers.length > 0) {
                        line.modifiers.forEach(modifier => {
                            let modLine = '    ' + modifier.name;
                            if (modifier.sub_sku) modLine += ', ' + modifier.sub_sku;
                            if (modifier.cat_code) modLine += ', ' + modifier.cat_code;
                            commands.push(this.cmd_text(this.truncate(modLine, 48) + '\n'));

                            if (modifier.variation) {
                                commands.push(this.cmd_text('      ' + modifier.variation + '\n'));
                            }

                            if (!receiptData.hide_price) {
                                commands.push(this.cmd_text(
                                    this.pad('      ' + modifier.quantity + ' x ' + modifier.unit_price_inc_tax, 33) +
                                    this.pad(modifier.line_total, 15, 'right') + '\n'
                                ));
                            }
                        });
                    }

                    commands.push(this.cmd_text(this.repeat('-', 48) + '\n'));
                });
            }

            // ============ TOTALS SECTION (80mm width) ============
            if (!receiptData.hide_price) {
                commands.push(this.cmd_feed(1));

                // Subtotal (Sous-total)
                if (receiptData.subtotal) {
                    commands.push(this.cmd_text(
                        this.pad('Sous-total:', 30) +
                        this.pad(receiptData.subtotal, 18, 'right') + '\n'
                    ));
                }

                // Shipping (Livraison)
                if (receiptData.shipping_charges) {
                    commands.push(this.cmd_text(
                        this.pad('Livraison:', 30) +
                        this.pad(receiptData.shipping_charges, 18, 'right') + '\n'
                    ));
                }

                // Discount (Remise)
                if (receiptData.discount) {
                    commands.push(this.cmd_text(
                        this.pad('Remise:', 30) +
                        this.pad('(-) ' + receiptData.discount, 18, 'right') + '\n'
                    ));
                }

                // Line discount
                if (receiptData.total_line_discount) {
                    const label = receiptData.line_discount_label || 'Line Discount';
                    commands.push(this.cmd_text(
                        this.pad(this.stripHtml(label) + ':', 30) +
                        this.pad('(-) ' + receiptData.total_line_discount, 18, 'right') + '\n'
                    ));
                }

                // Additional expenses
                if (receiptData.additional_expenses) {
                    Object.keys(receiptData.additional_expenses).forEach(key => {
                        commands.push(this.cmd_text(
                            this.pad(key + ':', 30) +
                            this.pad('(+) ' + receiptData.additional_expenses[key], 18, 'right') + '\n'
                        ));
                    });
                }

                // Reward points
                if (receiptData.reward_point_label && receiptData.reward_point_amount) {
                    commands.push(this.cmd_text(
                        this.pad(this.stripHtml(receiptData.reward_point_label) + ':', 30) +
                        this.pad('(-) ' + receiptData.reward_point_amount, 18, 'right') + '\n'
                    ));
                }

                // Tax
                if (receiptData.tax) {
                    commands.push(this.cmd_text(
                        this.pad('Tax:', 30) +
                        this.pad('(+) ' + receiptData.tax, 18, 'right') + '\n'
                    ));
                }

                // Total (Bold)
                commands.push(this.cmd_bold(true));
                commands.push(this.cmd_text(
                    this.pad('Total:', 30) +
                    this.pad(receiptData.total, 18, 'right') + '\n'
                ));
                commands.push(this.cmd_bold(false));

                // Total in words
                if (receiptData.total_in_words) {
                    commands.push(this.cmd_text('(' + receiptData.total_in_words + ')\n'));
                }

                // Payment methods (Méthode paiement)
                if (receiptData.payments && receiptData.payments.length > 0) {
                    commands.push(this.cmd_feed(1));
                    commands.push(this.cmd_text('Methode paiement:\n'));
                    receiptData.payments.forEach(payment => {
                        const method = payment.method || 'ESPECES';
                        const date = payment.date || '';
                        commands.push(this.cmd_text(
                            this.pad(method + ' (' + date + ')', 30) +
                            this.pad(payment.amount, 18, 'right') + '\n'
                        ));
                    });
                }

                // Tax summary
                if (receiptData.tax_summary_label && receiptData.taxes) {
                    commands.push(this.cmd_feed(1));
                    commands.push(this.cmd_align('center'));
                    commands.push(this.cmd_text(receiptData.tax_summary_label + '\n'));
                    commands.push(this.cmd_align('left'));
                    Object.keys(receiptData.taxes).forEach(key => {
                        commands.push(this.cmd_text(
                            this.pad(key, 30) +
                            this.pad(receiptData.taxes[key], 18, 'right') + '\n'
                        ));
                    });
                }
            }

            // ============ FOOTER SECTION ============
            commands.push(this.cmd_feed(1));

            // Additional notes
            if (receiptData.additional_notes) {
                commands.push(this.cmd_align('center'));
                commands.push(this.cmd_text(this.stripHtml(receiptData.additional_notes) + '\n'));
            }

            // Footer text
            if (receiptData.footer_text) {
                commands.push(this.cmd_align('center'));
                commands.push(this.cmd_text(this.stripHtml(receiptData.footer_text) + '\n'));
            }

            commands.push(this.cmd_feed(3));

            // Cut paper
            commands.push(this.cmd_cut());

            // Send all commands to printer
            await this.sendCommands(commands);

            return true;
        } catch (error) {
            console.error('Printing error:', error);
            throw error;
        }
    }

    /**
     * Print invoice in slim2 format for 58mm thermal printer (32 characters width)
     */
    async printSlim2Invoice(receiptData) {
        try {
            let commands = [];

            // Initialize printer
            commands.push(this.cmd_init());

            // ============ HEADER SECTION (Centered) ============
            commands.push(this.cmd_align('center'));

            // Header text
            if (receiptData.header_text) {
                commands.push(this.cmd_bold(true));
                commands.push(this.cmd_text(this.stripHtml(receiptData.header_text) + '\n'));
                commands.push(this.cmd_bold(false));
            }

            // Business name (Large)
            if (receiptData.display_name) {
                commands.push(this.cmd_size('large'));
                commands.push(this.cmd_bold(true));
                commands.push(this.cmd_text(receiptData.display_name + '\n'));
                commands.push(this.cmd_bold(false));
                commands.push(this.cmd_size('normal'));
            }

            // Address
            if (receiptData.address) {
                commands.push(this.cmd_text(this.stripHtml(receiptData.address) + '\n'));
            }

            // Contact & Website
            let contactLine = '';
            if (receiptData.contact) {
                contactLine += this.stripHtml(receiptData.contact);
            }
            if (receiptData.contact && receiptData.website) {
                contactLine += ', ';
            }
            if (receiptData.website) {
                contactLine += receiptData.website;
            }
            if (contactLine) {
                commands.push(this.cmd_text(contactLine + '\n'));
            }

            // Location custom fields
            if (receiptData.location_custom_fields) {
                commands.push(this.cmd_text(receiptData.location_custom_fields + '\n'));
            }

            // Sub heading lines
            if (receiptData.sub_heading_line1) {
                commands.push(this.cmd_text(receiptData.sub_heading_line1 + '\n'));
            }
            if (receiptData.sub_heading_line2) {
                commands.push(this.cmd_text(receiptData.sub_heading_line2 + '\n'));
            }
            if (receiptData.sub_heading_line3) {
                commands.push(this.cmd_text(receiptData.sub_heading_line3 + '\n'));
            }
            if (receiptData.sub_heading_line4) {
                commands.push(this.cmd_text(receiptData.sub_heading_line4 + '\n'));
            }
            if (receiptData.sub_heading_line5) {
                commands.push(this.cmd_text(receiptData.sub_heading_line5 + '\n'));
            }

            // Invoice number (Bold)
            commands.push(this.cmd_feed(1));
            commands.push(this.cmd_bold(true));
            let invoiceLabel = receiptData.invoice_no_prefix ;
            commands.push(this.cmd_text(this.stripHtml(invoiceLabel) + ' ' + receiptData.invoice_no + '\n'));
            commands.push(this.cmd_bold(false));

            // ============ INFO SECTION (Left aligned) ============
            commands.push(this.cmd_align('left'));
            commands.push(this.cmd_feed(1));

            // Date
            commands.push(this.cmd_text('Date: ' + receiptData.invoice_date + '\n'));

            // Sales Person
            if (receiptData.sales_person) {
                const label = receiptData.sales_person_label;
                commands.push(this.cmd_text(label + ': ' + receiptData.sales_person + '\n'));
            }

            // Commission Agent
            if (receiptData.commission_agent) {
                const label = receiptData.commission_agent_label ;
                commands.push(this.cmd_text(label + ': ' + receiptData.commission_agent + '\n'));
            }

            // Sell custom fields 1-4
            if (receiptData.sell_custom_field_1_value) {
                const label = receiptData.sell_custom_field_1_label ;
                commands.push(this.cmd_text(this.stripHtml(label) + ': ' + receiptData.sell_custom_field_1_value + '\n'));
            }
            if (receiptData.sell_custom_field_2_value) {
                const label = receiptData.sell_custom_field_2_label ;
                commands.push(this.cmd_text(this.stripHtml(label) + ': ' + receiptData.sell_custom_field_2_value + '\n'));
            }
            if (receiptData.sell_custom_field_3_value) {
                const label = receiptData.sell_custom_field_3_label ;
                commands.push(this.cmd_text(this.stripHtml(label) + ': ' + receiptData.sell_custom_field_3_value + '\n'));
            }
            if (receiptData.sell_custom_field_4_value) {
                const label = receiptData.sell_custom_field_4_label ;
                commands.push(this.cmd_text(this.stripHtml(label) + ': ' + receiptData.sell_custom_field_4_value + '\n'));
            }

            // Client info
            if (receiptData.customer_info) {
                commands.push(this.cmd_text('Client: ' + this.stripHtml(receiptData.customer_info) + '\n'));
            }

            // Client ID (Code client)
            if (receiptData.client_id) {
                commands.push(this.cmd_text('Code client: ' + receiptData.client_id + '\n'));
            }

            // Customer tax number (M.F)
            if (receiptData.customer_tax_number) {
                commands.push(this.cmd_text('M.F: ' + receiptData.customer_tax_number + '\n'));
            }

            // Customer custom fields
            if (receiptData.customer_custom_fields) {
                commands.push(this.cmd_text(this.stripHtml(receiptData.customer_custom_fields) + '\n'));
            }

            // Customer reward points
            if (receiptData.customer_rp_label) {
                commands.push(this.cmd_text(receiptData.customer_rp_label + ': ' + receiptData.customer_total_rp + '\n'));
            }

            // Shipping custom fields 1-5
            if (receiptData.shipping_custom_field_1_label && receiptData.shipping_custom_field_1_value) {
                commands.push(this.cmd_text(this.stripHtml(receiptData.shipping_custom_field_1_label) + ': ' + this.stripHtml(receiptData.shipping_custom_field_1_value) + '\n'));
            }
            if (receiptData.shipping_custom_field_2_label && receiptData.shipping_custom_field_2_value) {
                commands.push(this.cmd_text(this.stripHtml(receiptData.shipping_custom_field_2_label) + ': ' + this.stripHtml(receiptData.shipping_custom_field_2_value) + '\n'));
            }
            if (receiptData.shipping_custom_field_3_label && receiptData.shipping_custom_field_3_value) {
                commands.push(this.cmd_text(this.stripHtml(receiptData.shipping_custom_field_3_label) + ': ' + this.stripHtml(receiptData.shipping_custom_field_3_value) + '\n'));
            }
            if (receiptData.shipping_custom_field_4_label && receiptData.shipping_custom_field_4_value) {
                commands.push(this.cmd_text(this.stripHtml(receiptData.shipping_custom_field_4_label) + ': ' + this.stripHtml(receiptData.shipping_custom_field_4_value) + '\n'));
            }
            if (receiptData.shipping_custom_field_5_label && receiptData.shipping_custom_field_5_value) {
                commands.push(this.cmd_text(this.stripHtml(receiptData.shipping_custom_field_5_label) + ': ' + this.stripHtml(receiptData.shipping_custom_field_5_value) + '\n'));
            }



            // ============ PRODUCTS TABLE ============
            commands.push(this.cmd_feed(1));
            commands.push(this.cmd_text(this.repeat('-', 32) + '\n'));

            // Print items
            if (receiptData.lines && receiptData.lines.length > 0) {
                receiptData.lines.forEach(line => {
                    // Product name with SKU, brand, cat_code
                    let productLine = line.name || '';

                    commands.push(this.cmd_text(this.truncate(productLine, 32) + '\n'));

                    // Base unit details if available
                    if (receiptData.show_base_unit_details && line.base_unit_multiplier && line.base_unit_multiplier !== 1) {
                        commands.push(this.cmd_text('  1 ' + line.units + ' = ' + line.base_unit_multiplier + ' ' + line.base_unit_name + '\n'));
                    }

                    // Quantity x Price = Total
                    if (!receiptData.hide_price) {
                        let qtyLine = '  ' + line.quantity + ' x ' + line.unit_price_before_discount;
                        if (line.total_line_discount && line.total_line_discount != 0) {
                            qtyLine += ' - ' + line.total_line_discount;
                        }
                        commands.push(this.cmd_text(this.pad(qtyLine, 22) + this.pad(line.line_total, 10, 'right') + '\n'));
                    } else {
                        commands.push(this.cmd_text('  Qty: ' + line.quantity + '\n'));
                    }

                    // Modifiers (if any)
                    if (line.modifiers && line.modifiers.length > 0) {
                        line.modifiers.forEach(modifier => {
                            let modLine = '    ' + modifier.name;
                            if (modifier.sub_sku) modLine += ', ' + modifier.sub_sku;
                            if (modifier.cat_code) modLine += ', ' + modifier.cat_code;
                            commands.push(this.cmd_text(this.truncate(modLine, 32) + '\n'));

                            if (modifier.variation) {
                                commands.push(this.cmd_text('      ' + modifier.variation + '\n'));
                            }

                            if (!receiptData.hide_price) {
                                commands.push(this.cmd_text(
                                    this.pad('      ' + modifier.quantity + ' x ' + modifier.unit_price_inc_tax, 22) +
                                    this.pad(modifier.line_total, 10, 'right') + '\n'
                                ));
                            }
                        });
                    }

                    commands.push(this.cmd_text(this.repeat('-', 32) + '\n'));
                });
            }

            // ============ TOTALS SECTION ============
            if (!receiptData.hide_price) {
                commands.push(this.cmd_feed(1));

                // Subtotal (Sous-total)
                if (receiptData.subtotal) {
                    commands.push(this.cmd_text(
                        this.pad('Sous-total:', 20) +
                        this.pad(receiptData.subtotal, 12, 'right') + '\n'
                    ));
                }

                // Shipping (Livraison)
                if (receiptData.shipping_charges) {
                    commands.push(this.cmd_text(
                        this.pad('Livraison:', 20) +
                        this.pad(receiptData.shipping_charges, 12, 'right') + '\n'
                    ));
                }

                // Discount (Remise)
                if (receiptData.discount) {
                    commands.push(this.cmd_text(
                        this.pad('Remise:', 20) +
                        this.pad('(-) ' + receiptData.discount, 12, 'right') + '\n'
                    ));
                }

                // Line discount
                if (receiptData.total_line_discount) {
                    const label = receiptData.line_discount_label || 'Line Discount';
                    commands.push(this.cmd_text(
                        this.pad(this.stripHtml(label) + ':', 20) +
                        this.pad('(-) ' + receiptData.total_line_discount, 12, 'right') + '\n'
                    ));
                }

                // Additional expenses
                if (receiptData.additional_expenses) {
                    Object.keys(receiptData.additional_expenses).forEach(key => {
                        commands.push(this.cmd_text(
                            this.pad(key + ':', 20) +
                            this.pad('(+) ' + receiptData.additional_expenses[key], 12, 'right') + '\n'
                        ));
                    });
                }

                // Reward points
                if (receiptData.reward_point_label && receiptData.reward_point_amount) {
                    commands.push(this.cmd_text(
                        this.pad(this.stripHtml(receiptData.reward_point_label) + ':', 20) +
                        this.pad('(-) ' + receiptData.reward_point_amount, 12, 'right') + '\n'
                    ));
                }

                // Tax
                if (receiptData.tax) {
                    commands.push(this.cmd_text(
                        this.pad('Tax:', 20) +
                        this.pad('(+) ' + receiptData.tax, 12, 'right') + '\n'
                    ));
                }

                // Total (Bold)
                commands.push(this.cmd_bold(true));
                commands.push(this.cmd_text(
                    this.pad('Total:', 20) +
                    this.pad(receiptData.total, 12, 'right') + '\n'
                ));
                commands.push(this.cmd_bold(false));

                // Total in words
                if (receiptData.total_in_words) {
                    commands.push(this.cmd_text('(' + receiptData.total_in_words + ')\n'));
                }

                // Payment methods (Méthode paiement)
                if (receiptData.payments && receiptData.payments.length > 0) {
                    commands.push(this.cmd_feed(1));
                    commands.push(this.cmd_text('Methode paiement:\n'));
                    receiptData.payments.forEach(payment => {
                        const method = payment.method || 'ESPECES';
                        const date = payment.date || '';
                        commands.push(this.cmd_text(
                            this.pad(method + ' (' + date + ')', 20) +
                            this.pad(payment.amount, 12, 'right') + '\n'
                        ));
                    });
                }

                // Tax summary
                if (receiptData.tax_summary_label && receiptData.taxes) {
                    commands.push(this.cmd_feed(1));
                    commands.push(this.cmd_align('center'));
                    commands.push(this.cmd_text(receiptData.tax_summary_label + '\n'));
                    commands.push(this.cmd_align('left'));
                    Object.keys(receiptData.taxes).forEach(key => {
                        commands.push(this.cmd_text(
                            this.pad(key, 20) +
                            this.pad(receiptData.taxes[key], 12, 'right') + '\n'
                        ));
                    });
                }
            }

            // ============ FOOTER SECTION ============
            commands.push(this.cmd_feed(1));

            // Additional notes
            if (receiptData.additional_notes) {
                commands.push(this.cmd_align('center'));
                commands.push(this.cmd_text(this.stripHtml(receiptData.additional_notes) + '\n'));
            }

            // Footer text
            if (receiptData.footer_text) {
                commands.push(this.cmd_align('center'));
                commands.push(this.cmd_text(this.stripHtml(receiptData.footer_text) + '\n'));
            }

            commands.push(this.cmd_feed(3));

            // Cut paper
            commands.push(this.cmd_cut());

            // Send all commands to printer
            await this.sendCommands(commands);

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
    cmd_text(text) {
        if (typeof text !== 'string') {
            return ''; // Handle non-string input gracefully
        }
        return text
            .normalize("NFD")                     // Decompose accented chars
            .replace(/[\u0300-\u036f]/g, "")      // Remove diacritics
            .replace(/[^\w\s\/\-\:\(\)]/g, "");
    }
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

    stripHtml(html) {
        if (!html) return '';
        // Remove HTML tags and decode entities
        const tmp = document.createElement('DIV');
        tmp.innerHTML = html;
        return tmp.textContent || tmp.innerText || '';
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

