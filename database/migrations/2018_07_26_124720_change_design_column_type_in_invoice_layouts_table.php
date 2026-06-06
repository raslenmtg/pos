<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        DB::statement("ALTER TABLE invoice_layouts ALTER COLUMN design TYPE VARCHAR(190)");
        DB::statement("ALTER TABLE invoice_layouts ALTER COLUMN design SET DEFAULT 'classic'");
    }

    public function down()
    {
    }
};
