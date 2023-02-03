@extends('layouts.login')

@section('content')
<div class='other_top'>
  <div>
    <div id="icon_left">
      <img src="{{ asset('/storage/images/'.$user->images) }}" alt="" class="l_icon">
    </div>

    <div class="other_profile">
      <ul>
        <li class='others'>Name</li>
        <li>{{$user->username}}</li>
      </ul>
    </div>
  </div>

  <div class="other_profile">
    <ul>
      <li class='others'>Bio</li>
      <li>{{$user->bio}}</li>
    </ul>
  </div>

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
</div>

@foreach($posts as $post)
<div id="other_posts">
  <ul>
    <img src="{{ asset('/storage/images/'.$post->images) }}" alt="" class="l_icon">
    <li class='name'>{{$post->username}}</li>

    <li>{{$post->posts}}</li>

    <li>{{$post->created_at}}</li>
  </ul>
</div>
@endforeach

@endsection
