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
        Schema::table('transaction_payments', function (Blueprint $table) {
            $table->dropColumn([
                'card_type',
                'card_number',
                'card_holder_name',
                'card_year',
                'paid_through_link',
                'card_month',
                'card_security',
            ]);

            $table->date('due_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transaction_payments', function (Blueprint $table) {
            $table->dropColumn('paid_due');

            $table->enum('card_type', ['visa', 'master'])->nullable();
            $table->string('card_number')->nullable();
            $table->string('card_holder_name')->nullable();
            $table->string('card_year')->nullable();
            $table->string('card_month')->nullable();
            $table->string('card_security', 5)->nullable();
        });
    }
};

