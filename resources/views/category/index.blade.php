@extends('layouts.master')

@section('content')
    <h1>Categories</h1>
    <input type="text" name="category_name" id="category_name" autocomplete="off">
    <div id = "search-result"></div>
    <a href="{{url('category/create')}}" class="btn btn-primary pull-right">+Add</a>
    <br>
    <br>

    <table class="table table-bordered">
        <tr>
            <td>#</td>
            <td>Title</td>
            <td>Action</td>
        </tr>
        @foreach($category as $item)
            <tr>
                <td>{{$item->id}}</td>
                <td>{{$item->title}}</td>
                <td>
                    <a href="{{URL::to('category/'.$item->id.'/delete')}}" class="btn btn-danger"onclick="return DeleteConfirm()">Delete</a>
                    <a href="{{URL::to('category/'.$item->id.'/edit')}}" class="btn btn-primary">Edit</a>
                    <a href="{{URL::to('category/'.$item->id.'/view')}}" class="btn btn-success">View</a>
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


        $(document).ready(function () {
            $("#category_name").keyup(function () {

                var category_name = $("#category_name").val(); //document.getElementById('category_name')
                $.ajax({
                    url: '{{url('category/ajax-search')}}',
                    type: 'get',
                    data: {
                        cname: category_name
                    },
                    success: function (response) {
                        console.log(response);
                        $("#search-result").html(response);
                    }
                });
            });


        });

    </script>
@stop