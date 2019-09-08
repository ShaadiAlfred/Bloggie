@extends('layouts.master')

@section('title', 'Create Post')

@section('content')
	<h1>Create Post</h1>

	{!! Form::open(['action' => 'PostsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}

		<div class="form-group">
	    	{{ Form::label('title', 'Title') }}
	    	{{ Form::text('title', '', [
	    		'class' => 'form-control form-control-lg',
	    		'placeholder' => 'Title',
	    		'required' => true,
	    		'autofocus' => true
	    		]) }}
		</div>

		<div class="form-group">
	    	{{ Form::label('body', 'Body') }}
	    	{{ Form::textarea('body', '', [
	    		'id' => 'summernote',
	    		'name' => 'body',
	    		'class' => 'form-control',
	    		'required' => true
	    		]) }}
    		{{-- <div id="summernote">Hello Summernote</div> --}}

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

	{!! Form::close() !!}

@include('inc.editor')
@endsection