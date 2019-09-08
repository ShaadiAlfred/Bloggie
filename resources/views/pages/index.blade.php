@extends('layouts.master')

@section('content')
	<div class="jumbotron text-center">
		<h1 class="display-3">Hello!</h1>
		<p>This is my blog.</p>

		@guest
			<p>
				<a href="/login" class="btn btn-success btn-lg" role="button">Login</a>
				<a href="/register" class="btn btn-secondary btn-lg" role="button">Register</a>
			</p>

			<a href="/posts" class="btn btn-primary btn-lg" role="button"><i class="fa fa-file-text-o" aria-hidden="true"></i>Read Posts</a>
		@endguest

		@auth
			<p>
				<a href="/home" class="btn btn-primary btn-lg" role="button">Your Posts</a>
			</p>
		@endauth
	</div>
@endsection