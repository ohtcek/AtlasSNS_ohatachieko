<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Follow;
use Auth;
use App\User;
use App\Post;

class FollowsController extends Controller
{
    public function follow($id)

    {
        $myid = Auth::user();
        // 自分　フォローする側
        $is_following = $myid->isfollowing($id);
        // dd($isfollowing);
        if (!$is_following) {
            $myid->follows()->attach($id);
            // followsはUserモデルのメソッド名
            return back();
        }
    }
    public function unfollow($id)
    {
        $myid = Auth::user();
        // 自分　フォローする側
        $is_following = $myid->isfollowing($id);
        if ($is_following) {
            $myid->follows()->detach($id);
            // followsはUserモデルのメソッド名
            return back();
        }
    }

    public function followUser($id)
    {
        $user = User::find($id);
        $posts = Post::where('user_id', "=", $id)->get();
        // dd($users);
        // テーブルをもってくるぶん
        return view('users.userProfile', compact('user', 'posts'));
    }
}
