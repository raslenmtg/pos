<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('activity_log', function (Blueprint $table) {
            $table->integer('business_id')->after('subject_type')->nullable();
        });

        // PostgreSQL-compatible: use DISTINCT ON instead of GROUP BY
        $activities = DB::select('SELECT DISTINCT ON (causer_id) * FROM activity_log WHERE causer_id IS NOT NULL');

        foreach ($activities as $activity) {
            $causerId = $activity->causer_id;
            $causerType = $activity->causer_type;
            if ($causerId && $causerType === 'App\\User') {
                $user = DB::table('users')->where('id', $causerId)->first();
                if ($user) {
                    DB::table('activity_log')
                        ->where('causer_id', $causerId)
                        ->update(['business_id' => $user->business_id ?? null]);
                }
            }
        }
    }

    public function down()
    {
    }
};
