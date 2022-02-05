<?php

namespace App\Http\Controllers;

use App\Http\Requests\Feedback\CreateRequest;
use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function index()
    {
        return view('feedback');

    }

    public function store(CreateRequest $request)
    {
        $data = $request->validated();
        $created = Feedback::create($data);
        if($created) {

            return redirect()->route('index')
                ->with('success', __('messages.feedback.created.success'));
        }
        return back()
            ->with('error', __('messages.feedback.created.error'))
            ->withInput();

    }
}
