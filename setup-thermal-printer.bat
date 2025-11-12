@echo off
REM Thermal Printer Setup Script for Windows
echo ========================================
echo Thermal Printer Auto-Detection Setup
echo ========================================
echo.

cd /d "%~dp0"

echo Step 1: Clearing Laravel cache...
php artisan config:clear
php artisan cache:clear
echo.

echo Step 2: Regenerating configuration cache...
php artisan config:cache
echo.

echo Step 3: Refreshing autoloader...
composer dump-autoload
echo.

echo Step 4: Testing printer detection...
php artisan printer:detect
echo.

echo ========================================
echo Setup Complete!
echo ========================================
echo.
echo Available Commands:
echo   php artisan printer:detect                              - Detect available printers
echo   php artisan printer:test-connection --type=usb --name="POS-80"   - Test USB printer
echo   php artisan printer:test-connection --type=network --ip=192.168.1.100 - Test network printer
echo.
echo For more information, see: THERMAL_PRINTER_README.md
echo.
pause

