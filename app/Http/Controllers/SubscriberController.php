<?php

namespace App\Http\Controllers;

use App\Models\SubscriberMc;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    public function store(Request $request)
    {
       $data = $request->validate([
            'email' => 'required|email|unique:subscribers,email',
        ]);

       SubscriberMc::create($data);

       return redirect()->back()->with('status', 'Subscribed Successfully');
    }
}
