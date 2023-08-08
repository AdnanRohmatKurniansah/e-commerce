<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Cart;
use App\Models\Courier;
use App\Models\District;
use App\Models\Order;
use App\Models\Origin;
use App\Models\Province;
use App\Models\Regency;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use function PHPUnit\Framework\isEmpty;

class OrderController extends Controller
{
    public function show_checkout() 
    {
        if (Auth::id()) 
        {   
            $id = Auth::user()->id;
            $carts = Cart::where('user_id', $id)
                    ->whereDoesntHave('orders')->get();
            if ($carts->isEmpty()) {
                return redirect('/cart')->with('logFirst', 'Your Cart is Empty');
            }

            $address = Address::where('user_id', $id)
                ->where('primary', true)->first();

            if ($address == null) {
                $script = 
                '<script>
                    setTimeout(function() {
                        Swal.fire({
                            title: "You have not included your address",
                            text: "Complete your address so that your transaction can proceed easily",
                            icon: "warning",
                            showCancelButton: true,
                            cancelButtonText: "Later",
                            confirmButtonColor: "#3085d6",
                            cancelButtonColor: "#d33",
                            confirmButtonText: "Add address"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = "/address";
                            }
                        });
                    }, 2000); 
                </script>';  

                return view('checkout', [
                    'title' => 'Checkout',
                    'carts' => $carts,
                    'couriers' => Courier::pluck('title', 'code'),
                    'provinces' => Province::all(),
                    'subTotal' => $carts->sum('total'),
                    'subWeight' => $carts->sum('allWeight'),
                    'address' => $address,
                    'script' => $script
                 ]);
            } else {
                return view('checkout', [
                    'title' => 'Checkout',
                    'carts' => $carts,
                    'couriers' => Courier::pluck('title', 'code'),
                    'provinces' => Province::all(),
                    'subTotal' => $carts->sum('total'),
                    'subWeight' => $carts->sum('allWeight'),
                    'address' => $address,
                    'script' => ''
                ]);
            }
        } else {
            return redirect('/login')->with('logFirst', 'You Must Login First');
        }
    }
    public function getRegencies(Request $request) 
    {

        $id_province = $request->id_province;

        $regencies = Regency::where('province_id', $id_province)->get();

        foreach ($regencies as $regency) {
            echo "<option value='$regency->id'>$regency->name</option>";
        }
    }
    public function getDistricts(Request $request) 
    {
        $id_regency = $request->id_regency;

        $districts = District::where('regency_id', $id_regency)->get();

        foreach ($districts as $district) {
            echo "<option value='$district->id'>$district->name</option>";
        }
    }
    public function cost(Request $request) 
    {   
        $id = Auth::user()->id;
        $carts = Cart::where('user_id', $id)
                ->whereDoesntHave('orders')->get();
        // $origin = env('RAJAONGKIR_ORIGIN'); 
        $destination = $request->regencyId;
        $weight = $carts->sum('allWeight');
        $courier = $request->courier;
        $org = Origin::first();

        $response = Http::asForm()->withHeaders([
            'key' => env('RAJAONGKIR_API_KEY'),
        ])->post(env('RAJAONGKIR_BASE_URL'), [
            'origin' => $org->regency_id,
            'destination' => $destination,
            'weight' => $weight,
            'courier' => $courier,
        ]);

        $results = $response['rajaongkir']['results'][0];
        $services = $results['costs'];

        if (empty($services)) {
            return response()->json(['services' => []]);
        } else {
            return response()->json(['services' => $services]);  
        }
    
    }
    
    public function doCheckout(Request $request) 
    {
        $id = Auth::user()->id;
        $carts = Cart::where('user_id', $id)
                ->whereDoesntHave('orders')->get();

        $data = $request->validate([
            'fname' => 'required|max:255',
            'lname' => 'required|max:255',
            'pnumber' => 'required',
            'email' => 'required|email:dns',
            'province' => 'required',
            'regency' => 'required',
            'district' => 'required',
            'street' => 'required',
            'zip' => 'required',
            'note' => 'nullable|max:255',
            'courier' => 'required',
            'cart_ids' => 'required|array'
        ]);

        if ($request->ship_to === 'on') {
            $data['fname'] = $request->input('difFname');
            $data['lname'] = $request->input('difLname');
            $data['pnumber'] = $request->input('difPnumber');
            $data['email'] = $request->input('difEmail');
            $data['province'] = $request->input('difProvince');
            $data['regency'] = $request->input('difRegency');
            $data['district'] = $request->input('difDistrict');
            $data['street'] = $request->input('difStreet');
            $data['zip'] = $request->input('difZip');
        }
            
        $service = $request->shipping;
        $serviceArray = explode(' | ',$service);

        $data['service'] = $serviceArray[0] . ' | ' . $serviceArray[2];
        $shippingCost = (int) preg_replace('/[^\d]/', '', $serviceArray[1]);
        $data['shipping_cost'] = $shippingCost;

        $data['sub_total'] = $carts->sum('total');
        $data['total'] = $carts->sum('total') + $data['shipping_cost'];

        $data['user_id'] = $id;
        $dueDate = Carbon::parse($request->created_at)->addDay();
        $data['due_date'] = $dueDate;

        $order = Order::create($data);
        $order->carts()->sync($data['cart_ids']);

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;
            
        $params = array(
            'transaction_details' => array(
                'order_id' => $order->id,
                'gross_amount' => $order->total,
            ),
            'customer_details' => array(
                'first_name' => $order->fname,
                'last_name' => $order->lname,
                'email' => $order->email,
                'phone' => $order->phone,
            ),
        );
            
        $snapToken = \Midtrans\Snap::getSnapToken($params);

        $order->snaptoken = $snapToken;
        $order->save();

        Mail::send('auth.email.invoiceNotif', [
            'order' => $order->id,
            'ord' => $order
        ], function($message) use($order) {
            $message->to($order->email);
            $message->subject('Invoice Payment Reminder');
        });

        $addr = Address::where('user_id', $id)
            ->where('primary', true)->first();
        if ($addr == null) {
            $var = [
                'name' => $order->fname . ' ' .  $order->lname,
                'province_id' => $order->province,
                'regency_id' => $order->regency, 
                'district_id' => $order->district,
                'street' => $order->street,
                'zip' => $order->zip,
                'primary' => true,
                'user_id' => auth()->user()->id
            ];
    
            Address::create($var);
        }

        return redirect('/invoice/' . Crypt::encryptString($order->id))->with('success', 'Your order has been received');
    }
    public function removeOrder(Order $order) 
    {
        $cartIds = $order->carts->pluck('id')->toArray();
        $order->carts()->detach($cartIds);
        Order::destroy($order->id);

        return back()->with('success', 'Order has been removed');
    }
}
