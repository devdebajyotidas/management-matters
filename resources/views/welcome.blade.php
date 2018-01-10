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
    <link rel="icon" href="">
    <!-- Plugins CSS -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/landing_resource/css/plugins.css')}}">
    <!-- Our Min CSS -->
    <link rel='stylesheet' type="text/css" href="{{asset('assets/landing_resource/css/styles-animated.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('assets/landing_resource/css/style19.css')}}" id="colors">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
          integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
{{--    <link rel="stylesheet" href="{{ asset('assets/landing_resource/css/font-awesome.min.css') }}">--}}

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js" type="text/javascript"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js" type="text/javascript"></script>
    <![endif]-->

    <style type="text/css">
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
<div class="pre-loader gradient-color">
    <div class="loader"></div>
</div>
<!-- End PreLoader Section-->

<!-- Start Nav Section -->
<nav id="main-nav" class="nav-down">

    <div id="nav-color" class="gradient-color"></div>

    <div class="nav-wrapper">

        <!-- Add your Logo and Name here -->
        <a class="brand-logo design-font waves-effect waves-light no-bg" data-scroll-nav="0" href="#">
            <img class="responsive-img logo" src="{{asset('assets/img/mm-log.png')}}" alt="">
            <p class="title-link">
                <span>M</span><span>M</span>
            </p>
        </a>

        <!-- Main Menu Hamburger Icon for Mobile And Screen Width less than 993px -->
        <a href="#" data-activates="mobile-demo" class="button-collapse">

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

            <li>
                <a class="waves-effect waves-light no-bg" data-scroll-nav="0" href="#">Home</a>
            </li>

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
                <a class="waves-effect waves-light" data-scroll-nav="7" href="#">Contact</a>
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
                    <img class="responsive-img logo" src="{{asset('assets/landing_resource/images/logo.svg')}}"
                         alt="Logo image"><br>
                    <p class="title-link">
                        <span>A</span><span>p</span><span>p</span><span>e</span><span>r</span><span>l</span><span>e</span>
                    </p>
                </a>
            </li>

            <li>
                <a class="waves-effect waves-light" data-scroll-nav="0" href="#">Home</a>
            </li>

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
                <p class="description">Say hello to a whole new way to managing BETTER! <br> MM is a breakthrough
                    on-line program that inspires emerging and experienced managers and supervisors with the necessary
                    critical thinking skills to obtain superior performance from everyone in the organization.</p>

                <!-- App Slogan -->
                <p class="slogan">Tomorrow's Management Solution Today!</p>
            </div>

        </div>

        <div class="owl-carousel owl-header">

            <!-- Mobiles Image-->
            <img class="responsive-img" src={{asset('assets/landing_resource/images/iphone-mock/red/1-4.png')}} alt="">
            <img class="responsive-img" src={{asset('assets/landing_resource/images/iphone-mock/red/1-3.png')}} alt="">
            <img class="responsive-img" src={{asset('assets/landing_resource/images/iphone-mock/red/1-4.png')}} alt="">

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
                    <i class="gradient-color fa fa-snowflake-o fa-3x waves-circle waves-effect waves-light"></i>
                </div>

                <h5 class="p-tb-1">Learnings</h5>

                {{--<p>A new and innovative approach to learn and apply new skills to Coaching, Collaboration, Communication, Discipline, Engaging Today’s Workforce, Innovation and Creativity, Integrating Change,--}}
                {{--Meetings, Motivation, Performance Improvement, Problem Solving, Remote Supervising, Time Management, and Trust.</p>--}}

                <a class="button" href="#popup1">Click here to know more</a>
            </div>

            <div class="col s12 l4">

                <div class="icon p-tb-2">
                    <i class="gradient-color fa fa-pencil fa-3x waves-circle waves-effect waves-light"></i>
                </div>

                <h5 class="p-tb-1">Tools</h5>

                {{--<p>Management Self-Assessment, Quizzes, Personality (Behavior) Grid--}}
                {{--Identification Matrix, Tickets and Calendar Board, Awards, Notifications, Customization options,--}}
                {{--Dashboard (Analytics), and much more!</p>--}}
                <a class="button" href="#popup2">Click here to know more</a>

            </div>

            <div class="col s12 l4">

                <div class="icon p-tb-2">
                    <i class="gradient-color fa fa-superpowers fa-3x waves-circle waves-effect waves-light"></i>
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
                            <p>Assists managers to better manage today’s employees</p>
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
                            <p>Ensure knowledge attainment of the questions situational.</p>
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
                             src={{asset('assets/landing_resource/images/iphone-mock/red/1-4.png')}} alt="image of the
                             iPhone app">
                    </div>

                    <div>
                        <img class="responsive-img"
                             src={{asset('assets/landing_resource/images/iphone-mock/red/1-1.png')}} alt="image of the
                             iPhone app">
                    </div>

                    <div>
                        <img class="responsive-img"
                             src={{asset('assets/landing_resource/images/iphone-mock/red/1-2.png')}} alt="image of the
                             iPhone app">
                    </div>

                    <div>
                        <img class="responsive-img"
                             src={{asset('assets/landing_resource/images/iphone-mock/red/1-3.png')}} alt="image of the
                             iPhone app">
                    </div>

                    <div>
                        <img class="responsive-img"
                             src={{asset('assets/landing_resource/images/iphone-mock/red/1-4.png')}} alt="image of the
                             iPhone app">
                    </div>

                    <div>
                        <img class="responsive-img"
                             src={{asset('assets/landing_resource/images/iphone-mock/red/1-3.png')}} alt="image of the
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
                            <p>Assessment scores, Tickets completed, Awards attained, Quizzes completed.</p>

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
                            <p>A robust calendar to organize your Tickets</p>

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
                            <p>Receive awards completing activities, Quizzes, Assessment.</p>

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
            In Management Matters, positive behaviors are introduced <br> & <br> reinforced day-to-day
            <br>
            ensuring a change in employee attitudes and performance; contributing
            <br>
            greatly to a change in organizational culture.

        </p>

        <div class="row p-tb-3">

            <!-- Single Show Case -->
            <div class="col s12 l6" data-aos="fade-right" data-aos-delay="100">

                <!-- Small Title -->
                <h5 class="p-b-1">
                    PHASE 1
                </h5>

                <p><b>GET TO KNOW YOURSELF BETTTER</b></p>

                <div class="info">

                    <div>

                        <div>
                            <i class="fa fa-rocket gradient-color" aria-hidden="true"></i>
                        </div>

                    </div>

                    <div>

                        <h6> Conduct regularily a <b> Management Self-Assessment</b></h6>
                    </div>

                </div>

                <div class="info">

                    <div>

                        <div>
                            <i class="fa fa-rocket gradient-color" aria-hidden="true"></i>
                        </div>

                    </div>

                    <div>
                        <h6>A set of 3 questions out of 6 will be randomly selected for scoring by the Learner.
                            Thankfully, you won’t have to determine which Modules will be best suited for you to improve
                            your managing better skills. A prioritized list will be provided, as well as each score is
                            tabulated and conveyed on your Management Matters Chart.</h6>

                    </div>

                </div>

                <div class="info">

                    <div>

                        <div>
                            <i class="fa fa-rocket gradient-color" aria-hidden="true"></i>
                        </div>

                    </div>

                    <div>
                        <h6>Your goal must be <b>SPECIFIC</b>!</h6>
                    </div>

                </div>


            </div>

            <div class="col s12 l6 center-align" data-aos="fade-left" data-aos-delay="200">

                <!--Images-->
                <img src={{asset('assets/landing_resource/images/iphone-mock/red/3-1.png')}} alt="">

                <img class="absolute-image"
                     src={{asset('assets/landing_resource/images/iphone-mock/red/3-2.png')}} alt="">

            </div>

        </div>

        <div class="row p-tb-3 opposite-container">

            <!-- Single Show Case -->
            <div class="col s12 l6" data-aos="fade-left" data-aos-delay="200">

                <!-- Small Title -->
                <h5 class="p-b-1">PHASE 2</h5>

                <p><b>BROADEN YOUR HORIZONS</b></p>

                <div class="info">

                    <div>

                        <div>
                            <i class="fa fa-rocket gradient-color" aria-hidden="true"></i>
                        </div>

                    </div>

                    <div>

                        <h6> Obtain knowledge from the <b>Learning Modules Quizzes, and Cost of NOT Managing Better</b></h6>

                    </div>

                </div>

                <div class="info">

                    <div>

                        <div>
                            <i class="fa fa-rocket gradient-color" aria-hidden="true"></i>
                        </div>

                    </div>

                    <div>
                        <h6>Learning Modules for specific management topics to broaden the learner's knowledge with the
                            latest in the concepts and practices. The Learnings include an Overview, Why It Work, Keys,
                            Do's and Don'ts, Management Masters and Monsters, and Quizzes.

                            <br>You will be aware of the personality (behavior) styles within the workplace and
                            determine what those behaviors cost the organization. And then work to reduce their impact.
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
                        <h6>Your goal must be  <b>MEASURABLE</b>!</h6>

                    </div>

                </div>

            </div>

            <div class="col s12 l6 opposite center-align" data-aos="fade-right" data-aos-delay="100">

                <!--Images-->
                <img src={{asset('assets/landing_resource/images/iphone-mock/red/2-1.png')}} alt="">

                <img class="absolute-image"
                     src={{asset('assets/landing_resource/images/iphone-mock/red/2-2.png')}} alt="">

            </div>

        </div>

        <div class="row p-tb-3">

            <!-- Single Show Case -->
            <div class="col s12 l6" data-aos="fade-right" data-aos-delay="200">

                <!-- Small Title -->
                <h5 class="p-b-1">PHASE 3</h5>

                <p><b>RETHINK YOUR STRATEGY</b></p>

                <div class="info">
                    <div>
                        <div>
                            <i class="fa fa-rocket gradient-color" aria-hidden="true"></i>
                        </div>
                    </div>

                    <div>
                        <h6>Change behavior with the <b>Tickets and Calendar Board</b>
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
                        <h6>Visualized your Tickets or Action Items to managing better on the Board. This will allow you
                            to plan those incremental changes to better management practices.
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

                        <h6>Obtain awards when completing 10 activities.
                            Improving management practices requires due diligence and cannot be done as an one time
                            event. Keep in mind this is your personal improvement plan to FOREVER improve your skills.
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
                        <h6>Your goal must be <b>ASSIGNABLE</b>!</h6>

                    </div>

                </div>

            </div>

            <div class="col s12 l6 center-align" data-aos="fade-left" data-aos-delay="100">

                <!--Images-->
                <img src={{asset('assets/landing_resource/images/iphone-mock/red/3-2.png')}} alt="">

                <img class="absolute-image"
                     src={{asset('assets/landing_resource/images/iphone-mock/red/3-1.png')}} alt="">

            </div>

        </div>

        <div class="row p-tb-3 opposite-container">

            <!-- Single Show Case -->
            <div class="col s12 l6" data-aos="fade-left" data-aos-delay="200">

                <!-- Small Title -->
                <h5 class="p-b-1">PHASE 4</h5>

                <p><b>MAKE IT ROUTINE, TRACK PROGRESS AND BE REWARDED</b></p>

                <div class="info">

                    <div>

                        <div>
                            <i class="fa fa-rocket gradient-color" aria-hidden="true"></i>
                        </div>

                    </div>

                    <div>
                        <h6>Receive feedback from the <b>Awards and Notifications</b> on a regular basis by your daily activities as you manage better.
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


                        <h6>You will be given many new ideas to better
                            engage employees in a variety of situations and circumstances.
                            <br>
                            You can adjust your activities as time evolves.
                            With the attaining of awards, being notified of your managing better opportunities, and the
                            visualization of your progress, will have you engaged as never before - making Managing
                            Better fun!

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
                        <h6>Your goal must be <b>REALISTIC AND TIMELY!</b></h6>

                    </div>

                </div>

            </div>

            <div class="col s12 l6 opposite center-align" data-aos="fade-right" data-aos-delay="100">

                <!--Images-->
                <img src={{asset('assets/landing_resource/images/iphone-mock/red/3-2.png')}} alt="">

                <img class="absolute-image"
                     src={{asset('assets/landing_resource/images/iphone-mock/red/3-1.png')}} alt="">

            </div>

        </div>

    </div>

</section>
<!-- End Showcase Section-->

<!-- Start Subscribe Section-->
<section id="subscribe" class="main-section center-align">

    <div class="container row" data-aos="fade-up" data-aos-delay="100">

        <div class="subscribe-container">
            <div class="col s12 l4">

                <h4 class="title p-b-2">Subscribe</h4>

            </div>

            <!-- Subscription Form -->
            <form id="subscribe-form" name="subscribe-form" class="subscribe-input input-field col s12 l8">

                <!-- Email Field -->
                <input name="subscribe-email" id="subscribe-email" type="email" class="validate">

                <label data-error="Invalid Email" for="subscribe-email">Email</label>

                <!-- Submit Button -->
                <button id="subscribe-submit" class="gradient-color waves-effect waves-light" type="submit">

                    <i class="fa fa-paper-plane first"></i>

                    <i class="fa fa-paper-plane second"></i>

                </button>

                <!-- ! Anti-spam field ! Invisible for users, it will trick most bots to fill it and prevent the email from being sent to you -->
                <div class="input-field col s12 hidden">

                    <input type="text" id="subscribe-check-spam" placeholder="Leave field empty" name="check-spam">

                </div>

            </form>

        </div>

        <!-- Alert Message -->
        <div class="col s12 alert-message p-t-2" id="subscribe-alert-message"></div>

    </div>

</section>
<!-- End Subscribe Section-->

<!-- Start Screenshot Section-->
<section id="screenshot" data-scroll-index="2" class="main-section center-align">

    <div class="container">

        <!--Title-->
        <h4 class="reflection-text p-b-2">Screenshots</h4>

        <!-- Description -->
        <p class="p-t-1 desc">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum cupiditate deleniti eaque
            earum iste itaque quia rerum! Ea excepturi facere incidunt ipsam iure libero nemo, non pariatur rerum sequi
            voluptatibus.</p>

        <div class="carousel">

            <div class="carousel-item">

                <!-- Link to the image to open in full screen when clicked with lity plugin -->
                <a src={{asset('assets/landing_resource/images/iphone-mock/red/1-4.png')}} data-lity>

                    <!-- Screenshot Image -->
                    <img class="responsive-img"
                         src={{asset('assets/landing_resource/images/iphone-mock/red/1-4.png')}} alt="mobile mockup
                         image">

                </a>

            </div>

            <div class="carousel-item">

                <!-- Link to the image to open in full screen when clicked with lity plugin -->
                <a src={{asset('assets/landing_resource/images/iphone-mock/red/1-3.png')}} data-lity>

                    <!-- Screenshot Image -->
                    <img class="responsive-img"
                         src={{asset('assets/landing_resource/images/iphone-mock/red/1-3.png')}} alt="mobile mockup
                         image">

                </a>

            </div>

            <div class="carousel-item">

                <!-- Link to the image to open in full screen when clicked with lity plugin -->
                <a src={{asset('assets/landing_resource/images/iphone-mock/red/1-2.png')}} data-lity>

                    <!-- Screenshot Image -->
                    <img class="responsive-img"
                         src={{asset('assets/landing_resource/images/iphone-mock/red/1-2.png')}} alt="mobile mockup
                         image">

                </a>

            </div>

            <div class="carousel-item">

                <!-- Link to the image to open in full screen when clicked with lity plugin -->
                <a src={{asset('assets/landing_resource/images/iphone-mock/red/1-3.png')}} data-lity>

                    <!-- Screenshot Image -->
                    <img class="responsive-img"
                         src={{asset('assets/landing_resource/images/iphone-mock/red/1-3.png')}} alt="mobile mockup
                         image">

                </a>

            </div>

            <div class="carousel-item">

                <!-- Link to the image to open in full screen when clicked with lity plugin -->
                <a href="images/iphone-mock/red/1-1.png" data-lity>

                    <!-- Screenshot Image -->
                    <img class="responsive-img"
                         src={{asset('assets/landing_resource/images/iphone-mock/red/1-1.png')}} alt="mobile mockup
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


                <a class="m-t-1 grey darken-4 waves-effect waves-light"
                   href="landing_resource/images/iphone-mock/qrcode.jpg">
                    <span class="big-icon">
                        <i class="fa fa-qrcode"></i>
                    </span> Scan QR Code</a>
                </a>

            </div>

            <!-- Iphone Image on right -->
            <div class="col s12 l3 hide-on-med-and-down" data-aos="fade-left" data-aos-delay="100">

                <img class="responsive-img"
                     src={{asset('assets/landing_resource/images/iphone-mock/red/1-1.png')}} alt="">

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

                    <h5 class="p-b-1">Freelancer</h5>

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

                <a href="#" class="m-t-1 shadow-button waves-effect waves-light">Buy Now
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

                    <h5 class="p-b-1">One Project</h5>

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

                <a href="#" class="m-t-1 shadow-button waves-effect waves-light">Buy Now
                    <i class="fa fa-arrow-right"></i>
                </a>

            </div>

            <!-- Third Price -->
            <div class="price" data-aos="fade-right" data-aos-delay="100">

                <div class="gradient-color overlay"></div>

                <div class="info">

                    <h5 class="p-b-1">Multiple Projects</h5>

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

                <a href="#" class="m-t-1 shadow-button waves-effect waves-light">Buy Now
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
                         src={{asset('assets/landing_resource/images/iphone-mock/red/1-2.png')}} alt="">
                    <img class="responsive-img absolute-image"
                         src={{asset('assets/landing_resource/images/iphone-mock/red/1-4.png')}} alt="">
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

<!-- Start Map Section-->
<div id="map-section" data-scroll-index="7">

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
                    <form id="contact-form" name="contact-form" method="POST" data-name="Contact Form">

                        <div class="row">

                            <!-- Name Field -->
                            <div class="input-field col s12">

                                <i class="fa fa-user-o prefix" aria-hidden="true"></i>
                                <input id="contact-name" type="text" class="validate" name="first_name" required>
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

                                <button id="contact-submit" class="gradient-color waves-effect waves-light"
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
                            <span>15 Bath Rd, Heathrow, Longford, Hounslow TW6 2AB, UK</span>

                        </p>

                        <!-- Your Phone Number -->
                        <p class="p-b-1">

                            <i class="address-icon fa fa-phone"></i>
                            <a href="tel:+441711278528"> +44 171 127 8528</a>

                        </p>

                        <!-- Your Email -->
                        <p class="p-b-1">

                            <i class="address-icon fa fa-paper-plane" aria-hidden="true"></i>
                            <a href="mailto:perla.app@example.com">perla.app@example.com</a>

                        </p>

                        <!-- Your Social Network Links-->


                    </div>

                </div>

            </div>

        </div>

        <!-- Footer Area -->
        <div class="footer-content p-t-3 left-align">

            <div class="container">

                <div class="row">

                    <div class="about col s12 m6 l3">

                        <h5 class="p-b-2">About Us</h5>

                        <!-- Your Logo -->
                        <img class="responsive-img logo" src="" alt="logo image">
                        <br>
                        <!-- Your Title -->
                        <p class="title-link">
                            <span>A</span><span>p</span><span>p</span><span>e</span><span>r</span><span>l</span><span>e</span>
                        </p>
                        <!-- Your Info -->
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consectetur, exercitationem!</p>

                    </div>

                    <!-- News -->


                    <!-- Tags -->


                </div>

            </div>

        </div>

    </div>

</section>
<!-- End Footer Section-->

<!-- Start Copy Rights Section-->
<div id="copy-rights" class="col s12">

    <div class="container">

        <!-- Your Copy Right -->
        <p>Copyright &copy;</p>

        <!-- Your Social Network Links-->


    </div>

</div>
<!-- End Copy Rights Section-->

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


</body>

</html>
