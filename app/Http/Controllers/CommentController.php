<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Http\Requests\StoreCommentRequest;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    public function store(StoreCommentRequest $request)
    {

        $data = $request->validated();
        Comment::create($data);
        return back()->with('CommentCreateStatus', 'Comment created successfully');
    }
}
