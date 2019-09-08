@extends('layouts.master')

@section('title')
	{{ $post->title }}
@endsection

@section('content')
	<h1 class="display-3">{{ $post->title }}</h1>
	<div>
		@if($post->cover_image)
			<img src="{{ '/storage/'.$post->cover_image }}" class="mx-auto d-block img-fluid" alt="Cover Image">
			<br>
		@endif
		{!! $post->body !!}
	</div>
	<hr>
	<small>By:&nbsp;&nbsp;&nbsp;&nbsp;<a href="/users/{{ $post->user->id }}">{{ $post->user->name }}</a></small><br>
	<small>Written on {{ $post->created_at }}</small>
	<br>
	<br>
	{{-- @if(auth()->user()->owns($post)) --}}
	@can('update', $post)
		<div>
			<a class="btn btn-primary" href="/posts/{{ $post->title }}/edit" role="button">Edit</a>
			{{-- {!! Form::open(['action' => ['PostsController@destroy', $post->title], 'method' => 'POST', 'class' => 'float-right']) !!}
				{{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
				{{ Form::hidden('_method', 'DELETE') }}
			{!! Form::close() !!} --}}

		</div>
	@endcan
	{{-- @endif --}}
	<hr>
	<div>
		<a class="btn btn-default" href="/posts" role="button">Back</a>
	</div>
@endsection