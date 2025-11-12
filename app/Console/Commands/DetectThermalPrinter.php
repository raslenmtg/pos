<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\ThermalPrinterService;

class DetectThermalPrinter extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'printer:detect';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Detect available thermal printers (USB/Bluetooth/WiFi)';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('🖨️  Thermal Printer Detection Tool');
        $this->info('================================');
        $this->newLine();

        // List Windows printers
        $this->info('📋 Listing Windows Printers...');
        $this->listWindowsPrinters();
        $this->newLine();

        // Try to detect and connect
        $this->info('🔍 Attempting to detect thermal printer...');
        $printerService = new ThermalPrinterService();

        if ($printerService->detectAndConnect()) {
            $this->success('✅ Thermal printer detected and connected successfully!');
            $printerService->close();
            return Command::SUCCESS;
        } else {
            $this->error('❌ No thermal printer detected.');
            $this->newLine();
            $this->warn('Please check:');
            $this->line('  1. Printer is powered on');
            $this->line('  2. USB/Bluetooth connection is active');
            $this->line('  3. Network printer IP is correct');
            $this->line('  4. Printer drivers are installed');
            $this->newLine();
            $this->info('💡 Run: php artisan printer:test-connection for detailed troubleshooting');
            return Command::FAILURE;
        }
    }

    /**
     * List all Windows printers
     */
    private function listWindowsPrinters()
    {
        try {
            if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
                $output = shell_exec('powershell -Command "Get-Printer | Select-Object Name, PortName, DriverName | Format-Table -AutoSize"');

                if ($output) {
                    $this->line($output);
                } else {
                    // Try alternative method
                    $output = shell_exec('wmic printer get Name,PortName');
                    if ($output) {
                        $this->line($output);
                    } else {
                        $this->warn('Could not list printers. You may need to run as administrator.');
                    }
                }
            } else {
                $this->info('Not running on Windows. Skipping Windows printer listing.');
            }
        } catch (\Exception $e) {
            $this->error('Error listing printers: ' . $e->getMessage());
        }
    }

    /**
     * Success message helper
     */
    private function success($message)
    {
        $this->line("<fg=green>$message</>");
    }
}

