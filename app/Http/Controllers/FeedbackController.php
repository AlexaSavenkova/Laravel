<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function index()
    {
        return view('feedback');

    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'feedback' => ['required', 'string'],
        ]);

        $data = $request->all();
        $created = Feedback::create($data);
        if($created) {

            return redirect()->route('index')
                ->with('success', 'Спасибо за ваш отзыв');
        }
        return back()
            ->with('error', 'Не удалось добавить запись')
            ->withInput();

    }
}
