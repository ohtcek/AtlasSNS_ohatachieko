<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    //モデルをかく！2/26
    protected $fillable = ['following_id', 'followed_id'];

    protected $table = 'follows';
}
