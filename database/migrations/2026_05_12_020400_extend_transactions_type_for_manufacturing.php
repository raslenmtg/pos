<?php

use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up()
    {
        // type is already varchar in PostgreSQL - no need to alter ENUM
        // production_sell and production_purchase types will work as varchar values
    }

    public function down()
    {
    }
};
