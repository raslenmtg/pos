<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        DB::statement("UPDATE transactions SET total_before_tax=final_total WHERE type='expense'");
    }

    public function down()
    {
    }
};
