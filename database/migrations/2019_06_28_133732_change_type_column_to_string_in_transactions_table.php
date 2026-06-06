<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        // type column is already varchar; add index
        DB::statement('CREATE INDEX IF NOT EXISTS transactions_type_index ON transactions (type)');
        // location_id already nullable in PostgreSQL - no-op
    }

    public function down()
    {
    }
};
