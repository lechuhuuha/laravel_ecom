<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    //
    public function index()
    {
        return view('admin.comments.index', ['comments' => Comment::paginate(5)]);
    }
    public function delete(Comment $comment)
    {
        $comment->delete();
        return redirect()->route('admin.comments.index');

    }
}
