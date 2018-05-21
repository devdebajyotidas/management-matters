<!DOCTYPE html>
<html lang="en">
<head>
    <!--Meta tags-->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Change Title and Meta tags-->
    <title>MM | management matters | Home</title>
    <meta name="description" content="MM | Description will go here">
    <meta name="robots" content="index, follow">
    <meta name="author" content="Perle Template">

    <!-- Change Twitter card tags-->
    <meta name="twitter:card" content="app">
    <meta name="twitter:site" content="@">
    <meta name="twitter:app:name:iphone" content="">
    <meta name="twitter:app:id:iphone" content="">
    <meta name="twitter:app:name:ipad" content="">
    <meta name="twitter:app:id:ipad" content="">
    <meta name="twitter:app:name:googleplay" content="">
    <meta name="twitter:app:id:googleplay" content="">

    <!-- Favicon logo -->
    <link rel="icon" type="image/png"
          href="{{asset('assets/img/favicon.png')}}">
    <!-- Plugins CSS -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/landing_resource/css/plugins.css')}}">
    <!-- Our Min CSS -->
    <link rel='stylesheet' type="text/css" href="{{asset('assets/landing_resource/css/styles-animated.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('assets/landing_resource/css/style19.css')}}" id="colors">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
          integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    {{--    <link rel="stylesheet" href="{{ asset('assets/landing_resource/css/font-awesome.min.css') }}">--}}
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-modal/2.2.6/css/bootstrap-modal.css">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js" type="text/javascript"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js" type="text/javascript"></script>
    <![endif]-->

    <style type="text/css">

        .modal_scrollable {
            height: 500px;
            overflow-y: scroll;
            padding: 20px !important;
        }

        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            padding-top: 100px; /* Location of the box */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            min-height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
        }

        /* Modal Content */
        .modal-content {
            background-color: #fefefe;
            margin: auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }

        /* The Close Button */
        .close {
            color: #aaaaaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }

        .modal-content .close {
            position: relative;
            float: right;
            font-size: 25px;
            transition: transform 500ms ease;
            z-index: 11;
        }

        .about-us-image {
            width: 455px !important;
            height: 380px !important;
        }

        .phase-color {
            color: #f75b36 !important;
        }

        .gradient-color {
            background: linear-gradient(30deg, #f75b36, #f75b36);
        }

        .btn:hover, .btn-large:hover, .btn:focus, .btn-large:focus, .btn-floating:focus {
            background-color: #f5ebeb;
            color: #f75b36;
            font-weight: bold;
        }

        .single-feature > a > div > p {
            /*display: none;*/
        }

        .popup-overlay {
            position: fixed;
            z-index: 99;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(0, 0, 0, 0.7);
            transition: opacity 500ms;
            visibility: hidden;
            opacity: 0;
        }

        .popup-overlay:target {
            visibility: visible;
            opacity: 1;
        }

        .popup {
            margin: 200px auto;
            padding: 20px;
            background: #fff;
            border-radius: 5px;
            width: 70%;
            position: relative;
            transition: all 5s ease-in-out;
        }

        .popup h2 {
            margin-top: 0;
            color: #333;
            /*font-family: Tahoma, Arial, sans-serif;*/
        }

        .popup .close {
            position: absolute;
            top: 20px;
            right: 30px;
            transition: all 200ms;
            font-size: 30px;
            font-weight: bold;
            text-decoration: none;
            color: #333;
        }

        .popup .close:hover {
            color: #06D85F;
        }

        .popup .content {
            max-height: 30%;
            overflow: auto;
        }

        #main-nav .side-nav{
            background-color: #efefef;
        }
        #main-nav .side-nav a{
            color: #292929;
        }

        @media screen and (max-width: 700px) {
            .box {
                width: 70%;
            }

            .popup {
                width: 70%;
            }
        }
    </style>
</head>

<body>

<!-- Start PreLoader Section-->

<!-- End PreLoader Section-->

<!-- Start Nav Section -->
<nav id="main-nav" class="nav-down">

    <div id="nav-color" class="gradient-color"></div>

    <div class="nav-wrapper">

        <!-- Add your Logo and Name here -->
        <a class="design-font waves-effect waves-light no-bg" data-scroll-nav="0" href="#" style="width: 45px;height: 45px;display: inline-block;">
            {{--<img class="responsive-img logo" src="{{asset('assets/img/mm-logo.png')}}" alt="" style="border: 2px solid #fff">--}}
            <img src="{{asset('assets/img/mm-logo.png')}}" alt="" style="border: 2px solid #fff;width: 100%;height: 100%;display: block;box-shadow: 0 1px 3px rgba(0,0,0,.14);border-radius: 2px">
        </a>

        <!-- Main Menu Hamburger Icon for Mobile And Screen Width less than 993px -->
        <a href="#" data-activates="mobile-demo" class="button-collapse" style="display: inline-block !important;margin-top: -15px">

            <div class="very_small_hamburger" id="hamburger-menu">
                <svg viewBox="0 0 800 600">
                    <path d="M300,220 C300,220 520,220 540,220 C740,220 640,540 520,420 C440,340 300,200 300,200"
                          class="top"></path>
                    <path d="M300,320 L540,320" class="middle"></path>
                    <path d="M300,210 C300,210 520,210 540,210 C740,210 640,530 520,410 C440,330 300,190 300,190"
                          class="bottom" transform="translate(480, 320) scale(1, -1) translate(-480, -318) "></path>
                </svg>
            </div>

        </a>

        <!-- Main Menu Content -->
        <ul class="right hide-on-med-and-down">

            <!--  <li>
                 <a class="waves-effect waves-light no-bg" data-scroll-nav="0" href="#">Home</a>
             </li> -->

            <li>
                <a class="waves-effect waves-light" data-scroll-nav="1" href="#">Features</a>
            </li>

            <li>
                <a class="waves-effect waves-light" data-scroll-nav="2" href="#">Screenshots</a>
            </li>

            <li>
                <a class="waves-effect waves-light" data-scroll-nav="3" href="#">Download</a>
            </li>

            <!--News Main Menu Drop Down Link-->
            <!-- <li>
                <a class="dropdown-button waves-effect waves-light" href="#!" data-activates="news-dropdown">
                    News
                    <i class="fa fa-chevron-down"></i>
                </a>
            </li> -->

            <li>
                <a class="waves-effect waves-light" data-scroll-nav="5" href="#">Pricing</a>
            </li>

            <li>
                <a class="waves-effect waves-light" data-scroll-nav="6" href="#">FAQs</a>
            </li>

            <li>
                <a class="waves-effect waves-light" data-scroll-nav="7" href="#">About Us</a>
            </li>

            <li>
                <a class="waves-effect waves-light" data-scroll-nav="8" href="#">Contact</a>
            </li>


            @if (Route::has('login'))
                @if (Auth::check())
                    <li>
                        <a class="waves-effect waves-light" href="{{ url('/home') }}">
                            <button id="" class="btn btn-primary pull-center slide">
                                Home
                            </button>
                        </a>
                    </li>
                @else
                    <li>
                        <a class="waves-effect waves-light" href="{{ url('/login') }}">
                            <button id="" class="btn btn-primary pull-center slide">
                                Sign In
                            </button>
                        </a>
                    </li>
                    <li>
                        <a class="waves-effect waves-light" href="{{ url('/register') }}">
                            <button id="" class="btn btn-primary pull-center slide">
                                Sign Up
                            </button>
                        </a>
                    </li>
                @endif
            @endif

            <li>
                <!--Main Menu Social Icons-->
                <!-- <div class="fixed-action-btn click-to-toggle">

                    <a class="btn-floating btn-large waves-effect waves-light grey darken-4">
                        <div class="ham-cont">
                        <div class="very_small_hamburger" id="social-hamburger">
                            <svg viewBox="0 0 800 600">
                                <path d="M300,220 C300,220 520,220 540,220 C740,220 640,540 520,420 C440,340 300,200 300,200" class="top"></path>
                                <path d="M300,320 L540,320" class="middle"></path>
                                <path d="M300,210 C300,210 520,210 540,210 C740,210 640,530 520,410 C440,330 300,190 300,190" class="bottom" transform="translate(480, 320) scale(1, -1) translate(-480, -318) "></path>
                            </svg>
                        </div>
                     </div>
                    </a>



                </div> -->

            </li>

        </ul>

        <!--Main Menu News Drop Down Content-->
        <!-- <ul id="news-dropdown" class="dropdown-content">

            <li>
                <a class="waves-effect waves-light" data-scroll-nav="4" href="#">News Section</a>
            </li>

            <li class="divider"></li>

            <li>
                <a class="waves-effect waves-light" href="blog.html">News Page</a>
            </li>

            <li>
                <a class="waves-effect waves-light" href="single-blog.html">Single News Page</a>
            </li>

        </ul> -->

        <!--Side Nav for Mobile And Screen Width less than 993px-->
        <ul class="side-nav" id="mobile-demo">

            <!--Side Nav Add Logo and Name here-->
            <li>
                <a class="waves-effect waves-light home  no-bg" data-scroll-nav="0" href="#">
                    <img class="responsive-img logo" src="{{asset('assets/img/mm-logo.png')}}"
                         alt="Logo image"><br>
                    {{--<p class="title-link">--}}
                        {{--<span>A</span><span>p</span><span>p</span><span>e</span><span>r</span><span>l</span><span>e</span>--}}
                    {{--</p>--}}
                </a>
            </li>

            {{--<li>--}}
            {{--<a class="waves-effect waves-light" data-scroll-nav="0" href="#">Home</a>--}}
            {{--</li>--}}

            <li>
                <a class="waves-effect waves-light" data-scroll-nav="1" href="#">Features</a>
            </li>

            <li>
                <a class="waves-effect waves-light" data-scroll-nav="2" href="#">Screenshots</a>
            </li>

            <li>
                <a class="waves-effect waves-light" data-scroll-nav="3" href="#">Download</a>
            </li>

            <!--Side Nav News DropDown-->


            <li>
                <a class="waves-effect waves-light" data-scroll-nav="5" href="#">Pricing</a>
            </li>

            <li>
                <a class="waves-effect waves-light" data-scroll-nav="6" href="#">FAQs</a>
            </li>

            <li>
                <a class="waves-effect waves-light" data-scroll-nav="7" href="#">Contact</a>
            </li>

            @if (Route::has('login'))
                @if (Auth::check())
                    <li>
                        <a class="waves-effect waves-light" href="{{ url('/home') }}">
                            Home
                        </a>
                    </li>
                @else
                    <li>
                        <a class="waves-effect waves-light" href="{{ url('/login') }}">
                            Sign In
                        </a>
                    </li>
                    <li>
                        <a class="waves-effect waves-light" href="{{ url('/register') }}">
                            Sign Up
                        </a>
                    </li>
            @endif
        @endif

        <!--Side Nav Social Icons-->


        </ul>

    </div>

</nav>
<!-- End Nav Section-->

<!-- Start Header Section-->
<header id="main-header" data-scroll-index="0"
        style="background: url('{{asset('assets/landing_resource/images/background/header-bg-9.jpg')}}') center fixed;">
    <canvas class="hide-on-med-and-down" id="demo-canvas"></canvas>
    <div class="overlay gradient-color"></div>

    <div class="header-section container">

        <div class="header-text">

            <div>
                <!-- Your App name -->
                <div class="title">
                    <h1 class="title-link">
                        <span>M</span><span>A</span><span>N</span><span>A</span><span>G</span><span>E</span><span>M</span><span>E</span><span>N</span><span>T</span><br>
                        <span>M</span><span>A</span><span>T</span><span>T</span><span>E</span><span>R</span><span>S</span>
                    </h1>
                </div>

                <!-- App Main Description -->
                <p class="description"><item style="font-size: 22px;">Say HELLO to a whole new way to managing BETTER!</item> <br> MM is a breakthrough
                    on-line program that inspires emerging and experienced managers and supervisors with the necessary
                    critical thinking skills to obtain superior performance from everyone in the organization.</p>

                <!-- App Slogan -->
                <p class="slogan">Tomorrow's Management Solutions Today!</p>
            </div>

        </div>

        <div class="owl-carousel owl-header">

            <!-- Mobiles Image-->
            <img class="responsive-img" src={{asset('assets/landing_resource/img/dashboard.png')}} alt="">
            <img class="responsive-img" src={{asset('assets/landing_resource/img/assessment.png')}} alt="">
            <img class="responsive-img" src={{asset('assets/landing_resource/img/quiz.png')}} alt="">

        </div>
    </div>

</header>
<!-- End Header Section-->

<!-- Start About Section-->
<section id="about-us" class="main-section center-align">

    <div class="container">

        <!--Title-->
        <h4 class="reflection-text p-b-2">About MM</h4>

        <!-- Description -->
        <p class="p-t-1 desc">MM harnesses the power of behavioral change to inspire small changes that make a big
            impact. MM surrounds you with the right Learnings, Tools, and Technology during your journey of becoming a
            better manager - FOREVER!
        </p>

        <div class="row">

            <div class="col s12 l4">

                <div class="icon s6 p-tb-2">
                    <a href="#popup1"><i class="gradient-color fa fa-snowflake-o fa-3x waves-circle waves-effect waves-light" ></i></a>
                </div>

                <h5 class="p-tb-1">Learnings</h5>

                {{--<p>A new and innovative approach to learn and apply new skills to Coaching, Collaboration, Communication, Discipline, Engaging Today’s Workforce, Innovation and Creativity, Integrating Change,--}}
                {{--Meetings, Motivation, Performance Improvement, Problem Solving, Remote Supervising, Time Management, and Trust.</p>--}}

                <a class="button" href="#popup1">Click here to know more</a>
            </div>

            <div class="col s12 l4">

                <div class="icon p-tb-2">
                    <a href="#popup2"><i class="gradient-color fa fa-pencil fa-3x waves-circle waves-effect waves-light"></i></a>
                </div>

                <h5 class="p-tb-1">Tools</h5>

                {{--<p>Management Self-Assessment, Quizzes, Personality (Behavior) Grid--}}
                {{--Identification Matrix, Tickets and Calendar Board, Awards, Notifications, Customization options,--}}
                {{--Dashboard (Analytics), and much more!</p>--}}
                <a class="button" href="#popup2">Click here to know more</a>

            </div>

            <div class="col s12 l4">

                <div class="icon p-tb-2">
                    <a href="#popup3"><i class="gradient-color fa fa-superpowers fa-3x waves-circle waves-effect waves-light"></i></a>
                </div>

                <h5 class="p-tb-1">Technology</h5>

                {{--<p>Essential tools for better managing today’s employees made available on any device at any time. Once enrolled you will have all the tools available right at your fingertips!</p>--}}

                <a class="button" href="#popup3">Click here to know more</a>
            </div>

        </div>

    </div>


    <div id="popup1" class="popup-overlay">
        <div class="popup">
            <h5>Learnings</h5>
            <a class="close" href="#">&times;</a>
            <div class="content">
                <p>A new and innovative approach to learn and apply new skills to Coaching, Collaboration,
                    Communication, Discipline, Engaging Today’s Workforce, Innovation and Creativity, Integrating
                    Change,
                    Meetings, Motivation, Performance Improvement, Problem Solving, Remote Supervising, Time Management,
                    and Trust.</p>
            </div>
        </div>
    </div>

    <div id="popup2" class="popup-overlay">
        <div class="popup">
            <h5>Tools</h5>
            <a class="close" href="#">&times;</a>
            <div class="content">
                <p>Management Self-Assessment, Quizzes, Personality (Behavior) Grid
                    Identification Matrix, Tickets and Calendar Board, Awards, Notifications, Customization options,
                    Dashboard (Analytics), and much more!</p>
            </div>
        </div>
    </div>

    <div id="popup3" class="popup-overlay">
        <div class="popup">
            <h5>Technology</h5>
            <a class="close" href="#">&times;</a>
            <div class="content">
                <p>Essential tools for better managing today’s employees made available on any device at any time. Once
                    enrolled you will have all the tools available right at your fingertips!</p>
            </div>
        </div>
    </div>

</section>
<!-- End About Section-->


<!-- Start Features Section-->
<section id="features" data-scroll-index="1" class="main-section center-align">

    <div class="gradient-color overlay"></div>

    <div class="container">

        <!--Title-->
        <h4 class="reflection-text reflection-text-white p-b-2">Features</h4>

        <div class="row p-t-2">

            <div class="col s12 m12 l4 p-tb-1 feature-left">

                <div class="single-feature p-tb-2">

                    <a class="hoverable feature-link same-height active" data-owl-item="0">

                        <!--Title -->
                        <div>
                            <h5>Self-Assessment</h5>
                            {{--<p>Provides guidance on specific areas for improvement, and tracks progression over time.</p>--}}
                            <p>Tracks progression over time.</p>
                        </div>

                        <!-- Icon -->
                        <div>
                            <i class="fa fa-rocket gradient-color waves-effect waves-light" aria-hidden="true"></i>
                        </div>

                    </a>

                </div>

                <div class="single-feature p-tb-2">

                    <a class="hoverable feature-link same-height" data-owl-item="1">

                        <!-- Title -->
                        <div>
                            <h5>Learnings</h5>
                            {{--<p>Provides basic understanding and approaches to assisting managers to better manage today’s employees</p>--}}
                            <p>Assists managers to better understand and engage today’s employees.</p>
                        </div>

                        <!-- Icon -->
                        <div>

                            <i class="fa fa-lightbulb-o gradient-color waves-effect waves-light" aria-hidden="true"></i>

                        </div>

                    </a>

                </div>

                <div class="single-feature p-tb-2">

                    <a class="hoverable feature-link same-height" data-owl-item="2">

                        <!-- Title -->
                        <div>
                            <h5>Quizzes</h5>
                            {{--<p>A set of 10 questions that ensure knowledge attainment with 50% of the questions situational.</p>--}}
                            <p>Ensures knowledge attainment and application of the Learnings.</p>
                        </div>

                        <!-- Icon-->
                        <div>
                            <i class="fa fa-heartbeat gradient-color waves-effect waves-light" aria-hidden="true"></i>
                        </div>

                    </a>

                </div>

            </div>

            <div class="col push-m3 push-s3 s6 m6 l4 p-tb-1 images-slider">

                <!--Features Images-->
                <div class="owl-carousel owl-features">

                    <div>
                        <img class="responsive-img"
                             src={{asset('assets/landing_resource/img/assessment-one.png')}} alt="image of the
                             iPhone app">
                    </div>

                    <div>
                        <img class="responsive-img"
                             src={{asset('assets/landing_resource/img/quiz-taken.png')}} alt="image of the
                             iPhone app">
                    </div>

                    <div>
                        <img class="responsive-img"
                             src={{asset('assets/landing_resource/img/quiz.png')}} alt="image of the
                             iPhone app">
                    </div>

                    <div>
                        <img class="responsive-img"
                             src={{asset('assets/landing_resource/img/dashboard.png')}} alt="image of the
                             iPhone app">
                    </div>

                    <div>
                        <img class="responsive-img"
                             src={{asset('assets/landing_resource/img/calender.png')}} alt="image of the
                             iPhone app">
                    </div>

                    <div>
                        <img class="responsive-img"
                             src={{asset('assets/landing_resource/img/award.png')}} alt="image of the
                             iPhone app">
                    </div>

                </div>

            </div>
            <div class="col s12 m12 l4 p-tb-1 feature-right">

                <div class="single-feature p-tb-2">

                    <a class="hoverable feature-link same-height" data-owl-item="3">

                        <!-- Icon -->
                        <div>
                            <i class="fa fa-eye gradient-color waves-effect waves-light" aria-hidden="true"></i>
                        </div>

                        <div>

                            <!-- Title -->
                            <h5>Dashboard (Analytics)</h5>
                            {{--<p>Graphs that display metrics of Assessment scores, Tickets (or Actions) completed, Awards attained, Quizzes completed (if required),--}}
                            {{--etc.</p>--}}
                            <p>Tracks Assessment scores, Tickets completed, Awards attained, and Quizzes completed.</p>

                        </div>

                    </a>

                </div>

                <div class="single-feature p-tb-2">

                    <a class="hoverable feature-link same-height" data-owl-item="4">

                        <!-- Icon -->
                        <div>
                            <i class="fa fa-code gradient-color waves-effect waves-light" aria-hidden="true"></i>
                        </div>

                        <div>

                            <!-- Title -->
                            <h5>Ticket I Calendar Board</h5>
                            {{--<p>A robust calendar to organize your Tickets (or specific MM activities) that also ties into your native--}}
                            {{--iOS or Android calendar.</p>--}}
                            <p>Organizes Tickets and syncs with native iOS and Android calendars.</p>

                        </div>

                    </a>

                </div>

                <div class="single-feature p-tb-2">

                    <a class="hoverable feature-link same-height" data-owl-item="5">

                        <!-- Icon -->
                        <div>
                            <i class="fa fa-superpowers gradient-color waves-effect waves-light" aria-hidden="true"></i>
                        </div>

                        <div>

                            <!-- Title -->
                            <h5>Award and Notifications</h5>
                            <p>Displays Awards generated by Learner activity.</p>

                        </div>

                    </a>

                </div>

            </div>

        </div>

    </div>

</section>
<!-- End Features Section-->

<!-- Start Showcase Section-->
<section id="showcase" class="main-section">

    <!-- Overlay Color -->
    <div class="gradient-color overlay"></div>

    <div class="container">

        <!--Title-->
        <h4 class="reflection-text p-b-2">HOW IT WORKS</h4>

        <!-- Description -->
        <p class="p-t-1 desc"><b style="font-size: 1.5em;">4 Eye-Opening and Easy to Follow Phases</b>
            <br>
            1 Career-Changing Way to Better Manage Employees
            <br>
            In Management Matters, <b><i>POSITIVE BEHAVIORS</b></i> are introduced <br> & <br> reinforced day-to-day
            <br>
            ensuring a change in <b><i>EMPLOYEE ATTITUDES</i></b> and performance; contributing
            <br>
            greatly to a <b><i>CHANGE IN ORGANIZATONAL CULTURE</i></b>.

        </p>

        <div class="row p-tb-3">

            <!-- Single Show Case -->
            <div class="col s12 l6" data-aos="fade-right" data-aos-delay="100">

                <!-- Small Title -->
                <h5 class="p-b-1 phase-color">
                    PHASE 1
                </h5>

                <p><b class="phase-color">GET TO KNOW YOURSELF BETTTER</b></p>

                <div class="info">

                    <div>

                        <div>
                            <i class="fa fa-rocket gradient-color" aria-hidden="true"></i>
                        </div>

                    </div>

                    <div>

                        <h6> Conduct regularily a <b class="phase-color"> Management Self-Assessment.</b></h6>
                    </div>

                </div>

                <div class="info">

                    <div>

                        <div>
                            <i class="fa fa-rocket gradient-color" aria-hidden="true"></i>
                        </div>

                    </div>

                    <div>
                        {{--<h6>A set of 3 questions out of 6 will be randomly selected for scoring by the Learner.--}}
                        {{--Thankfully, you won’t have to determine which Modules will be best suited for you to improve--}}
                        {{--your managing better skills. A prioritized list of suggested Learning Modules based on your Assessment score will be provided, as well as each score is--}}
                        {{--tabulated and conveyed on your Management Matters Chart.</h6>--}}
                        <h6>
                            A prioritized list of suggested Learning Modules based on your Assessment score.
                        </h6>

                    </div>

                </div>

                <div class="info">

                    <div>

                        <div>
                            <i class="fa fa-rocket gradient-color" aria-hidden="true"></i>
                        </div>

                    </div>

                    <div>
                        <h6>Your goal will be <b class="phase-color">SPECIFIC</b>!</h6>
                    </div>

                </div>


            </div>

            <div class="col s12 l6 center-align" data-aos="fade-left" data-aos-delay="200">

                <!--Images-->
                <img src={{asset('assets/landing_resource/img/quiz-taken.png')}} alt="">

                <img class="absolute-image"
                     src={{asset('assets/landing_resource/img/assessment.png')}} alt="">

            </div>

        </div>

        <div class="row p-tb-3 opposite-container">

            <!-- Single Show Case -->
            <div class="col s12 l6" data-aos="fade-left" data-aos-delay="200">

                <!-- Small Title -->
                <h5 class="p-b-1 phase-color">PHASE 2</h5>

                <p><b class="phase-color">BROADEN YOUR HORIZONS</b></p>

                <div class="info">

                    <div>

                        <div>
                            <i class="fa fa-rocket gradient-color" aria-hidden="true"></i>
                        </div>

                    </div>

                    <div>

                        {{--<h6> Obtain knowledge from the <b class="phase-color">Learning Modules, Quizzes, and Cost of NOT Managing Better</b></h6>--}}

                        <h6>
                            Learning Modules for specific management topics to broaden the learner's knowledge with the latest in the concepts and practices.
                        </h6>
                    </div>

                </div>

                <div class="info">

                    <div>

                        <div>
                            <i class="fa fa-rocket gradient-color" aria-hidden="true"></i>
                        </div>

                    </div>

                    <div>
                        {{--<h6>Learning Modules for specific management topics to broaden the learner's knowledge with the--}}
                        {{--latest in the concepts and practices.You will be aware of the personality (behavior) styles within the workplace and--}}
                        {{--determine what those behaviors cost the organization. And then work to reduce their impact.--}}
                        {{--</h6>--}}

                        <h6>Learning Modules for specific management topics to broaden the learner's knowledge with the
                            latest in the concepts and practices.
                        </h6>

                    </div>

                </div>


                <div class="info">

                    <div>

                        <div>
                            <i class="fa fa-rocket gradient-color" aria-hidden="true"></i>
                        </div>

                    </div>

                    <div>
                        <h6>Gain knowledge of various personality (behavior) traits that impact performance and work to reduce their impact.</h6>

                    </div>

                </div>


                <div class="info">

                    <div>

                        <div>
                            <i class="fa fa-rocket gradient-color" aria-hidden="true"></i>
                        </div>

                    </div>

                    <div>
                        <h6>Your goal will be  <b class="phase-color">MEASURABLE</b>!</h6>

                    </div>

                </div>

            </div>

            <div class="col s12 l6 opposite center-align" data-aos="fade-right" data-aos-delay="100">

                <!--Images-->
                <img src={{asset('assets/landing_resource/img/quiz-taken.png')}} alt="">

                <img class="absolute-image"
                     src={{asset('assets/landing_resource/img/quiz-taken.png')}} alt="">

            </div>

        </div>

        <div class="row p-tb-3">

            <!-- Single Show Case -->
            <div class="col s12 l6" data-aos="fade-right" data-aos-delay="200">

                <!-- Small Title -->
                <h5 class="p-b-1 phase-color">PHASE 3</h5>

                <p><b class="phase-color">RETHINK YOUR STRATEGY</b></p>

                <div class="info">
                    <div>
                        <div>
                            <i class="fa fa-rocket gradient-color" aria-hidden="true"></i>
                        </div>
                    </div>

                    <div>
                        <h6>Change behavior with the <b class="phase-color">Tickets and Calendar Board</b>
                        </h6>
                    </div>

                </div>


                <div class="info">
                    <div>
                        <div>
                            <i class="fa fa-rocket gradient-color" aria-hidden="true"></i>
                        </div>
                    </div>

                    <div>
                        <h6>Visualized your Tickets or Action Items to managing better on the Board.
                        </h6>
                    </div>

                </div>

                <div class="info">

                    <div>
                        <div>
                            <i class="fa fa-rocket gradient-color" aria-hidden="true"></i>
                        </div>

                    </div>

                    <div>

                        {{--<h6>Obtain awards when completing 10 activities.--}}
                        {{--Improving management practices requires due diligence and cannot be done as an one time--}}
                        {{--event. Keep in mind this is your personal improvement plan to FOREVER improve your skills.--}}
                        {{--</h6>--}}

                        <h6>
                            Obtain awards when completing activities.
                        </h6>
                    </div>

                </div>

                <div class="info">

                    <div>
                        <div>
                            <i class="fa fa-rocket gradient-color" aria-hidden="true"></i>
                        </div>

                    </div>

                    <div>
                        <h6>Your goal will be <b class="phase-color">ASSIGNABLE</b>!</h6>

                    </div>

                </div>

            </div>

            <div class="col s12 l6 center-align" data-aos="fade-left" data-aos-delay="100">

                <!--Images-->
                <img src={{asset('assets/landing_resource/img/calender.png')}} alt="">

                <img class="absolute-image"
                     src={{asset('assets/landing_resource/img/calender.png')}} alt="" >

            </div>

        </div>

        <div class="row p-tb-3 opposite-container">

            <!-- Single Show Case -->
            <div class="col s12 l6" data-aos="fade-left" data-aos-delay="200">

                <!-- Small Title -->
                <h5 class="p-b-1 phase-color">PHASE 4</h5>

                <p><b class="phase-color">MAKE IT ROUTINE, TRACK PROGRESS AND BE REWARDED</b></p>

                <div class="info">

                    <div>

                        <div>
                            <i class="fa fa-rocket gradient-color" aria-hidden="true"></i>
                        </div>

                    </div>

                    <div>
                        <h6>Receive feedback from the <b class="phase-color">Awards and Notifications</b> on a regular basis.
                        </h6>

                    </div>

                </div>

                <div class="info">

                    <div>

                        <div>
                            <i class="fa fa-rocket gradient-color" aria-hidden="true"></i>
                        </div>

                    </div>

                    <div>


                        <h6>Continually adjust and monitor your activities to meet everyday issues – making Managing Better fun!

                        </h6>

                    </div>

                </div>

                <div class="info">

                    <div>

                        <div>
                            <i class="fa fa-rocket gradient-color" aria-hidden="true"></i>
                        </div>

                    </div>

                    <div>
                        <h6>Your goal will be <b class="phase-color">REALISTIC AND TIMELY!</b></h6>

                    </div>

                </div>

            </div>

            <div class="col s12 l6 opposite center-align" data-aos="fade-right" data-aos-delay="100">

                <!--Images-->
                <img src={{asset('assets/landing_resource/img/award.png')}} alt="">

                <img class="absolute-image"
                     src={{asset('assets/landing_resource/img/award.png')}} alt="">

            </div>

        </div>

    </div>

</section>
<!-- End Showcase Section-->

<!-- Start Subscribe Section-->
{{--<section id="subscribe" class="main-section center-align">--}}

    {{--<div class="container row" data-aos="fade-up" data-aos-delay="100">--}}

        {{--<div class="subscribe-container">--}}
            {{--<div class="col s12 l4">--}}

                {{--<h4 class="title p-b-2">Subscribe</h4>--}}

            {{--</div>--}}

            {{--<!-- Subscription Form -->--}}
            {{--<form id="subscribe-form" name="subscribe-form" class="subscribe-input input-field col s12 l8">--}}

                {{--<!-- Email Field -->--}}
                {{--<input name="subscribe-email" id="subscribe-email" type="email" class="validate">--}}

                {{--<label data-error="Invalid Email" for="subscribe-email">Email</label>--}}

                {{--<!-- Submit Button -->--}}
                {{--<button id="subscribe-submit" class="gradient-color waves-effect waves-light" type="submit">--}}

                    {{--<i class="fa fa-paper-plane first"></i>--}}

                    {{--<i class="fa fa-paper-plane second"></i>--}}

                {{--</button>--}}

                {{--<!-- ! Anti-spam field ! Invisible for users, it will trick most bots to fill it and prevent the email from being sent to you -->--}}
                {{--<div class="input-field col s12 hidden">--}}

                    {{--<input type="text" id="subscribe-check-spam" placeholder="Leave field empty" name="check-spam">--}}

                {{--</div>--}}

            {{--</form>--}}

        {{--</div>--}}

        {{--<!-- Alert Message -->--}}
        {{--<div class="col s12 alert-message p-t-2" id="subscribe-alert-message"></div>--}}

    {{--</div>--}}

{{--</section>--}}
<!-- End Subscribe Section-->

<!-- Start Screenshot Section-->
<section id="screenshot" data-scroll-index="2" class="main-section center-align">

    <div class="container">

        <!--Title-->
        <h4 class="reflection-text p-b-2">Screenshots</h4>

        <!-- Description -->
        <p class="p-t-1 desc">Here is some sample of our product</p>

        <div class="carousel">

            <div class="carousel-item">

                <!-- Link to the image to open in full screen when clicked with lity plugin -->
                <a src={{asset('assets/landing_resource/img/dashaboard.png')}} data-lity>

                    <!-- Screenshot Image -->
                    <img class="responsive-img"
                         src={{asset('assets/landing_resource/img/dashboard.png')}} alt="mobile mockup
                         image">

                </a>

            </div>

            <div class="carousel-item">

                <!-- Link to the image to open in full screen when clicked with lity plugin -->
                <a src={{asset('assets/landing_resource/img/assessment.png')}} data-lity>

                    <!-- Screenshot Image -->
                    <img class="responsive-img"
                         src={{asset('assets/landing_resource/img/assessment.png')}} alt="mobile mockup
                         image">

                </a>

            </div>

            <div class="carousel-item">

                <!-- Link to the image to open in full screen when clicked with lity plugin -->
                <a src={{asset('assets/landing_resource/img/quiz.png')}} data-lity>

                    <!-- Screenshot Image -->
                    <img class="responsive-img"
                         src={{asset('assets/landing_resource/img/quiz.png')}} alt="mobile mockup
                         image">

                </a>

            </div>

            <div class="carousel-item">

                <!-- Link to the image to open in full screen when clicked with lity plugin -->
                <a src={{asset('assets/landing_resource/img/award.png')}} data-lity>

                    <!-- Screenshot Image -->
                    <img class="responsive-img"
                         src={{asset('assets/landing_resource/img/award.png')}} alt="mobile mockup
                         image">

                </a>

            </div>

            <div class="carousel-item">

                <!-- Link to the image to open in full screen when clicked with lity plugin -->
                <a href="{{asset('assets/landing_resource/img/tickets.png')}}" data-lity>

                    <!-- Screenshot Image -->
                    <img class="responsive-img"
                         src={{asset('assets/landing_resource/img/tickets.png')}} alt="mobile mockup
                         image">

                </a>

            </div>

        </div>

        <!-- Navigation arrows to be hidden on small and medium screens -->
        <div class="navigation" id="screenshot-navigation">

            <div class="nav-prev" id="screenshot-prev">
                <i class="fa fa-angle-left"></i>
            </div>

            <div class="nav-next" id="screenshot-next">
                <i class="fa fa-angle-right"></i>
            </div>

        </div>

    </div>

</section>
<!-- End Screenshot Section-->

<!-- Start Testimonials Section-->
<section id="testimonials" class="main-section center-align">

    <!-- Overlay Color -->
    <div class="gradient-color overlay"></div>

    <div class="container">

        <!--Title-->
        <h4 class="reflection-text reflection-text-white p-b-2">Testimonials</h4>

        <div class="owl-carousel owl-testimonials">

            <div>

                <!-- Client Image -->
                <div>
                    <img class="responsive-img circle"
                         src={{asset('assets/landing_resource/images/team/testimonials4.jpg')}} alt="Image of a John,
                         one member of the team created the app">
                </div>

                <!-- Client Testimonial -->
                <p class="p-b-1">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus asperiores commodi
                    exercitationem facilis incidunt laudantium nam nulla numquam optio quasi, quis reiciendis suscipit,
                    voluptatum! Error, molestiae, natus? At, officia, unde.</p>

                <!-- Client Name -->
                <h5>John Doe</h5>

                <!-- Testimonial Rating, Add a star or half a star -->
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>

            </div>

            <div>

                <!-- Client Image -->
                <div>
                    <img class="responsive-img circle"
                         src={{asset('assets/landing_resource/images/team/testimonials1.jpg')}} alt="Image of a John,
                         one member of the team created the app">
                </div>

                <!-- Client Testimonial -->
                <p class="p-b-1">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus asperiores commodi
                    exercitationem facilis incidunt laudantium nam nulla numquam optio quasi, quis reiciendis suscipit,
                    voluptatum! Error, molestiae, natus? At, officia, unde.</p>

                <!-- Client Name -->
                <h5>John Doe</h5>

                <!-- Testimonial Rating, Add a star or half a star -->
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star-half" aria-hidden="true"></i>

            </div>

            <div>

                <!-- Client Image -->
                <div>
                    <img class="responsive-img circle"
                         src={{asset('assets/landing_resource/images/team/testimonials3.jpg')}} alt="Image of a John,
                         one member of the team created the app">
                </div>

                <!-- Client Testimonial -->
                <p class="p-b-1">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus asperiores commodi
                    exercitationem facilis incidunt laudantium nam nulla numquam optio quasi, quis reiciendis suscipit,
                    voluptatum! Error, molestiae, natus? At, officia, unde.</p>

                <!-- Client Name -->
                <h5>John Doe</h5>

                <!-- Testimonial Rating, Add a star or half a star -->
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>

            </div>

        </div>

    </div>

</section>
<!-- End Testimonials Section-->

<!-- Start Team Section-->

<!-- End Team Section-->

<!-- Start Download Section-->
<section id="download" data-scroll-index="3" class="main-section"
         style="background: url('landing_resource/images/background/header-bg-9.jpg') center fixed;">

    <!-- Overlay Color -->
    <div class="gradient-color overlay"></div>

    <div class="container">

        <!--Title-->
        <h4 class="reflection-text reflection-text-white p-b-2">Get It Now</h4>

        <!-- Description -->
        <p class="p-t-1 desc">The New MM App Lorem ipsum dolor sit amet, consectetur adipisicing elit. In, veniam! Lorem
            ipsum dolor sit amet, consectetur.</p>

        <div class="row p-t-2">

            <div class="col s12 l9">

                <!-- Link to download on the Apple store -->
                <a href="#" class="m-t-1 grey darken-4 waves-effect waves-light">

                    <span class="big-icon">
                        <i class="fa fa-apple"></i>
                    </span>

                    <span class="text">
                        <small>available on</small><br> Apple Store
                    </span>

                </a>

                <!-- Link to download on the Google store -->
                <a href="#" class="m-t-1 grey darken-4 waves-effect waves-light">

                    <span class="big-icon">
                        <i class="fa fa-android"></i>
                    </span>

                    <span class="text">
                        <small>available on</small><br> Google Store
                    </span>

                </a>

                <!-- Link to download on the Windows store -->


                {{--<a class="m-t-1 grey darken-4 waves-effect waves-light"--}}
                   {{--href="landing_resource/images/iphone-mock/qrcode.jpg">--}}
                    {{--<span class="big-icon">--}}
                        {{--<i class="fa fa-qrcode"></i>--}}
                    {{--</span> Scan QR Code</a>--}}
                {{--</a>--}}

            </div>

            <!-- Iphone Image on right -->
            <div class="col s12 l3 hide-on-med-and-down" data-aos="fade-left" data-aos-delay="100">

                <img class="responsive-img"
                     src={{asset('assets/landing_resource/img/dashboard.png')}} alt="">

            </div>

        </div>

    </div>

</section>
<!-- End Download Section-->

<!-- Start News Section-->

<!-- End News Section-->

<!-- Start Video Section-->
<!-- <section id="video" class="main-section center-align">

    <div class="gradient-color overlay"></div>

    <div class="container">

        <!--Title-->
<!--   <h4 class="reflection-text reflection-text-white p-b-2">Watch Video</h4> -->

<!-- Description -->
<!--  <p class="p-t-1 desc">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorem expedita ipsum, nulla quia saepe vel?</p>
-->
<!-- Link to Video -->
<!--   <a class="icon-button" href="https://www.youtube.com/watch?v=tpWFwnj9WKc" data-lity>
      <i class="fa fa-play-circle fa-4x"></i>
  </a>
-->
<!--   </div> -->

</section>
<!-- End Video Section-->

<!-- Start Prices Section-->
<section id="prices" data-scroll-index="5" class="main-section center-align">

    <div class="container">

        <!--Title-->
        <h4 class="reflection-text p-b-2">Prices</h4>

        <!-- Description -->
        <p class="p-t-1 desc">Lorem ipsum dolor deserunt impedit, inventore iste numquam optio porro possimus sunt
            voluptates!</p>

        <div class="price-container p-t-3">

            <!-- First Price -->
            <div class="price" data-aos="fade-left" data-aos-delay="100">

                <div class="gradient-color overlay"></div>

                <div class="info">

                    <h5 class="p-b-1">Learner</h5>

                    <hr>

                    <h3 class="p-tb-1"><sup>$</sup> 10.99
                        <small>/month</small>
                    </h3>

                    <hr>

                    <ul class="p-tb-1">

                        <li>Support Forum</li>
                        <li>Free Hosting</li>
                        <li>50GB Of Free Storage</li>
                        <li>Admin Area</li>

                    </ul>

                </div>

                <a href="#" class="m-t-1 shadow-button waves-effect waves-light">Subscribe Now
                    <i class="fa fa-arrow-right"></i>
                </a>

            </div>

            <!-- Best Price -->

            <div class="price best">

                <div class="gradient-color overlay"></div>

                <div class="sale-box two">
                    <span class="on_sale title_shop">Best</span>
                </div>

                <div class="info">

                    <h5 class="p-b-1">Organization</h5>

                    <hr>

                    <h3 class="p-tb-1"><sup>$</sup> 20.99
                        <small>/month</small>
                    </h3>

                    <hr>

                    <ul class="p-tb-1">

                        <li>Support Forum</li>
                        <li>Free Hosting</li>
                        <li>100GB Of Free Storage</li>
                        <li>Admin Area</li>
                        <li>Unlimited Hosting</li>

                    </ul>

                </div>

                <a href="#" class="m-t-1 shadow-button waves-effect waves-light">Subscribe Now
                    <i class="fa fa-arrow-right"></i>
                </a>

            </div>

            <!-- Third Price -->
            <div class="price" data-aos="fade-right" data-aos-delay="100">

                <div class="gradient-color overlay"></div>

                <div class="info">

                    <h5 class="p-b-1">Enterprise</h5>

                    <hr>

                    <h3 class="p-tb-1"><sup>$</sup> 33.99
                        <small>/month</small>
                    </h3>

                    <hr>

                    <ul class="p-tb-1">

                        <li>Support Forum</li>
                        <li>Free Hosting</li>
                        <li>50GB Of Free Storage</li>
                        <li>Admin Area</li>
                        <li>Unlimited Hosting</li>
                        <li>24/hr Support</li>

                    </ul>

                </div>

                <a href="#" class="m-t-1 shadow-button waves-effect waves-light">Contact Us
                    <i class="fa fa-arrow-right"></i>
                </a>

            </div>

        </div>

    </div>

</section>
<!-- End Prices Section-->

<!-- Start Statistics Section-->
<section id="statistics" class="main-section center-align"
         style="background: url('landing_resource/images/background/header-bg-9.jpg') bottom fixed;">

    <!-- Color Overylay -->
    <div class="gradient-color overlay"></div>

    <div class="container">

        <!--Title-->
        <h4 class="reflection-text reflection-text-white p-b-2">Statistics</h4>

        <!-- Description -->
        <p class="p-t-1 desc">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab adipisci amet corporis,
            cupiditate dolores ipsa ipsam maiores molestias nesciunt, nihil odio quae, quo ratione soluta.</p>

        <div class="row p-t-2">

            <div class="col s12 m6 l3 p-tb-1">

                <i class="fa fa-heart fa-3x" aria-hidden="true"></i>

                <h5>Happy Clients</h5>

                <h3 class="counter">1232</h3>

            </div>

            <div class="col s12 m6 l3 p-tb-1">

                <i class="fa fa-cloud-download fa-3x" aria-hidden="true"></i>

                <h5>App Downloads</h5>

                <h3><span class="counter">64</span>K</h3>

            </div>

            <div class="col s12 m6 l3 p-tb-1">

                <i class="fa fa-reddit-alien fa-3x" aria-hidden="true"></i>

                <h5>Active Users</h5>

                <h3 class="counter">1811</h3>

            </div>

            <div class="col s12 m6 l3 p-tb-1">

                <i class="fa fa-star fa-3x" aria-hidden="true"></i>

                <h5>Total Rates</h5>

                <h3 class="counter">232</h3>

            </div>

        </div>

    </div>

</section>
<!-- End Statistics Section-->

<!-- Start FAQs Section-->
<section id="faq" data-scroll-index="6" class="main-section">

    <div class="container">

        <!--Title-->
        <h4 class="reflection-text p-b-2">FAQ
            <small>s</small>
        </h4>

        <!-- Description -->
        {{--<p class="p-t-1 desc">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Impedit in odit tempora voluptates? Consequuntur deleniti deserunt impedit, inventore iste numquam optio porro possimus sunt voluptates!</p>--}}

        <div class="row p-t-3 faq-main">

            <div class="col s6 push-s4 m3 push-m2 l4 push-l1 faq-image" data-aos="fade-right" data-aos-delay="200">

                <!-- FAQ Image -->
                <div>
                    <img class="responsive-img"
                         src={{asset('assets/landing_resource/img/assessment-one.png')}} alt="">
                    <img class="responsive-img absolute-image"
                         src={{asset('assets/landing_resource/img/tickets.png')}} alt="">
                </div>

            </div>

            <div class="col s12 m6 push-m2 l7 push-l1 collapsible-container" data-aos="fade-left" data-aos-delay="100">

                <ul class="collapsible popout" data-collapsible="accordion">

                    <li>
                        <!-- Question -->
                        <div class="collapsible-header active gradient-color waves-effect waves-light">
                            <i class="fa fa-comment" aria-hidden="true"></i>
                            <span>What is Management Matters?</span>
                        </div>

                        <!-- Answer -->
                        <div class="collapsible-body">
                            <span>
                                MM is a breakthrough on-line program that inspires emerging and experienced managers and supervisors with the necessary critical thinking skills to obtain sustained performance improvements from everyone.
                                <br>
                                <br>
                                We have combined the experience of behavior change with today’s technology so you can make improvements with you and your team that actually stick.
                                <br>
                                <br>
                                MM harnesses the power of behavioral change to inspire small changes that make a big impact.  MM surrounds you with the right learnings, tools, and technology during your journey of becoming a better manager – FOREVER!
                            </span>
                        </div>

                    </li>

                    <li>
                        <!-- Question -->
                        <div class="collapsible-header gradient-color waves-effect waves-light">
                            <i class="fa fa-comment" aria-hidden="true"></i>
                            <span>How long will this program last?</span>
                        </div>

                        <!-- Answer -->
                        <div class="collapsible-body">
                            <span>
                                Management Matters is meant to change behaviors over time.  A manager will constantly have new employees, new issues and challenges to face as time goes on.  It is expected once a manager spends a year or so actively engaged on the app, then they most likely would have retained the necessary long term behavior change required to adapt to forthcoming challenges.  However, it would be advisable for the Manager or Learner to continue to improve using this app.
                            </span>
                        </div>

                    </li>

                    <li>
                        <!-- Question -->
                        <div class="collapsible-header gradient-color waves-effect waves-light">
                            <i class="fa fa-comment" aria-hidden="true"></i>
                            <span>How much time should I set aside each day to improve my MM skills?</span>
                        </div>

                        <!-- Answer -->
                        <div class="collapsible-body">
                            <span>Management Matters is meant for incremental learning and applying the skill set to effectively manage behavior change.  Each Learning Module is approximately 15 – 20 minutes of readings and quiz taking.  Subsequent application assigning of Tickets as well as completing Ticket activities, would be minutes per day.</span>
                        </div>

                    </li>

                    <li>
                        <!-- Question -->
                        <div class="collapsible-header gradient-color waves-effect waves-light">
                            <i class="fa fa-comment" aria-hidden="true"></i>
                            <span>Can I get a discount by adding more Learners within my organization?</span>
                        </div>

                        <!-- Answer -->
                        <div class="collapsible-body">
                            <span>Yes. Please see the Pricing section for this information</span>
                        </div>

                    </li>

                    <li>
                        <!-- Question -->
                        <div class="collapsible-header gradient-color waves-effect waves-light">
                            <i class="fa fa-comment" aria-hidden="true"></i>
                            <span>How do I get started?</span>
                        </div>

                        <!-- Answer -->
                        <div class="collapsible-body">
                            <span>
                                1. <a href="{{ url('register') }}">Sign-up (2 minutes)</a>
                                <br>
                                <br>
                                2. Determine if you are a single Learner (1 License) or you are signing up as an Organizational Administrator (multiple Licenses). (1-5 minutes)
                                <br>
                                Note:  If you sign-up as an single Learner, you will have the option at any time to upgrade to an Organizational Administrator and subsequently add Learners/Users/Licenses.
                                <br>
                                <br>
                                3. Set up your account.  If single Learner, (less  than 5 minutes), if signing up as an Organizational Administrator), allow 1-2 minutes per Learner license.
                                <br>
                                <br>
                                Each Learner/Licensed users will then receive an email notification welcoming them to MM and-requesting them to log-in and change their password.
                                <br>
                                <br>
                                Then, the MM journey begins!

                            </span>
                        </div>
                    </li>
                    <li>
                        <!-- Question -->
                        <div class="collapsible-header gradient-color waves-effect waves-light">
                            <i class="fa fa-comment" aria-hidden="true"></i>
                            <span>What if I want to cancel my subscription?</span>
                        </div>

                        <!-- Answer -->
                        <div class="collapsible-body">
                            <span>We really think you’ll like our program, but we understand that is may not be for everyone, and some may not want to fully commit.  If you would like to cancel, go to your account and unsubscribe.</span>
                        </div>

                    </li>

                </ul>

            </div>

        </div>

    </div>

</section>
<!-- End FAQs Section-->



<!-- Start About Us Section-->

<section id="team" data-scroll-index="7" class="main-section center-align">

    <div class="container">

        <!--Title-->
        <h4 class="reflection-text p-b-2">About Us</h4>

        <!-- Description -->
        <p class="p-t-1 desc">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab adipisci amet corporis, cupiditate dolores ipsa ipsam maiores molestias nesciunt, nihil odio quae, quo ratione soluta.</p>

        <!-- Owl Team Slider -->
        <div class="p-t-2 grid center-align owl-carousel owl-teams">

            <!-- Single Team Container -->
            <div class="team-member m-tb-2 z-depth-2 hoverable">
                <figure>

                    <!-- Team Image -->
                    <img class="responsive-img about-us-image" src="{{asset('assets/img/about_us/team3.jpg')}}" alt="news image">



                </figure>

                <div class="name p-b-1">

                    <!-- Team Member Name and link to his page -->
                    <a href="#">
                        <h5 class="team-name gradient-color waves-effect waves-light">Don Tapping</h5>
                    </a>
                    <h6>Publisher and Author</h6>

                    <!-- Team Member Job -->
                    <!-- <h6>Web Developer</h6> -->

                    <a class="shadow-button waves-effect waves-light" id="modal_btn1" onclick="modalOpenFunction('one')" style="cursor: pointer; color: #039be5; width: 50%;">
                        <b>Know more</b>

                    </a>

                    <!-- <a href="#" class="shadow-button waves-effect waves-light">
                        Read more
                        <i class="fa fa-arrow-right"></i>
                    </a> -->

                </div>
            </div>

            <!-- Single Team Container -->
            <div class="team-member m-tb-2 z-depth-2 hoverable">
                <figure>

                    <!-- Team Image -->
                    <img class="about-us-image" src="{{asset('assets/img/about_us/team1.jpg')}}" alt="img25">



                </figure>

                <div class="name p-b-1">

                    <!-- Team Member Name and link to his page -->
                    <a href="#">
                        <h5 class="team-name gradient-color waves-effect waves-light">Cynthia Guy</h5>
                    </a>
                    <h6>Partner</h6>

                    <a class="shadow-button waves-effect waves-light" id="modal_btn2" onclick="modalOpenFunction('two')" style="cursor: pointer; color: #039be5; width: 50%;">
                        <b>Know more</b>
                    </a>

                </div>

            </div>

            <!-- Single Team Container -->
            <div class="team-member  m-tb-2 z-depth-2 hoverable">
                <figure>

                    <!-- Team Image -->
                    <img class="about-us-image" src="{{asset('assets/img/about_us/team2.jpg')}}" alt="img25">



                </figure>

                <div class="name p-b-1">

                    <!-- Team Member Name and link to his page -->
                    <a href="#">
                        <h5 class="team-name gradient-color waves-effect waves-light">Joe D Buys</h5>
                    </a>
                    <h6>Partner</h6>

                    <a class="shadow-button waves-effect waves-light" id="modal_btn3" onclick="modalOpenFunction('three')" style="cursor: pointer; color: #039be5; width: 50%;">
                        <b>Know more</b>
                    </a>

                </div>

            </div>




        </div>

    </div>

</section>

<!-- End About Us Section-->




<!-- Start Map Section-->
<div id="map-section" data-scroll-index="8">

    <div id="map"></div>

</div>
<!-- End Map Section-->



<!-- Start Footer Section-->
<section id="footer" class="main-section center-align gradient-color">

    <div class="footer-main">

        <div class="main-section">

            <div class="container">

                <!--Title-->
                <h4 class="reflection-text p-b-2">Get In Touch</h4>

                <div class="contact-container">

                    <!-- Contact Form -->
                    <form id="contact-form" name="contact-form" method="POST" data-name="Contact Form" action="{{url('getintouch')}}">

                        {{ csrf_field() }}
                        <div class="row">

                            <!-- Name Field -->
                            <div class="input-field col s12">

                                <i class="fa fa-user-o prefix" aria-hidden="true"></i>
                                <input id="contact-name" type="text" class="validate" name="name" required>
                                <label for="contact-name">Name*</label>

                            </div>

                            <!-- Email Field -->
                            <div class="input-field col s12 m-t-1">

                                <i class="fa fa-paper-plane-o prefix" aria-hidden="true"></i>
                                <input id="contact-email" type="email" class="validate" name="email" required>
                                <label data-error="Invalid Email" for="contact-email">Email*</label>

                            </div>

                            <!-- Message Field -->
                            <div class="input-field col s12 m-t-1">

                                <i class="fa fa-envelope-o prefix" aria-hidden="true"></i>
                                <textarea id="contact-message" class="materialize-textarea validate" minlength="20"
                                          name="message" required></textarea>
                                <label for="contact-message"
                                       data-error="Minimum Length is 20 Characters">Message*</label>

                            </div>

                            <!-- Form Alert Message -->
                            <div class="col s12 alert-message" id="contact-alert-message"></div>

                            <!-- Submit Button -->
                            <div class="col s12">

                                <button id="intouch-btn" class="gradient-color waves-effect waves-light"
                                        type="submit">Send Message
                                </button>

                            </div>

                            <!-- ! Anti-spam field ! Invisible for users, it will trick most bots to fill it and prevent the email from being sent to you -->
                            <div class="input-field col s12 hidden">

                                <input type="text" id="contact-check-spam" placeholder="Leave field empty"
                                       name="check-spam">

                            </div>

                        </div>

                    </form>

                    <div class="address">

                        <!-- Your Address -->
                        <p class="p-b-1">

                            <i class="address-icon fa fa-map-marker"></i>
                            <!-- <span>15 Bath Rd, Heathrow, Longford, Hounslow TW6 2AB, UK</span> -->
                            <span>
                                MCS Media Inc. (TheLeanStore.com)
                                <br>
                                888 Ridge Road
                                <br>
                                Chelsea, MI 48118  USA
                            </span>

                        </p>

                        <!-- Your Phone Number -->
                        <p class="p-b-1">

                            <i class="address-icon fa fa-phone"></i>
                            <a href="tel:+441711278528"> <!-- +44 171 127 8528 -->
                                + 734-475—4301
                            </a>

                        </p>

                        <!-- Your Email -->
                        <p class="p-b-1">

                            <i class="address-icon fa fa-paper-plane" aria-hidden="true"></i>

                            <span>
                                <a href="mailto:info@theleanstore.com">
                                info@theleanstore.com
                            </a>
                                <br>
                            <a href="mailto:info@mgmt-matters.com" style="display: block">
                                info@mgmt-matters.com
                            </a>
                            </span>

                        </p>
                        <!-- Your Social Network Links-->
                    </div>

                </div>

            </div>

        </div>

        <!-- Footer Area -->
        {{--<div class="footer-content p-t-3 left-align">--}}

        {{--<div class="container">--}}

        {{--<div class="row">--}}

        {{--<div class="about col s12 m6 l3">--}}

        {{--<h5 class="p-b-2">About Us</h5>--}}

        {{--<!-- Your Logo -->--}}
        {{--<img class="responsive-img logo" src="" alt="logo image">--}}
        {{--<br>--}}
        {{--<!-- Your Title -->--}}
        {{--<p class="title-link">--}}
        {{--<span>A</span><span>p</span><span>p</span><span>e</span><span>r</span><span>l</span><span>e</span>--}}
        {{--</p>--}}
        {{--<!-- Your Info -->--}}
        {{--<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consectetur, exercitationem!</p>--}}

        {{--</div>--}}

        {{--<!-- News -->--}}


        {{--<!-- Tags -->--}}


        {{--</div>--}}

        {{--</div>--}}

        {{--</div>--}}

    </div>

</section>
<!-- End Footer Section-->

<!-- Start Copy Rights Section-->
<div id="copy-rights" class="col s12">

    <div class="container">

        <!-- Your Copy Right -->
        <p>Copyright &copy; {{date('Y')}}. Management Matters</p>

        <!-- Your Social Network Links-->


    </div>

</div>
<!-- End Copy Rights Section-->

<!-- <div class="modal fade" id="myModal" role="dialog">
<div class="modal-dialog">

<label for="modal" class="modal-bg"></label>
<div class="modal-content">
    <label for="modal" class="close">
        <i class="fa fa-times" aria-hidden="true"></i>
    </label>
    <header>
        <h2>So This is a Modal</h3>
    </header>
    <article class="content">
        <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra. Vestibulum erat wisi, condimentum sed, commodo vitae, ornare sit amet, wisi. Aenean fermentum, elit eget tincidunt condimentum, eros ipsum rutrum orci, sagittis tempus lacus enim ac dui.</p>
    </article>
    <footer>
        <a href="http://geekstudios.co" target="_parent" class="button success">Accept</a>
        <label for="modal" class="button danger">Decline</label>
    </footer>
</div>

</div>
</div> -->

<div id="modal_one" class="modal">

    <!-- Modal content -->
    <div class="modal-content modal_scrollable">
        <span class="close" id="modal_close1" onclick="closeModal('one')">&times;</span>
        <div class="img_div" style="text-align: left;">
            <img src="{{asset('assets/img/about_us/team3.jpg')}}" style="height: 200px; width: 200px;"/>
            <br/>
            <!-- <h5><b>Partner</b></h5> -->
            <h5><b>Don Tapping</b></h5>


            <p>
                Don Tapping graduated from The University of Michigan in 1976. He spent the next four years as a Lieutenant in the United States Marine Corps in various positions during his tour. After completing his Corps duties, Don worked in the medical technology, education, and aerospace industries for the next 20 years. Don authored the best-selling book, Value Stream Management for the Lean Office (Productivity Press 2003), Lean Office Demystified (II), Who Hollered Fore?, and over 50 other books and apps on business performance - setting the bar for continuous improvements. He continues to enlighten organizations with his ability to design step-by-step implementation methodologies identifying processes that require improvement, and then introducing proactive steps to improve or redesign them - reducing costs, boosting performance, and increasing customer (patient) satisfaction. Don today is using his experience in developing apps on how Lean can be applied using smart devices. Don also received his MBA from The University of Notre Dame.
            </p>
        </div>
    </div>

</div>


<div id="modal_two" class="modal">

    <!-- Modal content -->
    <div class="modal-content modal_scrollable">
        <span class="close" id="modal_close1" onclick="closeModal('two')">&times;</span>
        <div class="img_div" style="text-align: left;">
            <img src="{{asset('assets/img/about_us/team1.jpg')}}" style="height: 200px; width: 200px;"/>
            <br/>
            <!-- <h5><b>Partner</b></h5> -->
            <h5><b>Cynthia Guy</b></h5>


            <p>Cynthia Guy is a senior partner at Crystal Clear Concepts, a management consulting firm.  She holds a BA from Michigan State University in Journalism. She is a Communications and a Leadership specialist from Harvard/McBer Institute. She’s a certified T.A. analyst as well as certified by the AMA and Time Manager/Denmark.  Her strengths are being a catalyst of organizational change, leadership and innovation.  She has been certified in the Sycronist (Lean) Manufacturing program from General Motors. She is the author of Finding Profit, a book about the transformation of a business through lean manufacturing principles.
                In addition to a decade of human resource management expertise, Guy's strength lies in her ability as a catalyst of change. She’s been quoted as a change expert in the New York Times. Through close interaction with top management, she has been responsible for ushering in significant, positive change in a number of areas such as leadership, improved productivity and quality, resulting in increased profitability for companies. She developed her management skills as an owner of a major advertising agency that she operated before becoming a management consultant. She has gained the respect and admiration of top executives in business throughout the nation.
            </p>

            <b>Credentials:</b>
            <p>
                B.A. - Michigan State University<br/>
                McBer Institute, Harvard - Managing Motivation for Performance Improvement<br/>
                Author – Finding Profit, the story of Lean transformation<br/>
                ITTA - Transactional Analyst<br/>
                Time Management/Denmark - Certified as trainer's trainer </br>
                Trained for Michigan State University, University of Michigan, Grand Rapids Community College, Muskegon Junior College <br/>
                Former Director of Management Education for the Employers' Association of Western</br>
                Michigan
            </p>
        </div>
    </div>

</div>


<div id="modal_three" class="modal">

    <!-- Modal content -->
    <div class="modal-content modal_scrollable">
        <span class="close" id="modal_close1" onclick="closeModal('three')">&times;</span>
        <div class="img_div" style="text-align: left;">
            <img src="{{asset('assets/img/about_us/team2.jpg')}}" style="height: 200px; width: 200px;"/>
            <br/>
            <!-- <h5><b>Partner</b></h5> -->
            <h5><b>Joe D Buys</b></h5>


            <p>As a senior partner, Joe Buys has been an innovator in Cross-Functional Team Development, Creative Problem Solving, and Leadership Development. More recently, he’s been working on developing strategies for companies to implement Lean processes into both areas of production and administration. He has been an expert contributor on the www.Allexperts.com website for over 10 years.<br/>

                In addition to his human resource expertise as a consultant, Joe Buys was a national leader in the communications and research industries for over two decades. A past president of the Michigan Association of Broadcasters, Joe had a distinguished career in broadcasting as owner and/or manager of stations in Lansing, MI (WVIC- AM-FM), Detroit, MI (WKSG KISS-FM), Grand Rapids, MI (WZZR) and Fort Wayne, IN (WOWO-AM /FM).<br/>

                As a businessman and consultant, he has earned the reputation as a paladin by successfully turning around a number of unprofitable businesses through in-depth, hands-on management and employee coaching. He also left an imprint on the research industry as Central Division Manager for the Arbitron Research Company in Chicago. However, unlike most turn-around experts, he did it without a smoking gun. Instead of replacing people, he trains and motivates them. He understands the need for managers to empower and challenge their employees by instilling a sense of dignity through compassion and pride.<br/>

                “We have to tell our clients the facts in a way that they can understand how they will be impacted by them. Then we have to provide them with different tools they can use to improve performance, based on the reality of their situation. I trust that they will then make the best decisions for their particular needs.”
            </p>

            <b>Personal History</b>
            <p>
                Joe Buys was born in Grand Rapids, MI however, he lived his early years in East Lansing, MI. He developed an early interest in acting and competitive swimming. He participated in Toy Shop Theatre, a program at Michigan State University for young adults interested in theatre. That relationship led to his interest in broadcasting that was encouraged by cross participation between Toy Shop Theatre and the University’s television station, WKAR-TV. The interest in broadcasting and swimming led to an easy choice of college as he attended his hometown Michigan State University where he majored in Radio and Television, minored in Business and swam on the Spartan swim team. As an adult, he continued his swimming career by competing in the United States Masters Swimming and the Senior Olympics. He has set numerous state records, won a national championship and help set three world relay records.
            </p>

            <b>Client Base:</b>
            <p>Manufacturing , Healthcare, Financial Services, Trade Associations,  Media
                Law, Service Industries, Non-Profits,  Oil
            </p>

            <b>Credentials:</b>
            <p>
                Editor “Back-Street Lean” a book on Lean Manufacturing
                MA. Michigan State University - Telecommunications/Business<br/>
                B.A. Michigan State University - Telecommunications/Marketing<br/>
                Board Member - Michigan Association of Broadcasters Foundation<br/>
                Past President- Michigan Association of Broadcasters<br/>
                Past President - Communication Arts Alumni Association - Michigan State University<br/>
                Past President - Central East Lansing Business Association<br/>
                Legislative Liaison, National Association Broadcasters<br/>
                Time Management/Denmark - Certified as trainer’s trainer
            </p>
        </div>
    </div>

</div>








<!-- jQuery - and plugins JS files -->
<script src="{{asset('assets/landing_resource/js/plugins.js')}}" type="text/javascript"></script>
<!-- Background Animation Files JS -->
<script src="{{asset('assets/landing_resource/js/EasePack.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/landing_resource/js/TweenLite.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/landing_resource/js/animated1.js')}}" type="text/javascript"></script>
<!-- Contact Form JS -->
<script src="{{asset('assets/landing_resource/js/min/contact-form-min.js')}}" type="text/javascript"></script>
<!-- Google Maps JS -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBbWITJhiYWwcN7gobIdTe2RHGUWDmZKgw&amp;sensor=false"></script>
<!-- Our Main JS -->
<script src="{{asset('assets/landing_resource/js/min/main-min.js')}}" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-modal/2.2.6/js/bootstrap-modal.js" type="text/javascript"></script>

<script type="text/javascript">
    //  var modal = document.getElementById('myModal');

    // Get the button that opens the modal
    //  var btn = document.getElementById("myBtn");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks the button, open the modal
    // btn.onclick = function() {
    //     modal.style.display = "block";
    // }
    function modalOpenFunction(id) {
        modal = document.getElementById('modal_'+id);
        modal.style.display = "block";

        // $("#modal_close1").click( function() {
        //     modal.style.display = "none";
        // })

    }

    // When the user clicks on <span> (x), close the modal
    function closeModal(id) {
        var close_modal = document.getElementById('modal_'+id);
        close_modal.style.display = "none";
    }

    // // When the user clicks anywhere outside of the modal, close it
    // window.onclick = function(event) {
    //     if (event.target == modal) {
    //         modal.style.display = "none";
    //     }
    // }



</script>

</body>

</html>