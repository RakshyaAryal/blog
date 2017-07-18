@extends('layouts.master')
@section('content')

    <h1>Add New Posts</h1>
    <form action="{{url('post/store/'.$post->id)}}" method="post" enctype="multipart/form-data">
        {{csrf_field()}}


        <div class="form-group">
            <label>Title</label>
            <input type="text" name="title" value="@if(old('title')) {{old('title') }} @else {{$post->title}} @endif"  class="form-control">
        </div>

        <div class="form-group">
            <label>Thumbnail</label>
            <img src="{{ url('uploads/'.$post->thumbnail) }}" height="200">
            <input type="file" name="thumbnail" class="form-control" onchange="previewFile()">
        </div>

        <div class="form-group">
            <label>Body</label>
            <textarea id="body" name="body" class="form-control">@if(old('body')) {{old('body') }} @else{{$post->body}} @endif</textarea>
        </div>

        <div class="form-group">
            <label for="category_id">Category</label>
            <select name="category_id[]" id="category_id" class="form-control" multiple="">
                @foreach( $categories as $category)
                    <option value="@if(old('category_id[]')) {{old('category_id[]') }} @else {{ $category->id }} @endif"
                            @if(in_array($category->id, $selectedCategory)) selected @endif >{{ $category->title }}</option>
                @endforeach
            </select>
        </div>


        <input type="submit" name="submit" class="btn btn-primary">

    </form>

    <script>
        $(document).ready(function () {
            $('#category_id').multiselect();
            tinymce.init({selector: '#body'});
        });

        function previewFile() {
            var preview = document.querySelector('img');//$("img")
            var file    = document.querySelector('input[type=file]').files[0];
            var reader  = new FileReader();

            reader.onloadend = function () {
                preview.src = reader.result;
            }

            if (file) {
                reader.readAsDataURL(file);
            } else {
                preview.src = "";
            }
        }
    </script>
@endsection
{{--
<div class="form-group">
    <label>Generes</label>
    <select name="generes" class="form-control">
        <option value="country" @if($music->generes == "country") selected @endif >Country</option>
        <option value="classical" @if($music->generes == "classical") selected @endif >Classical</option>
        <option value="blues" @if($music->generes == "blues") selected @endif >Blues</option>

    </select>--}}
