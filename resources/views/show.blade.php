@extends('layouts.app')

@section('content')
<div class="container">
<div class="card" style="width:350px;">
@foreach($posts as $post)
  <img src="https://via.placeholder.com/350x150?text={{ $post->author}}" class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">{{$post->name}}</h5>
    <p class="card-text">{{$post->detail}}</p>
    <a href="{{ action('PostController@index') }}" class="btn btn-primary">Go Back</a>
  </div>
  @endforeach
</div>
</div>




@endsection