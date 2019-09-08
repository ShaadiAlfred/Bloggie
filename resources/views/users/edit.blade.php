@extends('layouts.master')

@section('title', $user->name)

@section('content')
    <h1>{{ $user->name }}</h1>
    {!! Form::open(['action' => ['UsersController@update', $user->id], 'method' => 'POST']) !!}

        <div class="form-group row">
            {{ Form::label('name', 'Name', ['class' => 'col-sm-2 col-form-label']) }}
            <div class="col-sm-10">
                {{ Form::text('name', $user->name, [
                    'class' => 'form-control',
                    'required' => true
                    ]) }}
            </div>
        </div>

        <div class="form-group row">
            {{ Form::label('email', 'Email', ['class' => 'col-sm-2 col-form-label']) }}
            <div class="col-sm-10">
                {{ Form::text('email', $user->email, [
                    'class' => 'form-control',
                    'type' => 'email',
                    'required' => true
                    ]) }}
            </div>
        </div>
        
        <div class="form-group row">
            {{ Form::label('password', 'Password', ['class' => 'col-sm-2 col-form-label']) }}
            <div class="col-sm-10">
                {{ Form::password('password', [
                    'class' => 'form-control',
                    'placeholder' => 'New Password',
                    ]) }}
            </div>
        </div>
        
        <div class="form-group row">
		    <div class="col text-center">
                {{ Form::submit('Update', ['class' => 'btn btn-primary center-block']) }}
                    {{ Form::hidden('_method', 'PUT') }}
                {!! Form::close() !!}
            </div>
            <div class="col text-center">
                {!! Form::open(['action' => ['UsersController@destroy', $user->id], 'method' => 'POST']) !!}
					{{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
					{{ Form::hidden('_method', 'DELETE') }}
		  	  	{!! Form::close() !!}
            </div>  
  		</div>
		
	
@endsection