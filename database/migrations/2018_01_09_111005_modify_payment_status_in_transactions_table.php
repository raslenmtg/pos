<?php

use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up()
    {
        // MySQL ENUM change - no-op for PostgreSQL (column type already varchar)
    }

    public function down()
    {
    }
};
