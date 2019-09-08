@extends('layouts.master')

@section('title')
    {{ $user->name }}
@endsection

@section('icon')
    {{ asset('icons/home.png') }}
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $user->name }}'s Posts</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (count($posts))
                        @foreach ($posts as $post)
                            <div class="card border-secondary w-75 mx-auto">
                                @if($post->cover_image)
                                  <a href="/posts/{{ $post->title }}"><img src="/{{ 'storage/'.$post->cover_image }}" class="card-img-top" alt="Cover Image"></a>
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
                            <div class="row">
                                <div class="col text-center">
                                    <div class="btn-group justify-content-center">
                                        <a href="/posts/{{ $post->title }}/edit">
                                            <button class="btn btn-secondary center-block mx-2">Edit</button>
                                        </a>
                                        {!! Form::open(['action' => ['PostsController@destroy', $post->title], 'method' => 'POST']) !!}
                                            {{ Form::submit('Delete', ['class' => 'btn btn-danger center-block mx-2']) }}
                                            {{ Form::hidden('_method', 'DELETE') }}
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>
                            <br>
                        @endforeach
                        <div class="d-flex justify-content-center">
                            {{ $posts->links() }}
                        </div>
                </div>

                    @else
                        No posts yet!
                    @endif
                </div>
            </div>
        </div>
    </div>
    <br>
    
    @if (auth()->id() == $user->id)
        <div class="row justify-content-center">
            <a class="btn btn-primary" href="/posts/create" role="button"><i class="fa fa-plus" aria-hidden="true"></i> Add Post</a>
        </div>
    @endif
</div>
@endsection
