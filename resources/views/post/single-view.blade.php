@extends('layouts.master')
@section('content')
    <h1>Post Details</h1>
    <div>
       <div>Title:{{$post->title }}</div>
        <br>
        <div>Body:{{$post->body}}</div>
        <br>
        <div>Author ID:{{$post->author_id}}</div>
    </div>

@endsection