<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Province;
use Illuminate\Http\Request;

class MyAddressController extends Controller
{
    public function address() 
    {
        return view('auth.account.address', [
            'title' => 'My Address',
            'addresses' => Address::where('user_id', auth()->user()->id)
                ->orderBy('primary', 'desc') 
                ->get(),
            'provinces' => Province::all(),
        ]);
    }
    public function addAddress(Request $request) 
    {
        $data = $request->validate([
            'name' => 'required|min:3|max:255',
            'province_id' => 'required',
            'regency_id' => 'required',
            'district_id' => 'required',
            'street' => 'required',
            'zip' => 'required',
        ]);

        if (Address::count() == 0) {
            $data['primary'] = true;
        } else {
            $data['primary'] = false;
        }
        
        $data['user_id'] = auth()->user()->id;

        Address::create($data);

        return back()->with('success', 'New address has been added');
    }
    public function updateAddress(Request $request) 
    {
        $data = $request->validate([
            'name' => 'required|min:3|max:255',
            'province_id' => 'required',
            'regency_id' => 'required',
            'district_id' => 'required',
            'street' => 'required',
            'zip' => 'required', 
        ]);

        Address::where('id', $request->id)
            ->update($data);

        return back()->with('update', 'Address has been updated');
    }
    public function removeAddress(Request $request) 
    {
        Address::destroy($request->id);
        return back()->with('success', 'Address has been removed!');
    }
    public function changePrimary(Request $request) 
    {   
        Address::where('primary', true)
            ->update([
                'primary' => false
            ]);

        Address::where('id', $request->id)
            ->update([
                'primary' => true
            ]);

        return back()->with('update', 'Success changed to primary');
    }   
}
