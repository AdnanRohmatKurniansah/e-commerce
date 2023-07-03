<?php

namespace App\Http\Controllers;

use App\Models\BlogCategory;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;

class BlogCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.blogs.categories.index', [
            'blogCategories' => BlogCategory::latest()->paginate(20)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.blogs.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'slug'  => 'required|unique:blog_categories'
        ]);

        BlogCategory::create($data);

        return redirect('/dashboard/blogs/categories')->with('success', 'New Category Added Succesfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(BlogCategory $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BlogCategory $category)
    {
        return view('dashboard.blogs.categories.edit', [
            'category' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BlogCategory $category)
    {
        $rules = [
            'name' => 'required'
        ];

        if($request->slug != $category->slug) {
            $rules['slug'] = 'required|unique:blog_categories';
        }

        $validatedData = $request->validate($rules);

        BlogCategory::where('id', $category->id)
            ->update($validatedData);

        return redirect('/dashboard/blogs/categories')->with('update', 'Category has been updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BlogCategory $category)
    {
        BlogCategory::destroy($category->id);
        return redirect('/dashboard/blogs/categories')->with('success', 'Category has been deleted!');
    }
    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(BlogCategory::class, 'slug', $request->name);
        return response()->json(['slug' => $slug]);
    }
}
