<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    /**
     * Static TND currency configuration
     * ID 142 - Tunisian Dinar
     */
    public static $staticTndCurrency = [
        'id' => 142,
        'country' => 'Tunisia',
        'currency' => 'Tunisian Dinar',
        'code' => 'DT',
        'symbol' => 'د.ت',
        'thousand_separator' => ',',
        'decimal_separator' => '.',
        'exchange_rate' => 1,
        'created_at' => null,
        'updated_at' => null,
    ];

    /**
     * Override find method to always return TND currency
     */
    public static function find($id, $columns = ['*'])
    {
        return (object) self::$staticTndCurrency;
    }

    /**
     * Override where method to always return TND currency
     */
    public static function where($column, $operator = null, $value = null, $boolean = 'and')
    {
        return new class {
            public function first() {
                return (object) Currency::$staticTndCurrency;
            }
        };
    }

    /**
     * Static method to get TND currency
     */
    public static function getTndCurrency()
    {
        return (object) self::$staticTndCurrency;
    }
}
