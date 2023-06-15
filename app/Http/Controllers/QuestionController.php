<?php

namespace App\Http\Controllers;

use App\Models\EducationSystemLevelSubject;
use App\Models\SubTopicSubStrand;
use App\Models\TopicStrand;
use Illuminate\Http\Request;

use App\Models\Subject;
use App\Models\Question;
use App\Models\EducationSystem;
use App\Models\EducationLevel;

use Illuminate\Support\Facades\Log;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subjects = Subject::all();
        $education_systems = EducationSystem::with('educationLevels')->get();
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
            'subtopic_id'=>'required',
            'topic_id'=>'required',
            'question' => 'required',
            'option1' => 'required',
            'option2' => 'required',
            'option3' => 'required',
            'option4' => 'required',
            'answer' => 'required',
            'image' => 'nullable'
        ]);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('uploads', $imageName); // Store the image file in the 'uploads' directory

            // Add the image path to the validated data
            $validatedData['image'] = 'uploads/' . $imageName;
        }

        Question::create([
            'subject_id' => $validatedData['subject_id'],
            'sub_topic_sub_strand_id' => $validatedData['subtopic_id'],
            'topic_strand_id' => $validatedData['topic_id'],
            'question' => $validatedData['question'],
            'option1' => $validatedData['option1'],
            'option2' => $validatedData['option2'],
            'option3' => $validatedData['option3'],
            'option4' => $validatedData['option4'],
            'answer' => $validatedData['answer'],
            'image' => $validatedData['image'],

        ]);

        return redirect()->route('get_questions')->with('success', 'Question created successfully.');

    }

    public function getEducationLevels(Request $request)
    {
        $educationSystemId = $request->input('educationSystemId');
        $educationSystem = EducationSystem::with('educationLevels')->find($educationSystemId);
        $educationLevels = $educationSystem->educationLevels;

        Log::info($educationLevels);

        return response()->json(['educationLevels' => $educationLevels]);
    }

    public function getSubjects(Request $request)
    {
        $educationLevelId = $request->input('educationLevelId');
        $educationLevel = EducationLevel::with('subjects')->find($educationLevelId);
        $subjects = $educationLevel->subjects;

        return response()->json(['subjects' => $subjects]);
    }

    public function getTopics(Request $request)
    {
        $subjectId = $request->input('subjectId');
        $subject = Subject::with('topicStrands')->find($subjectId);
        $topicStrands = $subject->topicStrands;

        return response()->json(['topics' => $topicStrands]);
    }

    public function getSubtopics(Request $request)
    {
        $topicId = $request->input('topicId');
        $topicStrands = TopicStrand::with('subTopicSubStrands')->find($topicId);
        $subTopicSubStrands = $topicStrands->subTopicSubStrands;

        return response()->json(['subtopics' => $subTopicSubStrands]);
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
