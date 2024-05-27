<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    protected $fillable = [
        'id', 'post', 'user_id', 'username'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
        // ひとりに所属する意味
        // 単数系だからs付かない
    }

    public function posts()
    {
        return $this->belongsToMany(User::class, 'follows', 'following_id', 'followed_id');
    }
}
