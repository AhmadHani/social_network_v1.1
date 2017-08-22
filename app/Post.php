<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['user_id','body','status_id'];
    public $with = ['user','status','likes','comments'];
    public function user(){
        return $this->belongsTo("App\User");
    }
    public function status(){
        return $this->belongsTo("App\Status");
    }
    public function likes(){
        return $this->hasMany("App\Like");
    }
    public function comments(){
        return $this->hasMany("App\Comment");
    }
    }
