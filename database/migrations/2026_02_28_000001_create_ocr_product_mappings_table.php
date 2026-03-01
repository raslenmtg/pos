<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOcrProductMappingsTable extends Migration
{
    public function up()
    {
        Schema::create('ocr_product_mappings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('business_id');
            $table->unsignedInteger('supplier_id')->nullable();
            $table->text('ocr_text');
            $table->unsignedInteger('product_id');
            $table->unsignedInteger('variation_id')->nullable();
            $table->unsignedInteger('confirmed_count')->default(1);
            $table->timestamp('last_used_at')->nullable();
            $table->timestamps();

            $table->foreign('business_id')->references('id')->on('business')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');

            $table->index(['business_id', 'supplier_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('ocr_product_mappings');
    }
}
