<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function invoice($id) 
    {   
        $url = Crypt::decryptString($id);
        $order = Order::findOrFail($url);

        $array = explode(' | ', $order->service);
        $value = $array[1];
        $etd = explode('-', $value)[0] + 1;
        $date = \Carbon\Carbon::parse($order->updated_at)->addDays($etd)->format('d M Y');

        if (\Carbon\Carbon::today() >= \Carbon\Carbon::parse($date)) {
            if ($order->status == 'process') {
                $order->update(['status' => 'finished']);                         
            }
        }

        return view('invoice', [
            'order' => $order,
            'title' => 'INV' . str_pad($order->id, 5, '0', STR_PAD_LEFT)
        ]);
    }
    public function transaction() 
    {
        $id = Auth::user()->id;                         
        Order::where('user_id', '=', $id)
            ->whereNotIn('status', ['paid', 'process', 'finished'])
            ->where('created_at', '<=', DB::raw('orders.due_date'))
            ->where('due_date', '<=', now())
            ->update(['status' => 'expired']);
        
        return view('transaction', [
            'title' => 'Transaction',
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
            }
        } 
    }
    public function orderProcess(Request $request) 
    {
        Order::where('id', $request->id)
            ->update([
            'resi' => $request->resi,
            'status' => 'process'
        ]);

        return redirect('/dashboard/orders')->with('success', 'Order processed');
    }
    public function itemsArrived(Request $request) 
    {
        Order::where('id', $request->id)
            ->update(['status' => 'finished']);

        return redirect('/transaction')->with('update', 'Thank you for ordering here');
    }
}
