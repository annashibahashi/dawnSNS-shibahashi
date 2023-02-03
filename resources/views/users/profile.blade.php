@extends('layouts.login')

@section('content')

{{ Form::open(['url' => '/update','files'=>true])}}

<div class='profile'>
  <div class="p_left">
    <img src="{{ asset('/storage/images/'.$auth->images) }}" alt="" class="icon">
  </div>

  <div class='p_left'>
    {{ Form::label('username','Username') }}
  </div>
  <div class="p_right">
    {{ Form::text('username',$auth->username,['class'=>'username']) }}</li>
  </div>

  @if($errors->has('username'))
  <div class="error">
    <p>{{ $errors->first('username') }}</p>
  </div>
  @endif

  <div class="p_left">
    {{ Form::label('mail','MailAdress')}}
  </div>
  <div class="p_right">
    {{ Form::email('mail',$auth->mail,['class'=>'mail']) }}
  </div>

  @if($errors->has('mail'))
  <div class="error">
    <p>{{ $errors->first('mail') }}</p>
  </div>
  @endif

  <div class="p_left">
    {{ Form::label('password','Password') }}
  </div>
  <div class="p_right">
    {{ Form::input('password','password',$auth->password,['readonly' ,'class'=>'password']) }}
  </div>

  <div class="p_left">
    {{ Form::label('newpassword','Newpassword') }}
  </div>
  <div class="p_right">
    {{ Form::input('password','newpassword',null,['class' => 'input']) }}
  </div>

  @if($errors->has('newpassword'))
  <div class="error">
    <p>{{ $errors->first('newpassword') }}</p>
  </div>
  @endif

  <div class="p_left">
    {{ Form::label('bio','Bio')}}
  </div>
  <div class="p_right">
    {{ Form::textarea('bio',$auth->bio,['class'=>'bio']) }}
  </div>

  @if($errors->has('bio'))
  <div class="error">
    <p>{{ $errors->first('bio') }}</p>
  </div>
  @endif

  <div class="p_left">
    {{ Form::label('images','IconImage') }}
  </div>
  <div class="p_right">
    {{ Form::file('images',null,['class'=>'icon']) }}
  </div>

  @if($errors->has('images'))
  <div class="error">
    <p>{{ $errors->first('images') }}</p>
  </div>
  @endif

  <div class="p_right">
    {{ Form::submit('更新',['class'=>'up_btn']) }}
  </div>

</div>

{{ Form::close()}}


@endsection
