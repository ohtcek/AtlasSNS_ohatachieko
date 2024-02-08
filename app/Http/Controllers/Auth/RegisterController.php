<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function register(Request $request)
    // ルーティング→メソッドregister
    // formで入力されたusernameやmailが$requestに入る
    {
        if ($request->isMethod('post')) {
            // postで受け取った場合の処理

            $username = $request->input('username');
            $mail = $request->input('mail');
            $password = $request->input('password');

            $request->validate(
                [
                    'username' => 'required|min:2|max:12',
                    'mail' => 'required|email|min:5|max:40|unique:posts',
                    'password' => 'required|min:8|max:20'
                ],
                [
                    'username.required' => '名前は必須項目です。',
                    'username.min' => '名前は2文字以上必要です。',
                    'username.max' => '名前は12文字以下で入力して下さい。。',
                    'mail.required' => 'メールアドレスは必須項目です。',
                    'mail.email' => 'メールアドレス形式で入力して下さい。',
                    'mail.min' => 'メールアドレスは5文字以上必要です。',
                    'mail.max' => 'メールアドレスは40文字以下で入力して下さい。',
                    'mail.unique:posts' => 'メールアドレスが重複しています。',
                    'password.required' => 'パスワードは必須項目です。',
                    'password.min' => 'パスワードは8文字以上必要です',
                    'password.max' => 'パスワードは20文字以下で入力して下さい。'
                ]
            );

            User::create([
                'username' => $username,
                'mail' => $mail,
                'password' => bcrypt($password),
            ]);

            return redirect('added')->with('username', $username);
            // returnで、成功していたらaddedに移行する。logincontrollerにも書いてるけどリダイレクトの時はURL、viewの時はbladeファイル(auth.はディレクトリ)を()内にかく
            // ->~~はセッションの文。上記withは()の中のを保存して受け渡す処理('key','value')。これを書いたら、
            // 送り先の表示したいviewで{{session('username')}}と記載すれば表示される。('key')

            $request->session()->put('username', $username);
        }
        // ここまでがpost処理の場合のif文
        return view('auth.register');
        // 青}までがpostのif文で、このreturnがgetの場合の処理文
    }

    public function added()
    {
        return view('auth.added');
    }
}
