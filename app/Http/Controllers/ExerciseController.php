<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use Illuminate\Http\Request;

class ExerciseController extends Controller
{
    public function index()
    {
        $exercises = Exercise::all();
        return view('exercises.index', compact('exercises'));
    }

    public function show(Exercise $exercise)
    {
        return view('exercises.show', compact('exercise'));
    }

    public function create()
    {
        return view('exercises.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'instructions' => 'required|string',
            'muscle_group' => 'nullable|string',
            'duration_seconds' => 'nullable|integer',
            'reps' => 'nullable|integer',
            'difficulty' => 'required|in:beginner,intermediate,advanced',
        ]);

        Exercise::create($validated);

        return redirect()->route('exercises.index')
            ->with('success', 'Упражнение добавлено успешно!');
    }
}