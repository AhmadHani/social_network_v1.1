<?php


namespace App\Traits;
use App\Friend;
trait Friendable
{
    public function add_friend($user_requested_id)
    {
        if ($this->id === $user_requested_id) {
            return 0;
        }
        if($this->is_friends_with($user_requested_id) === 1){
            return "already friends";
        }
        if ($this->has_pending_friend_request_sent_to($user_requested_id) === 1) {
            return "already send a friend request";
        }
        if ($this->has_pending_friend_request_from($user_requested_id) === 1) {
            return $this->accept_friend($user_requested_id);
        }

        $Friend = Friend::create([
            'requester' => $this->id,
            'user_requested' => $user_requested_id

        ]);

        if ($Friend) {
            return 1;
        }
        return 0;
    }

    public function accept_friend($requester)
    {
        if ($this->has_pending_friend_request_from($requester) === 0) {
            return 0;
        }
        $friend = Friend::where("requester", $requester)->where("user_requested", $this->id)->first();
        if ($friend) {
            $friend->update([
                'status' => 1
            ]);
            return response()->json($friend, 200);
        }
        return response()->json("fail", 501);
    }

    public function friends()
    {
        $friends = [];

        $f1 = Friend::where("status", 1)->where("requester", $this->id)->get();

        foreach ($f1 as $friend) {
            array_push($friends, \App\User::find($friend->user_requested));
        }

        $friends2 = [];

        $f2 = Friend::where("status", 1)->where("user_requested", $this->id)->get();

        foreach ($f2 as $friend) {
            array_push($friends2, \App\User::find($friend->requester));
        }
        return array_merge($friends, $friends2);
    }

    public function pending_friend_requests()
    {
        $users = [];

        $friends = Friend::where("status", 0)->where("user_requested", $this->id)->get();

        foreach ($friends as $friend) {
            array_push($users, \App\User::find($friend->requester));

        }
        return $users;
    }

    public function friends_ids()
    {
        return collect($this->friends())->pluck("id")->toArray();
    }

    public function is_friends_with($user_id)
    {

        if (in_array($user_id, $this->friends_ids())) {
            return 1;
        }
        return 0;
    }

    public function pending_friend_requests_ids()
    {
        return collect($this->pending_friend_requests())->pluck("id")->toArray();
    }

    public function pending_friend_requests_sent()
    {
        $users = array();
        $friends = Friend::where('status', 0)
            ->where('requester', $this->id)
            ->get();
        foreach ($friends as $friend):
            array_push($users, \App\User::find($friend->user_requested));
        endforeach;
        return $users;
    }

    public function pending_friend_requests_sent_ids()
    {
        return collect($this->pending_friend_requests_sent())->pluck('id')->toArray();
    }

    public function has_pending_friend_request_from($user_id)
    {
        if (in_array($user_id, $this->pending_friend_requests_ids())) {
            return 1;
        } else {
            return 0;
        }
    }

    public function has_pending_friend_request_sent_to($user_id)
    {
        if (in_array($user_id, $this->pending_friend_requests_sent_ids())) {
            return 1;
        } else {
            return 0;
        }
    }
}