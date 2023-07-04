<?php

namespace App\Console\Commands;

use App\Enums\AccountStatus;
use App\Models\Student;
use App\Models\SubscriptionPlan;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class UpdateStudentsAccountStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-students-account-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            $students = Student::where('account_status', AccountStatus::ACTIVE)->get();
            $subscriptionPlans = SubscriptionPlan::all();

            foreach ($students as $student) {
                foreach ($subscriptionPlans as $subscriptionPlan) {
                    Log::info("Current subscription status is ". $student->studentSubscriptionPlan->subscriptionPlan->id === $subscriptionPlan->id);
                    if ($student->studentSubscriptionPlan->subscriptionPlan->id === $subscriptionPlan->id) {
                        Log::info("Checking if " . $student->user->name . ":" . Carbon::parse($student->studentSubscriptionPlan->start_date)->addDays($subscriptionPlan->validity)->isPast() . " has an active subscription");
                        if (Carbon::parse($student->studentSubscriptionPlan->start_date)->addDays($subscriptionPlan->validity)->isPast()) {
                            $student->account_status = AccountStatus::SUSPENDED;
                            $student->active_subscription = null;
                            $student->save();
                        }
                        $student->save();
                    }
                }
            }

            Log::info('wacha kubonga');
        } catch (\Exception $e) {
            Log::error('An error occurred in the cron job: ' . $e->getMessage());
        }
    }
}
