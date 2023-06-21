<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateExamRequest;
use App\Models\EducationSystem;
use App\Models\Exam;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $education_systems = EducationSystem::all();
        $exams = Exam::with(['subject.educationLevel', 'subject.educationSystem'])
            ->withCount('questions')
            ->get();
        Log::info($exams);

        return view('teachers.exams', compact('education_systems', 'exams'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateExamRequest $request)
    {
        $data = $request->validated();

        $newExamRecord = new Exam();
        $newExamRecord->name = $data['name'];
        $newExamRecord->subject_id = $data['subject_id'];
        $newExamRecord->save();

        return redirect()->route('get_exams')->with('success', 'Exam Created successfully!');
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
