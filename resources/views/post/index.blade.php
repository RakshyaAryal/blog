@extends('layouts.master')

@section('content')
    <h1>Posts</h1>

    <div class="row form-inline" style="height: 50px;">
        <form action="{{ url('post/search') }}">
            <div class="form-group">
                <input type="text" name="body" class="form-control">

                    <select name="category_id" id="category_id" class="form-control">
                        @foreach( $categories as $category)
                            <option value="{{ $category->id }}"   >{{ $category->title }}</option>
                        @endforeach
                    </select>

                <input type="submit" value="Search" class="btn btn-success">
            </div>
        </form>
    </div>

    <a href="{{url('post/create')}}" class="btn btn-primary pull-right">+Add</a>
    <br>
    <br>
    <table class="table table-bordered">
        <tr>
            <td>#</td>
            <td>title</td>
            <td>body</td>
            <td>Author Name</td>
            <td>Action</td>

        </tr>
        @foreach($post as $item)

            <tr>
                <td>{{$item->id}}</td>
                <td>{{$item->title}}</td>
                <td>{{$item->body}}</td>
                <td>{{$item->user->name}}</td>
                <td>
                    <a href="{{URL::to('post/'.$item->id.'/delete')}}" class="btn btn-danger" onclick="return DeleteConfirm()">Delete</a>
                    <a href="{{URL::to('post/'.$item->id.'/edit')}}" class="btn btn-primary">Edit</a>
                    <a href="{{URL::to('post/'.$item->id.'/view')}}" class="btn btn-success">View</a>
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
    {{ $post->links() }}
@stop