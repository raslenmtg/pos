<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->integer('expense_category_id')->nullable()->unsigned()->after('final_total');
            $table->foreign('expense_category_id')->references('id')->on('expense_categories')->onDelete('cascade');
            $table->integer('expense_for')->nullable()->unsigned()->after('expense_category_id');
            $table->foreign('expense_for')->references('id')->on('users')->onDelete('cascade');

            $table->index('expense_category_id');
        });
    }

    public function down()
    {
        Schema::table('transactions', function (Blueprint $table) {
        });
    }
};
