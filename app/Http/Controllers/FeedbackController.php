<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function index()
    {
        return view('feedback');

    }

    public function store(Request $request)
    {
        $data = $this->getArrayFromJsonFile(public_path('/files/feedback.json'));

        $data[] = $request->all();
        file_put_contents(public_path('/files/feedback.json'), json_encode($data));

        $message = 'Спасибо за ваш отзыв';
        $type = 'primary';

        return view('message',['message' => $message, 'type' => $type]);
    }
}
