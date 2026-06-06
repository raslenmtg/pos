<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        DB::statement("ALTER TABLE products ALTER COLUMN alert_quantity TYPE DECIMAL(22, 4)");
        DB::statement("ALTER TABLE products ALTER COLUMN alert_quantity DROP NOT NULL");
        DB::statement("ALTER TABLE products ALTER COLUMN alert_quantity DROP DEFAULT");
    }

    public function down()
    {
    }
};
