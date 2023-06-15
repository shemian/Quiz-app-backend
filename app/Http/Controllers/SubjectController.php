<?php

namespace App\Http\Controllers;

use App\Models\EducationSystem;
use App\Models\TopicStrand;
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
        $subjects = Subject::with('educationSystem', 'educationLevel')->get();

        foreach ($subjects as $subject) {
            $count = TopicStrand::where('subject_id', $subject->id)->count();
            $subject->topicsCount = $count;
        }

        $education_systems = EducationSystem::all();

        return view('teachers.subjects', compact('subjects', 'education_systems'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SubjectsRequest $request)
    {
        $data = $request->validated();

        $newSubject = new Subject();
        $newSubject->name=$data['name'];
        $newSubject->education_system_id=$data['education_system_id'];
        $newSubject->education_level_id=$data['education_level_id'];
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
