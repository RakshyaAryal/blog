@extends('layouts.front-master')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h2>{{$post->title }}</h2>
            <div>Author: {{$post->user->name}}</div>
            <div>Date: {{$post->created_at}}</div>
            <br/>
            <div>{{$post->body}}</div>
        </div>
    </div>
@stop