<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        return view('order');

    }

    public function store(Request $request)
    {
        //dd($request->all());

        $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required'],
            'info' => ['required', 'string'],
        ]);
        $data = $this->getArrayFromJsonFile(public_path('/files/orders.json'));

        $data[] = $request->all();
        file_put_contents(public_path('/files/orders.json'), json_encode($data));

        $message = 'Ваш заказ принят';
        $type = 'success';

        return view('message',['message' => $message, 'type' => $type]);
    }
}
