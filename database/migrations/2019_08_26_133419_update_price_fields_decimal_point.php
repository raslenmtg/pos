<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        // Get all columns with type decimal(20, 2) in PostgreSQL
        $columns = DB::select("SELECT DISTINCT table_name, column_name, column_default
            FROM information_schema.columns
            WHERE data_type = 'numeric'
            AND table_schema = 'public'
            AND numeric_scale = 2
            AND numeric_precision = 20");

        foreach ($columns as $col) {
            if (!empty($col->table_name)) {
                $table_name = $col->table_name;
                $col_name = $col->column_name;
                $default = is_null($col->column_default) ? 'NULL' : $col->column_default;
                // Strip PostgreSQL cast from default (e.g. "0::numeric" -> "0")
                $default = preg_replace('/::[\w\s]+$/', '', $default);

                DB::statement("ALTER TABLE \"$table_name\" ALTER COLUMN \"$col_name\" TYPE DECIMAL(22, 4)");
                if ($default === 'NULL') {
                    DB::statement("ALTER TABLE \"$table_name\" ALTER COLUMN \"$col_name\" DROP NOT NULL");
                } else {
                    DB::statement("ALTER TABLE \"$table_name\" ALTER COLUMN \"$col_name\" SET DEFAULT $default");
                }
            }
        }
    }

    public function down()
    {
    }
};
