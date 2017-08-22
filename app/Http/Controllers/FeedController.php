<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
class FeedController extends Controller
{
    public function feed(){
        $friends = Auth::user()->friends();

        $feed = [];

        foreach($friends as $friend){
            foreach($friend->posts as $post){
                array_push($feed,$post);
            }
        }
        foreach(Auth::user()->posts as $posts){
            array_push($feed,$posts);
        }
        usort($feed,function($f1,$f2){
            return $f1->id < $f2->id;
        });
        return $feed;
    }
    public function my_posts(){
 $my_posts = [];
        foreach(Auth::user()->posts as $posts){
            array_push($my_posts,$posts);
        }
        return $my_posts;
    }
}
