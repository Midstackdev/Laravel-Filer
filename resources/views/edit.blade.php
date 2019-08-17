@extends('layouts.app')

@section('content')
<div class="container">
<div class="row">
	<div class="col-md-6 offset-3">
		@if($errors->any())
			<div class="alert alert-danger">
				<ul>
					@foreach($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif
		@foreach($posts as $post)
		<form action="{{ action('PostController@update', $post->id) }}" method="post">
			@csrf
			@method('PUT')
			<div class="form-group">
				<label>Name</label>
				<input class="form-control" type="text" name="name" placeholder="Mark Fields" value="{{ $post->name }}">
			</div>
			<div class="form-group">
				<label>Details</label>
				<textarea class="form-control" type="text" name="detail" placeholder="Detail">{{ $post->detail }}</textarea>
			</div>
			<div class="form-group">
				<label>Author</label>
				<input class="form-control" type="text" name="author" placeholder="writer" value="{{ $post->author }}">
			</div>
			<button type="submit" class="btn btn-primary">Submit</button>
			<a href="{{ action('PostController@index') }}" class="btn btn-default">Back</a>
		</form>
		@endforeach
	</div>
</div>
</div>


@endsection