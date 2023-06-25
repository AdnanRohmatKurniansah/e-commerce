<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Courier;
use App\Models\District;
use App\Models\Province;
use App\Models\Regency;
use App\Models\Village;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use function PHPUnit\Framework\isEmpty;

class OrderController extends Controller
{
    public function show_checkout() 
    {
        if (Auth::id()) 
        {   
            $id = Auth::user()->id;
            $carts = Cart::where('user_id', '=', $id)->get();
            if ($carts === isEmpty()) {
                return redirect('/cart')->with('logFirst', 'Your Cart is Empty');
            }
            return view('checkout', [
                'title' => 'Checkout',
                'carts' => $carts,
                'couriers' => Courier::pluck('title', 'code'),
                'provinces' => Province::all(),
                'subTotal' => $carts->sum('total'),
                'subWeight' => $carts->sum('allWeight')
            ]);
        } 
        else 
        {
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
    public function getVillages(Request $request) 
    {
        $id_district = $request->id_district;

        $villages = Village::where('district_id', $id_district)->get();

        foreach ($villages as $village) {
            echo "<option value='$village->id'>$village->name</option>";
        }
    }
    public function cost(Request $request) 
    {   
        $id = Auth::user()->id;
        $carts = Cart::where('user_id', '=', $id)->get();
        
        $origin = env('RAJAONGKIR_ORIGIN'); 
        $destination = $request->provinceId;
        $weight = $carts->sum('allWeight');
        $courier = $request->courier;

        $response = Http::asForm()->withHeaders([
            'key' => env('RAJAONGKIR_API_KEY'),
        ])->post(env('RAJAONGKIR_BASE_URL'), [
            'origin' => $origin,
            'destination' => $destination,
            'weight' => $weight,
            'courier' => $courier,
        ]);

        $results = $response['rajaongkir']['results'][0];
        $services = $results['costs'];
    
    return response()->json(['services' => $services]);  
    }

}
