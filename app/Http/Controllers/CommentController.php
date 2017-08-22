<?php

namespace App\Http\Controllers;
use Auth;
use App\Comment;
use App\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index($id){


    return Post::find($id)->comments;
    
    }
    public function create(Request $request){
        $comment = Comment::create([
        'post_id'=>$request->post_id,
        'user_id'=>Auth::id(),
        'comment'=>$request->content
        ]);
        return Comment::find($comment->id);
    }
}
