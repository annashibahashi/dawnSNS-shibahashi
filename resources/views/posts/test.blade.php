@foreach($posts as $post)

<a>
  <img src="{{ asset('/storage/images/'.$post->images) }}" alt="" class="icon">
</a>

<p>{{$post->username}}</p>
<p>{{$post->posts}}</p>
<p>{{$post->created_at}}</p>

@endforeach
