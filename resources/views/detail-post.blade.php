@extends('layout')

@section('title')
    {{ $post->title }}
@endsection

@section('head')
    <link rel="stylesheet" href={{ asset('css/detail-post.css') }}>
@endsection

@section('content')
    <div class="py-5">
        <div class="container">
            <img src="https://via.placeholder.com/750x350" width="750" height="350" class="w-100" alt="thumbnail-post">
            <div class="content bg-white p-5">
                <h1 class="text-center py-3 title">{{ $post->title }}</h1>
                <div class="text-center">
                    <img src="https://via.placeholder.com/100x100" width="100" height="100" class="rounded-circle" alt="thumbnail-avatar ">
                    <h5 class="my-3 text-uppercase font-weight-bold">
                        <span class="text-secondary">{{ $post->created_at }}</span> / 
                        <span class="text-success">{{ $post->user->name }}</span>
                    </h5>
                </div>

                <p>{{ $post->body }}</p>

                @if (!$post->tags->isEmpty())
                    <div>
                        Tags: 
                        @foreach ($post->tags as $tag)
                            <a href={{ route('list-post', ['tag' => $tag->name]) }}>{{ $tag->name }}</a>
                            @if (!$loop->last)
                                , 
                            @endif                    
                        @endforeach
                    </div>
                @endif

                <a href={{ route('list-post') }}>Back to List</a>
            </div>
        </div>
    </div>
@endsection
