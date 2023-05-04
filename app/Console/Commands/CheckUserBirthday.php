<?php

namespace App\Console\Commands;

use App\Jobs\SendUserBirthdayEmail;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class CheckUserBirthday extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:birthday';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check users birthday and send email';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $today = now();
        $users = User::all();
        Log::info([
            'now' => $today,
            'day_of_now' => $today->day,
            'month_of_now' => $today->month,
        ]);

        foreach ($users as $user) {
            Log::info([
                'user_day' => $user->birthday->day,
                'user_month' => $user->birthday->month,
            ]);
            if ($user->birthday->day == $today->day && $user->birthday->month == $today->month) {
                dispatch(new SendUserBirthdayEmail($user));
            }
        }
    }
}
