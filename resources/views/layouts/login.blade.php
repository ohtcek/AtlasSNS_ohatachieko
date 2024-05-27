<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <!--IEブラウザ対策-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="ページの内容を表す文章" />
    <title></title>
    <link rel="stylesheet" href="{{ asset('css/reset.css') }} ">
    <link rel="stylesheet" href="{{ asset('css/style.css') }} ">
    <!--スマホ,タブレット対応-->
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <!--サイトのアイコン指定-->
    <link rel="icon" href="画像URL" sizes="16x16" type="image/png" />
    <link rel="icon" href="画像URL" sizes="32x32" type="image/png" />
    <link rel="icon" href="画像URL" sizes="48x48" type="image/png" />
    <link rel="icon" href="画像URL" sizes="62x62" type="image/png" />
    <!--iphoneのアプリアイコン指定-->
    <link rel="apple-touch-icon-precomposed" href="画像のURL" />
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    <!--OGPタグ/twitterカード-->
</head>

<body>
    <header>
        <div id="head">
            <h1><a href="{{URL::to('/top')}}"><img class="logo" src="{{ asset('/images/atlas.png') }}" alt="Atlasロゴ"></a></h1>
            <!-- 相対ぱすコピーするとpublic/ついてくるけどいらない -->
            <div id="">
                <div id="">
                    <div class="user-info">
                        <p class="username">
                            @if (Auth::check())
                            <!-- ログインしてたら表示されるの意味のif。ログインしてなかったら表示されない -->
                            {{ Auth::user()->username }}
                            @endifさん
                        </p>

                        <div class="accordion-menu">
                            <p class="accordion">V</p>
                            <ul class="menu">
                                <li><a class="link" href=" /top">HOME</a></li>
                                <li><a class="link" href="/profile/{{ Auth::user()->id }}">プロフィール編集</a></li>
                                <li><a class="link" href=" /logout">ログアウト</a></li>
                                <!-- 送り先リンクは/logoutだけど、実際は/logoutは目に見えない。けど処理として送る -->
                            </ul>
                        </div>
                        <img class="user-icon" src="{{ Storage::url( Auth::user()->images) }}" alt="ユーザーアイコン">
                        <!-- 相対ぱすコピーするとpublic/ついてくるけどいらない -->
                    </div>
                </div>

    </header>

    <div id="row">

        <div id="container">
            @yield('content')
        </div>

        <div id="side-bar">
            <div id="confirm">
                <p class="count">@if (Auth::check())
                    <!-- ログインしてたら表示されるの意味のif。ログインしてなかったら表示されない -->
                    {{ Auth::user()->username }}
                    @endifさんの<br>
                </p>
                <br>
                <div>
                    <div class="count">
                        <p class="count-about">フォロー数</p>
                        <p>{{ Auth::user()->follows->count() }}</p>
                        <!--countの時は最後にcount() -->
                        <p>人</p>
                    </div>
                    <p class="btn"><a class="btn-link" href="/follow-list">フォローリスト</a></p>
                    <div class="count">
                        <p class="count-about">フォロワー数
                        <p>{{ Auth::user()->followers->count() }}</p>
                        <p>人</p>
                    </div>
                    <p class="btn"><a class="btn-link m-40" href="/follower-list">フォロワーリスト</a></p>
                </div>
            </div>
            <p class="search"><a class="search-link" href="/search">ユーザー検索</a></p>
            <!-- ユーザー検索の場所　迷子 元は<div id=" side-bar">の中だったけど出した　違う？-->
        </div>


    </div>
    </div>
    </div>

    <footer>
    </footer>
    <script src="JavaScriptファイルのURL"></script>
    <script src="JavaScriptファイルのURL"></script>
</body>

</html>
