<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
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
        if (! Schema::hasColumn('transactions', 'adjustment_type')) {
            return;
        }

        $column = DB::selectOne("SHOW COLUMNS FROM transactions WHERE Field = 'adjustment_type'");
        if (! empty($column) && ! empty($column->Type) && str_contains(strtolower($column->Type), 'enum(')) {
            DB::statement('ALTER TABLE transactions MODIFY adjustment_type VARCHAR(191) NULL');
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};

