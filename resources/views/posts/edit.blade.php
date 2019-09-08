@extends('layouts.master')

@section('title', 'Edit Post')


@section('content')
	<h1>Edit Post</h1>

	{!! Form::open(['action' => ['PostsController@update', $post->title], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}

		<div class="form-group">
	    	{{ Form::label('title', 'Title') }}
	    	{{ Form::text('title', $post->title, [
	    		'class' => 'form-control form-control-lg',
	    		'required' => true,
	    		'autofocus' => true
	    		]) }}
		</div>

		<div class="form-group">
	    	{{ Form::label('body', 'Body') }}
	    	{{ Form::textarea('body', $post->body, [
	    		'id' => 'summernote',
	    		'name' => 'body',
	    		'class' => 'form-control',
	    		'required' => true
	    		]) }}
		</div>

		<div class="form-group">
	    	{{ Form::label('cover_image', 'Cover Image', ['for' => 'cover_image']) }}
	    	{{ Form::file('cover_image', ['class' => 'form-control-file']) }}
		</div>
		<div class="row">
		    <div class="col text-center">
		    	{{ Form::submit('Submit', ['class' => 'btn btn-primary center-block']) }}
  			</div>
  		</div>
		{{ Form::hidden('_method', 'PUT') }}
	{!! Form::close() !!}

@include('inc.editor')
@endsection

