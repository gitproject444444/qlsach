<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\BookLate;
use App\User;

class EveryDay extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'everyday:mail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Gui mail moi ngay';

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

        $users = User::where('status', 1)->get();
        foreach ($users as $user) {
            foreach ($user->books as $book) {
                if ($book->pivot->status == 1) {
                    $email = $user->email;
                    Mail::to($email)->send(new BookLate());
                }
            }
        }
    }
}
