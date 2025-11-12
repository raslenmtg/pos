<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Thermal Printer Configuration
    |--------------------------------------------------------------------------
    |
    | Configure thermal printer detection and printing settings
    |
    */

    // Common thermal printer names to search for
    'printer_names' => [
        'POS-80',
        'POS-58',
        'XP-80C',
        'XP-58',
        'TM-T20',
        'TM-T20II',
        'TM-T20III',
        'TM-T88',
        'TM-T88V',
        'TM-T88VI',
        'RP80',
        'RP58',
        'Thermal Printer',
        'Receipt Printer',
        'USB Printer',
        'Bluetooth Printer',
        'POS Printer',
        '80mm Thermal Printer',
        '58mm Thermal Printer',
    ],

    // Network printer configuration
    'network' => [
        // Common IP addresses to try
        'ips' => [
            '192.168.1.100',
            '192.168.0.100',
            '192.168.1.200',
            '192.168.0.200',
            '10.0.0.100',
        ],
        // Standard ESC/POS port
        'port' => 9100,
        // Connection timeout in seconds
        'timeout' => 3,
    ],

    // Serial/Bluetooth COM ports to try
    'serial_ports' => [
        'COM1',
        'COM2',
        'COM3',
        'COM4',
        'COM5',
        'COM6',
        'COM7',
        'COM8',
        '/dev/usb/lp0',
        '/dev/usb/lp1',
        '/dev/usb/lp2',
    ],

    // Printer paper width (in characters)
    'paper_width' => [
        '80mm' => 48, // 80mm paper = 48 characters
        '58mm' => 32, // 58mm paper = 32 characters
    ],

    // Default paper width to use
    'default_paper_width' => '58mm',

    // Auto-detect printer on every print
    'auto_detect' => true,

    // Log printer activities
    'logging' => true,

    // Fallback to HTML if printer not found
    'fallback_to_html' => true,
];

