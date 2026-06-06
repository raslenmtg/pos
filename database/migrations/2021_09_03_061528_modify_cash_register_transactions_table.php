<?php

use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up()
    {
        // transaction_type already varchar - no-op for PostgreSQL
    }

    public function down()
    {
    }
};
