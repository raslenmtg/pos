<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        DB::statement("ALTER TABLE transactions MODIFY COLUMN type ENUM(
            'purchase',
            'sell',
            'expense',
            'stock_adjustment',
            'sell_transfer',
            'purchase_transfer',
            'opening_stock',
            'sell_return',
            'opening_balance',
            'purchase_return',
            'payroll',
            'expense_refund',
            'sales_order',
            'purchase_order',
            'production_sell',
            'production_purchase'
        ) DEFAULT NULL");
    }

    public function down()
    {
        DB::statement("ALTER TABLE transactions MODIFY COLUMN type ENUM(
            'purchase',
            'sell',
            'expense',
            'stock_adjustment',
            'sell_transfer',
            'purchase_transfer',
            'opening_stock',
            'sell_return',
            'opening_balance',
            'purchase_return',
            'payroll',
            'expense_refund',
            'sales_order',
            'purchase_order'
        ) DEFAULT NULL");
    }
};

