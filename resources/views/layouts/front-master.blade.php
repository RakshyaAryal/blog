<html>

<head>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"
          integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
            integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
            crossorigin="anonymous"></script>
</head>

<body>

{{-- header start --}}
<div class="container-fluid blog-header">
    My Blog
</div>
{{-- header section ends --}}


{{-- body section starts --}}
<div class="container-fluid" style="background-color: gainsboro;">
    <div class="row" style="width: 80%; margin: 0 auto;">

        <div class="col-md-8" style="">
            @yield('content')
        </div>

        <div class="col-md-4" style="background-color: #8eb4cb">
            <div class="row form-inline" style="height: 50px;">
                <form action="{{ url('home/search') }}">
                    <div class="form-group">
                        <input type="text" name="title" class="form-control">
                        <input type="submit" value="Search" class="btn btn-success">
                    </div>

                </form>
            </div>

            <h2>Categories</h2>

            <ul>
                @foreach($categories as $category)
                    <li><a href="{{ url('category/'.$category->title.'/'.$category->id) }}">{{$category->title}}</a>
                    </li>

                @endforeach
            </ul>
            <h2>Archive</h2>

            @php($previousYear = "")
            @foreach($post_archives as $post)
                @if($post->year != $previousYear)
                    @php($previousYear = $post->year)
                    <div>-{{ $post->year }}</div>
                @endif
                <div>--<a href="{{ url('archive/'.$post->year.'/'.$post->month) }}">{{ $post->month_name }} ({{ $post->post_count }})</a></div>
            @endforeach
        </div>

    </div>
</div>
{{-- body section ends --}}

{{-- footer section starts --}}
<div class="container-fluid" style="height: 50px; background-color: grey;">

</div>


{{-- footer section ends --}}

</body>

</html>