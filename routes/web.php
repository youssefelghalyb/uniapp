<?php

use App\Http\Controllers\AssistantController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
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


Route::get('/products' , [ProductController::class , 'viewAllProducts']);
Route::get('/products/create' , [ProductController::class , 'create']);
Route::post('/products' , [ProductController::class , 'store'])->name('products.store');


});



require __DIR__.'/auth.php';
