<?php

use App\Http\Controllers\AssistantController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentDashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('students', StudentController::class)->names('students');
    Route::resource('assistants', AssistantController::class)->names('assistants');
    Route::resource('courses', CourseController::class)->names('courses');

    Route::get('departments' ,  [DepartmentController::class , 'index'])->name('departments.index');
    Route::get('departments/create' ,  [DepartmentController::class , 'create'])->name('departments.create');
    Route::post('departments/store' ,  [DepartmentController::class , 'store'])->name('departments.store');
    Route::delete('departments/delete/{id}' ,  [DepartmentController::class , 'destroy'])->name('departments.delete');
    Route::get('departments/edit/{id}' ,  [DepartmentController::class , 'edit'])->name('departments.edit');
    Route::post('departments/update/{id}' ,  [DepartmentController::class , 'update'])->name('departments.update');


    Route::prefix('student-dashboard')->group(function () {
        Route::get('/', [StudentDashboardController::class, 'dashboard'])->name('student-dashboard');
        Route::get('/requests', [StudentDashboardController::class, 'newRequest'])->name('student-requests.index');
        Route::post('/requests', [StudentDashboardController::class, 'storeRequest'])->name('student-requests.store');
        Route::get('/requests/{request}', [StudentDashboardController::class, 'showRequest'])->name('student-requests.show');
        Route::delete('/requests/{request}', [StudentDashboardController::class, 'destroyRequest'])->name('student-requests.destroy');


        Route::get('/meetings', [StudentDashboardController::class, 'meetings'])->name('student-meetings.index');
        Route::post('/meetings', [StudentDashboardController::class, 'storeMeeting'])->name('student-meetings.store');
        Route::get('/meetings/{meeting}', [StudentDashboardController::class, 'showMeeting'])->name('student-meetings.show');
        Route::delete('/meetings/{meeting}', [StudentDashboardController::class, 'destroyMeeting'])->name('student-meetings.destroy');
        Route::patch('/meetings/{meeting}/reschedule', [StudentDashboardController::class, 'rescheduleMeeting'])->name('student-meetings.reschedule');

        Route::get('/faq', [StudentDashboardController::class, 'faq'])->name('student-faq.index');





















    });








});






require __DIR__ . '/auth.php';
