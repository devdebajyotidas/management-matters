<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from wrappixel.com/demos/admin-templates/pixeladmin/inverse/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 23 Sep 2017 07:57:18 GMT -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png"
          href="{{asset('assets/img/favicon.png')}}">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    @include('includes.css')
</head>

<body class="fix-header">
<!-- Preloader -->
<div class="preloader">
    {{--<div class="cssload-speeding-wheel"></div>--}}
</div>
<div id="wrapper">
    <!-- Navigation -->
    @include('includes.header')
    <!-- Left navbar-header -->
    <!-- Left sidebar -->
    @include('includes.sidebar')
    <!-- Page Content -->
    <div id="page-wrapper">
        <!-- /.container-fluid -->
        @yield('content')
        <!-- Footer -->
        @include('includes.footer')
    </div>
    <!-- /#page-wrapper -->
</div>
@include('includes.js')
</body>


<!-- Mirrored from wrappixel.com/demos/admin-templates/pixeladmin/inverse/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 23 Sep 2017 07:59:03 GMT -->
</html>
