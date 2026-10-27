<?php
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => view('home'))->name('home');
Route::resource('students', StudentController::class)->except(['show']);
Route::resource('teachers', TeacherController::class)->except(['show']);
