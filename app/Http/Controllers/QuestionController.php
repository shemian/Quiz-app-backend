<?php

namespace App\Http\Controllers;

use App\Models\EducationSystemLevelSubject;
use Illuminate\Http\Request;

use App\Models\Subject;
use App\Models\Question;
use App\Models\EducationSystem;
use App\Models\EducationLevel;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subjects = Subject::all();
        $education_systems = EducationSystem::all();
        $education_level_system_subjects = EducationSystemLevelSubject::with('subject', 'educationSystem', 'educationLevel')->get();
        return view('teachers.questions', compact('subjects', 'education_level_system_subjects', 'education_systems'));
    }

    public function create_question(){
        $subjects = Subject::all();
        $education_systems = EducationSystem::all();
        return view('teachers.create_question',compact('subjects',  'education_systems'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'subject_id' => 'required',
            'subtopic' => 'required',
            'education_system_id' => 'required',
            'education_level_id' => 'required',
            'question' => 'required',
            'option1' => 'required',
            'option2' => 'required',
            'option3' => 'required',
            'option4' => 'required',
            'answer' => 'required',
        ]);

        Question::create($validatedData);

        return redirect()->route('get_questions')->with('success', 'Question created successfully.');

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
