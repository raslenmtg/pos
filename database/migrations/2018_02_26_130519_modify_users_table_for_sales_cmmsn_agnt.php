<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // MODIFY COLUMN surname - no-op for PostgreSQL
        Schema::table('users', function (Blueprint $table) {
            $table->char('contact_no', 15)->nullable()->after('language');
            $table->text('address')->nullable()->after('contact_no');
            $table->boolean('is_cmmsn_agnt')->default(0)->after('business_id');
            $table->decimal('cmmsn_percent', 4, 2)->default(0)->after('is_cmmsn_agnt');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
        });
    }
};
