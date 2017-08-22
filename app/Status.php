<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $fillable = ['status_id'];
    public function posts(){

        return $this->hasMany("App\Post");
    }
}
