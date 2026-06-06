<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // ENUM change - no-op for PostgreSQL (type is varchar)
        Schema::table('transactions', function (Blueprint $table) {
            $table->integer('return_parent_id')->nullable()->after('transfer_parent_id');
        });
    }

    public function down()
    {
    }
};
