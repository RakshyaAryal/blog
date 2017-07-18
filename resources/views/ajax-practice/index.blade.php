@extends('layouts.front-master')

@section('content')
    <button type="button" id="ajax-button">Get Ajax Data</button>

    <div id="my-data"></div>

    <script>
        $(document).ready(function(){

           $("#ajax-button").click(function () {

               $.ajax({
                  url: "{{ url("post/get-details") }}",
                  type: "get",
                  data: {first_name: "rakshya"},
                  success: function (response) {
                      //console.log(response);
                    $("#my-data").html(response);
                  }
               });
               /*var name = "rakshu";
               $("#my-data").html(name);*/

           });
        });
    </script>
@stop