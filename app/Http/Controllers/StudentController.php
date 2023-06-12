<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Result;
use App\Models\Subject;
use App\Models\Student;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('students.dashboard');
    }

    public function getSubjects()
    {
        $subjects = Subject::all();
        return view('students.get_subjects', compact('subjects'));
    }

    public function showQuestions($subjectId)
    {
        // Retrieve the authenticated user
        $user = auth()->user();

        // Retrieve the corresponding student record based on the user's ID
        $student = Student::where('user_id', $user->id)->first();

        if (!$student) {
            // Handle the case where the student record does not exist
            return redirect()->back()->with('error', 'Student record not found.');
        }

        // Check if a result exists for the given student and subject
        $result = Result::where('student_id', $student->id)->where('subject_id', $subjectId)->first();

        if ($result) {
            // Redirect to the view_result route with the result ID parameter
            return redirect()->route('students.view_results', ['result' => $result]);
        }

        $subject = Subject::findOrFail($subjectId);
        $questions = Question::where('subject_id', $subjectId)->get();
        $subtopic = 'Some subtopic'; // Replace with your subtopic logic
        return view('students.display_questions', compact('subject', 'questions', 'subtopic'));
    }

    public function submitAnswers(Request $request, $subjectId)
    {
        $answers = $request->input('answer');
        $subject = Subject::findOrFail($subjectId);

        // Retrieve the authenticated user
        $user = auth()->user();

        // Retrieve the corresponding student record based on the user's ID
        $student = Student::where('user_id', $user->id)->first();

        if (!$student) {
            // Handle the case where the student record does not exist
            return redirect()->back()->with('error', 'Student record not found.');
        }

        $correctAnswers = 0;
        $incorrectAnswers = 0;
        $resultDetails = [];

        foreach ($answers as $questionId => $selectedAnswer) {
            $question = Question::find($questionId);

            if (!$question) {
                // Handle the case where the question does not exist
                continue;
            }

            $correctAnswer = $question->answer;
            $isCorrect = $correctAnswer === $selectedAnswer;

            if ($isCorrect) {
                $correctAnswers++;
                $resultDetails[$questionId] = 'correct';
            } else {
                $incorrectAnswers++;
                $resultDetails[$questionId] = 'incorrect';
            }
        }

        $result = Result::create([
            'student_id' => $student->id,
            'subject_id' => $subjectId,
            'yes_ans' => $correctAnswers,
            'no_ans' => $incorrectAnswers,
            'result_json' => json_encode($resultDetails),
        ]);

        if ($result) {
            return redirect()->route('students.view_results', ['result' => $result->id])->with('success', 'Answers submitted successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to submit answers. Please try again.');
        }
    }

    public function viewResult(Result $result)
{
    // Retrieve the subject related to the result
    $subject = $result->subject;

    // Retrieve the subject ID from the result
    $subjectId = $result->subject_id;

    // Retrieve the questions related to the subject
    $questions = Question::where('subject_id', $subjectId)->get();

    // Decode the result JSON to retrieve the details of correct and incorrect answers
    $resultDetails = json_decode($result->result_json, true);

    // Create an array to store the details of correct and incorrect answers
    $answersDetails = [
        'correct' => [],
        'incorrect' => [],
    ];

    foreach ($questions as $question) {
        $questionId = $question->id;

        // Check if the result details array has an entry for the question ID
        if (array_key_exists($questionId, $resultDetails)) {
            $answerStatus = $resultDetails[$questionId];

            // If the answer is correct, add the question to the correct answers details array
            if ($answerStatus === 'correct') {
                $answersDetails['correct'][] = $question;
            } else {
                // If the answer is incorrect, add the question and its correct answer to the incorrect answers details array
                $answersDetails['incorrect'][] = [
                    'question' => $question,
                    'correctAnswer' => $question->answer,
                ];
            }
        }
    }

    return view('students.view_result', compact('result', 'subject', 'answersDetails'));
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
