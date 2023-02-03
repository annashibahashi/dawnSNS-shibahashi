@extends('layouts.login')

@section('content')

{{ Form::open(['url' => '/search'])}}
{{ Form::text('search',null,['class'=>'search_form','placeholder'=>'ユーザー名'])}}
{{ Form::button('<i class="fas fa-search">検索</i>',['class' => "search",'type' => 'submit'])}}
{{ Form::close()}}

@if(isset($search))
<p>検索ワード:{{$search}}</p>
@endif

<table>
  @foreach($users as $user)
  <tr>
    <td>
      <img src="{{ asset('/storage/images/'.$user->images) }}" alt="" class="icon">
    </td>

    <td>{{$user->username}}</td>

    <td>
      @if($user->id != $auth->id)
      @if($followings->contains('follow',$user->id))

      <form action="/unfollow" method="post">
        @csrf
        <input type="hidden" value="{{ $user->id }}" name="unfollow">
        <input type="submit" value="フォローをはずす" class="unf_btn">

      </form>
      @else
      <form action="/follow" method="post">
        @csrf
        <input type="hidden" value="{{ $user->id }}" name="follow">
        <input type="submit" value="フォローする" class="f_btn">
      </form>
      @endif
      @endif
    </td>
  </tr>
  @endforeach
</table>



@endsection
