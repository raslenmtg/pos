<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // ENUM change - no-op for PostgreSQL (method is varchar)
        Schema::table('transaction_payments', function (Blueprint $table) {
            $table->string('transaction_no')->nullable()->after('method');
        });
    }

    public function down()
    {
        Schema::table('transaction_payments', function (Blueprint $table) {
        });
    }
};
