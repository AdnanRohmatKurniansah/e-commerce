<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
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
    public function callback(Request $request)
    {
        $serverKey = env('MIDTRANS_SERVER_KEY');
        $hashed = hash("sha512", $request->order_id.$request->status_code.$request->gross_amount.$serverKey);
        if($hashed == $request->signature_key){
            if($request->transaction_status == 'capture' or $request->transaction_status == 'settlement'){
                $order = Order::find($request->order_id);
                $order->update(['status' => 'paid']);

                foreach ($order->carts as $cart) {
                    $product = Product::find($cart->product_id);
                    if ($product) {
                        $reduce = $product->qty - $cart->qty;
                        $product->update(['qty' => $reduce]);
                    }
                }
            } else {
                $order = Order::find($request->order_id);
                $order->update(['status' => $request->transaction_status]);
            }
        } 
    }


}
