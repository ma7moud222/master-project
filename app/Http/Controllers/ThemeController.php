<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ThemeController extends Controller
{
    public function index()
    {
        return view('theme.index');
    }

    public function category()
    {
        return view('theme.category');
    }

    public function contact()
    {
        return view('theme.contact');
    }

    public function singleBlog()
    {
        return view('theme.single-blog');
    }

    public function login()
    {
        if (Auth::check()) {
            return redirect()->route('theme.index');
        }
        return view('theme.login');
    }

    public function register()
    {
        if (Auth::check()) {
            return redirect()->route('theme.index');
        }
        return view('theme.register');
    }
}

    

