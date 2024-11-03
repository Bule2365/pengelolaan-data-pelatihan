<?php

namespace App\Http\Controllers;

use App\Models\FeedbackTraining;
use Illuminate\Http\Request;

class FeedbackTrainingController extends Controller
{
    public function create()
    {
        // Tampilkan form untuk memberikan feedback
        return view('feedback.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'trainee_id' => 'required|exists:trainees,id',
            'post_id' => 'required|exists:posts,id',
            'trainer_id' => 'required|exists:trainers,id',
            'description' => 'nullable|string',
            'score' => 'required|integer|min:1|max:5',
        ]);

        FeedbackTraining::create($request->all());

        return redirect()->route('feedback.index')->with('success', 'Feedback berhasil disimpan.');
    }

    public function index()
    {
        $feedbacks = FeedbackTraining::with('trainee', 'post', 'trainer')->get();
        return view('feedback.index', compact('feedbacks'));
    }
}
