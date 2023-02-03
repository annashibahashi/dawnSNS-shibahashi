@extends('layouts.login')

@section('content')
{{ Form::open(['url' => '/create'])}}
{{ Form::text('posts',null,['class'=>'form-control','placeholder'=>'何をつぶやこうか…？'])}}
<input type="image" src="/storage/images/post.png" alt="送信">
{{ Form::close()}}

@foreach($posts as $post)

<div class='post'>
  <ul>
    <li>
      <a>
        <img src="{{ asset('/storage/images/'.$post->images) }}" alt="" class="icon">
      </a>
    </li>

    <li class='post_name'>{{ $post->username }}</li>

    <li class='post_posts'>{{ $post->posts }}</li>

    <li class='post_create'>{{ $post->created_at }}</li>

    <div class='posts_btn'>

      @if($auth->id == $post->user_id)
      <div class='modalopen' data-target="{{$post->id}}">
        <img class='edit_btn' src="{{asset('/storage/images/edit.png')}}" alt="更新">
      </div>

      <div class='modal' id="{{$post->id}}">
        <div class='modal_form'>
          <div class='modal-content'>
            <form class='form' action="/post/update" method="post">

              @csrf
              <input type="hidden" name="id" value="{{$post->id}}">
              <input class='up_post' type="textarea" name="up_post" value="{{$post->posts}}">

              <button class='editin_btn' type="submit">
                <img src="{{asset('/storage/images/edit.png')}}" alt="更新">
              </button>

            </form>
          </div>
        </div>
      </div>
    </div>

    <a href="/post/{{$post->id}}/delete" onclick="return confirm('こちらの投稿を削除してもよろしいでしょうか？')">
      <img class='del_btn' src="{{asset('/storage/images/trash_h.png')}}" alt="削除">
    </a>

    @else

    @endif
  </ul>
</div>

@endforeach
@endsection
