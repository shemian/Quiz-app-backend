<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\GuardianController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\QuestionController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('/admin')->middleware(['isAdmin'])->group(function(){
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/teachers', [AdminController::class, 'get_teachers'])->name('get_teachers');
    Route::post('/teachers', [AdminController::class, 'store_teachers'])->name('store_teachers');
    Route::get('/getTeachers', [AdminController::class, 'display_Teachers'])->name('teachers.list');
    Route::get('/teacher-profile', [AdminController::class, 'teacher_profile'])->name('teacher_profile');

});

Route::prefix('parent')->middleware(['isParent'])->group(function(){
    Route::get('/', [GuardianController::class, 'index'])->name('parent.dashboard');
    Route::get('/create_students', [GuardianController::class, 'createStudent'])->name('get_students');
    Route::post('/students', [GuardianController::class, 'store'])->name('store_student');
});


Route::prefix('teacher')->middleware([ 'isTeacher'])->group(function(){
    Route::get('/', [TeacherController::class, 'index'])->name('teacher.dashboard');
    Route::get('/subjects', [SubjectController::class, 'index'])->name('get_subjects');
    Route::post('/subjects', [SubjectController::class, 'store'])->name('store_subjects');
    Route::get('/questions', [QuestionController::class, 'index'])->name('get_questions');
    Route::post('/questions', [QuestionController::class, 'store'])->name('store_questions');
});


Route::prefix('student')->middleware(['auth', 'isStudent'])->group(function(){
    Route::get('/', [StudentController::class, 'index'])->name('student.dashboard');
    Route::get('/view_questions', [StudentController::class, 'getSubjects'])->name('view_questions');
    Route::get('/questions/{subject}', [StudentController::class, 'showQuestions'])->name('show_questions');
    Route::post('/questions/{subject}', [StudentController::class, 'submitAnswers'])->name('questions.submit');
    Route::get('/view_result/{result}', [StudentController::class, 'viewResult'])->name('students.view_results');

});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
