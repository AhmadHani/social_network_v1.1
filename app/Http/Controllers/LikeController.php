<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Post;
use App\Like;
class LikeController extends Controller
{
    public function like($id){
        $post = Post::find($id);
        $like = Like::create([
            'user_id'=>Auth::id(),
            'post_id'=>$post->id
        ]);
        return Like::find($like->id);
    }
    public function unlike($id){
        $like = Like::where("post_id",$id)->where("user_id",Auth::id())->first();
        if($like){
            $like->delete();
            return $like->id;
        }else{
            return redirect()->back();
        }
    }
    public function count($id){
        $likes = Like::where("post_id",$id)->get();
        return count($likes);
    }
}
