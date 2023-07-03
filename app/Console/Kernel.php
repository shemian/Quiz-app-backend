<?php

namespace App\Console;

use App\Enums\AccountStatus;
use App\Models\Student;
use App\Models\SubscriptionPlan;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;


class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {

        $students = Student::where('account_status', AccountStatus::ACTIVE)->first();
        $subscription_plans = SubscriptionPlan::all();

        foreach ($students as $student) {
            foreach ($subscription_plans as $subscription_plan) {
                if ($student->active_subscription == $subscription_plan->name) {
                    if(Carbon::parse( $student->start_date)->addDays($subscription_plan->validity) <= Carbon::now()){
                        $student->account_status = AccountStatus::SUSPENDED;
                        $student->active_subscription = null;
                        $student->save();
                    }
                    $student->credit = $student->credit - $subscription_plan->price;
                    $student->save();
                }
            }
        }
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
