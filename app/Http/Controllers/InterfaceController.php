<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Contact;
use App\Models\Feature;
use App\Models\Footer;
use App\Models\Gallery;
use App\Models\Slide;
use App\Models\Sosmed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InterfaceController extends Controller
{
    public function slide() 
    {
        return view('dashboard.slides.index', [
            'slides' => Slide::orderBy('id', 'desc')->get()
        ]);
    }
    public function createSlide() 
    {
        return view('dashboard.slides.create');
    }
    public function storeSlide(Request $request) 
    {
        $data = $request->validate([
            'heading' => 'required|max:250|min:3',
            'subHeading' => 'required',
            'image' => 'image|file|max:2048'
        ]);

        if($request->file('image')) {
            $data['image'] = $request->file('image')->store('slide-images');
        } 

        Slide::create($data);
        
        return redirect('/dashboard/slides')->with('success', 'New Slide has been added!');
    }
    public function editSlide(Slide $slide) 
    {
        return view('dashboard.slides.edit', [
            'slide' => $slide
        ]);
    }
    public function updateSlide(Request $request, Slide $slide) 
    {
        $data = $request->validate([
            'heading' => 'required|max:250|min:3',
            'subHeading' => 'required',
            'image' => 'image|file|max:2048'
        ]);

        if ($request->file('image')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $data['image'] = $request->file('image')->store('slide-images');
        }   

        Slide::where('id', $slide->id)
            ->update($data);
        
        return redirect('/dashboard/slides')->with('success', 'Slide has been updated!');
    }
    public function destroySlide(Slide $slide)
    {
        if ($slide->image) {
            Storage::delete($slide->image);
        }
        
        Slide::destroy($slide->id);
        return redirect('/dashboard/slides')->with('success', 'Slide has been deleted!');
    }
    public function feature() 
    {
        return view('dashboard.features.index', [
            'features' => Feature::orderBy('id', 'desc')->get()
        ]);
    }
    public function createFeature() 
    {
        return view('dashboard.features.create');
    }
    public function storeFeature(Request $request) 
    {
        $data = $request->validate([
            'title' => 'required|max:250|min:3',
            'desc' => 'required',
            'image' => 'image|file|max:2048'
        ]);

        if($request->file('image')) {
            $data['image'] = $request->file('image')->store('feature-images');
        } 

        Feature::create($data);
        
        return redirect('/dashboard/features')->with('success', 'New Feature has been added!');
    }
    public function editFeature(Feature $feature) 
    {
        return view('dashboard.features.edit', [
            'feature' => $feature
        ]);
    }
    public function updateFeature(Request $request, Feature $feature) 
    {
        $data = $request->validate([
            'title' => 'required|max:250|min:3',
            'desc' => 'required',
            'image' => 'image|file|max:2048'
        ]);

        if ($request->file('image')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $data['image'] = $request->file('image')->store('feature-images');
        }   

        Feature::where('id', $feature->id)
            ->update($data);
        
        return redirect('/dashboard/features')->with('success', 'Feature has been updated!');
    }
    public function destroyFeature(Feature $feature)
    {
        if ($feature->image) {
            Storage::delete($feature->image);
        }
        
        Feature::destroy($feature->id);
        return redirect('/dashboard/features')->with('success', 'Feature has been deleted!');
    }
    public function gallery() 
    {
        return view('dashboard.galleries.index', [
            'galleries' => Gallery::orderBy('id', 'desc')->get()
        ]);
    }
    public function createGallery() 
    {
        return view('dashboard.galleries.create');
    }
    public function storeGallery(Request $request) 
    {
        $data = $request->validate([
            'text' => 'required|max:250|min:3',
            'image' => 'image|file|max:2048'
        ]);

        if($request->file('image')) {
            $data['image'] = $request->file('image')->store('gallery-images');
        } 

        Gallery::create($data);
        
        return redirect('/dashboard/galleries')->with('success', 'New Gallery has been added!');
    }
    public function editGallery(Gallery $gallery) 
    {
        return view('dashboard.galleries.edit', [
            'gallery' => $gallery
        ]);
    }
    public function updateGallery(Request $request, Gallery $gallery) 
    {
        $data = $request->validate([
            'text' => 'required|max:250|min:3',
            'image' => 'image|file|max:2048'
        ]);

        if ($request->file('image')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $data['image'] = $request->file('image')->store('gallery-images');
        }   

        Gallery::where('id', $gallery->id)
            ->update($data);
        
        return redirect('/dashboard/galleries')->with('success', 'Gallery has been updated!');
    }
    public function destroyGallery(Gallery $gallery)
    {
        if ($gallery->image) {
            Storage::delete($gallery->image);
        }
        
        Gallery::destroy($gallery->id);
        return redirect('/dashboard/galleries')->with('success', 'Gallery has been deleted!');
    }
    public function brand() 
    {
        return view('dashboard.brands.index', [
            'brands' => Brand::orderBy('id', 'desc')->get()
        ]);
    }
    public function createBrand() 
    {
        return view('dashboard.brands.create');
    }
    public function storeBrand(Request $request) 
    {
        $data = $request->validate([
            'image' => 'image|file|max:2048'
        ]);

        if($request->file('image')) {
            $data['image'] = $request->file('image')->store('brand-images');
        } 

        Brand::create($data);
        
        return redirect('/dashboard/brands')->with('success', 'New Brand has been added!');
    }
    public function editBrand(Brand $brand) 
    {
        return view('dashboard.brands.edit', [
            'brand' => $brand
        ]);
    }
    public function updateBrand(Request $request, Brand $brand) 
    {
        $data = $request->validate([
            'image' => 'image|file|max:2048'
        ]);

        if ($request->file('image')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $data['image'] = $request->file('image')->store('brand-images');
        }   

        Brand::where('id', $brand->id)
            ->update($data);
        
        return redirect('/dashboard/brands')->with('success', 'Brand has been updated!');
    }
    public function destroyBrand(Brand $brand)
    {
        if ($brand->image) {
            Storage::delete($brand->image);
        }
        
        Brand::destroy($brand->id);
        return redirect('/dashboard/brands')->with('success', 'Brand has been deleted!');
    }
    public function contact() 
    {
        return view('dashboard.contacts.index', [
            'contacts' => Contact::all()
        ]);
    }
    public function editContact(Contact $contact) 
    {
        return view('dashboard.contacts.edit', [
            'contact' => $contact
        ]);
    }
    public function updateContact(Request $request, Contact $contact) 
    {
        $data = $request->validate([
            'map' => 'required',
            'address' => 'required',
            'pnumber' => 'required',
            'email' => 'required'
        ]);

        Contact::where('id', $contact->id)
            ->update($data);
        
        return redirect('/dashboard/contacts')->with('success', 'Contact has been updated!');
    }
    public function sosmed() 
    {
        return view('dashboard.sosmeds.index', [
            'sosmeds' => Sosmed::orderBy('id', 'desc')->get()
        ]);
    }
    public function createSosmed() 
    {
        return view('dashboard.sosmeds.create');
    }
    public function storeSosmed(Request $request) 
    {
        $data = $request->validate([
            'icon' => 'required|max:250',
            'link' => 'required'
        ]);

        Sosmed::create($data);
        
        return redirect('/dashboard/sosmeds')->with('success', 'New Sosmed has been added!');
    }
    public function editSosmed(Sosmed $sosmed) 
    {
        return view('dashboard.sosmeds.edit', [
            'sosmed' => $sosmed
        ]);
    }
    public function updateSosmed(Request $request, Sosmed $sosmed) 
    {
        $data = $request->validate([
            'icon' => 'required|max:250',
            'link' => 'required'
        ]);

        Sosmed::where('id', $sosmed->id)
            ->update($data);
        
        return redirect('/dashboard/sosmeds')->with('success', 'Sosmed has been updated!');
    }
    public function destroySosmed(Sosmed $sosmed)
    {
        if ($sosmed->image) {
            Storage::delete($sosmed->image);
        }   
        
        Sosmed::destroy($sosmed->id);
        return redirect('/dashboard/sosmeds')->with('success', 'Sosmed has been deleted!');
    }
    public function footer() 
    {
        return view('dashboard.footer.index', [
            'footers' => Footer::all()
        ]);
    }
    public function editFooter(Footer $footer) 
    {
        return view('dashboard.footer.edit', [
            'footer' => $footer
        ]);
    }
    public function updateFooter(Request $request, Footer $footer) 
    {
        $data = $request->validate([
            'about' => 'required|max:250',
            'copyright' => 'required|max:80',
            'link' => 'required'
        ]);

        Footer::where('id', $footer->id)
            ->update($data);
        
        return redirect('/dashboard/footer')->with('success', 'Footer has been updated!');
    }
}
