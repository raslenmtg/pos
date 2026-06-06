<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (! Schema::hasColumn('transactions', 'adjustment_type')) {
            return;
        }

        // In PostgreSQL, check if it's not already varchar
        $column = DB::selectOne("SELECT data_type FROM information_schema.columns WHERE table_schema = 'public' AND table_name = 'transactions' AND column_name = 'adjustment_type'");
        if (! empty($column) && $column->data_type !== 'character varying') {
            DB::statement('ALTER TABLE transactions ALTER COLUMN adjustment_type TYPE VARCHAR(191)');
            DB::statement('ALTER TABLE transactions ALTER COLUMN adjustment_type DROP NOT NULL');
        }
    }

    public function down()
    {
    }
};
