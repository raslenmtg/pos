<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('mfg_work_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('business_id')->unsigned();
            $table->foreign('business_id')->references('id')->on('business')->onDelete('cascade');
            $table->integer('location_id')->unsigned();
            $table->foreign('location_id')->references('id')->on('business_locations')->onDelete('cascade');
            $table->integer('recipe_id')->unsigned();
            $table->foreign('recipe_id')->references('id')->on('mfg_recipes')->onDelete('cascade');
            $table->string('ref_no')->nullable();
            $table->enum('status', ['draft', 'completed', 'cancelled'])->default('draft');
            $table->dateTime('started_at')->nullable();
            $table->dateTime('completed_at')->nullable();
            $table->decimal('planned_output_qty', 22, 4);
            $table->decimal('produced_output_qty', 22, 4)->default(0);
            $table->decimal('overhead_cost', 22, 4)->default(0);
            $table->decimal('wastage_cost', 22, 4)->default(0);
            $table->decimal('total_ingredient_cost', 22, 4)->default(0);
            $table->decimal('total_cost', 22, 4)->default(0);
            $table->integer('consumption_transaction_id')->unsigned()->nullable();
            $table->foreign('consumption_transaction_id')->references('id')->on('transactions')->onDelete('set null');
            $table->integer('production_transaction_id')->unsigned()->nullable();
            $table->foreign('production_transaction_id')->references('id')->on('transactions')->onDelete('set null');
            $table->text('notes')->nullable();
            $table->integer('created_by')->unsigned()->nullable();
            $table->integer('completed_by')->unsigned()->nullable();
            $table->timestamps();

            $table->index(['business_id', 'status']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('mfg_work_orders');
    }
};

