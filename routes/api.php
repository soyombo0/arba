<?php

use App\Http\Controllers\GradeController;
use App\Http\Controllers\LectureController;
use App\Http\Controllers\StudentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::apiResources(
    [
        'students' => StudentController::class,
        'grades' => GradeController::class,
        'lectures' => LectureController::class
    ]
);

Route::post('student/attend', [StudentController::class, 'attendLecture'])->name('student.attend');

Route::get('grades/{grade}/schedule', [GradeController::class, 'schedule'])->name('grade.schedule');
Route::post('grades/schedule', [GradeController::class, 'storeSchedule'])->name('grade.schedule.store');
Route::put('grades/schedule', [GradeController::class, 'updateSchedule'])->name('grade.schedule.update');
