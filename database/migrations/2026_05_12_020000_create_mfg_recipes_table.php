<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('mfg_recipes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('business_id')->unsigned();
            $table->foreign('business_id')->references('id')->on('business')->onDelete('cascade');
            $table->string('name');
            $table->integer('finished_product_id')->unsigned();
            $table->foreign('finished_product_id')->references('id')->on('products')->onDelete('cascade');
            $table->integer('finished_variation_id')->unsigned();
            $table->foreign('finished_variation_id')->references('id')->on('variations')->onDelete('cascade');
            $table->decimal('yield_quantity', 22, 4)->default(1);
            $table->boolean('is_active')->default(true);
            $table->text('instructions')->nullable();
            $table->integer('created_by')->unsigned()->nullable();
            $table->timestamps();

            $table->index(['business_id', 'is_active']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('mfg_recipes');
    }
};

