<?php


namespace App\Jobs;

use App\Enums\DeliveryStatusEnum;
use App\Helpers\GeneralHelper;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use App\Http\Controllers\SmsController;
use App\Models\Student;
use App\Models\Sms;

class SendOtpOnLogin implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $student;

    /**
     * Create a new job instance.
     */
    public function __construct(Student $student )
    {
        $this->student = $student;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        Log::info('Executing OTP job for ' . $this->student->user->name);

        // Generate OTP
        $otp = $this->generateOTP();

        // Send OTP via SMS to the parent
        $parentPhoneNumber = $this->student->guardian->user->phone_number;
        $parentSms = $this->createSms($parentPhoneNumber, $this->getParentSmsContent($this->otp));
        $this->sendSms($parentSms);

        // Send OTP via SMS to the student
        $studentPhoneNumber = $this->student->user->phone_number;
        $studentSms = $this->createSms($studentPhoneNumber, $this->getStudentSmsContent($this->otp));
        $this->sendSms($studentSms);
    }

    /**
     * Create an SMS instance.
     */
    private function createSms(string $recipient, string $text): Sms
    {
        $sms = new Sms();
        $sms->external_ref = Str::uuid();
        $sms->recipient = GeneralHelper::phoneNumberToInternational($recipient);
        $sms->text = $text;
        $sms->short_code = config('app.sms.celcom.short_code');
        $sms->save();

        return $sms;
    }

    /**
     * Send an SMS.
     */
    private function sendSms(Sms $sms)
    {
        $result = (new SmsController)->sendSms($sms);
        Log::info("Response from SMS API: " . $result);

        // Update SMS status
        $result = json_decode($result);
        if (intval($result->responses[0]->{"response-code"}) === 200) {
            $sms->delivery_status = DeliveryStatusEnum::SENT;
        } else {
            $sms->delivery_status = DeliveryStatusEnum::UNDELIVERED;
        }
        $sms->status_description = $result->responses[0]->{"response-description"};
        $sms->save();
    }

    /**
     * Get the SMS content for parent.
     */
    private function getParentSmsContent(string $otp): string
    {
        return "Your OTP for logging in to your parent account: " . $otp . ". Thank you for using Centy Plus";
    }



    /**
     * Get the SMS content for student.
     */
    private function getStudentSmsContent(string $otp): string
    {
        return "Your OTP for logging in to your student account: " . $otp . ". Thank you for using Centy Plus";
    }

    /**
     * Generate the OTP.
     */
    private function generateOTP(): string
    {
        // Generate a random 6-digit OTP
        return str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
    }

}


