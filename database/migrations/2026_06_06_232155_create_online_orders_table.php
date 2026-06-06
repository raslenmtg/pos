<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('online_orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('business_id');
            $table->string('order_number')->unique();
            $table->string('customer_name');
            $table->string('customer_phone', 30);
            $table->text('customer_address');
            $table->string('customer_city', 100)->nullable();
            $table->text('customer_notes')->nullable();
            $table->json('items');
            $table->decimal('subtotal', 15, 4)->default(0);
            $table->string('status', 50)->default('new');
            $table->string('shipping_status', 50)->nullable();
            $table->unsignedBigInteger('contact_id')->nullable();
            $table->unsignedBigInteger('transaction_id')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('online_orders');
    }
};
