<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\GuardianController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;



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
});


Route::prefix('teacher')->middleware(['auth', 'isTeacher'])->group(function(){
    Route::get('/', [TeacherController::class, 'index'])->name('teacher.dashboard');
    Route::get('/subjects', [SubjectController::class, 'index'])->name('get_subjects');
    Route::post('/subjects', [SubjectController::class, 'store'])->name('store_subjects');
});


Route::prefix('student')->middleware(['auth'])->group(function(){
    Route::get('/dashboard', [StudentController::class, 'index']);
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
