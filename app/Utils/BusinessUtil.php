<?php

namespace App\Utils;

use App\Barcode;
use App\Business;
use App\BusinessLocation;
use App\Contact;
use App\Currency;
use App\InvoiceLayout;
use App\InvoiceScheme;
use App\NotificationTemplate;
use App\Unit;
use App\User;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\VariationLocationDetails;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\NetworkPrintConnector;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;


class BusinessUtil extends Util
{
    /**
     * Adds a default settings/resources for a new business
     *
     * @param  int  $business_id
     * @param  int  $user_id
     * @return bool
     */
    public function newBusinessDefaultResources($business_id, $user_id)
    {
        $user = User::find($user_id);

        //create Admin role and assign to user
        $role = Role::create(['name' => 'Admin#'.$business_id,
            'business_id' => $business_id,
            'guard_name' => 'web', 'is_default' => 1,
        ]);
        $user->assignRole($role->name);

        //Create Cashier role for a new business
        $cashier_role = Role::create(['name' => 'Cashier#'.$business_id,
            'business_id' => $business_id,
            'guard_name' => 'web',
        ]);
        $cashier_role->syncPermissions(['sell.view', 'sell.create', 'sell.update', 'sell.delete', 'access_all_locations', 'view_cash_register', 'close_cash_register']);

        $business = Business::findOrFail($business_id);

        //Update reference count
        $ref_count = $this->setAndGetReferenceCount('contacts', $business_id);
        $contact_id = $this->generateReferenceNumber('contacts', $ref_count, $business_id);

        //Add Default/Walk-In Customer for new business
        $customer = [
            'business_id' => $business_id,
            'type' => 'customer',
            'name' => 'Passager',
            'created_by' => $user_id,
            'is_default' => 1,
            'contact_id' => $contact_id,
            'credit_limit' => 0,
        ];
        Contact::create($customer);

        //create default invoice setting for new business
        InvoiceScheme::create(['name' => 'Default',
            'scheme_type' => 'blank',
            'prefix' => '',
            'start_number' => 1,
            'total_digits' => 4,
            'is_default' => 1,
            'business_id' => $business_id,
        ]);
        $input=['name' => 'Défaut',
            'header_text' => null,
            'tax_label' => 'Tax',
            'total_label' => 'Total',
            'show_landmark' => 1,
            'show_city' => 1,
            'show_state' => 1,
            'show_zip_code' => 1,
            'show_country' => 1,
            'highlight_color' => '#000000',
            'footer_text' => '',
            'is_default' => 1,
            'business_id' => $business_id,
            'invoice_heading_not_paid' => '',
            'invoice_heading_paid' => '',
            'total_due_label' => 'Total Impayé',
            'paid_label' => 'Total Payé',
            'show_payments' => 1,
            'show_customer' => 1,
            'customer_label' => 'Client',
            'table_product_label' => 'Désignation',
            'table_qty_label' => 'Qté',
            'table_unit_price_label' => 'P.U',
            'table_subtotal_label' => 'Sous-total',
            'date_label' => 'Date',
    ];
       $input['invoice_no_prefix']='Facture n°:';
            $input['invoice_heading']='Facture';
            $input['quotation_no_prefix']='Devis n°:';
            $input['sub_total_label']='Sous-total';
            $input['discount_label']='Remise';
            $input['tax_label']='Tax';
            $input['total_label']='total';
            $input['total_due_label']='Total Impayé';
            $input['client_id_label']='ID';
            $input['date_label']='Date';
            $input['quotation_heading']='Devis';
            $input['cat_code_label']='HSN';
            $input['client_tax_label']='M.F';
            $input['cn_heading']='Facture d\'avoir';
            $input['cn_no_label']='Facture d\'avoir n°:';
            $input['cn_amount_label']='Total d\'avoir';
            $input['sales_person_label']='Vendeur:';
            $input['change_return_label']='Rendu';
            $input['commission_agent_label']='Comissionaire:';
        //create default invoice layour for new business
        InvoiceLayout::create($input);

        //create default barcode setting for new business
        // Barcode::create(['name' => 'Default',
        //                 'description' => '',
        //                 'width' => 37.29,
        //                 'height' => 25.93,
        //                 'top_margin' => 5,
        //                 'left_margin' => 5,
        //                 'row_distance' => 1,
        //                 'col_distance' => 1,
        //                 'stickers_in_one_row' => 4,
        //                 'is_default' => 1,
        //                 'business_id' => $business_id
        //             ]);

        //Add Default Unit for new business
        $units = [
          [  'business_id' => $business_id,
            'actual_name' => 'Pièce',
            'short_name' => 'Pu',
            'allow_decimal' => 0,
            'created_by' => $user_id,
            'created_at' => now(),
            'updated_at' => now()],
        
          [  'business_id' => $business_id,
            'actual_name' => 'Kg',
            'short_name' => 'Kg',
            'allow_decimal' => 1,
            'created_by' => $user_id,
            'created_at' => now(),
            'updated_at' => now()],

        ];
        Unit::insert($units);

        //Create default notification templates
        $notification_templates = NotificationTemplate::defaultNotificationTemplates($business_id);
        foreach ($notification_templates as $notification_template) {
            NotificationTemplate::create($notification_template);
        }

        return true;
    }

    /**
     * Gives a list of all currencies
     *
     * @return array
     */
    public function allCurrencies()
    {
        // Return only TND currency to reduce database load
        return [142 => 'Tunisia - Tunisian Dinar(DT) '];
    }

    /**
     * Gives a list of all timezone
     *
     * @return array
     */
    public function allTimeZones()
    {
        return [
            'Africa/Tunis' => 'Africa/Tunis',

        ];
        $datetime = new \DateTimeZone('EDT');

        $timezones = $datetime->listIdentifiers();
        $timezone_list = [];
        foreach ($timezones as $timezone) {
            $timezone_list[$timezone] = $timezone;
        }

        return $timezone_list;
    }

    /**
     * Gives a list of all accouting methods
     *
     * @return array
     */
    public function allAccountingMethods()
    {
        return [
            'fifo' => __('business.fifo'),
            'lifo' => __('business.lifo'),
        ];
    }

    /**
     * Creates new business with default settings.
     *
     * @return array
     */
    public function createNewBusiness($business_details)
    {
        $business_details['sell_price_tax'] = 'includes';

        $business_details['default_profit_percent'] = 25;
        $business_details['tax_label_1'] = 'M.F';

        //Add POS shortcuts
        $business_details['keyboard_shortcuts'] = '{"pos":{"express_checkout":"shift+e","pay_n_ckeckout":"shift+p","draft":"shift+d","cancel":"shift+c","edit_discount":"shift+i","edit_order_tax":"shift+t","add_payment_row":"shift+r","finalize_payment":"shift+f","recent_product_quantity":"f2","add_new_product":"f4"}}';

        $business_details['custom_labels']='{"payments":{"custom_pay_1":"Lettre de change","custom_pay_2":null,"custom_pay_3":null,"custom_pay_4":null,"custom_pay_5":null,"custom_pay_6":null,"custom_pay_7":null},"contact":{"custom_field_1":null,"custom_field_2":null,"custom_field_3":null,"custom_field_4":null,"custom_field_5":null,"custom_field_6":null,"custom_field_7":null,"custom_field_8":null,"custom_field_9":null,"custom_field_10":null},"product":{"custom_field_1":null,"custom_field_2":null,"custom_field_3":null,"custom_field_4":null,"custom_field_5":null,"custom_field_6":null,"custom_field_7":null,"custom_field_8":null,"custom_field_9":null,"custom_field_10":null,"custom_field_11":null,"custom_field_12":null,"custom_field_13":null,"custom_field_14":null,"custom_field_15":null,"custom_field_16":null,"custom_field_17":null,"custom_field_18":null,"custom_field_19":null,"custom_field_20":null},"product_cf_details":{"1":{"type":null,"dropdown_options":null},"2":{"type":null,"dropdown_options":null},"3":{"type":null,"dropdown_options":null},"4":{"type":null,"dropdown_options":null},"5":{"type":null,"dropdown_options":null},"6":{"type":null,"dropdown_options":null},"7":{"type":null,"dropdown_options":null},"8":{"type":null,"dropdown_options":null},"9":{"type":null,"dropdown_options":null},"10":{"type":null,"dropdown_options":null},"11":{"type":null,"dropdown_options":null},"12":{"type":null,"dropdown_options":null},"13":{"type":null,"dropdown_options":null},"14":{"type":null,"dropdown_options":null},"15":{"type":null,"dropdown_options":null},"16":{"type":null,"dropdown_options":null},"17":{"type":null,"dropdown_options":null},"18":{"type":null,"dropdown_options":null},"19":{"type":null,"dropdown_options":null},"20":{"type":null,"dropdown_options":null}},"location":{"custom_field_1":null,"custom_field_2":null,"custom_field_3":null,"custom_field_4":null},"user":{"custom_field_1":null,"custom_field_2":null,"custom_field_3":null,"custom_field_4":null},"purchase":{"custom_field_1":null,"custom_field_2":null,"custom_field_3":null,"custom_field_4":null},"purchase_shipping":{"custom_field_1":null,"custom_field_2":null,"custom_field_3":null,"custom_field_4":null,"custom_field_5":null},"sell":{"custom_field_1":null,"custom_field_2":null,"custom_field_3":null,"custom_field_4":null},"shipping":{"custom_field_1":null,"custom_field_2":null,"custom_field_3":null,"custom_field_4":null,"custom_field_5":null},"types_of_service":{"custom_field_1":null,"custom_field_2":null,"custom_field_3":null,"custom_field_4":null,"custom_field_5":null,"custom_field_6":null}}';
     /*   //Add prefixes
        $business_details['ref_no_prefixes'] = [
            'purchase' => 'AC',
            'stock_transfer' => 'ST',
            'stock_adjustment' => 'SA',
            'sell_return' => 'RA',
            'expense' => 'DE',
            'contacts' => 'CO',
            'purchase_payment' => 'PA',
            'sell_payment' => 'SP',
            'business_location' => 'BL',
        ];*/

        //Disable inline tax editing
        $business_details['enable_inline_tax'] = 0;

        $business = Business::create_business($business_details);

        return $business;
    }

    /**
     * Gives details for a business
     *
     * @return object
     */
    public function getDetails($business_id)
    {
        $details = Business::leftjoin('tax_rates AS TR', 'business.default_sales_tax', 'TR.id')
                        ->leftjoin('currencies AS cur', 'business.currency_id', 'cur.id')
                        ->select(
                            'business.*',
                            'cur.code as currency_code',
                            'cur.symbol as currency_symbol',
                            'thousand_separator',
                            'decimal_separator',
                            'TR.amount AS tax_calculation_amount',
                            'business.default_sales_discount'
                        )
                        ->where('business.id', $business_id)
                        ->first();

        return $details;
    }

    /**
     * Gives current financial year
     *
     * @return array
     */
    public function getCurrentFinancialYear($business_id)
    {
        $current_year = date('Y');

        return [
            'start' => $current_year . '-01-01',
            'end' => $current_year . '-12-31',
        ];
    }

    /**
     * Adds a new location to a business
     *
     * @param  int  $business_id
     * @param  array  $location_details
     * @param  int  $invoice_layout_id default null
     * @return location object
     */
    public function addLocation($business_id, $location_details, $invoice_scheme_id = null, $invoice_layout_id = null)
    {
        if (empty($invoice_scheme_id)) {
            $layout = InvoiceLayout::where('is_default', 1)
                                    ->where('business_id', $business_id)
                                    ->first();
            $invoice_layout_id = $layout->id;
        }

        if (empty($invoice_scheme_id)) {
            $scheme = InvoiceScheme::where('is_default', 1)
                                    ->where('business_id', $business_id)
                                    ->first();
            $invoice_scheme_id = $scheme->id;
        }

        //Update reference count
        $ref_count = $this->setAndGetReferenceCount('business_location', $business_id);
        $location_id = $this->generateReferenceNumber('business_location', $ref_count, $business_id);

        //Enable all payment methods by default
        $payment_types = $this->payment_types();
        $location_payment_types = [];
        foreach ($payment_types as $key => $value) {
            $location_payment_types[$key] = [
                'is_enabled' => 1,
                'account' => null,
            ];
        }
        $location = BusinessLocation::create(['business_id' => $business_id,
            'name' => $location_details['name'],
            'landmark' => $location_details['landmark'],
            'city' => $location_details['city'],
            'state' => $location_details['state'],
            'zip_code' => $location_details['zip_code'],
            'country' => $location_details['country'],
            'invoice_scheme_id' => $invoice_scheme_id,
            'invoice_layout_id' => $invoice_layout_id,
            'sale_invoice_layout_id' => $invoice_layout_id,
            'mobile' => ! empty($location_details['mobile']) ? $location_details['mobile'] : '',
            'alternate_number' => ! empty($location_details['alternate_number']) ? $location_details['alternate_number'] : '',
            'website' => ! empty($location_details['website']) ? $location_details['website'] : '',
            'email' => '',
            'location_id' => $location_id,
            'default_payment_accounts' => json_encode($location_payment_types),
        ]);

        return $location;
    }

    /**
     * Return the invoice layout details
     *
     * @param  int  $business_id
     * @param  array  $layout_id = null
     * @return location object
     */
    public function invoiceLayout($business_id, $layout_id = null)
    {
        $layout = null;
        if (! empty($layout_id)) {
            $layout = InvoiceLayout::find($layout_id);
        }

        //If layout is not found (deleted) then get the default layout for the business
        if (empty($layout)) {
            $layout = InvoiceLayout::where('business_id', $business_id)
                        ->where('is_default', 1)
                        ->first();
        }
        //$output = []
        return $layout;
    }

    /**
     * Return the printer configuration
     *
     * @param  int  $business_id
     * @param  int  $printer_id
     * @return array
     */
    public function printerConfig($business_id, $printer_id)
    {
      /*  $printer = Printer::where('business_id', $business_id)
                    ->find($printer_id);

        $output = [];

        if (! empty($printer)) {
            $output['connection_type'] = $printer->connection_type;
            $output['capability_profile'] = $printer->capability_profile;
            $output['char_per_line'] = $printer->char_per_line;
            $output['ip_address'] = $printer->ip_address;
            $output['port'] = $printer->port;
            $output['path'] = $printer->path;
            $output['server_url'] = $printer->server_url;
        }

        return $output;*/
        return [];
    }

    /**
     * Return the date range for which editing of transaction for a business is allowed.
     *
     * @param  int  $business_id
     * @param  char  $edit_transaction_period
     * @return array
     */
    public function editTransactionDateRange($business_id, $edit_transaction_period)
    {
        if (is_numeric($edit_transaction_period)) {
            return ['start' => \Carbon::today()
                ->subDays($edit_transaction_period),
                'end' => \Carbon::today(),
            ];
        } elseif ($edit_transaction_period == 'fy') {
            //Editing allowed for current financial year
            return $this->getCurrentFinancialYear($business_id);
        }

        return false;
    }

    /**
     * Return the default setting for the pos screen.
     *
     * @return array
     */
    public function defaultPosSettings()
    {
        return ['disable_pay_checkout' => 0, 'disable_draft' => 0, 'disable_express_checkout' => 0, 'hide_product_suggestion' => 0, 'hide_recent_trans' => 0, 'disable_discount' => 0, 'disable_order_tax' => 0, 'is_pos_subtotal_editable' => 0];
    }

    /**
     * Return the default setting for the email.
     *
     * @return array
     */
    public function defaultEmailSettings()
    {
        return ['mail_host' => '', 'mail_port' => '', 'mail_username' => '', 'mail_password' => '', 'mail_encryption' => '', 'mail_from_address' => '', 'mail_from_name' => ''];
    }

    /**
     * Return the default setting for the email.
     *
     * @return array
     */
    public function defaultSmsSettings()
    {
        return ['url' => '', 'send_to_param_name' => 'to', 'msg_param_name' => 'text', 'request_method' => 'post', 'param_1' => '', 'param_val_1' => '', 'param_2' => '', 'param_val_2' => '', 'param_3' => '', 'param_val_3' => '', 'param_4' => '', 'param_val_4' => '', 'param_5' => '', 'param_val_5' => ''];
    }

    /**
     * Directly print receipt to thermal printer
     *
     * @param  array  $receipt_details
     * @param  int  $printer_id
     * @return array
     */
    public function directPrint($receipt_details)
    {
        try {
            //TODO: Update with your printer details.
            $printer_details = (object)[
                'connection_type' => env('PRINTER_CONNECTION_TYPE', 'windows'), // Supported: 'windows', 'network', 'linux'
                'path' => env('PRINTER_PATH', 'YOUR_PRINTER_NAME'), // For windows and linux type. REPLACE YOUR_PRINTER_NAME with your printer's name.
                'ip_address' => env('PRINTER_IP_ADDRESS', '192.168.1.123'), // For network type
                'port' => env('PRINTER_PORT', 9100), // For network type
            ];

            if (empty($printer_details)) {
                return ['success' => 0, 'msg' => 'Printer not found. Please configure a printer.'];
            }

            $connector = null;
            if ($printer_details->connection_type == 'windows') {
                $connector = new WindowsPrintConnector($printer_details->path);
            } elseif ($printer_details->connection_type == 'network') {
                $connector = new NetworkPrintConnector($printer_details->ip_address, $printer_details->port);
            } elseif ($printer_details->connection_type == 'linux') {
                $connector = new FilePrintConnector($printer_details->path);
            } else {
                return ['success' => 0, 'msg' => 'Invalid printer connection type'];
            }

            $printer = new Printer($connector);

            //Print receipt
            $printer->setJustification(Printer::JUSTIFY_CENTER);
            $printer->text($receipt_details->business_name . "\n");
            $printer->text($receipt_details->location_name . "\n");
            $printer->text($receipt_details->location_address . "\n");
            if(!empty($receipt_details->contact)){
                $printer->text($receipt_details->contact . "\n");
            }
            if(!empty($receipt_details->tax_info1)){
                $printer->text($receipt_details->tax_label1 . " " . $receipt_details->tax_info1 . "\n");
            }
            if(!empty($receipt_details->tax_info2)){
                $printer->text($receipt_details->tax_label2 . " " . $receipt_details->tax_info2 . "\n");
            }
            $printer->text("\n");
            $printer->setJustification(Printer::JUSTIFY_LEFT);
            $printer->text($receipt_details->invoice_no_prefix . $receipt_details->invoice_no . "\n");
            $printer->text($receipt_details->date_label . " " . $receipt_details->invoice_date . "\n");

            if(!empty($receipt_details->customer_name)){
                $printer->text($receipt_details->customer_label . ": " . $receipt_details->customer_name . "\n");
            }

            $printer->text("--------------------------------\n");
            foreach ($receipt_details->lines as $line) {
                $printer->text($line['name'] . "\n");
                $printer->text($line['quantity'] . " " . $line['units'] . " x " . $line['unit_price_inc_tax'] . " = " . $line['line_total'] . "\n");
            }
            $printer->text("--------------------------------\n");

            if(!empty($receipt_details->subtotal)){
                $printer->text($receipt_details->subtotal_label . " " . $receipt_details->subtotal . "\n");
            }
            if(!empty($receipt_details->total)){
                $printer->text($receipt_details->total_label . " " . $receipt_details->total . "\n");
            }

            $printer->text("\n");
            $printer->setJustification(Printer::JUSTIFY_CENTER);
            if(!empty($receipt_details->footer_text)){
                $printer->text($receipt_details->footer_text . "\n");
            }

            $printer->cut();
            $printer->close();

            return ['success' => 1, 'msg' => 'Receipt printed successfully'];
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return ['success' => 0, 'msg' => $e->getMessage()];
        }
    }
}
