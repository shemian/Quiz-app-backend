<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\TopicStrand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TopicsAndStrandsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $educationSystemId, string $educationLevelId, string $subjectId)
    {
        $topicStrands = TopicStrand::with('subject.educationSystem', 'subject.educationLevel')->get();
        return view('teachers.create_topics_strands', compact('topicStrands', 'educationSystemId', 'educationLevelId', 'subjectId'));
    }


    /**
     * Store a newly created resource in storage.
     */


    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'topic_strand' => 'required|string',
            'education_system_id' => 'required|string',
            'education_level_id' => 'required|string',
            'subject_id' => 'required|string',
        ]);

        // Create a new topic/strand record in the topic_strands table
        $topicStrand = TopicStrand::create([
            'subject_id' => $validatedData['subject_id'],
            'topic_strand' => $validatedData['topic_strand'],
        ]);

        // Optionally, you can return a response or redirect as needed
        return redirect()->route('topics_strands.index', [
            'educationSystemId' => $validatedData['education_system_id'],
            'educationLevelId' => $validatedData['education_level_id'],
            'subjectId' => $validatedData['subject_id'],
        ])->with('success', 'Topic/Strand created successfully');
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
