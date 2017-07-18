<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- bootstrap css load -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-multiselect.css') }}" rel="stylesheet">

    {{-- jquery library--}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    {{--<script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>--}}
    {{-- bootstrap js load--}}
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/bootstrap-multiselect.js') }}"></script>

    @if(Session::has('flash_message'))
        <div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span><em> {!! session('flash_message') !!}</em></div>
    @endif
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Blog</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->

                <ul class="nav navbar-nav navbar-right">

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">@if(\Auth::user()){{\Auth::user()->name}}@endif <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Change Password</a></li>
                            <li role="separator" class="divider"></li>
                            <li>
                                {{-- logout button --}}
                                <form action="{{route('logout')}}" method="post">
                                    {{ csrf_field() }}
                                    <input type="submit" value="Logout" class="btn btn-success">
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>

</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-3">
            @include('_sidebar')
        </div>
        <div class="col-md-9">
            @yield('content')
        </div>
    </div>
</div>
</body>
</html>