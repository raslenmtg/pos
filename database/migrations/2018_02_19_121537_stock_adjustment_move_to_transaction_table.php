<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // ENUM change for type - no-op for PostgreSQL (type is varchar)

        DB::statement('DROP TABLE IF EXISTS stock_adjustment_lines CASCADE');

        Schema::create('stock_adjustment_lines', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('transaction_id')->unsigned();
            $table->foreign('transaction_id')->references('id')->on('transactions')->onDelete('cascade');
            $table->integer('product_id')->unsigned();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->integer('variation_id')->unsigned();
            $table->foreign('variation_id')->references('id')->on('variations')
            ->onDelete('cascade');
            $table->decimal('quantity', 22, 4);
            $table->decimal('unit_price', 22, 4)->comment('Last purchase unit price')->nullable();
            $table->timestamps();

            $table->index('transaction_id');
        });

        Schema::table('transactions', function (Blueprint $table) {
            $table->string('adjustment_type')->nullable()->after('payment_status');
            $table->decimal('total_amount_recovered', 22, 4)->comment('Used for stock adjustment.')->nullable()->after('exchange_rate');
        });

        // Create temp table using PostgreSQL syntax
        DB::statement('CREATE TABLE IF NOT EXISTS stock_adjustments (id INTEGER DEFAULT NULL)');
        Schema::rename('stock_adjustments', 'stock_adjustments_temp');
    }

    public function down()
    {
    }
};
