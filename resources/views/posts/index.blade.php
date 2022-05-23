@extends('layouts.login')

@section('content')
{{ Form::open(['url' => '/post/create'])}}
{{ Form::text('posts',null,['class'=>'form-control','placeholder'=>'何をつぶやこうか…？'])}}
{{ Form::button('<i class="fas fa-paper-plane"></i>',['class' => "btn",'type' => 'submit'])}}
{{ Form::close()}}

@foreach($posts as $post)
  <tr>
    <td>{{ $post->posts }}</td>
  </tr>
@endforeach
@endsection
