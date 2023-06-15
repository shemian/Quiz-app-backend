<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateTeacherRequest;
use App\Models\User;
use App\Models\Guardian;
use App\Models\Student;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Datatables;
use Illuminate\Support\Facades\Mail;
use App\Mail\TeacherCreated;
use Illuminate\Support\Facades\Session;



class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customerCount = Guardian::count();
        $studentCount = Student::count();
        $teacherCount = User::where('role', 'teacher')->count();
        return view ('admin.dashboard', compact('customerCount','studentCount','teacherCount'));
    }

    //Display teacher's Details
    public function get_teachers(){
        $teachers = User::where('role', 'teacher')->get();
        return view('admin.teacher', compact('teachers'));
    }

    public function get_customers(){
        $customers = Guardian::with('user')->get();
        return view('admin.customers', compact('customers'));
    }

    public function get_students(){
        $students = Student::with('user')->get();
        return view('admin.students', compact('students'));
    }


    //store teachers details
    public function store_teachers(CreateTeacherRequest $request){
        $data = $request->validated();
        $newTeacher = new User();
        $newTeacher->name=$data['name'];
        $newTeacher->email= $data['email'];
        $newTeacher->role = 'teacher';
        $password = strval(mt_rand(1000, 9999));
        $newTeacher->password = $password;
        $newTeacher->save();


        // Send email with password

        Mail::to($newTeacher->email)->queue(new TeacherCreated($newTeacher, $password));


        // Clear form data
    Session::flash('formData', null);

    return redirect()->route('get_teachers')->with('success', 'Teacher added successfully!, Login Credentials Sent to the Email Address');

    }

    public function teacher_profile(){
        return view('teacher_profile');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
