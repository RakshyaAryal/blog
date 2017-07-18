@extends('layouts.master')

@section('content')
    <h1>Users</h1>

    <div class="row form-inline" style="height: 50px;">
        <form action = "{{ url('user-management/search') }}">
            <div class="form-group">
                <input type="text" name="Username" class="form-control">
                <input type="submit" value="Search" class="btn btn-success">
            </div>

        </form>
    </div>

    <a href="{{url('user-management/create')}}" class="btn btn-primary pull-right">+Add</a>
<br>
<br>

    <table class="table table-bordered">
        <tr>
            <td>#</td>
            <td>Name</td>
            <td>Email</td>
            <td>User Type</td>
            <td>Action</td>
        </tr>
        @foreach($user as $item)
            <tr>
                <td>{{$item->id}}</td>
                <td>{{$item->name}}</td>
                <td>{{$item->email}}</td>
                <td>
                    @if($item->user_type == 1)
                        <label class="text text-info">Admin</label>
                    @else
                        Author
                    @endif
                </td>
                <td>
                    <a href="{{URL::to('user-management/'.$item->id.'/delete')}}" class="btn btn-danger" onclick="return DeleteConfirm()">Delete</a>
                    <a href="{{URL::to('user-management/'.$item->id.'/edit')}}" class="btn btn-primary">Edit</a>
                    <a href="{{URL::to('user-management/'.$item->id.'/view')}}" class="btn btn-success">View</a>
                </td>
            </tr>
        @endforeach
    </table>

    <script>
        function DeleteConfirm() {
            var isDelete = confirm('Are you sure want to delete?');

            if(isDelete) {
                return true;
            } else {
                return false;
            }

        }
    </script>
    {{ $user->links() }}
@stop