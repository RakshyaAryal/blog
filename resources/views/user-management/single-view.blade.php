@extends('layouts.master')
@section('content')
<h1>User Details</h1>
<div>
    <div>Name:{{$user->name }}</div>
    <div>Email:{{$user->email}}</div>
    <div>User Type:{{$user->user_type}}</div>
</div>

@endsection