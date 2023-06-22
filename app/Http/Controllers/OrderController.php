<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function PHPUnit\Framework\isEmpty;

class OrderController extends Controller
{
    public function show_checkout() {
        if (Auth::id()) 
        {   
            $id = Auth::user()->id;
            $carts = Cart::where('user_id', '=', $id)->get();
            if ($carts === isEmpty()) {
                return redirect('/cart')->with('logFirst', 'Your Cart is Empty');
            }

            return view('checkout', [
                'title' => 'Checkout'
            ]);
        } 
        else 
        {
            return redirect('/login')->with('logFirst', 'You Must Login First');
        }
    }
}
