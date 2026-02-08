<?php

use App\Http\Controllers\ExerciseController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('exercises.index');
});

Route::resource('exercises', ExerciseController::class);