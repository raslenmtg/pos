<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('business_id')->unsigned();
            $table->foreign('business_id')->references('id')->on('business')->onDelete('cascade');

            $table->integer('location_id')->unsigned();
            $table->foreign('location_id')->references('id')->on('business_locations')->onDelete('cascade');

            $table->string('ref_no')->nullable();
            $table->dateTime('inventory_date');
            $table->text('notes')->nullable();
            $table->string('status')->default('final');

            $table->integer('stock_adjustment_transaction_id')->unsigned()->nullable();
            $table->foreign('stock_adjustment_transaction_id')->references('id')->on('transactions')->nullOnDelete();

            $table->integer('created_by')->unsigned();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');

            $table->integer('updated_by')->unsigned()->nullable();
            $table->foreign('updated_by')->references('id')->on('users')->nullOnDelete();

            $table->timestamps();

            $table->index(['business_id', 'inventory_date']);
            $table->index(['business_id', 'location_id']);
            $table->index('stock_adjustment_transaction_id');
        });

        Schema::create('inventory_lines', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('inventory_id')->unsigned();
            $table->foreign('inventory_id')->references('id')->on('inventories')->onDelete('cascade');

            $table->integer('product_id')->unsigned();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');

            $table->integer('variation_id')->unsigned();
            $table->foreign('variation_id')->references('id')->on('variations')->onDelete('cascade');

            $table->decimal('theoretical_qty', 22, 4)->default(0);
            $table->decimal('real_qty', 22, 4)->default(0);
            $table->decimal('difference_qty', 22, 4)->default(0);
            $table->decimal('unit_price', 22, 4)->nullable();

            $table->timestamps();

            $table->index('inventory_id');
            $table->index(['product_id', 'variation_id']);
            $table->unique(['inventory_id', 'variation_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inventory_lines');
        Schema::dropIfExists('inventories');
    }
};

