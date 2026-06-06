<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        // In PostgreSQL, use BIGSERIAL or alter sequence - change to bigint
        DB::statement("ALTER TABLE transaction_sell_lines_purchase_lines ALTER COLUMN id TYPE BIGINT");
        // Reset sequence to bigint type
        DB::statement("ALTER SEQUENCE transaction_sell_lines_purchase_lines_id_seq AS BIGINT");
    }

    public function down()
    {
    }
};
