<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\SubTopicSubStrand;
use App\Models\TopicStrand;
use Illuminate\Http\Request;

class SubTopicSubStrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(TopicStrand $topicStrand)
    {
        return view('teachers.create_subtopic_substrand', compact('topicStrand'));
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, TopicStrand $topicStrand)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Create a new subtopic/substrand for the given topic strand
        $subtopicSubStrand = new SubtopicSubStrand([
            'name' => $request->input('name'),
        ]);

        // Associate the subtopic/substrand with the topic strand
        $topicStrand->subTopicSubStrands()->save($subtopicSubStrand);


        return redirect()->route('createSubtopicSubStrand', ['topicStrand' => $topicStrand])->with('success', 'Subtopic/Substrand added successfully');

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
