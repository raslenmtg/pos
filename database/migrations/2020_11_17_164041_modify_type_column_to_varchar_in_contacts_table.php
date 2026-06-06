<?php

use App\Contact;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up()
    {
        // type column is already varchar - no-op for PostgreSQL
        Contact::where('type', '=', '')
                 ->orWhereNull('type')
                ->update(['type' => 'lead']);
    }

    public function down()
    {
    }
};
