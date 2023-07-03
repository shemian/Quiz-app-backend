<?php

namespace App\Http\Controllers;

use App\Enums\AccountStatus;
use App\Models\Student;
use App\Models\SubscriptionPlan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AccountStatusController extends Controller
{

    public function changeAccountStatus()
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
}
