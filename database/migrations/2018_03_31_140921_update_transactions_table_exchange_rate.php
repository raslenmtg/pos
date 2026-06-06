<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        DB::statement('ALTER TABLE transactions ALTER COLUMN exchange_rate TYPE DECIMAL(20,3)');
        DB::statement('ALTER TABLE transactions ALTER COLUMN exchange_rate SET NOT NULL');
        DB::statement('ALTER TABLE transactions ALTER COLUMN exchange_rate SET DEFAULT 0');
    }

    public function down()
    {
    }
};
