<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    protected $fillable = [
        'id', 'post', 'user_id'
    ];

    public function posts()
    {
        return $this->hasMany('App\posts');
    }
}
