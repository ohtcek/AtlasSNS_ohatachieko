<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Auth;

class PostsController extends Controller
{
    //

    public function index(Request $request)
    {
        $posts = Post::get();
        return view('posts.index', ['posts' => $posts]);
        // ['posts' => $posts]で、投稿を表示させるforeach構文の@foreach ($posts as $post)の$posts部分を定義
        // かりきゅらむにも書いてる(booksのあたり)

        // $books = Book::get(); //Bookモデル（booksテーブル）からレコード情報を取得
        // return view('books.index', ['books' => $books]);
    }

    public function follow(Request $request)
    {
        return view('follows.followList');
    }

    public function follower(Request $request)
    {
        return view('follows.followerList');
    }

    public function postCreate(Request $request)
    {

        $request->validate(
            [
                'post' => 'required|max:150'
            ]
            // あとでバリデーション日本語追加する
        );

        $post = $request->input('post');
        Post::create([
            'user_id' => Auth::user()->id,
            'post' => $post
        ]);
        return redirect('/top');
        // post通信の時はreturn redirectで覚える！
        // 処理したものはRoute::get('/top', 'PostsController@index');に戻る！！！
    }

    // public function show()
    // {
    //     $post = Post::get(); //Bookモデル（booksテーブル）からレコード情報を取得
    //     return view('posts.index', ['post' => $post]);
    // }いらないやつ　表示用で作った

    public function update(Request $request)
    {
        // dd($request);
        $id = $request->input('id');
        $post = $request->input('post');
        Post::where('id', $id)->update([
            'post' => $post,
        ]);
        return redirect('/top');
        // redirectは指定したルーティングに行く
    }


    public function delete($id)
    {
        Post::where('id', $id)->delete();
        return redirect('/top');
    }
}
