<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.products.index', [
            'products' => Product::orderBy('id', 'desc')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.products.create', [
            'categories' => Category::all(),
            'colors' => ['Black', 'White', 'Brown', 'Gray', 'Blue', 'Red', 'Green', 'Yellow', 'Pink', 'Purple'],
            'sizes' => ['32', '33', '34', '35', '36', '37', '38', '39', '40', '41', '42', '43', '44', '45', 'S', 'M', 'L', 'XL', 'XXL']
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'slug'  => 'required|unique:products',
            'desc' => 'required',
            'price' => 'required',
            'qty' => 'required',
            'image' => 'image|file|max:2048',
            'category_id' => 'required'
        ]);  
        
        if($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('product-images');
        } 

        $validatedData['short_desc'] = Str::limit(strip_tags($request->desc), 150);

        $validatedData['weight'] = $request->weight / 1000;
        $validatedData['color'] = json_encode($request->input('color') ?? []);
        $validatedData['size'] = json_encode($request->input('size') ?? []);

        Product::create($validatedData);
        
        return redirect('/dashboard/products')->with('success', 'New Product has been added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('dashboard.products.edit', [
            'product' => $product,
            'categories' => Category::all(),
            'colors' => ['Black', 'White', 'Brown', 'Gray', 'Blue', 'Red', 'Green', 'Yellow', 'Pink', 'Purple'],
            'sizes' => ['32', '33', '34', '35', '36', '37', '38', '39', '40', '41', '42', '43', '44', '45', 'S', 'M', 'L', 'XL', 'XXL']
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $rules = [
            'name' => 'required|max:255',
            'desc' => 'required',
            'weight' => 'required',
            'price' => 'required',
            'qty' => 'required',
            'image' => 'image|file|max:2048',
            'category_id' => 'required'
        ];  
        
        if($request->slug != $product->slug) {
            $rules['slug'] = 'required|unique:products';
        }

        $validatedData = $request->validate($rules);

        if ($request->file('image')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validatedData['image'] = $request->file('image')->store('product-images');
        }

        $validatedData['short_desc'] = Str::limit(strip_tags($request->desc), 150);

        $validatedData['color'] = json_encode($request->input('color') ?? []);
        $validatedData['size'] = json_encode($request->input('size') ?? []);

        Product::where('id', $product->id)
            ->update($validatedData);
        
        return redirect('/dashboard/products')->with('success', 'Product has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::delete($product->image);
        }
        
        Product::destroy($product->id);
        return redirect('/dashboard/products')->with('success', 'Product has been deleted!');
    }
    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Product::class, 'slug', $request->name);
        return response()->json(['slug' => $slug]);
    }

}
