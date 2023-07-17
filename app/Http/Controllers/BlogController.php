<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogComment;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.blogs.index', [
            'blogs' => Blog::orderBy('id', 'desc')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.blogs.create', [
            'blogCategories' => BlogCategory::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'slug'  => 'required|unique:blogs',
            'blogCategory_id' => 'required',
            'body' => 'required',
            'image' => 'image|file|max:2048',
        ]);  
        
        if($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('blog-images');
        } 

        $validatedData['author'] = auth()->user()->name;

        Blog::create($validatedData);
        
        return redirect('/dashboard/blogs')->with('success', 'New Blog has been added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        return view('dashboard.blogs.edit', [
            'blog' => $blog,
            'blogCategories' => BlogCategory::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog)
    {
        $rules = [
            'title' => 'required|max:255',
            'blogCategory_id' => 'required',
            'body' => 'required',
            'image' => 'image|file|max:2048',
        ];  
        
        if($request->slug != $blog->slug) {
            $rules['slug'] = 'required|unique:blogs';
        }

        $validatedData = $request->validate($rules);

        if ($request->file('image')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validatedData['image'] = $request->file('image')->store('blog-images');
        }   

        $validatedData['author'] = auth()->user()->name;

        Blog::where('id', $blog->id)
            ->update($validatedData);
        
        return redirect('/dashboard/blogs')->with('success', 'Blog has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        if ($blog->image) {
            Storage::delete($blog->image);
        }
        
        Blog::destroy($blog->id);
        return redirect('/dashboard/blogs')->with('success', 'Blog has been deleted!');
    }
    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Blog::class, 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }
    public function addComment(Request $request) 
    {   
        if (Auth::id()) {
            $data = $request->validate([
                'blog_id' => 'required',
                'message' => 'required|max:250',
            ]);
    
            $data['name'] = auth()->user()->name;
            $data['user_id'] = auth()->user()->id;

            $existingComment = BlogComment::where('user_id', $data['user_id'])
            ->where('blog_id', $data['blog_id'])
            ->first();

            if ($existingComment) {
                return redirect()->back()->with('error', 'You have already commented');
            }
    
            BlogComment::create($data);
    
            return redirect()->back()->with('success', 'Thanks for your comment');
        } else {
            return redirect('/login')->with('logFirst', 'You Must Login First');
        }
    }
    public function comment() 
    {
        return view('dashboard.blogs.comments.index', [
            'blogComments' => BlogComment::orderBy('id', 'desc')->get()
        ]);
    }
    public function removeComment(BlogComment $blogComment) {
        BlogComment::destroy($blogComment->id);
        return redirect('/dashboard/blogs/comments')->with('success', 'Blog Comment has been deleted!');
    }
    
}
