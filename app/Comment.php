<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    
    protected $fillable=['comment','user_id','post_id'];
public $with = ['user'];
    public function user(){
        return $this->belongsTo("App\User");
    }

    public function post(){
        return $this->belongsTo("App\Post");
    }
}
