@extends('layouts.app')

@section('content')
<div class="container">
	@if(session('success'))
		<div class="alert alert-success">
			<strong>{{ session('success') }}</strong>
		</div>
	@endif
	<p>
		<a href="{{ route('makeFile') }}" class="btn btn-outline-primary">Upload A new file</a>
	</p>
	<div class="row">
		@foreach($files as $file)
		<div class="col-md-4">
			<div class="card" style="width: 20rem;">
			  <img src="{{ Storage::url($file->path) }}" class="card-img-top" alt="...">
			  <div class="card-body">
			  	<strong class="card-title">{{ $file->title }}</strong>
			    <span class="card-text">{{ $file->created_at->diffForHumans() }}</span>
			    <p class="card-text">{{ $file->description }}</p>
			    <div class="row">
				    <form action="{{ route('deleteFile', $file->id) }}" method="post">
				    	@csrf
				    	@method('DELETE')
				    	<button type="submit" class="btn btn-danger">Delete</button>
				    	<a href="{{ route('downloadFile', $file->id) }}" class="btn btn-success">Download</a>
				    	<a href="{{ route('emailFile', $file->id) }}" class="btn btn-primary">E-Mail</a>
				    </form>
			    </div>
			  </div>
			</div>
		</div>
		@endforeach
	</div>
</div>

@endsection