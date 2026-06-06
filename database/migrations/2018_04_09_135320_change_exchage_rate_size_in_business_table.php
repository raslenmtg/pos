<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        DB::statement('ALTER TABLE business ALTER COLUMN p_exchange_rate TYPE DECIMAL(20,3)');
        DB::statement('ALTER TABLE business ALTER COLUMN p_exchange_rate SET NOT NULL');
        DB::statement('ALTER TABLE business ALTER COLUMN p_exchange_rate SET DEFAULT 1');
        DB::statement('ALTER TABLE transactions ALTER COLUMN exchange_rate TYPE DECIMAL(20,3)');
        DB::statement('ALTER TABLE transactions ALTER COLUMN exchange_rate SET NOT NULL');
        DB::statement('ALTER TABLE transactions ALTER COLUMN exchange_rate SET DEFAULT 1');

        DB::table('transactions')
            ->where('exchange_rate', 0)
            ->update(['exchange_rate' => 1]);
    }

    public function down()
    {
    }
};
