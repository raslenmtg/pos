<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class AlterTransactionsStatusAllowOnline extends Migration
{
    public function up()
    {
        DB::statement('ALTER TABLE transactions DROP CONSTRAINT IF EXISTS transactions_status_check');
        DB::statement("ALTER TABLE transactions ADD CONSTRAINT transactions_status_check CHECK (status IN ('received','pending','ordered','draft','final','online'))");
    }

    public function down()
    {
        DB::statement('ALTER TABLE transactions DROP CONSTRAINT IF EXISTS transactions_status_check');
        DB::statement("ALTER TABLE transactions ADD CONSTRAINT transactions_status_check CHECK (status IN ('received','pending','ordered','draft','final'))");
    }
}
