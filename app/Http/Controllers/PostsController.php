<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Auth;
use App\User;

class PostsController extends Controller
{
    //

    public function index(Request $request)
    {
        $posts = Post::orderBy('updated_at', 'desc')->get();
        return view('posts.index', ['posts' => $posts]);
        // ['posts' => $posts]で、投稿を表示させるforeach構文の@foreach ($posts as $post)の$posts部分を定義
        // かりきゅらむにも書いてる(booksのあたり)

        // $books = Book::get(); //Bookモデル（booksテーブル）からレコード情報を取得
        // return view('books.index', ['books' => $books]);
    }

    public function followList()
    {
        // compact('posts')でコントローラーで受け取った値をbladeに受け渡す際に使う
        // 今回ここを開いているページは/follow-listなので、
        // web.phpを見ると、Route::get('/follow-list', 'PostsController@follow');
        // →PostControllerを使っているのでここに記載する
        $following_id = Auth::user()->follows()->pluck('followed_id');
        $posts = Post::with('user')->whereIn('user_id', $following_id)->get();
        $icons = User::whereIn('id', $following_id)->get();

        // postモデルのuserメソッドを持ってきてるやつのuser
        // 取得したいテーブルのカラム名user_id

        // フォローしているユーザーのidを元に投稿内容を取得
        // $posts = Post::with('user')->whereIn(' ② ', $following_id)->get();

        return view('follows.followList', compact('posts', 'icons'));
        // これでフォローリストのbladeに表示される
    }



    public function followerList()
    {
        $following_id = Auth::user()->followers()->pluck('following_id');
        $posts = Post::with('user')->whereIn('user_id', $following_id)->get();
        $icons = User::whereIn('id', $following_id)->get();
        return view('follows.followerList', compact('posts', 'icons'));
        // ここも上のfollowと同じ
    }

    public function postCreate(Request $request)
    {
        $request->validate(
            [
                'post' => 'required|max:150'
            ],
            [
                'post.max' => '投稿内容は150文字以内です。'
            ]
        );

        $post = $request->input('post');
        Post::create([
            'user_id' => Auth::id(),
            'post' => $post
            // ログインしてる人の投稿を取りたいやつ
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
        if ($request->isMethod('post')) {
            // postで受け取った場合の処理

            $post = $request->input('post');

            $request->validate(
                [
                    'post' => 'required|max:150'
                ],
                [
                    'post.required' => '投稿を入力して下さい。',
                    'post.max' => '投稿内容は150文字以内です。'
                ]
            );

            // dd($request);
            $id = $request->input('id');
            $post = $request->input('post');
            Post::where('id', "=", $id)->update([
                // 等しいははしょれる
                'post' => $post,
            ]);
            return redirect('/top');
            // redirectは指定したルーティングに行く
        }
    }

    public function delete($id)
    {
        Post::where('id', $id)->delete();
        return redirect('/top');
    }

    public function show()
    {
        $following_id = Auth::user()->follows()->pluck('following_id');
        dd($following_id);
        $posts = Post::with('user')->whereIn(' ② ', $following_id)->get();

        // フォローしているユーザーのidを元に投稿内容を取得
        // $posts = Post::with('user')->whereIn(' ② ', $following_id)->get();

        return view('yyyy', compact('posts'));
    }
}
