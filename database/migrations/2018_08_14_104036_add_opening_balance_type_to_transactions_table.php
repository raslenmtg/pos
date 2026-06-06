<?php

use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up()
    {
        // ENUM change - no-op for PostgreSQL (type is varchar)
    }

    public function down()
    {
    }
};
