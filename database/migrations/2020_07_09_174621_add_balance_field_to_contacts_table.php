<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('contacts', function (Blueprint $table) {
            $table->decimal('balance', 22, 4)->default(0)->after('created_by');
        });

        Schema::table('transaction_payments', function (Blueprint $table) {
            $table->boolean('is_advance')->default(0)->after('created_by');
        });

        // method and pay_method already varchar - no-op for PostgreSQL
    }

    public function down()
    {
    }
};
