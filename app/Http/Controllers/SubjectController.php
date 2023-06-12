<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SubjectsRequest;
use App\Models\Subject;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subjects = Subject::all();
        return view('teachers.subjects', compact('subjects'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SubjectsRequest $request)
    {
        $data = $request->validated();

        $newSubject = new Subject();
        $newSubject->name=$data['name'];
        $newSubject->save();
        return redirect()->route('get_subjects')->with('success', 'Subject Created successfully!');
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
