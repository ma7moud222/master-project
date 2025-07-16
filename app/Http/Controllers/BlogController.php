<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\bootstrap;
use App\Http\Requests\StoreBlogRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Categoies;
use App\Models\Category;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::check()) {
            $Categories = Category::get();
            return view('theme.blogs.create', compact('Categories'));
        }
        abort(403);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBlogRequest $request)
    {

        $data = $request->validated();
        // image upload
        // get image
        $image = $request->image;
        // change it's current name
        $newimageName = time() . '-' . $image->getClientOriginalName();

        // move image to my project
        $image->storeAs('blogs', $newimageName, 'public');
        // save new name to database record
        $data['image'] = $newimageName;

        $data['user_id'] = Auth::user()->id;
        // create blog
        Blog::create($data);
        return back()->with('blogCreatestatus', 'Blog created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        return view('theme.single-blog', compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        $Categories = Category::get();
        return view('theme.blogs.edit', compact('Categories', 'blog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        //
    }


    /**
     * display my blogs
     */
    public function myBlogs()
    {
        if (Auth::check()) {

            $blogs = Blog::where('user_id', Auth::user()->id)->paginate(10);
            return view('theme.blogs.my-blogs', compact('blogs'));
        }
        abort(403);
    }
}
