<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        // PostgreSQL uses RENAME COLUMN instead of CHANGE COLUMN
        DB::statement('ALTER TABLE stock_adjustment_lines RENAME COLUMN purchase_line_id TO removed_purchase_line');
    }

    public function down()
    {
    }
};
