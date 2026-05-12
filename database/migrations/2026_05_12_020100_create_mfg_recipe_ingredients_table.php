<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('mfg_recipe_ingredients', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('recipe_id')->unsigned();
            $table->foreign('recipe_id')->references('id')->on('mfg_recipes')->onDelete('cascade');
            $table->integer('product_id')->unsigned();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->integer('variation_id')->unsigned();
            $table->foreign('variation_id')->references('id')->on('variations')->onDelete('cascade');
            $table->decimal('quantity_per_batch', 22, 4);
            $table->decimal('wastage_percent', 8, 4)->default(0);
            $table->integer('sort_order')->default(0);
            $table->timestamps();

            $table->unique(['recipe_id', 'variation_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('mfg_recipe_ingredients');
    }
};

