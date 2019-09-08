<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Post;

class PostsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(10);
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'title' => 'required|unique:posts|min:3|max:255',
            'body' => 'required',
            'cover_image' => 'image|nullable'
        ]);

        if ($request->hasFile('cover_image')) {
            $cover_image = substr($request->file('cover_image')->store('public/cover_images'), 7); // Store and get image's name
        } else {
            $cover_image = '';
        }

        $post = Post::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'body' => $request->body,
            'cover_image' => $cover_image
        ]);

        return redirect('/posts/'.$post->title)->with('success', 'Post Submitted!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $this->authorize('update', $post);

        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);

        $request->validate([
            'title' => 'required|min:3|max:255|unique:posts,title,'.$post->id,
            'body' => 'required',
            'cover_image' => 'image|nullable'
        ]);

        if ($request->hasFile('cover_image')) {
            $cover_image = substr($request->file('cover_image')->store('public/cover_images'), 7);
            Storage::delete('public/'.$post->cover_image);
        } else {
            $cover_image = $post->cover_image;
        }

        $post->update([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'body' => $request->body,
            'cover_image' => $cover_image
        ]);

        return redirect('posts/'.$post->title)->with('success', 'Post Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        // abort_unless(auth()->user()->owns($post), 403);
        $this->authorize('update', $post);
        // Storage::delete('public/'.$post->cover_image);
        $post->delete();
        // return redirect('/home')->with('success', 'Post Deleted!');
        return redirect()->back()->with('success', 'Post Deleted!');
    }
}
