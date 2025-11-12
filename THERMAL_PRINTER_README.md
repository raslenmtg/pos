# Thermal Printer Integration - Auto-Detection

## Overview
This implementation provides automatic detection and printing to thermal printers (USB/Bluetooth/WiFi) using the `mike42/escpos-php` library for the slim2 invoice design.

## Features
- **Automatic Printer Detection**: Automatically detects thermal printers connected via:
  - USB
  - Bluetooth
  - WiFi/Network (Ethernet)
  
- **Smart Fallback**: If no printer is detected, the system falls back to HTML/browser printing
  
- **Multiple Printer Support**: Supports various thermal printer brands including:
  - Epson TM series (TM-T20, TM-T88, etc.)
  - XPrinter (XP-80C, XP-58, etc.)
  - Generic POS printers (80mm and 58mm)

## Installation & Setup

### 1. Verify mike42/escpos-php Installation
The library is already included in your `composer.json`. If you need to reinstall:

```bash
composer require mike42/escpos-php
```

### 2. Clear Configuration Cache
After setup, clear the Laravel configuration cache:

```bash
php artisan config:cache
php artisan cache:clear
```

## Configuration

### Printer Settings
Edit `config/thermal_printer.php` to customize:

- **Printer Names**: Add your specific printer names to the detection list
- **Network IPs**: Configure your network printer IP addresses
- **Serial Ports**: Adjust COM ports for serial/Bluetooth printers
- **Paper Width**: Set default paper width (58mm or 80mm)

### Example Configuration:
```php
// config/thermal_printer.php
return [
    'printer_names' => [
        'POS-80',
        'Your Printer Name', // Add your printer name here
    ],
    'network' => [
        'ips' => [
            '192.168.1.100', // Your printer IP
        ],
        'port' => 9100,
    ],
];
```

## How to Use

### For slim2 Invoice Design
When you select the "slim2" invoice design in your POS system, the thermal printer will automatically:

1. Detect available printers (USB → Network → Serial/Bluetooth)
2. Connect to the first available printer
3. Print the invoice in thermal receipt format
4. Close the connection

### Manual Testing
You can test the printer detection by creating a test route:

```php
// routes/web.php
Route::get('/test-printer', function() {
    $printerService = new \App\Services\ThermalPrinterService();
    
    if ($printerService->detectAndConnect()) {
        return "Printer detected and connected successfully!";
    } else {
        return "No printer detected. Please check connections.";
    }
});
```

## Troubleshooting

### Printer Not Detected

#### For USB Printers:
1. Ensure the printer is powered on and connected via USB
2. Install the printer drivers on Windows
3. Check if the printer appears in Windows "Devices and Printers"
4. Add the exact printer name to `config/thermal_printer.php`

#### For Bluetooth Printers:
1. Pair the printer with your computer via Bluetooth
2. Note the assigned COM port (e.g., COM3, COM4)
3. Add the COM port to `config/thermal_printer.php` under `serial_ports`

#### For WiFi/Network Printers:
1. Ensure the printer is connected to the same network
2. Find the printer's IP address (usually printed on a test page)
3. Add the IP address to `config/thermal_printer.php` under `network.ips`
4. Ensure port 9100 is open (standard ESC/POS port)

### Testing Printer Connection

#### Windows Command Prompt:
```cmd
# List all printers
wmic printer get name

# Get default printer
wmic printer where "Default=TRUE" get Name

# Test network printer connection
telnet 192.168.1.100 9100
```

#### PowerShell:
```powershell
# List all printers
Get-Printer | Select-Object Name

# Get default printer
Get-Printer | Where-Object {$_.Default -eq $true}
```

### Common Issues

1. **"Printer not connected" Error**
   - Solution: Check physical connections and ensure printer is powered on
   - Verify printer name in config matches exactly

2. **Network Printer Not Found**
   - Solution: Ping the printer IP address to ensure network connectivity
   - Check firewall settings for port 9100

3. **Bluetooth Printer Issues**
   - Solution: Ensure Bluetooth is enabled and printer is paired
   - Check which COM port is assigned to the Bluetooth printer

4. **Printing Cuts Off or Incomplete**
   - Solution: Adjust paper width in config
   - Check printer paper is loaded correctly

## Files Modified/Created

### New Files:
1. `app/Services/ThermalPrinterService.php` - Main thermal printer service
2. `config/thermal_printer.php` - Configuration file
3. `THERMAL_PRINTER_README.md` - This documentation

### Modified Files:
1. `app/Http/Controllers/SellPosController.php` - Added thermal printing logic at line 740

## Code Structure

### ThermalPrinterService Class Methods:

- `detectAndConnect()` - Automatically detects and connects to available printer
- `connectToWindowsPrinter()` - Connects to USB/Bluetooth printers
- `connectToNetworkPrinter()` - Connects to WiFi/Network printers
- `connectToFilePrinter()` - Connects to Serial printers
- `printSlim2Invoice($receipt_details)` - Prints invoice in slim2 format
- `close()` - Closes printer connection

## Advanced Configuration

### Add Custom Printer Name:
If your printer isn't detected, add its exact name:

```php
// Find your printer name in Windows
// Then add to config/thermal_printer.php
'printer_names' => [
    'Your Exact Printer Name',
    // ... other names
],
```

### Set Specific Network Printer:
If you have a dedicated network printer:

```php
// config/thermal_printer.php
'network' => [
    'ips' => [
        '192.168.1.50', // Your printer's IP
    ],
],
```

## Support

For issues or questions:
1. Check the Laravel logs: `storage/logs/laravel.log`
2. Enable debug mode in `.env`: `APP_DEBUG=true`
3. Check printer status in Windows Device Manager

## License
This implementation follows the same license as your UltimatePOS application.

