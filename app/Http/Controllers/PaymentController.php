<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class PaymentController extends Controller
{
    public function invoice($id) 
    {   
        $url = Crypt::decryptString($id);
        $order = Order::findOrFail($url);

        return view('invoice', [
            'order' => $order,
            'title' => 'Invoice'
        ]);
    }
    public function transaction() 
    {
        $id = Auth::user()->id;
        $orders = Order::where('user_id', '=', $id)->paginate(10);

        return view('transaction', [
            'title' => 'Transaction',
            'orders' => $orders,
        ]);
    }

}
