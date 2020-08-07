@extends('layout')

@section('head')
    <link rel="stylesheet" href={{ asset('css/detail-post.css') }}>
@endsection

@section('content')
    <h1>Title of post is {{ $post->title }}</h1>
@endsection
