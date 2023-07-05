<?php

namespace App\Http\Controllers;

use App\Enums\AccountStatus;
use App\Http\Controllers\MpesaTransactionController;
use App\Models\EducationSystem;
use App\Models\SubscriptionPlan;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Student;
use App\Models\Guardian;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Datatables;
use App\Jobs\SendStudentAccountEmail;
use App\Jobs\SendStudentAccountSms;
class GuardianController extends Controller
{

    public function index()
    {
        $guardian = Guardian::where('user_id', auth()->user()->id)->first();
        $students = $guardian->students;
        return view('parents.dashboard', compact('students'));
    }

    /**
     * Display a listing of the resource.
     */
    public function createStudent()
    {
        $guardian = Guardian::where('user_id', auth()->user()->id)->first();
        $students = $guardian->students;
        $education_systems = EducationSystem::all();
        $subscription_plans = SubscriptionPlan::all();
        return view('parents.create_student', compact('education_systems', 'students', 'subscription_plans'));
    }

    public function activateStudent(Request $request)
    {
        $request->validate([
            'student_id' => 'required',
            'subscription_plan_name' => 'required',
            'subscription_plan_price' => 'required',
        ]);

        $student = Student::findOrFail($request->student_id);
        $guardian =  $student->guardian()->first();
        $user = User::findOrFail($student->user_id);

        $response = (new MpesaTransactionController)->customerMpesaSTKPush($guardian->user->phone_number, $request->subscription_plan_price, $user->centy_plus_id, $request->subscription_plan_name);
        $response = json_decode($response, true);

        if ($response["ResponseCode"] == "0") {
            $student->account_status = AccountStatus::PENDING;
            $student->save();
        }

        return response()->json([
            "success" => $response["ResponseCode"],
            "message" => $response["ResponseDescription"] . " Check your phone for a prompt to complete the payment."
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'date_of_birth' => 'required',
            'school_name' => 'required',
            'education_system_id' => 'required',
            'education_level_id' => 'required',

        ]);

        // Create a new user
        $user = new User();
        $user->name = $request->name;
        $password = strval(mt_rand(1000, 9999));
        $user->password = Hash::make($password);
        $user->role = 'student';
        $user->save();


        // Create a new student
        $student = new Student();
        $student->user_id = $user->id;
        $student->credit = 0.00;
        $student->student_phone_number = '07122345678';
        $student->date_of_birth = $request->date_of_birth;
        $student->school_name = $request->school_name;
        $student->guardian_id = auth()->user()->id;
        $student->education_system_id = $request->education_system_id;
        $student->education_level_id = $request->education_level_id;
        $student->save();

        // Send email to the parent with the student's username and password
        dispatch(new SendStudentAccountEmail($student->guardian->user, $password));

        // Send sms to the parent with the student's username and password
//        dispatch(new SendStudentAccountSms($student, $password));

//        $guardian = Guardian::where('user_id', auth()->user()->id)->first();
//        if ($guardian) {
//            $student->guardian_id = $guardian->id;
//            $user->student()->save($student);
//        }

        return redirect()->route('get_students')
            ->with('success', 'Student account created successfully. The account details have been sent to your email.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'date_of_birth' => 'required',
            'school_name' => 'required',
            'education_system_id' => 'required',
            'education_level_id' => 'required',
        ]);

        $student = Student::find($id);
        $student->name = $request->name;
        $student->date_of_birth = $request->date_of_birth;
        $student->school_name = $request->school_name;
        $student->education_system_id = $request->education_system_id;
        $student->education_level_id = $request->education_level_id;
        $student->save();

        return redirect()->route('get_students')
            ->with('success', 'Student account updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $student = Student::find($id);
        $student->delete();

        return redirect()->route('get_students')
            ->with('success', 'Student account deleted successfully.');
    }
}
