<?php

namespace App\Http\Controllers;
use App\Models\Guardian;
use App\Models\MpesaTransaction;
use App\Models\Student;
use App\Models\ChartOfAccounts;
use App\Models\SubscriptionPlan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Response;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MpesaTransactionController extends Controller
{
    public function generateAccessToken()
    {
        $consumer_key="kherIDoJ1N8eHMdqnAhpfZ8HIU0NcmfO";
        $consumer_secret="bOtjBSgX943NrScy";

        $credentials = base64_encode($consumer_key.":".$consumer_secret);
        $url = "https://api.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials";
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Authorization: Basic ".$credentials));
        curl_setopt($curl, CURLOPT_HEADER,false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $curl_response = curl_exec($curl);
        $access_token=json_decode($curl_response);
        return $access_token->access_token;
    }

    public function lipaNaMpesaPassword()
    {
        $lipa_time = Carbon::rawParse('now')->format('YmdHms');
        $passkey = "bd2a11f17f6de08072faf4003988267f28cd84d9b45efa413d35b1a68352a1da";
        $BusinessShortCode = 4113243;
        $timestamp =$lipa_time;
        $lipa_na_mpesa_password = base64_encode($BusinessShortCode.$passkey.$timestamp);
        return $lipa_na_mpesa_password;
    }

    /**
     * Lipa na M-PESA STK Push method
     * */

    public function customerMpesaSTKPush($phone_number, $amount, $centyPlusId, $planName)
    {
        $url = 'https://api.safaricom.co.ke/mpesa/stkpush/v1/processrequest';
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer '.$this->generateAccessToken()));

        $formattedAmount = number_format($amount, 0, '', '');
        $formattedPhoneNumber = '254' . substr($phone_number, 1);
        Log::info($formattedPhoneNumber);

        $curl_post_data = [
            //Fill in the request parameters with valid values
            'BusinessShortCode' => 4113243,
            'Password' => $this->lipaNaMpesaPassword(),
            'Timestamp' => Carbon::rawParse('now')->format('YmdHms'),
            'TransactionType' => 'CustomerPayBillOnline',
            'Amount' => $formattedAmount,
            'PartyA' => $formattedPhoneNumber, // replace this with your phone number
            'PartyB' => 4113243,
            'PhoneNumber' => $formattedPhoneNumber, // replace this with your phone number
            'CallBackURL' => 'https://quiz.centyplus.africa/api/v1/quiz/transaction/confirmation/',
            'AccountReference' => $centyPlusId.' '.$planName,
            'TransactionDesc' => "Centy Plus $planName Payment"
        ];
        $data_string = json_encode($curl_post_data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
        $curl_response = curl_exec($curl);
        Log::info("Callback Confirmation: ". $curl_response);

        return $curl_response;
    }


    /**
     * J-son Response to M-pesa API feedback - Success or Failure
     */
    public function createValidationResponse($result_code, $result_description){
        $result=json_encode(["ResultCode"=>$result_code, "ResultDesc"=>$result_description]);
        $response = new Response();
        $response->headers->set("Content-Type","application/json; charset=utf-8");
        $response->setContent($result);
        return $response;
    }
    /**
     *  M-pesa Validation Method
     * Safaricom will only call your validation if you have requested by writing an official letter to them
     */
    public function mpesaValidation(Request $request)
    {
        $result_code = "0";
        $result_description = "Accepted validation request.";
        return $this->createValidationResponse($result_code, $result_description);
    }
    /**
     * M-pesa Transaction confirmation method, we save the transaction in our databases
     */
    public function mpesaConfirmation(Request $request)
    {
        Log::info('Mpesa'.$request);

        $content=json_decode($request->getContent());
        $mpesa_transaction = new MpesaTransaction();
        $mpesa_transaction->transaction_type = $content->TransactionType;
        $mpesa_transaction->trans_id = $content->TransID;
        $mpesa_transaction->trans_time = $content->TransTime;
        $mpesa_transaction->trans_amount = $content->TransAmount;
        $mpesa_transaction->business_short_code = $content->BusinessShortCode;
        $mpesa_transaction->bill_ref_number = $content->BillRefNumber;
        $mpesa_transaction->invoice_number = $content->InvoiceNumber;
        $mpesa_transaction->org_account_balance = $content->OrgAccountBalance;
        $mpesa_transaction->third_party_trans_id = $content->ThirdPartyTransID;
        $mpesa_transaction->msisdn = $content->MSISDN;
        $mpesa_transaction->first_name = $content->FirstName;
        if (isset($content->MiddleName)) $mpesa_transaction->middle_name = $content->MiddleName;
        if (isset($content->LastName)) $mpesa_transaction->last_name = $content->LastName;
        $mpesa_transaction->save();

        $accRef = explode(' ', $content->BillRefNumber);
        $planName = $accRef[1];
        $centyPlusId = $accRef[0];

        $user = User::where('centy_plus_id', $centyPlusId)->first();
        $student = Student::where('user_id', $user->id)->first();
//        $parent = User::where('parent_id', $student->parent_id)->first();
        $plan = SubscriptionPlan::where('name', $planName)->first();

        $chart_of_account = ChartOfAccounts::where('account_name', 'Business Account')->first();
        $chart_of_account->account_balance = $chart_of_account->account_balance + $plan->price/2;
        $chart_of_account->save();

        $student->centy_balance = floatval($student->centy_balance) + $plan->price/2;
        $student->save();

        // add surplus to the parent account
        $student->guardian->credit = floatval($student->guardian->credit) + ($content->TransAmount - $plan->price);
        $student->guardian->credit->save();

        // Responding to the confirmation request
        $response = new Response();
        $response->headers->set("Content-Type","text/xml; charset=utf-8");
        $response->setContent(json_encode(["C2BPaymentConfirmationResult"=>"Success"]));

        return $response;
    }


    public function mpesaRegisterUrls()
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, 'https://api.safaricom.co.ke/mpesa/c2b/v1/registerurl');
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization: Bearer '. $this->generateAccessToken()));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode(array(
            'ShortCode' => "4113243",
            'ResponseType' => 'Completed',
            'ConfirmationURL' => "https://quiz.centyplus.africa/api/v1/hlab/transaction/confirmation",
            'ValidationURL' => "https://quiz.centyplus.africa/api/v1/hlab/validation"
        )));
        $curl_response = curl_exec($curl);
        echo $curl_response;
    }



}
