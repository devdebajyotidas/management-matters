<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from wrappixel.com/demos/admin-emails/pixeladmin/inverse/500.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 23 Sep 2017 08:00:21 GMT -->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" type="image/png" href="{{asset('assets/img/favicon.png')}}">
  <title>Internal Server Error</title>
  <!-- Bootstrap Core CSS -->
  <link href="{{ asset('assets/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
  <!-- animation CSS -->
  <link href="{{ asset('assets/css/animate.css') }}" rel="stylesheet">

  <!-- Custom CSS -->
  <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
  <!-- color CSS -->
  <link href="{{ asset('assets/css/colors/default.css') }}" id="theme"  rel="stylesheet">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body>
<!-- Preloader -->
<div class="preloader">
  <div class="cssload-speeding-wheel"></div>
</div>
<section id="wrapper" class="error-page">
  <div class="error-box">
    <div class="error-body text-center">

      <h1>500</h1>
      <h3 class="text-uppercase">Internal Server Error.</h3>
      <p class="text-muted m-t-30 m-b-30">Please try after some time</p>
      <a href="{{url('dashboard')}}" class="btn btn-info btn-rounded waves-effect waves-light m-b-40">Back to home</a> </div>
    <footer class="footer text-center">&copy; {{date('Y')}} Management Matters</footer>
  </div>
</section>
<script src="https://wrappixel.com/demos/admin-templates/pixeladmin/plugins/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="{{ asset('assets/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- Custom Theme JavaScript -->
<script src="{{ asset('assets/js/custom.min.js') }}"></script>

</body>

<!-- Mirrored from wrappixel.com/demos/admin-emails/pixeladmin/inverse/500.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 23 Sep 2017 08:00:21 GMT -->
</html>
