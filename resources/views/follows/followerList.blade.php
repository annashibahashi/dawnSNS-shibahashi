@extends('layouts.login')

@section('content')

<div id = 'icons'>
@foreach($icons as $icon)
  <a href="/other-profile/{{$icon->id}}">
    <img src="/storage/images/{{ $icon->images }}" alt="" class="icon">
  </a>
@endforeach
</div>

<div id = 'f_posts'>
@foreach($posts as $post)
  <ul>
    <a href="/other-profile/{{$icon->id}}">
      <img src="/storage/images/{{ $post->images }}" alt="" class="icon">
    </a>

    <li class = 'name'>{{$post->username}}</li>

    <li>{{$post->posts}}</li>

    <li>{{$post->p_created_at}}</li>
  </ul>
@endforeach
</div>

@endsection
