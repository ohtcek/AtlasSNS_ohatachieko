<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'mail', 'password', 'img_path'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function posts()
    {
        return $this->hasMany('App\Post');
        // 複数形だからsがつく
    }
    public function follows()
    // リレーション
    {
        // 多対多のやつ
        return $this->belongsToMany(User::class, 'follows', 'following_id', 'followed_id');
        // User::class、'follows'→中間テーブルの名前、
    }

    public function followers()
    // リレーション
    {
        // 多対多のやつ
        return $this->belongsToMany(User::class, 'follows', 'followed_id', 'following_id');
        // User::class、'follows'→中間テーブルの名前、
    }
    public function isFollowing($id)
    {
        return $this->follows()->where('followed_id', $id)->exists();
        // フォローしてるかどうかの判別
    }
}
