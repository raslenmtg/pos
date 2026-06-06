<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('allow_login')->default(1)->after('business_id');
        });

        // Make username and password nullable in PostgreSQL
        DB::statement('ALTER TABLE users ALTER COLUMN username DROP NOT NULL');
        DB::statement('ALTER TABLE users ALTER COLUMN password DROP NOT NULL');
    }

    public function down()
    {
    }
};
