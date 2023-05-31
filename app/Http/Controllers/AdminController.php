<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateTeacherRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Datatables;


class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view ('admin.dashboard');
    }

    //Display teacher's Details
    public function get_teachers(){
        return view ('admin.teacher');
    }

    public function getTeachers(Request $request){
        
        if ($request->ajax()) {
            $getTeachers = User::all();
            return Datatables::of($getTeachers);
        }
    }

    //store teachers details
    public function store_teachers(CreateTeacherRequest $request){
        $data = $request->validated();

        $newTeacher = new User();
        $newTeacher->name=$data['name'];
        $newTeacher->email= $data['email'];
        $newTeacher->role = 2;
        $newTeacher->password = Str::password(10);
        $newTeacher->save();


        return redirect()->route('get_teachers');
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
