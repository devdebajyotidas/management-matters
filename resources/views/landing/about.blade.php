<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="{{asset('assets/images/favicon.png')}}" />
    <title>ManagementFITT - About Us</title>

    <!-- ICONS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <!--    <link href="http://leanfitt-testing.tk/assets/static/plugin/themify-icons/themify-icons.css" rel="stylesheet">-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/material-design-icons/3.0.1/iconfont/material-icons.min.css" rel="stylesheet">

    <!-- THEME CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />

    <!-- CUSTOM CSS -->
    <link href="{{asset('assets/css/styles.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/custom.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/default.css')}}" rel="stylesheet">

    <style type="text/css">
        @media only screen and (min-width: 768px) {
            section#team {
                padding: 90px 0 200px 0;
            }
        }

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
        .show-more a {
            color: var(--primary-color) !important;
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
        .team {
            background-image: url("{{asset('assets/images/team/1.svg')}}"), url("{{asset('assets/images/team/2.svg')}}");
            background-repeat: no-repeat, no-repeat;
            background-size: auto;
            background-position: left bottom, right top;
        }
        .team h6 {
            color: black;
        }
        .team-avatar {
            height: 120px;
            width: 120px;
            object-fit: cover;
            /*border-radius: 100%;*/
            border-radius: 100% 50% 50% 100% / 75% 69% 69% 75%;
        }
        .team-social {
            font-size: 25px;
            color: gray !important;
            transition: color 0.3s;
            text-decoration: none !important;
            cursor: pointer;
        }
        .team-social.facebook {
            margin-right: 5px;
        }
        .team-social.facebook:hover {
            color: #3e5d93 !important;
        }
        .team-social.linkedin:hover {
            color: #3a7ab0 !important;
        }
        .team-social-group .social-icons {
            text-align: right;
            font-size: 30px;
        }
        @media only screen and (max-width: 992px) {
            .team {
                background-size: 30%;
            }
        }
        @media only screen and (max-width: 768px) {
            .team img.team-avatar:not(:first-child){
                margin-top: 20px;
            }
            .team-social-group, .team-social-group .social-icons {
                text-align: center !important;
            }
        }
        @media only screen and (max-width: 480px) {
            .team {
                background-image: none;
            }
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
                        <li><a class="nav-link activated" href="{{url('/about')}}">About</a></li>
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
        <!-- Featre -->
        <section class="section gray-bg aboutus-section">
            <div class="container">
                <div class="row justify-content-center m-50px-b md-m-35px-b">
                    <div class="col-md-10 col-lg-12 col-xl-12 col-sm-12 text-center">
                        <h2 class="theme-title-primary">About Us</h2>
                        <img src="{{asset('assets/images/about_1st_section_image.svg')}}" alt="About Us" class="mt-5" />
                        <div class="row justify-content-center">
                            <div class="col-md-10 col-md-offset-1">
                                <h4 class="mt-5">About ManagementFITT&trade;</h4>
                                <p class="mt-3">MangementFITT&trade; harnesses the power of behavioral change to inspire small changes that make a big impact.  ManagementFITT&trade; surrounds you with the right Functional, Integrated, Technology, and Training during your journey to becoming a more FITT manager!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- container -->
        </section>
        <!-- / -->
        <!-- Our Team -->

        <section class="section border-bottom">
            <div class="container">
                <div class="row justify-content-center m-45px-b md-m-25px-b">
                    <div class="col-md-10 col-lg-8">
                        <h2 class="theme-title-primary">The Founders</h2>
                    </div>
                </div> <!-- row -->

                <div class="row">
                    <div class="col-md-12 col-lg-12 m-15px-tb">
                        <div class="our-team row">
                            <div class="col-md-9 col-lg-10">
                                <div class="info" style="text-align: left;">
                                    <h6>Don Tapping</h6>
                                    <label class="theme-text-secondary mb-2">Publisher and Author</label>
                                    <div class="content hideContent">
                                        <p style="line-height: 21px;">
                                            Don Tapping graduated from The University of Michigan in 1976. He spent the next four years as a Lieutenant in the United States Marine Corps in various positions during his tour. After completing his Corps duties, Don worked in the medical technology, education, and aerospace industries for the next 20 years. Don authored the best-selling book, Value Stream Management for the Lean Office (Productivity Press 2003), Lean Office Demystified (II), Who Hollered Fore?, and over 50 other books and apps on business performance - setting the bar for continuous improvements. He continues to enlighten organizations with his ability to design step-by-step implementation methodologies identifying processes that require improvement, and then introducing proactive steps to improve or redesign them - reducing costs, boosting performance, and increasing customer (patient) satisfaction. Don today is using his experience in developing apps on how Lean can be applied using smart devices. Don also received his MBA from The University of Notre Dame.
                                        </p>
                                    </div>
                                    <div class="show-more">
                                        <a href="javascript:void(0)">Show more</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-lg-2">
                                <div class="img" style="background-image: url({{asset('assets/images/don_tapping.jpg')}});">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 col-lg-12 m-15px-tb">
                        <div class="our-team  bg-reverse row">
                            <div class="col-md-3 col-lg-2">
                                <div class="img" style="background-image: url({{asset('assets/images/joe_d_buys.jpg')}});">
                                </div>
                            </div>
                            <div class="col-md-9 col-lg-10">
                                <div class="info" style="text-align: left;">
                                    <h6>Joe D Buys</h6>
                                    <label class="theme-text-secondary mb-2">Partner</label>
                                    <div class="content hideContent">
                                        <p style="line-height: 21px;">
                                            As a senior partner, Joe Buys has been an innovator in Cross-Functional Team Development, Creative Problem Solving, and Leadership Development. More recently, he’s been working on developing strategies for companies to implement Lean processes into both areas of production and administration. He has been an expert contributor on the www.Allexperts.com website for over 10 years.<br>
                                            In addition to his human resource expertise as a consultant, Joe Buys was a national leader in the communications and research industries for over two decades. A past president of the Michigan Association of Broadcasters, Joe had a distinguished career in broadcasting as owner and/or manager of stations in Lansing, MI (WVIC- AM-FM), Detroit, MI (WKSG KISS-FM), Grand Rapids, MI (WZZR) and Fort Wayne, IN (WOWO-AM /FM).<br>
                                            As a businessman and consultant, he has earned the reputation as a paladin by successfully turning around a number of unprofitable businesses through in-depth, hands-on management and employee coaching. He also left an imprint on the research industry as Central Division Manager for the Arbitron Research Company in Chicago. However, unlike most turn-around experts, he did it without a smoking gun. Instead of replacing people, he trains and motivates them. He understands the need for managers to empower and challenge their employees by instilling a sense of dignity through compassion and pride.<br>

                                            “We have to tell our clients the facts in a way that they can understand how they will be impacted by them. Then we have to provide them with different tools they can use to improve performance, based on the reality of their situation. I trust that they will then make the best decisions for their particular needs.”<br><br>

                                            <strong style="color: black;">Personal History:</strong><br><br>

                                            Joe Buys was born in Grand Rapids, MI however, he lived his early years in East Lansing, MI. He developed an early interest in acting and competitive swimming. He participated in Toy Shop Theatre, a program at Michigan State University for young adults interested in theatre. That relationship led to his interest in broadcasting that was encouraged by cross participation between Toy Shop Theatre and the University’s television station, WKAR-TV. The interest in broadcasting and swimming led to an easy choice of college as he attended his hometown Michigan State University where he majored in Radio and Television, minored in Business and swam on the Spartan swim team. As an adult, he continued his swimming career by competing in the United States Masters Swimming and the Senior Olympics. He has set numerous state records, won a national championship and help set three world relay records.<br><br>

                                            <strong style="color: black;">Client Base:</strong><br><br>

                                            Manufacturing , Healthcare, Financial Services, Trade Associations, Media Law, Service Industries, Non-Profits, Oil<br><br>

                                            <strong style="color: black;">Credentials:</strong><br><br>
                                            Editor “Back-Street Lean” a book on Lean Manufacturing MA. Michigan State University - Telecommunications/Business<br>
                                            B.A. Michigan State University - Telecommunications/Marketing<br>
                                            Board Member - Michigan Association of Broadcasters Foundation<br>
                                            Past President- Michigan Association of Broadcasters<br>
                                            Past President - Communication Arts Alumni Association - Michigan State University<br>
                                            Past President - Central East Lansing Business Association<br>
                                            Legislative Liaison, National Association Broadcasters<br>
                                            Time Management/Denmark - Certified as trainer’s trainer
                                        </p>
                                    </div>
                                    <div class="show-more">
                                        <a href="javascript:void(0)">Show more</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 col-lg-12 m-15px-tb">
                        <div class="our-team row">
                            <div class="col-md-9 col-lg-10">
                                <div class="info" style="text-align: left;">
                                    <h6>Cynthia Guy</h6>
                                    <label class="theme-text-secondary mb-2">Partner</label>
                                    <div class="content hideContent">
                                        <p style="line-height: 21px;">
                                            Cynthia Guy is a senior partner at Crystal Clear Concepts, a management consulting firm. She holds a BA from Michigan State University in Journalism. She is a Communications and a Leadership specialist from Harvard/McBer Institute. She’s a certified T.A. analyst as well as certified by the AMA and Time Manager/Denmark. Her strengths are being a catalyst of organizational change, leadership and innovation. She has been certified in the Sycronist (Lean) Manufacturing program from General Motors. She is the author of Finding Profit, a book about the transformation of a business through lean manufacturing principles. In addition to a decade of human resource management expertise, Guy's strength lies in her ability as a catalyst of change. She’s been quoted as a change expert in the New York Times. Through close interaction with top management, she has been responsible for ushering in significant, positive change in a number of areas such as leadership, improved productivity and quality, resulting in increased profitability for companies. She developed her management skills as an owner of a major advertising agency that she operated before becoming a management consultant. She has gained the respect and admiration of top executives in business throughout the nation.<br><br>
                                            <strong style="color: black;">Credentials:</strong><br><br>
                                            B.A. - Michigan State University<br>
                                            McBer Institute, Harvard - Managing Motivation for Performance Improvement<br>
                                            Author – Finding Profit, the story of Lean transformation<br>
                                            ITTA - Transactional Analyst<br>
                                            Time Management/Denmark - Certified as trainer's trainer<br>
                                            Trained for Michigan State University, University of Michigan, Grand Rapids Community College, Muskegon Junior College <br>
                                            Former Director of Management Education for the Employers' Association of Western<br>
                                            Michigan
                                        </p>
                                    </div>
                                    <div class="show-more">
                                        <a href="javascript:void(0)">Show more</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-lg-2">
                                <div class="img" style="background-image: url({{asset('assets/images/cynthia_guy.jpg')}});">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 col-lg-12 m-15px-tb">
                        <div class="our-team bg-reverse row">
                            <div class="col-md-3 col-lg-2">
                                <div class="img" style="background-image: url({{asset('assets/images/rob_ptacek.png')}});">
                                </div>
                            </div>
                            <div class="col-md-9 col-lg-10">
                                <div class="info" style="text-align: left;">
                                    <h6 class="mb-2">Rob Ptacek</h6>
                                    {{--<label>Partner</label>--}}
                                    <div class="content hideContent">
                                        <p style="line-height: 21px;">
                                            Rob Ptacek is a Partner in the Global Lean Institute and President and CEO of Competitive Edge Training and Consulting, a firm specializing in leader and organizational development, and Lean Enterprise transformations. Rob holds a BS in Metallurgical Engineering from Michigan Technological University and a Masters of Management from Aquinas College. Rob has held leadership positions in Quality, Sales, and Operations Management, and has over 25 years of practical experience implementing continuous improvements in a variety of industries. Rob can be contacted at ptacek@i2k.com.
                                        </p>
                                    </div>
                                    <div class="show-more">
                                        <a href="javascript:void(0)">Show more</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 col-lg-12 m-15px-tb">
                        <div class="our-team row">
                            <div class="col-md-9 col-lg-10">
                                <div class="info" style="text-align: left;">
                                    <h6>Deborah Salimi</h6>
                                    <label class="theme-text-secondary mb-2">Project Management Professional (PMP), PhD</label>
                                    <div class="content hideContent">
                                        <p style="line-height: 21px;">
                                            Deborah brings a practical approach to Lean, based on applied learning. Her experience spans three continents in manufacturing, project management, logistics, not for profit health care and higher education. She co-founded and is a key leader at the Lean Gulf Institute, spreading Lean awareness, professional development and empowerment through process improvement activities. She holds an Engineering degree from Boston University, an MBA and PhD. Deborah can be contacted at deb@leangulf.org or visit www.leangulf.org.
                                        </p>
                                    </div>
                                    <div class="show-more">
                                        <a href="javascript:void(0)">Show more</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-lg-2">
                                <div class="img" style="background-image: url({{asset('assets/images/deborah_salimi.png')}});">
                                </div>
                            </div>
                        </div>
                    </div>

                </div> <!-- row -->
            </div> <!-- container -->
        </section>

        <!-- Advisory Board -->

        <section class="section border-bottom">
            <div class="container">
                <div class="row justify-content-center m-45px-b md-m-25px-b">
                    <div class="col-md-10 col-lg-8">
                        <h2 class="theme-title-primary">Our Advisors</h2>
                    </div>
                </div> <!-- row -->

                <div class="row">
                    <div class="col-md-12 col-lg-12 m-15px-tb">
                        <div class="our-team bg-reverse row">
                            <div class="col-md-3 col-lg-2">
                                <div class="img" style="background-image: url({{asset('assets/images/don_tapping.jpg')}});">
                                </div>
                            </div>
                            <div class="col-md-9 col-lg-10">
                                <div class="info" style="text-align: left;">
                                    <h6 class="mb-2">Sam Salimi</h6>
                                    {{--<label class="theme-text-secondary mb-2">Publisher and Author</label>--}}
                                    <div class="content hideContent">
                                        <p style="line-height: 21px;">
                                            NEED CONTENT
                                        </p>
                                    </div>
                                    <div class="show-more">
                                        <a href="javascript:void(0)">Show more</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 col-lg-12 m-15px-tb">
                        <div class="our-team row">
                            <div class="col-md-9 col-lg-10">
                                <div class="info" style="text-align: left;">
                                    <h6 class="mb-2">Todd Sperl</h6>
                                    {{--<label class="theme-text-secondary mb-2">Publisher and Author</label>--}}
                                    <div class="content hideContent">
                                        <p style="line-height: 21px;">
                                            Todd Sperl is an enthusiastic, creative speaker and process improvement expert who looks beyond today’s problems to find tomorrow’s solutions. As Owner and Managing Partner of Lean Fox Solutions, Todd’s vision is to improve the patient care experience from one healthcare touch point to the next. As a Master Black Belt and Lean Sensei, Todd’s exceptional track record of process improvement has been based on his philosophy of total enterprise engagement in change. Todd received his BS in Psychology from the University of Wisconsin-River Falls and an MS in Industrial-Organizational Psychology from St. Mary’s University in San Antonio, Texas. Todd can be contacted at tsperl@leanfoxsolutions.com or visit www.leanfoxsolutions.com.
                                        </p>
                                    </div>
                                    <div class="show-more">
                                        <a href="javascript:void(0)">Show more</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-lg-2">
                                <div class="img" style="background-image: url({{asset('assets/images/todd_sperl.png')}});">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- DEVELOPERS -->
        <section class="section border-bottom">
            <div class="container">
                <div class="row justify-content-center m-45px-b md-m-25px-b">
                    <div class="col-md-10 col-lg-8">
                        <h2 class="theme-title-primary">The Developers</h2>
                    </div>
                </div>
                <div class="row justify-content-center mt-5">
                    <div class="col-md-12 col-lg-12 justify-content-center text-center team">
                        <div class="row justify-content-center">
                            <div class="col-md-4 col-6">
                                <img src="{{asset('assets/images/team/logo.png')}}" alt="">
                            </div>
                        </div>
                        <div class="row justify-content-center mt-5 team-avatar-group">
                            <div class="col-md-3 text-center">
                                <img src="{{asset('assets/images/team/abhishek_paul.jpg')}}" alt="" class="avatar team-avatar">
                                <h6 class="fs-16 mt-3">
                                    Abhishek Paul<br>
                                    <span style="white-space: nowrap">(Founder of Astakyuta)</span>
                                </h6>
                            </div>
                            <div class="col-md-3 text-center">
                                <img src="{{asset('assets/images/team/debajyoti_das.jpg')}}" alt="" class="avatar team-avatar">
                                <h6 class="fs-16 mt-3">
                                    Debajyoti Das<br>
                                    <span style="white-space: nowrap">(Co-Founder of Astakyuta)</span>
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row team-social-group">
                    <div class="col-md-6 px-0 mt-3">
                        <h6 class="text-muted" style="font-size: 0.8rem;">To know more about us, please visit <a href="https://astakyuta.com/" target="_blank" class="theme-text-primary">https://astakyuta.com/</a></h6>
                    </div>
                    <div class="col-md-6 px-0 social-icons">
                        <a class="team-social facebook" href="https://www.facebook.com/Astakyuta-pvt-ltd-328771107985184/" target="_blank">
                            <i class="fa fa-facebook-official"></i>
                        </a>
                        <a class="team-social linkedin" href="https://www.linkedin.com/company/astakyuta-pvt-ltd/" target="_blank">
                            <i class="fa fa-linkedin-square"></i>
                        </a>
                    </div>
                </div>
            </div>
        </section>

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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    <!-- SCRIPTS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.js"></script>

    <!-- CUSTOM SCRIPTS -->
    <script src="{{asset('assets/js/custom.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function(){

            $(".show-more a").on("click", function() {
                let $this = $(this);
                let $content = $this.parents('.info').find(".content");
                let linkText = $this.text().toUpperCase();

                if(linkText === "SHOW MORE"){
                    linkText = "Show less";
                    $content.switchClass("hideContent", "showContent", 100);
                } else {
                    linkText = "Show more";
                    $content.switchClass("showContent", "hideContent", 100);
                };

                $this.text(linkText);
            });
        });

    </script>
</body>

</html>
