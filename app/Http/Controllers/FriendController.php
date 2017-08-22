<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use App\User;
use App\Notifications\AddFriend;
use App\Notifications\AcceptFriend;
use Notification;
class FriendController extends Controller
{
    public function check($id){
        if(Auth::user()->is_friends_with($id)){
            return ['status'=>"friends"];
        }
        if(Auth::user()->has_pending_friend_request_from($id)){
            return ['status'=>"pending"];
        }
         if(Auth::user()->has_pending_friend_request_sent_to($id)){
            return ['status'=>"waiting"];
        }
        return ['status'=>0];
    }
    public function add_friend($id){
       $resp =  Auth::user()->add_friend($id);
            Notification::send(User::find($id),new AddFriend(Auth::user()));
            return $resp;
            }

    public function accept_friend($id){
     $resp =    Auth::user()->accept_friend($id);
        Notification::send(User::find($id),new AcceptFriend(Auth::user()));
        return $resp;
            }
}
