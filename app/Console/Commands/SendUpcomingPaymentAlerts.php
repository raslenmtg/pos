<?php

namespace App\Console\Commands;

use App\Transaction;
use App\Notifications\UpcomingPaymentAlert;
use App\TransactionPayment;
use App\User;
use Illuminate\Console\Command;
use Carbon\Carbon;

class SendUpcomingPaymentAlerts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pos:sendUpcomingPaymentAlerts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send dashboard notifications for upcoming payment dues of invoices';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        try {
            $days = 3; // Number of days to look ahead for upcoming payments
            $start_date = Carbon::now()->startOfDay();
            $end_date = Carbon::now()->addDays($days)->endOfDay();

            $transaction_payments=TransactionPayment::whereBetween('paid_on', [$start_date, $end_date])
                ->leftJoin('transactions', 'transaction_payments.transaction_id', '=', 'transactions.id')
                ->where('transactions.type', 'sell')
                ->where('transactions.status', 'final')
                ->get();


            foreach ($transaction_payments as $transaction) {
                $usersBusiness=User::where('business_id', $transaction->business_id)->get();
                    foreach ($usersBusiness as $user) {
                        $exists = $user->notifications()
                            ->where('type', UpcomingPaymentAlert::class)
                            ->where('data->transaction_id', $transaction->id)
                            ->exists();

                        if (!$exists) {
                            $data = [
                                'transaction_id' => $transaction->id,
                                'invoice_no' => $transaction->transaction->invoice_no,
                                'paid_on' => Carbon::parse($transaction->paid_on)->format('d/m'),
                                'method' => $transaction->method,
                                'card_number' => $transaction->card_number,
                                'amount' => $transaction->amount,
                                'cheque_number' => $transaction->cheque_number,
                                'bank_account_number' => $transaction->bank_account_number,
                            ];
                            $user->notify(new UpcomingPaymentAlert($data));
                        }
                    }
            }
        } catch (\Exception $e) {
            \Log::emergency('File:'.$e->getFile().'Line:'.$e->getLine().'Message:'.$e->getMessage());
        }
    }
}

