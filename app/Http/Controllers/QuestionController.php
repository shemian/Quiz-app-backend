<?php

namespace App\Http\Controllers;

use App\Models\EducationSystemLevelSubject;
use App\Models\Exam;
use App\Models\SubTopicSubStrand;
use App\Models\TopicStrand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\Subject;
use App\Models\Question;
use App\Models\EducationSystem;
use App\Models\EducationLevel;

use Exception;

use Illuminate\Support\Facades\Log;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $questions = Question::with(['subject.educationLevel', 'subject.educationSystem'])
            ->select('id', 'exam_id', 'question', 'answer', 'created_at')
            ->get();
        return view('teachers.questions', compact('questions'));
    }

    public function create_question($examId){
        $subjects = Subject::all();
        $education_systems = EducationSystem::all();
        $exam = Exam::with(['subject.educationLevel', 'subject.educationSystem'])
            ->select('id', 'subject_id', 'name',)
            ->where('id', $examId)
            ->first();

        return view('teachers.create_question',compact('subjects',  'education_systems', 'exam'));
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'exam_id' => 'required',
            'education_level_id' => 'required|array',
            'education_level_id.*' => 'required',
            'subtopic_id' => 'required',
            'topic_id' => 'required',
            'questions' => 'required|array',
            'questions.*' => 'required',
            'option1' => 'required|array',
            'option1.*' => 'required',
            'option2' => 'required|array',
            'option2.*' => 'required',
            'option3' => 'required|array',
            'option3.*' => 'required',
            'option4' => 'required|array',
            'option4.*' => 'required',
            'answer' => 'required|array',
            'answer.*' => 'required',
        ]);

        $createdQuestions = [];

        foreach ($validatedData['questions'] as $index => $question) {
            $newQuestionData = [
                'exam_id' => $validatedData['exam_id'],
                'sub_topic_sub_strand_id' => $validatedData['subtopic_id'],
                'topic_strand_id' => $validatedData['topic_id'],
                'question' => $question,
                'option1' => $request->input('option1')[$index],
                'option2' => $request->input('option2')[$index],
                'option3' => $request->input('option3')[$index],
                'option4' => $request->input('option4')[$index],
            ];

            // Set the answer based on the selected option
            $answer = $request->input('answer')[$index];
            switch ($answer) {
                case 'option1':
                    $newQuestionData['answer'] = $request->input('option1')[$index];
                    break;
                case 'option2':
                    $newQuestionData['answer'] = $request->input('option2')[$index];
                    break;
                case 'option3':
                    $newQuestionData['answer'] = $request->input('option3')[$index];
                    break;
                case 'option4':
                    $newQuestionData['answer'] = $request->input('option4')[$index];
                    break;
            }

            if (isset($validatedData['education_level_id'][$index])) {
                $newQuestionData['education_level_id'] = $validatedData['education_level_id'][$index];
            }

            if ($request->hasFile('image_' . $index + 1)) { // Use 'image_' . $index to get the correct file for each question
                $image = $request->file('image_' . $index + 1);
                $imageName = time() . '_' .  $index + 1 . '.' . $image->getClientOriginalExtension();
                $image->storeAs('assets/images/exam_images', $imageName);
                $newQuestionData['image'] = 'assets/images/exam_images/' . $imageName;
            }

            $newQuestion = Question::create($newQuestionData);
            $createdQuestions[] = $newQuestion;
        }

        return redirect()->route('get_exams')->with('success', 'Questions created successfully!');
    }


    public function getEducationLevels(Request $request)
    {
        $educationSystemId = $request->input('educationSystemId');
        $educationSystem = EducationSystem::with('educationLevels')->find($educationSystemId);
        $educationLevels = $educationSystem->educationLevels;

        return response()->json(['educationLevels' => $educationLevels]);
    }

    public function getSubjects(Request $request)
    {
        $subjects = Subject::with('educationLevel', 'educationSystem')->get();
        return response()->json(['subjects' => $subjects]);
    }

    public function getTopics($subjectId )
    {
        $subject = Subject::with('topicStrands')->find($subjectId);
        $topicStrands = $subject->topicStrands;
        return response()->json(['topicStrands' => $topicStrands]);
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
    public function update(Request $request, $id)
    {
        try {
            // Validate the incoming data
            $validatedData = $request->validate([
                'exam_id' => 'required',
                'education_level_id' => 'required',
                'subtopic_id' => 'required',
                'topic_id' => 'required',
                'question' => 'required',
                'option1' => 'required|array',
                'option1.*' => 'required',
                'option2' => 'required|array',
                'option2.*' => 'required',
                'option3' => 'required|array',
                'option3.*' => 'required',
                'option4' => 'required|array',
                'option4.*' => 'required',
                'answer' => 'required|array',
                'answer.*' => 'required',
            ]);

            // Find the question by ID
            $question = Question::find($id);

            if (!$question) {
                return redirect()->back()->with('error', 'Question not found');
            }

            // Update the question data
            $question->exam_id = $validatedData['exam_id'];
            $question->sub_topic_sub_strand_id = $validatedData['subtopic_id'];
            $question->topic_strand_id = $validatedData['topic_id'];
            $question->question = $validatedData['question'];
            $question->option1 = $validatedData['option1'][0];
            $question->option2 = $validatedData['option2'][0];
            $question->option3 = $validatedData['option3'][0];
            $question->option4 = $validatedData['option4'][0];
            $question->education_level_id = $validatedData['education_level_id'];

            // Set the answer based on the selected option
            $answer = $validatedData['answer'][0];
            switch ($answer) {
                case 'option1':
                    $question->answer = $validatedData['option1'][0];
                    break;
                case 'option2':
                    $question->answer = $validatedData['option2'][0];
                    break;
                case 'option3':
                    $question->answer = $validatedData['option3'][0];
                    break;
                case 'option4':
                    $question->answer = $validatedData['option4'][0];
                    break;
            }

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '_updated.' . $image->getClientOriginalExtension();
                $image->storeAs('assets/images/exam_images', $imageName);
                $question->image = 'assets/images/exam_images/' . $imageName;
            }

            $question->save();

            return redirect()->route('view_exam_questions', ['id' => $question->exam_id])->with('success', 'Question updated successfully!');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred during the update.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $question = Question::find($id);

        if (!$question) {
            return redirect()->back()->with('error', 'Question not Found.');
        }

        $examId = $question->exam_id;

        $question->delete();

        return redirect()->route('view_exam_questions', ['id' => $examId])->with('success', 'Exam deleted successfully!');
    }
}
