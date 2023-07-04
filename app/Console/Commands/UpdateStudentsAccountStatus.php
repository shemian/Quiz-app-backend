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
                    if ($student->studentSubscriptionPlan->subscriptionPlan->id === $subscriptionPlan->id) {
                        $end_date = Carbon::parse($student->studentSubscriptionPlan->start_date)->addDays($subscriptionPlan->validity);
                        Log::info("Plan status is: ". ($end_date->isBefore(Carbon::now())). " from ". $end_date);
                        if ($end_date->isBefore(Carbon::now())) {
                            Log::info("Account should be suspended");
                            $student->account_status = AccountStatus::SUSPENDED;
                            $student->active_subscription = null;
                            $student->save();
                            Log::info("Account has been suspended");
                        }
                    }
                }
            }

            Log::info('wacha kubonga');
        } catch (\Exception $e) {
            Log::error('An error occurred in the cron job: ' . $e->getMessage());
        }
    }
}
