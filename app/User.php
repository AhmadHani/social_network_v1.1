<?php

namespace App;
use Storage;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Traits\Friendable;
class User extends Authenticatable 
{
    use Friendable;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','username','avatar','gender'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    Public function getAvatarAttribute($avatar){
        return asset(Storage::url($avatar));
    }
    public function profile(){
        return $this->hasOne("App\Profile");
    }
    public function posts(){
        return $this->hasMany("App\Post");
    }
    public function likes(){
        return $this->hasMany("App\Like");
    }
    public function comments(){
        return $this->hasMany("App\Comment");
    }
}
