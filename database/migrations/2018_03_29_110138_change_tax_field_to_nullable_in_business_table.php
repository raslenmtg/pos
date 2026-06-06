<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        // PostgreSQL ALTER TABLE syntax for making columns nullable
        DB::statement('ALTER TABLE business ALTER COLUMN tax_number_1 DROP NOT NULL');
        DB::statement('ALTER TABLE business ALTER COLUMN tax_label_1 DROP NOT NULL');
    }

    public function down()
    {
    }
};
