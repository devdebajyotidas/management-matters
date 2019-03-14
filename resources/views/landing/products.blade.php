<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="{{asset('assets/images/favicon.png')}}" />
    <title>ManagementFITT - Products</title>

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
        .large_letter {
            color: #00B289;
            font-size: 20px;
        }

        .hideContent {
            overflow: hidden;
            line-height: 1em;
            height: 3em;
            transition: height 0.3s ease;
        }

        .showContent {
            line-height: 1em;
            height: auto;
            transition: height 0.3s ease;
            overflow: hidden;
        }

        .show-more {
            padding: 10px 0;
            /*text-align: center;*/
        }
    </style>
    <style type="text/css">
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
    </style>
</head>

<!-- Body Start -->

<body>

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
                        <li><a class="nav-link" href="{{url('/')}}">Home</a></li>
                        <li><a class="nav-link" href="{{url('/tools')}}">Tools</a></li>
                        <li><a class="nav-link" href="{{url('/workflow')}}">How It Works</a></li>
                        <li><a class="nav-link " href="{{url('/faq')}}">FAQs</a></li>
                        <li><a class="nav-link" href="{{url('/about')}}">About</a></li>
                        <li><a class="nav-link " href="{{url('/pricing')}}">Pricing</a></li>
                        <li><a class="nav-link activated" href="{{url('/products')}}">Products</a></li>
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
        <!-- Featre -->
        <section class="section gray-bg aboutus-section">
            <div class="container">
                <div class="row justify-content-center m-50px-b md-m-35px-b">
                    <div class="col-md-12 col-lg-10 col-xl-10 col-sm-12 text-center">
                        <h2 class="theme-title-disabled" style="color: var(--primary-color)">The <span class="theme-text-secondary">FITT</span> Products</h2>
                        <p class="text-center mt-4">On-site and remote training on all the functions of LeanFITT™ is available. Please call 734-475-4301 or email info@leanfitt.com. We offer a 4-hour training session (maximum per group is 12), taking users through a LeanFITT™ business case study and assist in setting up first projects. Cost 2500 per day, plus expenses (minimum 1 day).</p>
                    </div>
                </div>
                <div class="row justify-content-center m-50px-b md-m-35px-b founders-cards override-products-cards">
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 card-container">
                        <div class="row card">
                            <div class="col-md-12 card-heading">
                                <img src="{{asset('assets/images/leanfitt_logo.svg')}}" alt="LeanFITT&trade;" />
                            </div>
                            <div class="col-md-12 card-body">
                                
                                <p>LeanFITT™ harnesses the power of continuous improvement, employee engagement, and standardized knowledge and tool usage to inspire process changes that make a big impact. LeanFITT™ surrounds you with the right Functional, Integrated, Technology, and Training during your journey of getting your process FITT– FOREVER!</p>
                            </div>
                            <div class="col-md-12 card-footer">
                                <a href="http://leanfitt.com/" class="btn btn-secondary theme-btn" style="border-radius: 7px;">Click to Visit</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 card-container">
                        <div class="row card">
                            <div class="col-md-12 card-heading">
                                <img src="{{asset('assets/images/leanstore_logo.svg')}}" alt="TheLeanStore&trade;" />
                            </div>
                            <div class="col-md-12 card-body">
                                <p> Lorem ipsum dolor sit abet, consectetur adipisicing elite. In, venial! Lorem ipsum dolor sit abet, consectetur. Lorem ipsum dolor sit abet, consectetur adipisicing elite. In, venial! Lorem ipsum dolor sit abet, consectetur.</p>
                            </div>
                            <div class="col-md-12 card-footer">
                                <a href="https://theleanstore.com/" class="btn btn-secondary theme-btn" style="border-radius: 7px;">Click to Visit</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 card-container">
                        <div class="row card">
                            <div class="col-md-12 card-heading">
                                <img src="{{asset('assets/images/leanfoxsolutions_logo.png')}}" alt="LeanFoxSolutions&trade;" />
                            </div>
                            <div class="col-md-12 card-body">
                                <p>MF harnesses the power of behavioral change to inspire small changes that make a big impact. MF surrounds you with the right Learnings, Tools, and Technology during your journey of becoming a better manager - FOREVER!</p>
                            </div>
                            <div class="col-md-12 card-footer">
                                <a href="http://www.leanfoxsolutions.com/" class="btn btn-secondary theme-btn" style="border-radius: 7px;">Click to Visit</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- container -->
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
</html>