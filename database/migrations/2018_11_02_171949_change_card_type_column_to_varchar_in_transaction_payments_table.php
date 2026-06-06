<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        // card_type is already varchar in PostgreSQL - no-op
        DB::statement('ALTER TABLE transaction_payments ALTER COLUMN card_type DROP NOT NULL');
    }

    public function down()
    {
    }
};
