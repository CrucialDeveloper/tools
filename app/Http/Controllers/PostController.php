<?php

namespace App\Http\Controllers;

use App\Post;
use Inertia\Inertia;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Inertia::setRootView('blog');
        return Inertia::render('Posts/Index', [
            'posts' => Post::latest()->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize(Post::class, 'create');

        $this->validateRequest($request);

        $post = Post::make($request->all());
        $post->slug = Str::slug($post->title);
        $post->save();

        return '/blog';
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return Inertia::render('Posts/Show', [
            'post' => $post
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }

    public function validateRequest($request)
    {
        $request->validate([
            'title' => 'sometimes|required',
            'excerpt' => 'sometimes|required',
            'body' => 'sometimes|required',
            'byline' => 'sometimes|required',
            'image' => 'sometimes|required',
            'video' => 'sometimes|required',
            'publishe_at' => 'sometimes|required',
        ]);
    }
}
