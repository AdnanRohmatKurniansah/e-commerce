<?php

namespace App\Http\Controllers;

use App\Models\Origin;
use App\Models\Province;
use App\Models\Regency;
use Illuminate\Http\Request;

class OriginController extends Controller
{
    public function index() 
    {
        return view('dashboard.origin.index', [
            'origin' => Origin::all(),
            'provinces' => Province::all()
        ]);
    }
    public function edit(Origin $origin) {
        return view('dashboard.origin.edit', [
            'origin' => $origin,
            'provinces' => Province::all()
        ]);
    }
    public function update(Request $request, Origin $origin) 
    {
        $data = $request->validate([
            'province_id' => 'required',
            'regency_id' => 'required',
            'district_id' => 'required'
        ]);

        Origin::where('id', $origin->id)
            ->update($data);

        return redirect('/dashboard/origin')->with('update', 'Origin has been updated');
    }   
}
