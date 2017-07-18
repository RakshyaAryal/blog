@extends('layouts.front-master')

@section('content')


    @foreach($posts as $item)
        <div class="row">
            <div class="col-md-12">
                <h2><a href="{{ url('single-post/'.$item->id) }}">{{$item->title }}</a></h2>
                <div class="col-md-3">
                    <img src="{{ url('uploads/'.$item->thumbnail) }}" width="150"/>
                </div>
                <div class="col-md-9">
                    <div>Author: {{$item->user->name}}</div>
                    <div>Date: {{$item->created_at}}</div>
                    <br/>
                    <div>{{$item->body}}</div>
                    <div>
                        Category:
                        <ul>
                            @foreach($item->categories as $cat)
                                <li>{{ $cat->title }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <a href="{{ url('single-post/'.$item->id) }}" class="btn btn-success">Read More</a>
                </div>
            </div>
        </div>
    @endforeach

    {{ $posts->links() }}


@stop