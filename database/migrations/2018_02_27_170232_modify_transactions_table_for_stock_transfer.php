<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // ENUM change for type - no-op for PostgreSQL (type is varchar)
        Schema::table('transactions', function (Blueprint $table) {
            $table->integer('transfer_parent_id')->nullable()->after('total_amount_recovered');
            $table->integer('opening_stock_product_id')->nullable()->after('transfer_parent_id');
        });
    }

    public function down()
    {
        Schema::table('transactions', function (Blueprint $table) {
        });
    }
};
