<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class UsersController extends Controller
{
    //
    public function profile($id)
    {
        $users = User::find($id);
        // dd($users);
        // テーブルをもってくるぶん
        return view('users.profile', compact('users'));
    }
    public function search(Request $request)
    {
        if ($request->isMethod('post')) {

            // if文　検索をした時の処理
            // 自分以外を表示させるやり方　!=で〜以外 ここではログイン認証している人以外の意味
            $keyword = $request->input('keyword');
            $users = User::where('username', 'like', '%' . $keyword . '%')->where('id', "!=", Auth::user()->id)->get();
            return view('users.search', compact('users', 'keyword'));
            // return view('users.search', ['users' => $users], ['keyword' => $keyword]);←同じ！
            // 検索処理した場合のreturn　['users'=$users];(compactと同じ意味)
        }
        //
        $users = User::where('id', "!=", Auth::user()->id)->get();
        return view('users.search', compact('users'));
        // 上2行はpost処理じゃなかった場合＝get
        // compactはbladeに$usersを渡す文
        // 他のページから検索ボタンを押した場合の処理？？
    }

    public function index(Request $request)
    {
        return view('users.search');
    }


    public function update(Request $request)
    {
        $username = $request->input('username');
        $mail = $request->input('mail');
        $password = $request->input('password');
        $bio = $request->input('bio');
        $id = $request->input('id');
        // dd($request);
        $request->validate(
            [
                'username' => 'required|min:2|max:12',
                'mail' => 'required|email|min:5|max:40|unique:users,mail,' . Auth::id(),
                // unique:テーブル名,カラム名,除外ID,IDカラム名
                // unique:users→間違ったやつ　usersテーブルの中で同じものは登録できないの意味　違うテーブル名にするとエラーが出る
                // unique:users->ignore(Auth::id())'はログインしているユーザーは除いて重複不可の文
                'password' => 'required|min:8|max:20|confirmed',
                'bio' => 'max:150',
                'img_path' => 'image|mimes:jpeg,png,gif,bmp,svg'
            ],
            [
                'username.required' => '名前は必須項目です。',
                'username.min' => '名前は2文字以上必要です。',
                'username.max' => '名前は12文字以下で入力して下さい。',
                'mail.required' => 'メールアドレスは必須項目です。',
                'mail.email' => 'メールアドレス形式で入力して下さい。',
                'mail.min' => 'メールアドレスは5文字以上必要です。',
                'mail.max' => 'メールアドレスは40文字以下で入力して下さい。',
                'mail.unique:users' => 'メールアドレスが重複しています。',
                'password.required' => 'パスワードは必須項目です。',
                'password.min' => 'パスワードは8文字以上必要です',
                'password.max' => 'パスワードは20文字以下で入力して下さい。',
                'password.confirmed' => 'パスワードが一致していません。',
                'img_path.mimes' => 'アップロード可能な画像形式はjpeg,png,gif,bmp,svgです。'
            ]
        );

        User::where('id', "=", $id)->update([
            // // 等しいははしょれる
            'username' => $username,
            'mail' => $mail,
            'password' => bcrypt($password),
            'bio' => $bio
        ]);

        if ($request->hasFile('img_path')) {
            $img = $request->file('img_path')->getClientOriginalName();
            // ファイル名を取ってくる処理
            $request->file('img_path')->storeAs('public/', $img);
            // storeAsで保存するやつ 指定した名前
            User::where('id', "=", $id)->update([
                'images' => $img
            ]);
            // imagesはカラムの名前

            // 変数に送られてきたファイルの名前のまま保存
            // 画像本体をpublic/storage下に保存する
            // カラムの名前を更新したい名前に変更する
        }

        // 画像フォームでリクエストした画像情報を取得
        // $img = $request->file('img_path');
        // $path = $img->store('storage', 'public');
        // User::updateOrCreate()([
        //     'img_path' => $path,
        // ]);

        return redirect('/top');
    }
}
