<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Follow;

class FollowsController extends Controller
{
    //
    public function followList()
    {

        // $username = User::withCount('follows.followList')->take(5)->get();
        $username = User::withCount('follows.followList')->take(5)->get();
        $username->likes('follows.followList')->count();
        dd($username);

        return view('follows.followList');
    }

    public function followerList()
    {

        // もしくは$username = User::withCount('follows.followerList')->take()->get();
        $username = User::withCount('follows.followerList')->take()->get();
        $username->likes('follows.followerList')->count();
        // take(5)とget()について・・・
        dd($username);

        return view('follows.followerList');
    }
}
