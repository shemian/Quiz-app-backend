<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Student;
use App\Models\Guardian;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Datatables;
use Illuminate\Support\Facades\Mail;
use App\Mail\StudentAccountCreated;

class GuardianController extends Controller
{

    public function index()
    {
        return view('parents.dashboard');
    }

    /**
     * Display a listing of the resource.
     */
    public function createStudent()
    {
        return view('parents.create_student');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'account_number' => 'required',
            'date_of_birth' => 'required',
            'school_name' => 'required',
            'county' => 'required',
            'username' => 'required',
        ]);

        // Create a new user
        $user = new User();
        $user->name = $request->username;
        $password = Str::random(4);
        $user->password = Hash::make($password);
        $user->role = 'student';
        $user->save();


        // Create a new student
        $student = new Student();
        $student->account_number = $request->account_number;
        $student->credit = 500.09;
        $student->date_of_birth = $request->date_of_birth;
        $student->school_name = $request->school_name;
        $student->county = $request->county;
        $student->username = $request->username;
        $student->guardian_id = auth()->user()->id;

        // Send email to the parent with the student's username and password
        Mail::to(auth()->user()->email)->send(new StudentAccountCreated($user, $password));
        
        $guardian = Guardian::where('user_id', auth()->user()->id)->first();

        if ($guardian) {
            $student->guardian_id = $guardian->id;
            $user->student()->save($student);
            
            return redirect()->route('get_students')
                ->with('success', 'Student account created successfully. The account details have been sent to your email.');
        }

       
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
