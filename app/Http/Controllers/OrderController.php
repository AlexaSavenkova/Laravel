<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        return view('order');

    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required'],
            'info' => ['required', 'string'],
        ]);
        $data = $request->all();
        $created = Order::create($data);

        if($created) {

            return redirect()->route('index')
                ->with('success', 'Ваш заказ успешно оформлен');
        }
        return back()
            ->with('error', 'Не удалось оформить заказ')
            ->withInput();
    }
}
