<?php

namespace App\Console\Commands;

use App\Enums\AccountStatus;
use App\Models\Student;
use App\Models\SubscriptionPlan;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ChangeAccountStatusCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'account:status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Change account status for students';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        try {
            DB::beginTransaction();

            $students = Student::where('account_status', AccountStatus::ACTIVE)->get();
            $subscriptionPlans = SubscriptionPlan::all();

            foreach ($students as $student) {
                foreach ($subscriptionPlans as $subscriptionPlan) {
                    if ($student->active_subscription === $subscriptionPlan->name) {
                        if (Carbon::parse($student->start_date)->addDays($subscriptionPlan->validity)->isPast()) {
                            $student->account_status = AccountStatus::SUSPENDED;
                            $student->active_subscription = null;
                            $student->save();
                            break; // Exit the inner loop once the account is suspended
                        }
                        $student->credit -= $subscriptionPlan->price;
                        $student->save();
                        break; // Exit the inner loop once the credit is updated
                    }
                }
            }

            DB::commit();

            $this->info('Cron job executed successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('An error occurred in the cron job: ' . $e->getMessage());
        }
    }
}