@extends('layouts.logout')

@section('content')

{!! Form::open() !!}


<div id = 'login'>
  <p>DAWNSNSへようこそ</p>

  <div class = 'label'>
    {{ Form::label('e-mail') }}
  </div>

  {{ Form::text('mail',null,['class' => 'login_user']) }}

  <div class = 'label'>
    {{ Form::label('password') }}
  </div>

  {{ Form::password('password',['class' => 'login_user']) }}

  <div class = 'label'>
    {{ Form::submit('ログイン',['class' => 'login_btn']) }}
  </div>

  <p>
    <a href="/register">新規ユーザーの方はこちら</a>
  </p>

</div>

{!! Form::close() !!}

@endsection
