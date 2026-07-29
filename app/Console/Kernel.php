<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $env = config('app.env');

        if ($env === 'production') {
            //Scheduling backup, specify the time when the backup will get cleaned & time when it will run.
            
           // $schedule->command('backup:clean')->weekly()->at('03:00');
           // $schedule->command('backup:run')->weekly()->at('03:10');
            $schedule->command('pos:generateRecurringExpense')->daily()->at('00:01');


            //Schedule to create recurring invoices
            /*  $schedule->command('pos:generateSubscriptionInvoices')->dailyAt('23:30');
            $schedule->command('pos:updateRewardPoints')->dailyAt('23:45');

            $schedule->command('pos:autoSendPaymentReminder')->dailyAt('8:00');*/
            $schedule->command('pos:updateRewardPoints')->dailyAt('03:00');
            $schedule->command('pos:sendUpcomingPaymentAlerts')->dailyAt('01:00');
            $schedule->command('check:low-stock')->cron('0 2 */2 * *');

        }
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');
        require base_path('routes/console.php');
    }
}
