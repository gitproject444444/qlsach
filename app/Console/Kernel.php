<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        'App\Console\Commands\EveryDay',
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('everyday:mail')->everyMinute();


        //     $schedule->call(function () {

        //     })->everyMinute();




        // $users = User::where('status', 1)->get();
        // foreach ($users as $user) {
        //     foreach ($user->books as $book) {
        //         if ($book->pivot->status == 1) {
        //             // $daybefore = $book->pivot->created_at;
        //             // $dayafter = $book->pivot->pay;
        //             $email = $user->email;
        //             // Mail::to($email)->send(new BookLate());
        //             $schedule->call(function () use ($email) {
        //                 Mail::to($email)->send(new BookLate());
        //             })->everyMinute();
        //         }
        //     }
        // }
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
