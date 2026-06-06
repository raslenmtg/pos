<?php

use App\Transaction;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up()
    {
        // status column is already varchar - no-op for PostgreSQL
        Transaction::where('type', 'sell_transfer')
                ->update(['status' => 'final']);

        Transaction::where('type', 'purchase_transfer')
                ->update(['status' => 'received']);
    }

    public function down()
    {
    }
};
