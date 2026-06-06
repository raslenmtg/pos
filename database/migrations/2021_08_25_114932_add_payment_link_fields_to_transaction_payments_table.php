<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // created_by already nullable - no-op for PostgreSQL
        Schema::table('transaction_payments', function (Blueprint $table) {
            $table->boolean('paid_through_link')->default(0)->after('created_by');
            $table->string('gateway')->nullable()->after('paid_through_link');
        });
    }

    public function down()
    {
        Schema::table('transaction_payments', function (Blueprint $table) {
        });
    }
};
