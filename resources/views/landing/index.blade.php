<!DOCTYPE html>
<html lang="zxx">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="{{asset('assets/images/favicon.png')}}" />
    <title>ManagementFITT</title>

    <!-- ICONS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<!--    <link href="http://leanfitt-testing.tk/assets/static/plugin/themify-icons/themify-icons.css" rel="stylesheet">-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/material-design-icons/3.0.1/iconfont/material-icons.min.css" rel="stylesheet">

    <!-- THEME CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.css" />


    <!-- CUSTOM CSS -->
    <link href="{{asset('assets/css/styles.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/custom.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/default.css')}}" rel="stylesheet">

    <style type="text/css">
        section#home {
            background-size: auto;
        }
        @media only screen and (max-width: 1600px) {
            section#home {
                background-size: 75%;
            }
        }
        @media only screen and (max-width: 1200px) {
            section#home {
                background-size: 80%;
            }
            section#home .container .full-screen {
                min-height: unset;
            }
        }
        @media only screen and (max-width: 992px) {
            section#home {
                background-size: contain;
                background-image: url(assets/images/zone3-1.svg) !important;
            }
            .navbar {
                background: #8bc4ff90;
            }
            section#home .container .full-screen .col {
                padding-top: 100px;
            }
        }
        @media only screen and (max-width: 768px) {
            section#home {
                background-image: unset !important;
            }
            section#home .container .full-screen .col {
                padding-top: 0;
                margin-top: 0;
            }
            .navbar {
                background: white;
            }
        }
        .conter_row {
            width: 900px;
            margin: 0 auto;
            max-width: 100%;
        }

        .username {
            position: relative;
            padding: 0;
            display: inline-block;
            font-size: 16px;
            vertical-align: top;
            color: #333357;
            font-weight: 400;
            line-height: 38px;
        }

        #nprogress .spinner {
            display: none !important;
            z-index: -100;
        }

        .dropmessage-response p {
            padding: 15px 10px;
            background-color: #f8f8f8;
            border-left: 5px solid #00B289;
        }
        .header-nav-light .navbar-nav .nav-link {
            color: white;
            font-weight: 500;
        }
        .header-nav-light .navbar-nav .nav-link.activated {
            color: var(--secondary-color);
        }
        .header-nav-light .navbar-nav .nav-link.nav-btn {
            border-color: white;
        }
        .header-nav-light .navbar-nav .nav-link.activated.nav-btn {
            border-color: var(--secondary-color);
        }
        .header-nav-light .navbar-nav .nav-link:after {
            background: white;
        }
        .header-nav-light .navbar-nav .nav-link.activated:after {
            background: var(--secondary-color);
        }
        .feature-box-01 {
            border: none;
            box-shadow: var(--theme-shadow);
            transition: transform 0.3s;
        }
        .feature-box-01 .fix_height {
            height: 200px;
            overflow: scroll;
        }
        @media only screen and (min-width: 1024px) {
            .feature-box-01:hover {
                transform: scale(1.05);
            }
        }
    </style>
</head>

<!-- Body Start -->

<body data-spy="scroll" data-target="#navbar" data-offset="98">

    <!-- Loading -->
    <div id="loading">
        <div class="load-circle"><span class="one"></span></div>
    </div>
    <!-- / -->

    <!-- Header -->
    <header>
        <nav class="navbar header-nav fixed-top navbar-expand-lg header-nav-light">
            <div class="container">
                <!-- Brand -->
                <a class="navbar-brand landing_logo" href="{{url('/')}}">
                    <img class="mb-4 lean_logo" src="{{asset('assets/images/logo.png')}}" alt="">
                </a>
                <!-- / -->

                <!-- Mobile Toggle -->
                <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
                <!-- / -->
                <div class="collapse navbar-collapse justify-content-end" id="navbar">
                    <ul class="navbar-nav ml-auto">
                        <li><a class="nav-link activated" href="{{url('/')}}">Home</a></li>
                        <li><a class="nav-link" href="{{url('/tools')}}">Tools</a></li>
                        <li><a class="nav-link" href="{{url('/workflow')}}">How It Works</a></li>
                        <li><a class="nav-link " href="{{url('/faq')}}">FAQs</a></li>
                        <li><a class="nav-link" href="{{url('/about')}}">About</a></li>
                        <li><a class="nav-link " href="{{url('/pricing')}}">Pricing</a></li>
                        <li><a class="nav-link " href="{{url('/products')}}">Products</a></li>
                        <li><a class="nav-btn-default nav-link " href="{{url('/login')}}">Login</a></li>
                        <li><a class="nav-btn-default nav-link" href="{{url('/register')}}">Sign Up</a></li>
                    </ul>
                </div>
                <!-- Top Menu -->
                <!-- / -->

            </div><!-- Container -->
        </nav> <!-- Navbar -->
    </header>
    <!-- Header End -->

    <!-- Main Start -->
    <main>
        <!-- Home Banner Start -->
        <section id="home" class="home-banner-01 gray-bg-g border-bottom" style="background-image: url('{{asset('assets/images/zone-3.svg')}}');background-repeat: no-repeat;background-position: right top;">
            <div class="container">
                <div class="row full-screen align-items-center">
                    <div class="col col-md-12 col-lg-5 col-xl-5 p-80px-tb md-p-30px-b sm-p-60px-t m-50px-t">
                        <div class="home-text-center p-50px-r md-p-0px-r">
                            <h1 class="font-alt" style="color: #0080FF;"><span style="font-weight: bold;">Say HELLO!</span></h1>
                            <p>to a whole new way to managing BETTER!</p>
                            <h3 class="mt-4 mb-2">
                                <a href="javascript:void(0)" class="btn btn-primary theme-btn" style="border-radius: 50px; box-shadow: none; font-size: unset; padding: 2px 20px;">Try It Now</a>
                                free trial for 30 days !
                            </h3>
                            <h4>(no credit card required !)</h4>
                        </div> <!-- home-text-center -->
                    </div>
                </div>
            </div><!-- container -->
        </section>
        <!-- / -->
        <!-- about us -->

        <section id="tomorrowManagement" class="section border-bottom" style="padding-bottom: 50px;">
            <div class="container">
                <div class="row justify-content-center m-20px-b">
                    <div class="col-md-8 col-lg-8 col-xl-7 col-sm-12">
                        <h2 class="theme-after-bg mb-4 text-white text-left">TOMORROW'S <br>MANAGEMENT SOLUTIONS TODAY!</h2>
                        
                        <p>Join Us To Become A Better Manager.</p>
                        <p>MF harnesses the power of behavioral change to inspire small changes that make a big impact. MF surrounds you with the right Learnings, Tools, and Technology during your journey of becoming a better manager - FOREVER!</p>
                    </div>
                    <div class="col-md-4 col-lg-4 col-xl-5 col-sm-12 text-center">
                        <img src="{{asset('assets/images/home_2nd_handshake.svg')}}" alt="ManagementFITT" />
                    </div>
                </div>
            </div> <!-- container -->
        </section>
        
        <!-- ABOUT -->
        <section id="about" class="section border-bottom" style="padding-bottom: 50px;">
            <div class="container">
                <div class="row justify-content-center mb-5 text-center">
                    <div class="col-md-4 col-lg-4 col-xl-4">
                        <div class="home-3rd-section-cards">
                            <div class="card-logo-container">
                                <img src="{{asset('assets/images/learnings.svg')}}" alt="Learnings"/>
                            </div>
                            <div class="card-body-container">
                                <h5 class="card-heading">Learnings</h5>
                                <p>A new and innovative approach to learn and apply new skills to Coaching, Collaboration, Communication, Discipline.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-4 col-xl-4">
                        <div class="home-3rd-section-cards">
                            <div class="card-logo-container">
                                <img src="{{asset('assets/images/tools.svg')}}" alt="Learnings"/>
                            </div>
                            <div class="card-body-container">
                                <h4 class="card-heading">Tools</h4>
                                <p>Management Self-Assessment, Quizzes, Personality (Behavior) Grid Identification Matrix, Tickets and Calendar Board, Awards, Notifications, Customization options, Dashboard (Analytics), and much more!</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-4 col-xl-4">
                        <div class="home-3rd-section-cards">
                            <div class="card-logo-container">
                                <img src="{{asset('assets/images/technology.svg')}}" alt="Learnings"/>
                            </div>
                            <div class="card-body-container">
                                <h5 class="card-heading">Technology</h5>
                                <p>Essential tools for better managing today’s employees made available on any device at any time. Once enrolled you will have all the tools available right at your fingertips!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- container -->
        </section>
<!--
        <section id="whatPeopleSay" class="section border-bottom" style="padding-bottom: 50px;">
            <div class="container">
                <div class="row justify-content-center mb-5 text-center">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <h2 class="theme-title-primary">What People Say ?</h2>
                    </div>
                </div>
                <div class="row justify-content-center mb-5 text-center">
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        
                    </div>
                </div>
            </div>
        </section>
-->
        
        <!-- Tools -->
        <section id="about" class="section border-bottom" style="padding-bottom: 50px;">
        <div class="container">
            <div class="row justify-content-center m-20px-b">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <h2 class="theme-title-primary">ManagementFITT&trade; tools</h2>
                    <p class="text-center">We sort 14 tools to improve your business communications</p>
                </div>
            </div>

            <div class="conter_row">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-4 m-15px-tb">
                        <div class="feature-box-01">
                            <div class="icon blue">
                                <img src="{{asset('assets/images/tools/coaching.png')}}">
                            </div>
                            <h4><a href="#">Coaching</a></h4>
                            <!-- <p>methods to ensure areas, files, folders, etc.</p> -->
                        </div>
                    </div> <!-- col -->
                    <div class="col-12 col-md-6 col-lg-4 m-15px-tb">
                        <div class="feature-box-01">
                            <div class="icon red">
                                <img src="{{asset('assets/images/tools/conflict-management.png')}}">
                            </div>
                            <h4><a href="#">Conflict Management</a></h4>
                            <!-- <p>“tell the continuous improvement story” in a logical and visual way.</p> -->
                        </div>
                    </div> <!-- col -->
                    <div class="col-12 col-md-6 col-lg-4 m-15px-tb">
                        <div class="feature-box-01">

                            <div class="icon green">
                                <img src="{{asset('assets/images/tools/communications.png')}}">
                            </div>
                            <h4><a href="#">Communications</a></h4>
                            <!-- <p>5 step problem solving methodology.</p> -->
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-md-6 col-lg-4 m-15px-tb">
                        <div class="feature-box-01">
                            <div class="icon green">
                                <img src="{{asset('assets/images/tools/descipline.png')}}">
                            </div>
                            <h4><a href="#">Discipline</a></h4>
                            <!-- <p>“tell the continuous improvement story” in a logical and visual way.</p> -->
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4 m-15px-tb">
                        <div class="feature-box-01">
                            <div class="icon red">
                                <img src="{{asset('assets/images/tools/engaging-today.png')}}">
                            </div>
                            <h4><a href="#">Engaging Today’s Workforce</a></h4>
                            <!-- <p>methods to ensure areas, files, folders, etc.</p> -->
                        </div>
                    </div> <!-- col -->
                    <div class="col-12 col-md-6 col-lg-4 m-15px-tb">
                        <div class="feature-box-01">
                            <div class="icon blue">
                                <img src="{{asset('assets/images/tools/innovation-and-creativity.png')}}">
                            </div>
                            <h4><a href="#">Innovation and Creativity</a></h4>
                            <!-- <p>ask questions, and provide support and insights.</p> -->
                        </div>
                    </div>
                </div>
            </div>


            <div class="row justify-content-center ">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <div class="" style="padding-top: 30px; text-align: center;">
                        <h2 class="tool_more"><a href="{{url('/tools')}}">+ 8 more</a></h2>
                        <!-- <a href="">see more</a> -->
                    </div>
                </div>
            </div>

        </div> <!-- container -->
    </section>

        <!-- Get it now -->
        <section id="getItNow" class="section border-bottom">
            <div class="container">
                <div class="row justify-content-center m-45px-b md-m-25px-b">
                    <div class="col-md-6 col-lg-4 m-15px-tb">
                        <div class="">
                            <h2 class="theme-after-bg">Get It Now</h2>
                            <p class="cont">The New MF App Lorem ipsum dolor sit abet, consectetur adipisicing elite. In, venial! Lorem ipsum dolor sit abet, consectetur.</p>
                        </div>
                        <div class="row mt-5">
                            <div class="col-md-12 col-to-center">
                                <a href="javascript:void(0)" class="btn get-it-now-button" target="_blank">
                                    <i class="fa fa-apple mb-2 mr-3" style="font-size: 45px;"></i>
                                    <span>
                                        <span class="available-on">available on</span><br>
                                        App Store
                                    </span>
                                </a>
                                
                                <a href="javascript:void(0)" class="btn get-it-now-button" target="_blank">
                                    <i class="fa fa-android mb-2 mr-3" style="font-size: 45px;"></i>
                                    <span>
                                        <span class="available-on">available on</span><br>
                                        Google Play
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div> <!-- col -->
                    <div class="col-md-6 col-lg-8 m-15px-tb text-right">
                        <div class=" m-50px-l md-m-0px-l">
                            <img src="{{asset('assets/images/get-it-now.svg')}}" alt="Get It Now" />
                        </div>
                    </div> <!-- col -->
                </div> <!-- row -->
            </div> <!-- Container -->
        </section>
        
        <!-- Contact us -->
        <section id="contatus" class="section border-bottom">
            <div class="container">
                <div class="row justify-content-center m-45px-b md-m-25px-b">
                    <div class="col-md-10 col-lg-8">
                        <h2 class="theme-after-bg">Quick Contact</h2>
                        <p class="footer-text text-center">We would love to answer any and all questions you may have with Management FITT™. It can be optimized for your organization. We just need to hear from you! And Management FITT™ can accelerate your continuous improvement journey like nothing else!</p>
                    </div> <!-- col -->
                </div> <!-- row -->

                <div class="row">
                    <div class="col-md-6 col-lg-4 m-15px-tb">
                        <div class="contact-info-box">
                            <h2>contact information</h2>
                            <div class="contact-info mt-4">
                                <p class="ml-3">
                                    <i class="fa fa-map-marker theme-text-primary mr-3" style="font-size: 18px;"></i>
                                    <span>
                                        MCS Media, Inc. <br>
                                    </span>
                                    <span style="margin-left: 28px;">
                                        (TheLeanStore)<br>
                                    </span>
                                    <span style="margin-left: 28px;">
                                        888 Ridge Road <br>
                                    </span>
                                    <span style="margin-left: 28px;">
                                        Chelsea, Michigan 48118
                                    </span>
                                </p>
                            </div>
                            <div class="contact-info">
                                <p class="ml-3">
                                    <i class="fa fa-phone theme-text-primary mr-3" style="font-size: 18px;"></i>
                                    +734-475-4301
                                </p>
                            </div>
                            <div class="contact-info">
                                <p class="ml-3">
                                    <i class="fa fa-envelope theme-text-primary mr-3" style="font-size: 18px;"></i>
                                    info@managementfitt.com
                                </p>
                            </div>
                            <div class="contact-info">
                                <p class="ml-3">
                                    <i class="fa fa-internet-explorer theme-text-primary mr-3" style="font-size: 18px;"></i>
                                    www.managementfitt.com
                                </p>
                            </div>
                        </div>
                    </div> <!-- col -->
                    <div class="col-md-6 col-lg-8 m-15px-tb">
                        <div class="contact-form m-50px-l md-m-0px-l">
                            <h2>Drop Us A Message</h2>
                            <form id="contactForm" class="contactform" method="post" onsubmit="javascript:void(0)">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input name="name" type="text" placeholder="Name" class="validate form-control" required="">
                                            <span class="input-focus-effect"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="email" placeholder="Email" name="email" class="validate form-control" required="">
                                            <span class="input-focus-effect"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" placeholder="Subject" name="subject" class="validate form-control" required="">
                                            <span class="input-focus-effect"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" placeholder="Phone" name="phone" class="validate form-control" required="">
                                            <span class="input-focus-effect"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <textarea placeholder="Your Comment" name="message" class="form-control" required=""></textarea>
                                            <span class="input-focus-effect"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="send">
                                            <button class="m-btn m-btn-theme2nd" type="submit" name="send"> Send</button>
                                        </div>
                                        <div class="form-group mt-4 dropmessage-response" style="display: none">
                                            <p></p>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div> <!-- col -->
                </div> <!-- row -->
            </div> <!-- Container -->
        </section>
        <!-- / -->

    </main>
    <!-- Main End -->

    <!-- Footer Start -->
    <footer class="footer-light">
        <section class="footer-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-lg-4 cols">
                        <h4 class="font-alt">About Us</h4>
                        <p class="footer-text">MF harnesses the power of behavioral change to inspire small changes that make a big impact. MF surrounds you with the right Learnings, Tools, and Technology during your journey of becoming a better manager - FOREVER!</p>
                    </div> <!-- col -->

                    <div class="col-md-6 col-lg-4 cols">
                        <h4 class="font-alt">Pages</h4>
                        <ul class="fot-link">
                            <li><a href="{{url('/')}}">Home</a></li>
                            <li><a href="{{url('/tools')}}">Tools</a></li>
                            <li><a href="{{url('/workflow')}}">How It Works</a></li>
                            <li><a href="{{url('/faq')}}">FAQs</a></li>
                            <li><a href="{{url('/about')}}">About Us</a></li>
                            <li><a href="{{url('/pricing')}}">Pricing</a></li>
                            <li><a href="{{url('/products')}}">Products</a></li>
                        </ul>
                    </div>

                    <div class="col-md-6 col-lg-4 cols">
                        <h4 class="font-alt">Get in touch</h4>
                        <p>MCS Media, Inc. </p>
                        <p>(TheLeanStore.com)</p>
                        <p>888 Ridge Road</p>
                        <p>Chelsea, MI 48118 USA</p>
                        <p><span>E-Mail:</span> info@managementfitt.com </p>
                        <p><span>Phone:</span> +734-475-4301 </p>
                        <p><span>Website:</span> ManagementFITT.com</p>
                    </div> <!-- col -->

                </div>

                <div class="footer-copy">
                    <div class="row">
                        <div class="col-12">
                            <p>Copyright © 2018 ManagementFITT&trade;. All rights reserved.</p>
                        </div><!-- col -->
                    </div> <!-- row -->
                </div> <!-- footer-copy -->

            </div> <!-- container -->
        </section>
    </footer>
    <!-- / -->

    <!-- JQUERY -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-migrate/3.0.0/jquery-migrate.min.js"></script>

    <!-- SCRIPTS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.js"></script>

    <!-- CUSTOM SCRIPTS -->
    <script src="{{asset('assets/js/custom.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            
        });
    </script>
</body>
<!-- Body End -->
</html>