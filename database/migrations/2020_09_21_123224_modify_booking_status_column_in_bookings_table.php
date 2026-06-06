<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // booking_status already varchar - no-op for PostgreSQL
        Schema::table('bookings', function (Blueprint $table) {
            $table->index('booking_status');
        });
    }

    public function down()
    {
    }
};
