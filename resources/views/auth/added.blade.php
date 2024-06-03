@extends('layouts.logout')

@section('content')
<div class="added">
  <div id="clear">
    <p class="added-bold font-big m-20">{{session('username')}}さん</p>
    <!-- セッションの利用。RegisterControllerにメモ記載 -->
    <p class="added-bold m-40">ようこそ！AtlasSNSへ！</p>
    <p class="added-lighter  m-20">ユーザー登録が完了いたしました。</p>
    <p class="added-lighter m-30">早速ログインをしてみましょう。</p>

    <p class="btn"><a href="/login">ログイン画面へ</a></p>
  </div>
</div>
@endsection
