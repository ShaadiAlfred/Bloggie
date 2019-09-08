@extends('layouts.master')

@section('title', 'Posts')

@section('content')
	<h1>Posts</h1>

	@if(count($posts))
		@foreach ($posts as $post)
			<div class="card border-secondary w-75 mx-auto">
				@if($post->cover_image)
				  <a href="/posts/{{ $post->title }}"><img src="{{ 'storage/'.$post->cover_image }}" class="card-img-top" alt="Cover Image"></a>
				@endif
			    <div class="card-body" style="padding: 10px">
			  		<a href="/posts/{{ $post->title }}"><h4 class="text-center" style="margin-bottom: 0px">{{ $post->title }}</h4></a>
			  	</div>
			  	<div class="card-footer" style="padding-top: 5px; padding-bottom: 5px">
			  		<h6 class="card-subtitle mb-2 text-muted float-left" style="margin-top: 0px; margin-bottom: 0px !important">By:&nbsp;&nbsp;&nbsp;&nbsp;{{ $post->user->name }}</h6>
			  		<small class="float-right">Written on {{ $post->created_at }}</small>
			  	</div>
			</div>
			<br>
		@endforeach
		<div class="d-flex justify-content-center">
			{{ $posts->links() }}
		</div>
	@else
		<p>No posts yet!</p>
	@endif



	<div>
		<a class="btn btn-primary" href="/posts/create" role="button"><i class="fa fa-plus" aria-hidden="true"></i> Add Post</a>
	</div>
@endsection