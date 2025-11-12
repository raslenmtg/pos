<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\PrintConnectors\NetworkPrintConnector;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;

class TestPrinterConnection extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'printer:test-connection 
                            {--type=auto : Connection type: auto, usb, network, serial}
                            {--name= : Printer name for USB/Bluetooth}
                            {--ip= : IP address for network printer}
                            {--port=9100 : Port for network printer}
                            {--com= : COM port for serial/Bluetooth}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test connection to a specific thermal printer';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $type = $this->option('type');

        $this->info('🖨️  Thermal Printer Connection Test');
        $this->info('==================================');
        $this->newLine();

        switch ($type) {
            case 'usb':
                return $this->testUSBConnection();
            case 'network':
                return $this->testNetworkConnection();
            case 'serial':
                return $this->testSerialConnection();
            case 'auto':
            default:
                return $this->testAutoConnection();
        }
    }

    /**
     * Test USB/Bluetooth connection
     */
    private function testUSBConnection()
    {
        $printerName = $this->option('name');

        if (!$printerName) {
            $this->error('Please specify printer name with --name option');
            $this->info('Example: php artisan printer:test-connection --type=usb --name="POS-80"');
            return Command::FAILURE;
        }

        $this->info("Testing USB/Bluetooth connection to: $printerName");

        try {
            $connector = new WindowsPrintConnector($printerName);
            $printer = new Printer($connector);

            // Print test receipt
            $printer->text("Test Print Successful!\n");
            $printer->text("Printer: $printerName\n");
            $printer->text("Date: " . date('Y-m-d H:i:s') . "\n");
            $printer->feed(2);
            $printer->cut();
            $printer->close();

            $this->success("✅ Successfully connected and printed to: $printerName");
            return Command::SUCCESS;
        } catch (\Exception $e) {
            $this->error("❌ Connection failed: " . $e->getMessage());
            return Command::FAILURE;
        }
    }

    /**
     * Test Network connection
     */
    private function testNetworkConnection()
    {
        $ip = $this->option('ip');
        $port = $this->option('port');

        if (!$ip) {
            $this->error('Please specify IP address with --ip option');
            $this->info('Example: php artisan printer:test-connection --type=network --ip=192.168.1.100');
            return Command::FAILURE;
        }

        $this->info("Testing network connection to: $ip:$port");

        try {
            $connector = new NetworkPrintConnector($ip, $port, 5);
            $printer = new Printer($connector);

            // Print test receipt
            $printer->text("Test Print Successful!\n");
            $printer->text("Printer: $ip:$port\n");
            $printer->text("Date: " . date('Y-m-d H:i:s') . "\n");
            $printer->feed(2);
            $printer->cut();
            $printer->close();

            $this->success("✅ Successfully connected and printed to: $ip:$port");
            return Command::SUCCESS;
        } catch (\Exception $e) {
            $this->error("❌ Connection failed: " . $e->getMessage());
            $this->newLine();
            $this->warn('Troubleshooting:');
            $this->line("  1. Verify printer IP: $ip");
            $this->line("  2. Check network connectivity: ping $ip");
            $this->line("  3. Verify port $port is open");
            $this->line("  4. Check firewall settings");
            return Command::FAILURE;
        }
    }

    /**
     * Test Serial/COM connection
     */
    private function testSerialConnection()
    {
        $com = $this->option('com');

        if (!$com) {
            $this->error('Please specify COM port with --com option');
            $this->info('Example: php artisan printer:test-connection --type=serial --com=COM3');
            return Command::FAILURE;
        }

        $this->info("Testing serial connection to: $com");

        try {
            $connector = new FilePrintConnector($com);
            $printer = new Printer($connector);

            // Print test receipt
            $printer->text("Test Print Successful!\n");
            $printer->text("Port: $com\n");
            $printer->text("Date: " . date('Y-m-d H:i:s') . "\n");
            $printer->feed(2);
            $printer->cut();
            $printer->close();

            $this->success("✅ Successfully connected and printed to: $com");
            return Command::SUCCESS;
        } catch (\Exception $e) {
            $this->error("❌ Connection failed: " . $e->getMessage());
            return Command::FAILURE;
        }
    }

    /**
     * Test auto-detection
     */
    private function testAutoConnection()
    {
        $this->info('Testing auto-detection...');
        $this->newLine();

        // Try USB printers
        $this->info('1️⃣  Checking USB/Bluetooth printers...');
        $usbPrinters = config('thermal_printer.printer_names', []);
        foreach ($usbPrinters as $name) {
            try {
                $connector = new WindowsPrintConnector($name);
                $printer = new Printer($connector);
                $printer->close();
                $this->success("   ✅ Found: $name");
            } catch (\Exception $e) {
                $this->line("   ⏭️  Not found: $name");
            }
        }
        $this->newLine();

        // Try Network printers
        $this->info('2️⃣  Checking Network printers...');
        $networkIPs = config('thermal_printer.network.ips', []);
        $port = config('thermal_printer.network.port', 9100);
        foreach ($networkIPs as $ip) {
            try {
                $connector = new NetworkPrintConnector($ip, $port, 2);
                $printer = new Printer($connector);
                $printer->close();
                $this->success("   ✅ Found: $ip:$port");
            } catch (\Exception $e) {
                $this->line("   ⏭️  Not found: $ip:$port");
            }
        }
        $this->newLine();

        // Try Serial printers
        $this->info('3️⃣  Checking Serial/COM ports...');
        $comPorts = config('thermal_printer.serial_ports', []);
        foreach ($comPorts as $com) {
            try {
                $connector = new FilePrintConnector($com);
                $printer = new Printer($connector);
                $printer->close();
                $this->success("   ✅ Found: $com");
            } catch (\Exception $e) {
                $this->line("   ⏭️  Not found: $com");
            }
        }
        $this->newLine();

        $this->info('💡 To test specific printer:');
        $this->line('   USB: php artisan printer:test-connection --type=usb --name="POS-80"');
        $this->line('   Network: php artisan printer:test-connection --type=network --ip=192.168.1.100');
        $this->line('   Serial: php artisan printer:test-connection --type=serial --com=COM3');

        return Command::SUCCESS;
    }

    /**
     * Success message helper
     */
    private function success($message)
    {
        $this->line("<fg=green>$message</>");
    }
}

