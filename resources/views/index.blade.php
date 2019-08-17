@extends('layouts.app')

@section('content')
<div class="container">
@if($message = Session::get('success'))
	<div class="alert alert-success">
		<p>{{ $message }}</p>
	</div>
@endif
<div class="row">
	<div class="col-md-6">
		<h1>Laravel 5.8 CRUD</h1>
	</div>
	<div class="col-md-4">
		<form action="/search" method="get">
			<div class="input-group">
				<input type="text" name="search" class="form-control">
				<span class="input-group-prepend">
					<button type="submit" class="btn btn-primary">Search</button>
				</span>
			</div>
		</form>
	</div>
	<div class="col-md-2 text-right">
		<a href="{{ action('PostController@create') }}" class="btn btn-primary">Add Data</a>
	</div>
</div>
<form method="post">
	@csrf
	@method('DELETE')
	<button type="submit" formaction="/deleteAll" class="btn btn-danger">Delete Selected</button>
<table class="table table-bordered">
	<thead>
		<tr>
			<th><input type="checkbox" class="selectAll"></th>
			<th>Name</th>
			<th>Detail</th>
			<th>Author</th>
			<th width="250">Actions</th>
		</tr>
	</thead>
	<tbody>
		@foreach($posts as $post)
		<tr>
			<td><input type="checkbox" name="ids[]" class="selectbox" value="{{ $post->id }}"></td>
			<td>{{ $post->name }}</td>
			<td>{{ $post->detail }}</td>
			<td>{{ $post->author }}</td>
			<td>
				<a href="{{ action('PostController@show', $post->id) }}" class="btn btn-info">Show</a>
				<a href="{{ action('PostController@edit', $post->id) }}" class="btn btn-warning">Edit</a>
				<button type="submit" formaction="{{ action('PostController@destroy', $post->id) }}" class="btn btn-danger">Delete</button>
			</td>
		</tr>

		@endforeach
	</tbody>
	<tfoot>
		<tr>
			<th><input type="checkbox" class="selectAll2"></th>
			<th>Name</th>
			<th>Detail</th>
			<th>Author</th>
			<th width="250">Actions</th>
		</tr>
	</tfoot>
</table>
</form>

{{$posts->links()}}

<script>
	$('.selectAll').click(function() {
		$('.selectbox').prop('checked', $(this).prop('checked'))
		$('.selectAll2').prop('checked', $(this).prop('checked'))
	});

	$('.selectAll2').click(function() {
		$('.selectbox').prop('checked', $(this).prop('checked'))
		$('.selectAll').prop('checked', $(this).prop('checked'))
	});

	$('.selectbox').change(function() {
		var total = $('.selectbox').length;
		var number = $('.selectbox:checked').length;
		if(total == number) {
			$('.selectAll').prop('checked', true);
			$('.selectAll2').prop('checked', true);
		}
		else {
			$('.selectAll').prop('checked', false);
			$('.selectAll2').prop('checked', false);
		}
	});
</script>
</div>

@endsection