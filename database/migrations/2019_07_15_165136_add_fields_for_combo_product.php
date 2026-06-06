<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('variations', function (Blueprint $table) {
            $table->text('combo_variations')->nullable()->comment('Contains the combo variation details');
        });

        // ENUM change for type - no-op for PostgreSQL (type is varchar)

        Schema::table('transaction_sell_lines', function (Blueprint $table) {
            $table->string('children_type')
                ->default('')
                ->after('parent_sell_line_id')
                ->comment('Type of children for the parent, like modifier or combo');

            $table->index(['children_type']);
            $table->index(['parent_sell_line_id']);
        });

        DB::statement("UPDATE transaction_sell_lines SET children_type='modifier' WHERE parent_sell_line_id IS NOT NULL");
    }

    public function down()
    {
        Schema::table('variations', function (Blueprint $table) {
            $table->dropColumn(['combo_variations']);
        });
    }
};
