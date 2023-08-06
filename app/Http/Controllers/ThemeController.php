<?php

namespace App\Http\Controllers;

use App\Models\Theme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ThemeController extends Controller
{
    public function index() {
        return view('dashboard.theme.index', [
            'theme' => Theme::first()
        ]);
    }

    public function edit(Theme $theme) {
        return view('dashboard.theme.edit', [
            'theme' => $theme
        ]);
    }
    public function update(Request $request, Theme $theme) {
        $data = $request->validate([
            'colorPrimary' => 'required',
            'colorSecondary' => 'required',
            'fontPrimary' => 'required',
            'fontSecondary' => 'required',
            'logo' => 'image|max:2048',
            'banner' => 'image|max:2048',
            'commonBanner' => 'image|max:2048'
        ]);

        if ($request->file('logo')) {
            if ($request->oldLogo) {
                Storage::delete($request->oldLogo);
            }
            $data['logo'] = $request->file('logo')->store('themes');
        }   

        if ($request->file('banner')) {
            if ($request->oldBanner) {
                Storage::delete($request->oldBanner);
            }
            $data['banner'] = $request->file('banner')->store('themes');
        }   

        if ($request->file('commonBanner')) {
            if ($request->oldCommonBanner) {
                Storage::delete($request->oldCommonBanner);
            }
            $data['commonBanner'] = $request->file('commonBanner')->store('themes');
        }   

        Theme::where('id', $theme->id)
            ->update($data);
        
        return redirect('/dashboard/theme')->with('update', 'Theme has been updated!');
    }
}
