@extends('layouts.logout')

@section('content')



{!! Form::open() !!}

<div id ='register'>
  <h2>新規ユーザー登録</h2>

  <div class = 'label'>
    {{ Form::label('ユーザー名') }}
  </div>

  {{ Form::text('username',null,['class' => 'new_user']) }}

  @if($errors->has('username'))
    <div class="error">
      <p>{{ $errors->first('username') }}</p>
    </div>
  @endif

  <div class = 'label'>
    {{ Form::label('メールアドレス') }}
  </div>

  {{ Form::text('mail',null,['class' => 'new_user']) }}

  @if($errors->has('mail'))
    <div class="error">
      <p>{{ $errors->first('mail') }}</p>
    </div>
  @endif

  <div class = 'label'>
    {{ Form::label('パスワード') }}
  </div>

  {{ Form::text('password',null,['class' => 'new_user']) }}

  @if($errors->has('password'))
    <div class="error">
      <p>{{ $errors->first('password') }}</p>
    </div>
  @endif

  <div class = 'label'>
    {{ Form::label('パスワード確認') }}
  </div>

  {{ Form::text('password_confirmation',null,['class' => 'new_user']) }}

  @if($errors->has('password_confirmation'))
    <div class="error">
      <p>{{ $errors->first('password_confirmation') }}</p>
    </div>
  @endif

  <div class = 'label'>
    {{ Form::submit('登録',['class'=>'register_btn']) }}
  </div>

  <p>
    <a href="/login">ログイン画面へ戻る</a>
  </p>

</div>
{!! Form::close() !!}



@endsection
