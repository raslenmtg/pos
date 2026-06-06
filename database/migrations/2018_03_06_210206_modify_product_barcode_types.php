<?php

use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up()
    {
        // ENUM change for barcode_type - no-op for PostgreSQL (barcode_type is varchar)
    }

    public function down()
    {
    }
};
