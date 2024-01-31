<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\StudentController;


Route::get('/', fn () => view('welcome'));

// Ajax
Route::get('students', [StudentController::class, 'index'])->name('students');
Route::post('add-student', [StudentController::class, 'addStudent'])->name('student.add');
Route::get('/students/{id}', [StudentController::class, 'getStudentById']);
Route::put('/student}', [StudentController::class, 'updateStudent'])->name('student.update');
Route::delete('/students/{id}', [StudentController::class, 'deleteStudent']);
Route::delete('/selected-students', [StudentController::class, 'deleteCheckedStudent'])->name('student.deleteselected');

// client validation
Route::get('register', [AuthController::class, 'index']);
Route::post('register', [AuthController::class, 'registerSubmit'])->name('auth.registersubmit');

// infinite scroll
Route::get('posts', [PostController::class, 'index']);

// chart
Route::get('chart', [ChartController::class, 'index']);
Route::get('barchart', [ChartController::class, 'barchart']);

// Multi Form
Route::get('form', [FormController::class, 'index'])->name('form');
Route::post('form', [FormController::class, 'formSubmit'])->name('form.submit');
