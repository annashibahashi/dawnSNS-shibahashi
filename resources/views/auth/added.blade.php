@extends('layouts.logout')

@section('content')


<div id="clear">
  <p>{{session('name')}}さん、</p>
  <p>ようこそ！DAWNSNSへ！</p>
<br>
<br>
  <p>ユーザー登録が完了しました。</p>
  <p>さっそく、ログインをしてみましょう。</p>
<br>
<br>
<br>
  <p>
    <a class="added_btn" href="/login">ログイン画面へ</a>
  </p>
</div>


@endsection
