<?php

namespace App\Services;

use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\PrintConnectors\NetworkPrintConnector;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\EscposImage;
use Exception;
use Illuminate\Support\Facades\Log;

class ThermalPrinterService
{
    private $printer = null;
    private $connector = null;

    /**
     * Automatically detect and connect to thermal printer
     * Tries USB, Network, and Bluetooth connections
     */
    public function detectAndConnect()
    {
        // Try Windows USB/Bluetooth printers first
        if ($this->connectToWindowsPrinter()) {
            return true;
        }

        // Try Network printers
        if ($this->connectToNetworkPrinter()) {
            return true;
        }

        // Try File/Serial printers
        if ($this->connectToFilePrinter()) {
            return true;
        }

        return false;
    }

    /**
     * Connect to Windows printer (USB/Bluetooth)
     */
    private function connectToWindowsPrinter()
    {
        try {
            // Get printer names from config
            $printerNames = config('thermal_printer.printer_names', [
                'POS-80',
                'POS-58',
                'XP-80C',
                'XP-58',
                'TM-T20',
                'TM-T88',
                'RP80',
                'RP58',
                'Thermal Printer',
                'Receipt Printer',
                'USB Printer',
                'Bluetooth Printer',
            ]);

            // Try to find printer by common names
            foreach ($printerNames as $name) {
                try {
                    $this->connector = new WindowsPrintConnector($name);
                    $this->printer = new Printer($this->connector);
                    Log::info("Connected to printer: $name");
                    return true;
                } catch (Exception $e) {
                    continue;
                }
            }

            // Try to get default printer from Windows
            $defaultPrinter = $this->getDefaultWindowsPrinter();
            if ($defaultPrinter) {
                try {
                    $this->connector = new WindowsPrintConnector($defaultPrinter);
                    $this->printer = new Printer($this->connector);
                    Log::info("Connected to default printer: $defaultPrinter");
                    return true;
                } catch (Exception $e) {
                    Log::error("Failed to connect to default printer: " . $e->getMessage());
                }
            }

            // Try to list and connect to any available printer
            $availablePrinters = $this->listWindowsPrinters();
            foreach ($availablePrinters as $printerName) {
                try {
                    $this->connector = new WindowsPrintConnector($printerName);
                    $this->printer = new Printer($this->connector);
                    Log::info("Connected to printer: $printerName");
                    return true;
                } catch (Exception $e) {
                    continue;
                }
            }
        } catch (Exception $e) {
            Log::error("Windows printer connection error: " . $e->getMessage());
        }

        return false;
    }

    /**
     * Connect to Network printer (WiFi/Ethernet)
     */
    private function connectToNetworkPrinter()
    {
        try {
            // Get network settings from config
            $networkAddresses = config('thermal_printer.network.ips', [
                '192.168.1.100',
                '192.168.0.100',
                '192.168.1.200',
                '192.168.0.200',
                '10.0.0.100',
            ]);

            $port = config('thermal_printer.network.port', 9100); // Standard ESC/POS port
            $timeout = config('thermal_printer.network.timeout', 3);

            foreach ($networkAddresses as $ip) {
                try {
                    $this->connector = new NetworkPrintConnector($ip, $port, $timeout);
                    $this->printer = new Printer($this->connector);
                    Log::info("Connected to network printer: $ip:$port");
                    return true;
                } catch (Exception $e) {
                    continue;
                }
            }
        } catch (Exception $e) {
            Log::error("Network printer connection error: " . $e->getMessage());
        }

        return false;
    }

    /**
     * Connect to File/Serial printer
     */
    private function connectToFilePrinter()
    {
        try {
            // Get serial ports from config
            $ports = config('thermal_printer.serial_ports', [
                'COM1',
                'COM2',
                'COM3',
                'COM4',
                'COM5',
                '/dev/usb/lp0',
                '/dev/usb/lp1',
            ]);

            foreach ($ports as $port) {
                try {
                    $this->connector = new FilePrintConnector($port);
                    $this->printer = new Printer($this->connector);
                    Log::info("Connected to serial/file printer: $port");
                    return true;
                } catch (Exception $e) {
                    continue;
                }
            }
        } catch (Exception $e) {
            Log::error("File printer connection error: " . $e->getMessage());
        }

        return false;
    }

    /**
     * Get default Windows printer
     */
    private function getDefaultWindowsPrinter()
    {
        try {
            if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
                // Use PowerShell to get default printer
                $output = shell_exec('powershell -Command "Get-WmiObject -Query \"SELECT * FROM Win32_Printer WHERE Default=$true\" | Select-Object -ExpandProperty Name"');
                if ($output) {
                    return trim($output);
                }

                // Alternative method using wmic
                $output = shell_exec('wmic printer where "Default=TRUE" get Name /value');
                if ($output && preg_match('/Name=(.+)/', $output, $matches)) {
                    return trim($matches[1]);
                }
            }
        } catch (Exception $e) {
            Log::error("Error getting default printer: " . $e->getMessage());
        }

        return null;
    }

    /**
     * List all available Windows printers
     */
    private function listWindowsPrinters()
    {
        $printers = [];
        try {
            if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
                // Use PowerShell to list all printers
                $output = shell_exec('powershell -Command "Get-WmiObject -Query \"SELECT * FROM Win32_Printer\" | Select-Object -ExpandProperty Name"');
                if ($output) {
                    $printers = array_filter(explode("\n", $output));
                    $printers = array_map('trim', $printers);
                }
            }
        } catch (Exception $e) {
            Log::error("Error listing printers: " . $e->getMessage());
        }

        return $printers;
    }

    /**
     * Print invoice in slim2 format
     */
    public function printSlim2Invoice($receipt_details)
    {
        if (!$this->printer) {
            throw new Exception("Printer not connected. Please check printer connection.");
        }

        try {
            $printer = $this->printer;

            // Initialize printer
            $printer->initialize();

            // Set character set
            $printer->setJustification(Printer::JUSTIFY_CENTER);
            $printer->selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
            $printer->text($receipt_details->business_name . "\n");
            $printer->selectPrintMode();

            // Business details
            if (!empty($receipt_details->location_custom_field1)) {
                $printer->text($receipt_details->location_custom_field1 . "\n");
            }
            if (!empty($receipt_details->location_custom_field2)) {
                $printer->text($receipt_details->location_custom_field2 . "\n");
            }
            if (!empty($receipt_details->location_custom_field3)) {
                $printer->text($receipt_details->location_custom_field3 . "\n");
            }
            if (!empty($receipt_details->location_custom_field4)) {
                $printer->text($receipt_details->location_custom_field4 . "\n");
            }

            $printer->feed();

            // Invoice details
            $printer->setJustification(Printer::JUSTIFY_LEFT);
            $printer->text(str_pad("Invoice: " . $receipt_details->invoice_no, 32) . "\n");
            $printer->text(str_pad("Date: " . $receipt_details->invoice_date, 32) . "\n");

            if (!empty($receipt_details->customer_name)) {
                $printer->text(str_pad("Customer: " . $receipt_details->customer_name, 32) . "\n");
            }

            if (!empty($receipt_details->customer_tax_number)) {
                $printer->text(str_pad("Tax No: " . $receipt_details->customer_tax_number, 32) . "\n");
            }

            $printer->feed();
            $printer->text(str_repeat("-", 32) . "\n");

            // Items header
            $printer->text(str_pad("Item", 16) . str_pad("Qty", 6) . str_pad("Price", 10, ' ', STR_PAD_LEFT) . "\n");
            $printer->text(str_repeat("-", 32) . "\n");

            // Print items
            if (!empty($receipt_details->lines)) {
                foreach ($receipt_details->lines as $line) {
                    $itemName = $this->truncate($line->name ?? $line->product_name ?? '', 16);
                    $qty = $line->quantity ?? '0';
                    $price = $this->formatCurrency($line->line_total ?? 0, $receipt_details->currency);

                    $printer->text(str_pad($itemName, 16) . str_pad($qty, 6) . str_pad($price, 10, ' ', STR_PAD_LEFT) . "\n");

                    // Print modifiers or variations if available
                    if (!empty($line->variation)) {
                        $printer->text("  " . $this->truncate($line->variation, 30) . "\n");
                    }
                }
            }

            $printer->text(str_repeat("-", 32) . "\n");

            // Totals
            $printer->setJustification(Printer::JUSTIFY_RIGHT);

            if (!empty($receipt_details->subtotal)) {
                $subtotal = $this->formatCurrency($receipt_details->subtotal, $receipt_details->currency);
                $printer->text("Subtotal: " . $subtotal . "\n");
            }

            if (!empty($receipt_details->discount_amount) && $receipt_details->discount_amount > 0) {
                $discount = $this->formatCurrency($receipt_details->discount_amount, $receipt_details->currency);
                $printer->text("Discount: " . $discount . "\n");
            }

            if (!empty($receipt_details->tax_amount) && $receipt_details->tax_amount > 0) {
                $tax = $this->formatCurrency($receipt_details->tax_amount, $receipt_details->currency);
                $printer->text("Tax: " . $tax . "\n");
            }

            if (!empty($receipt_details->shipping_charges) && $receipt_details->shipping_charges > 0) {
                $shipping = $this->formatCurrency($receipt_details->shipping_charges, $receipt_details->currency);
                $printer->text("Shipping: " . $shipping . "\n");
            }

            $printer->selectPrintMode(Printer::MODE_EMPHASIZED);
            $total = $this->formatCurrency($receipt_details->total ?? 0, $receipt_details->currency);
            $printer->text("TOTAL: " . $total . "\n");
            $printer->selectPrintMode();

            $printer->setJustification(Printer::JUSTIFY_LEFT);
            $printer->text(str_repeat("-", 32) . "\n");

            // Payment details
            if (!empty($receipt_details->payments)) {
                foreach ($receipt_details->payments as $payment) {
                    $method = $payment->method ?? 'Cash';
                    $amount = $this->formatCurrency($payment->amount ?? 0, $receipt_details->currency);
                    $printer->text("Payment (" . $method . "): " . $amount . "\n");
                }
            }

            $printer->feed();

            // Footer
            $printer->setJustification(Printer::JUSTIFY_CENTER);
            if (!empty($receipt_details->footer_text)) {
                $printer->text($receipt_details->footer_text . "\n");
            }

            if (!empty($receipt_details->invoice_url)) {
                $printer->text($receipt_details->invoice_url . "\n");
            }

            $printer->feed(2);
            $printer->text("Thank You!\n");
            $printer->feed(3);

            // Cut paper
            $printer->cut();

            Log::info("Invoice printed successfully: " . $receipt_details->invoice_no);

            return true;
        } catch (Exception $e) {
            Log::error("Printing error: " . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Format currency value
     */
    private function formatCurrency($amount, $currency)
    {
        $symbol = $currency['symbol'] ?? '$';
        $decimal = $currency['decimal_separator'] ?? '.';
        $thousand = $currency['thousand_separator'] ?? ',';

        return $symbol . number_format((float)$amount, 2, $decimal, $thousand);
    }

    /**
     * Truncate string to specified length
     */
    private function truncate($string, $length)
    {
        if (strlen($string) > $length) {
            return substr($string, 0, $length - 3) . '...';
        }
        return $string;
    }

    /**
     * Close printer connection
     */
    public function close()
    {
        if ($this->printer) {
            try {
                $this->printer->close();
            } catch (Exception $e) {
                Log::error("Error closing printer: " . $e->getMessage());
            }
        }
    }

    /**
     * Get printer instance
     */
    public function getPrinter()
    {
        return $this->printer;
    }
}

