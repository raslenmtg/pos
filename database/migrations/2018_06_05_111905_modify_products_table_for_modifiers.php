<?php

use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up()
    {
        // ENUM type changes and nullable int - no-op for PostgreSQL (varchar type already)
    }

    public function down()
    {
    }
};
