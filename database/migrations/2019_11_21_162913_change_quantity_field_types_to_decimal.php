<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        DB::statement("ALTER TABLE purchase_lines ALTER COLUMN quantity TYPE DECIMAL(22, 4)");
        DB::statement("ALTER TABLE purchase_lines ALTER COLUMN quantity SET NOT NULL");
        DB::statement("ALTER TABLE purchase_lines ALTER COLUMN quantity SET DEFAULT 0");

        DB::statement("ALTER TABLE transaction_sell_lines ALTER COLUMN quantity TYPE DECIMAL(22, 4)");
        DB::statement("ALTER TABLE transaction_sell_lines ALTER COLUMN quantity SET NOT NULL");
        DB::statement("ALTER TABLE transaction_sell_lines ALTER COLUMN quantity SET DEFAULT 0");

        DB::statement("ALTER TABLE transactions ALTER COLUMN discount_amount TYPE DECIMAL(22, 4)");
        DB::statement("ALTER TABLE transactions ALTER COLUMN discount_amount SET DEFAULT 0");
    }

    public function down()
    {
    }
};
