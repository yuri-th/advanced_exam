<?php

namespace App\Console;

use Carbon\Carbon;
use App\Models\Reservation;
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
    
    // $today = Carbon::today();
    // $reservations = Reservation::where('date', $today)->get();
    
    // foreach ($reservations as $reservation) {
    //     // 各予約に対してリマインダーを送信するスケジュールを設定
    //     $schedule->command('reminder:send ' . $reservation->user_id)->dailyAt('17:00');
    }
     // $schedule->command('inspire')->hourly();
    

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
