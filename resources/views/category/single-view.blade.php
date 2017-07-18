@extends('layouts.master')
@section('content')
    <h1>Category Details</h1>
    <div>
        <div>Name:{{$category->title }}</div>
    </div>
    @endsection