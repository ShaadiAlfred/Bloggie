@extends('layouts.master')

@section('title', 'Users')

@section('content')
	<h1>Users</h1>
	<table class="table table-striped table-dark table-hover table-responsive-sm">
	  <thead>
	    <tr>
	      <th scope="col">ID</th>
	      <th scope="col">Full Name</th>
	      <th scope="col">Email</th>
	      <th scope="col">Posts</th>
	      <th scope="col">Edit User</th>
	      <th scope="col">Delete</th>
	    </tr>
	  </thead>
	  <tbody>
	  	@foreach ($users as $user)
		  	<tr>
		  	  <th scope="row">{{ $user->id }}</th>
		  	  <td>{{ $user->name }}</td>
		  	  <td>{{ $user->email }}</td>
		  	  <td><a href="users/{{ $user->id }}">{{ count($user->posts) }}</a></td>
		  	  <td><a href="users/{{ $user->id }}/edit" class="btn btn-secondary">Edit</a></td>
		  	  <td>
		  	  	{!! Form::open(['action' => ['UsersController@destroy', $user->id], 'method' => 'POST']) !!}
					{{ Form::submit('Delete', ['class' => 'btn btn-danger',
											   'onclick' => "return confirm('Are you sure you want to delete this user and his posts?');"
					]) }}
					{{ Form::hidden('_method', 'DELETE') }}
		  	  	{!! Form::close() !!}
		  	  </td>
		  	</tr>
	  	@endforeach
	  </tbody>
	</table>

@endsection