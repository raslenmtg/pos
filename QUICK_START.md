# 🖨️ Thermal Printer - Quick Start Guide

## What Was Implemented

✅ **Automatic Printer Detection** - Detects USB, Bluetooth, and WiFi thermal printers
✅ **Smart Printing** - Automatically prints slim2 invoices to thermal printer
✅ **Fallback System** - Falls back to HTML printing if no printer detected
✅ **Testing Tools** - Command-line tools to test and troubleshoot printers

---

## 🚀 Quick Start (3 Steps)

### Step 1: Run Setup Script
Double-click the file: `setup-thermal-printer.bat`

**OR** run manually in terminal:
```bash
cd "C:\Users\Med Raslen\Desktop\UltimatePOS_v6.5"
php artisan config:cache
php artisan cache:clear
composer dump-autoload
```

### Step 2: Detect Your Printer
Run in terminal:
```bash
php artisan printer:detect
```

This will show all available printers and try to connect.

### Step 3: Configure (If Needed)
If your printer isn't detected, add it to: `config/thermal_printer.php`

```php
'printer_names' => [
    'Your Printer Name Here', // Add your exact printer name
],
```

---

## 📝 How It Works

When you print an invoice with **slim2** design:
1. System automatically detects available thermal printers
2. Connects to first available printer (USB → WiFi → Bluetooth)
3. Prints the invoice in thermal receipt format
4. If no printer found, shows HTML version for browser printing

---

## 🔧 Testing Your Printer

### Detect All Printers
```bash
php artisan printer:detect
```

### Test USB/Bluetooth Printer
```bash
php artisan printer:test-connection --type=usb --name="POS-80"
```

### Test Network/WiFi Printer
```bash
php artisan printer:test-connection --type=network --ip=192.168.1.100
```

### Test Serial/Bluetooth COM Port
```bash
php artisan printer:test-connection --type=serial --com=COM3
```

---

## 🔍 Finding Your Printer

### Windows Users:

**Method 1: Control Panel**
1. Open "Devices and Printers"
2. Look for your thermal printer name
3. Copy the exact name

**Method 2: PowerShell**
```powershell
Get-Printer | Select-Object Name
```

**Method 3: Command Prompt**
```cmd
wmic printer get name
```

### For Network Printers:
- Check printer's LCD screen/display for IP address
- Print a test page from printer (usually has IP on it)
- Check your router's connected devices

---

## 📋 Supported Printers

✅ Epson TM series (TM-T20, TM-T88, etc.)
✅ XPrinter (XP-80C, XP-58, etc.)
✅ Generic POS-80, POS-58
✅ Any ESC/POS compatible thermal printer
✅ 80mm and 58mm paper width

---

## 🐛 Troubleshooting

### Printer Not Detected?

**For USB Printers:**
1. ✔️ Check printer is powered ON
2. ✔️ Check USB cable is connected
3. ✔️ Install printer drivers
4. ✔️ Printer appears in Windows "Devices and Printers"?
5. ✔️ Add exact printer name to config

**For Bluetooth Printers:**
1. ✔️ Bluetooth is enabled on computer
2. ✔️ Printer is paired with computer
3. ✔️ Note the COM port assigned (e.g., COM3)
4. ✔️ Add COM port to config: `config/thermal_printer.php`

**For WiFi/Network Printers:**
1. ✔️ Printer connected to same network
2. ✔️ Find printer IP address
3. ✔️ Test: `ping <printer-ip>`
4. ✔️ Add IP to config: `config/thermal_printer.php`
5. ✔️ Check firewall allows port 9100

---

## ⚙️ Configuration

Edit: `config/thermal_printer.php`

### Add Your Printer Name:
```php
'printer_names' => [
    'POS-80',           // Already included
    'Your Printer',     // ADD YOUR PRINTER HERE
],
```

### Add Network Printer IP:
```php
'network' => [
    'ips' => [
        '192.168.1.100',    // Already included
        '192.168.1.50',     // ADD YOUR IP HERE
    ],
],
```

### Add Bluetooth COM Port:
```php
'serial_ports' => [
    'COM1',    // Already included
    'COM3',    // ADD YOUR COM PORT HERE
],
```

---

## 📁 Files Created/Modified

### New Files:
- ✅ `app/Services/ThermalPrinterService.php` - Main printer service
- ✅ `app/Console/Commands/DetectThermalPrinter.php` - Detection command
- ✅ `app/Console/Commands/TestPrinterConnection.php` - Testing command
- ✅ `config/thermal_printer.php` - Configuration file
- ✅ `THERMAL_PRINTER_README.md` - Full documentation
- ✅ `QUICK_START.md` - This file
- ✅ `setup-thermal-printer.bat` - Setup script

### Modified Files:
- ✅ `app/Http/Controllers/SellPosController.php` (Line 740) - Added auto-print logic

---

## 💡 Usage in Application

### In Your POS System:
1. Go to POS screen
2. Create a sale
3. Select **"slim2"** invoice design
4. Click Print/Generate Invoice
5. **Printer automatically prints!** 🎉

If printer not detected:
- Browser shows HTML version
- You can still print from browser
- Error message shows in logs

---

## 📊 Check Logs

If something goes wrong, check:
```
storage/logs/laravel.log
```

Look for entries like:
- "Connected to printer: [name]"
- "Printer connection error: [details]"
- "Invoice printed successfully"

---

## 🆘 Need Help?

### Check printer connection:
```bash
php artisan printer:detect
```

### View Laravel logs:
```bash
tail -f storage/logs/laravel.log
```

### Enable debug mode:
Edit `.env`:
```
APP_DEBUG=true
```

### Test specific printer:
```bash
php artisan printer:test-connection --type=usb --name="YourPrinterName"
```

---

## ✨ Features

- 🔍 **Auto-Detection**: Automatically finds your printer
- 🔄 **Multi-Protocol**: USB, Bluetooth, WiFi support
- 🎯 **Smart Fallback**: HTML printing if printer unavailable
- 📝 **Detailed Logging**: Track all print operations
- ⚙️ **Configurable**: Easy to customize
- 🧪 **Testing Tools**: Built-in troubleshooting commands
- 🌐 **Platform Support**: Windows optimized (Linux compatible)

---

## 🎓 Advanced Usage

### Programmatic Usage:
```php
use App\Services\ThermalPrinterService;

$printer = new ThermalPrinterService();
if ($printer->detectAndConnect()) {
    $printer->printSlim2Invoice($receipt_details);
    $printer->close();
}
```

### Custom Printer Priority:
Edit `ThermalPrinterService.php` method `detectAndConnect()`:
```php
// Change order: Try network first, then USB, then serial
if ($this->connectToNetworkPrinter()) {
    return true;
}
if ($this->connectToWindowsPrinter()) {
    return true;
}
if ($this->connectToFilePrinter()) {
    return true;
}
```

---

## 📞 Support Checklist

Before asking for help, verify:
- ✅ Ran `setup-thermal-printer.bat`
- ✅ Ran `php artisan printer:detect`
- ✅ Checked `storage/logs/laravel.log`
- ✅ Printer appears in Windows "Devices and Printers"
- ✅ Tested with `php artisan printer:test-connection`
- ✅ Reviewed `config/thermal_printer.php`

---

## 📄 Full Documentation

For detailed documentation, see: **THERMAL_PRINTER_README.md**

---

**Ready to print? Run the setup and test your printer!** 🚀

```bash
# Quick test:
php artisan printer:detect
```

