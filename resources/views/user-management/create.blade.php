@extends('layouts.master')
@section('content')
    <h1>Add Users</h1>

    <form action="{{url('user-management/store/'.$user->id)}}" method="post">
        {{csrf_field()}}

        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" value="{{$user->name}}" class="form-control">
        </div>

        <div class="form-group">
        <label>Email</label>
        <input type="text" name="email" value="{{$user->email}}" class="form-control">
        </div>

        <div class="form-group">
        <label>Password</label>
        <input type="password" name="password" value="{{$user->password}}" class="form-control">
        </div>


        <div class="form-group">
        <label>User Type</label>
        <select name="user_type" class="form-control">
            <option value="1" @if($user->user_type == "1") selected @endif >Admin</option>
            <option value="2" @if($user->user_type == "2") selected @endif >Author</option>

        </select>
        </div>

        <br>

        <input type="submit" name="submit" class="btn btn-success">

    </form>

@endsection