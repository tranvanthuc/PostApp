<?php

namespace App\Http\Controllers;

use App\Post;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function __construct()
    {
        $exceptMiddlewares = [
            'index',
            'show', 
            'increaseLike',
            'decreaseLike'
        ];
        $this->middleware('auth')->except($exceptMiddlewares);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->has('tag')) {
            $tagName = $request->get('tag');
            $tag = Tag::where('name', $tagName)->firstOrFail();
            $posts = $tag->posts()->orderByDesc('created_at')->paginate(6);
        } else if ($request->has('search')) {
            $search = $request->get('search');
            $posts = Post::where('title', 'like', '%' . $search .'%')->orderByDesc('created_at')->paginate(6);
        } else {
            $posts = Post::orderByDesc('created_at')->paginate(6);
        }

        return view('list-post', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::all();
        return view('create-post', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $postData = [
            'title' => $request->get('title'),
            'slug' => Str::slug($request->get('title'), '-'),
            'body' => $request->get('body'),
            'user_id' => Auth::id(),
        ];
        $tagIds = $request->get('tag_ids'); // [1, 2, 3]
        
        $post = Post::create($postData);

        $post->tags()->sync($tagIds);

        return redirect(route('list-post'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('detail-post', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $tags = Tag::all();
        $tagIds = $post->tags()->pluck('tag_id')->toArray();
        return view('edit-post', compact('tags', 'post', 'tagIds'));
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
        $tagIds = $request->get('tag_ids'); // [1, 2, 3]
        
        $post->title = $request->get('title');
        $post->slug = Str::slug($request->get('title'), '-');
        $post->body = $request->get('body');
        $post->save();

        $post->tags()->sync($tagIds);

        return redirect(route('list-post'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        
        return redirect(route('list-post'));
    }

    public function increaseLike(Post $post)
    {
        $post->increment('likes');
        return $post->likes;
    }

    public function decreaseLike(Post $post)
    {
        $post->decrement('likes');
        return $post->likes;
    }

}
