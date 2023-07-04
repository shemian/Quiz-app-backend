<?php

namespace App\Console\Commands;

use App\Enums\AccountStatus;
use App\Models\Student;
use App\Models\SubscriptionPlan;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class UpdateStudentAccountsCommand extends Command
{
    protected $signature = 'students:update-accounts';

    protected $description = 'Update student accounts based on subscription expiration';

    public function handle()
    {
        Log::info("My Schedule Task");
        return 0;
    }
}
