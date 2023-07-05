<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use App\Http\Controllers\SmsController;
use App\Models\Student;
use App\Models\Sms;

class SendStudentAccountSms implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $student;
    public $password;

    /**
     * Create a new job instance.
     */
    public function __construct(Student $student, string $password)
    {
        $this->student = $student;
        $this->password = $password;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        Log::info('Executing SendStudentAccountSms job for ' . $this->student->user->name);

        $sms = new Sms();
        $sms->external_ref = Str::uuid();
        $sms->recipient = $this->student->guardian->user->phone_number;
        $sms->text = "You have successfully created an account for " . $this->student->user->name . " Please use below credentials to log in to student account\nUsername: " . $this->student->user->centy_plus_id . "\n" . "Password: " . $this->password;
        $sms->save();

        Log::info("Message " . $sms->text . " saved successfully!");

        (new SmsController)->sendSms($sms);

        Log::info("Message " . $sms->text . " queued successfully!");
    }
}
