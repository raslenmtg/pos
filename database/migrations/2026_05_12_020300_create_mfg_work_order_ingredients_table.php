<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('mfg_work_order_ingredients', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('work_order_id')->unsigned();
            $table->foreign('work_order_id')->references('id')->on('mfg_work_orders')->onDelete('cascade');
            $table->integer('product_id')->unsigned();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->integer('variation_id')->unsigned();
            $table->foreign('variation_id')->references('id')->on('variations')->onDelete('cascade');
            $table->decimal('quantity_per_batch', 22, 4);
            $table->decimal('required_quantity', 22, 4);
            $table->decimal('wastage_percent', 8, 4)->default(0);
            $table->decimal('consumed_quantity', 22, 4)->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('mfg_work_order_ingredients');
    }
};

