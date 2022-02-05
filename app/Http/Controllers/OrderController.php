<?php

namespace App\Http\Controllers;

use App\Http\Requests\Order\CreateRequest;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        return view('order');

    }

    public function store(CreateRequest $request)
    {

        $data = $request->validated();
        $created = Order::create($data);

        if($created) {

            return redirect()->route('index')
                ->with('success',  __('messages.order.created.success'));
        }
        return back()
            ->with('error', __('messages.order.created.error'))
            ->withInput();
    }
}
