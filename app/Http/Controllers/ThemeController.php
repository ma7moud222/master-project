<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ThemeController extends Controller
{
    public function index()
    {
        $blogs = Blog::latest()->paginate(1);
        $sliderBlogs = Blog::latest()->take(5)->get();
        return view('theme.index', compact('blogs', 'sliderBlogs'));
    }

    public function category($id)
    {
        $categoryName = Category::find($id)->name;
        $blogs = Blog::where('category_id', $id)->paginate(8);
        return view('theme.category', compact('blogs', 'categoryName'));
    }

    public function contact()
    {
        return view('theme.contact');
    }
}
