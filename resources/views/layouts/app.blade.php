<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" sizes="16x16"
          href="{{url('favicon.ico')}}">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    @include('includes.css')
</head>
<body id="{{ $page }}" class="content-wrapper no-sidebar">
    <div id="wrapper">
        <!-- Preloader -->
        <div class="preloader">
            <div class="cssload-speeding-wheel"></div>
        </div>
        @include('includes.header')
        {{--@include('includes.sidebar')--}}

        <!-- Page Content -->
        <div id="page-wrapper">
            @yield('content')
            @include('includes.footer')
        </div>
        @include('includes.right-sidebar')
    </div>

<!-- Scripts -->
@include('includes.js')
</body>
</html>
