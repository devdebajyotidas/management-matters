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
                        <li><a class="nav-link" href="{{url('/')}}.html">Home</a></li>
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
        <section class="section border-bottom" id="team">
            <div class="container">
                <h2 class="theme-title-primary text-center">The Founders</h2>
                <div class="row founders-cards">
                    <div class="col-md-4 col-sm-12 card-container">
                        <div class="row card">
                            <div class="card-close">
                                <i class="fa fa-close"></i>
                            </div>
                            <div class="col-md-12 card-heading">
                                <img src="{{asset('assets/images/don_tapping.jpg')}}" alt="Don Tapping" />
                                <div class="headings" style="display: none; margin-left: 20px; vertical-align: middle;">
                                    <h4 class="theme-text-secondary mb-3">Don Tapping</h4>
                                    <h6 class="theme-text-disabled-darker mb-4">Publisher and Author</h6>
                                </div>
                            </div>
                            <div class="col-md-12 card-body text-center">
                                <h4 class="theme-text-secondary mb-3">Don Tapping</h4>
                                <h6 class="theme-text-disabled-darker mb-4">Publisher and Author</h6>
                                <!--                                <a href="javascript:void(0)">Know More</a>-->
                                <p>Don Tapping graduated from The University of Michigan in 1976. He spent the next four years as a Lieutenant in the United States Marine Corps in various positions during his tour. After completing his Corps duties, Don worked in the medical technology, education, and aerospace industries for the next 20 years. Don authored the best-selling book, Value Stream Management for the Lean Office (Productivity Press 2003), Lean Office Demystified (II), Who Hollered Fore?, and over 50 other books and apps on business performance - setting the bar for continuous improvements. He continues to enlighten organizations with his ability to design step-by-step implementation methodologies identifying processes that require improvement, and then introducing proactive steps to improve or redesign them - reducing costs, boosting performance, and increasing customer (patient) satisfaction. Don today is using his experience in developing apps on how Lean can be applied using smart devices. Don also received his MBA from The University of Notre Dame.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12 card-container">
                        <div class="row card">
                            <div class="card-close">
                                <i class="fa fa-close"></i>
                            </div>
                            <div class="col-md-12 card-heading">
                                <img src="{{asset('assets/images/cynthia_guy.jpg')}}" alt="Cynthia Guy" />
                                <div class="headings" style="display: none; margin-left: 20px; vertical-align: middle;">
                                    <h4 class="theme-text-secondary mb-3">Cynthia Guy</h4>
                                    <h6 class="theme-text-disabled-darker mb-4">Partner</h6>
                                </div>
                            </div>
                            <div class="col-md-12 card-body text-center">
                                <h4 class="theme-text-secondary mb-3">Cynthia Guy</h4>
                                <h6 class="theme-text-disabled-darker mb-4">Partner</h6>
                                <!--                                <a href="javascript:void(0)">Know More</a>-->
                                <p>Cynthia Guy is a senior partner at Crystal Clear Concepts, a management consulting firm. She holds a BA from Michigan State University in Journalism. She is a Communications and a Leadership specialist from Harvard/McBer Institute. She’s a certified T.A. analyst as well as certified by the AMA and Time Manager/Denmark. Her strengths are being a catalyst of organizational change, leadership and innovation. She has been certified in the Sycronist (Lean) Manufacturing program from General Motors. She is the author of Finding Profit, a book about the transformation of a business through lean manufacturing principles. In addition to a decade of human resource management expertise, Guy's strength lies in her ability as a catalyst of change. She’s been quoted as a change expert in the New York Times. Through close interaction with top management, she has been responsible for ushering in significant, positive change in a number of areas such as leadership, improved productivity and quality, resulting in increased profitability for companies. She developed her management skills as an owner of a major advertising agency that she operated before becoming a management consultant. She has gained the respect and admiration of top executives in business throughout the nation.<br><br>
                                    <strong style="color: black;">Credentials:</strong><br><br>
                                    B.A. - Michigan State University<br>
                                    McBer Institute, Harvard - Managing Motivation for Performance Improvement<br>
                                    Author – Finding Profit, the story of Lean transformation<br>
                                    ITTA - Transactional Analyst<br>
                                    Time Management/Denmark - Certified as trainer's trainer<br>
                                    Trained for Michigan State University, University of Michigan, Grand Rapids Community College, Muskegon Junior College <br>
                                    Former Director of Management Education for the Employers' Association of Western<br>
                                    Michigan</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12 card-container">
                        <div class="row card">
                            <div class="card-close">
                                <i class="fa fa-close"></i>
                            </div>
                            <div class="col-md-12 card-heading">
                                <img src="{{asset('assets/images/joe_d_buys.jpg')}}" alt="Joe D Buys" />
                                <div class="headings" style="display: none; margin-left: 20px; vertical-align: middle;">
                                    <h4 class="theme-text-secondary mb-3">Joe D Buys</h4>
                                    <h6 class="theme-text-disabled-darker mb-4">Partner</h6>
                                </div>
                            </div>
                            <div class="col-md-12 card-body text-center">
                                <h4 class="theme-text-secondary mb-3">Joe D Buys</h4>
                                <h6 class="theme-text-disabled-darker mb-4">Partner</h6>
                                <!--                                <a href="javascript:void(0)">Know More</a>-->
                                <p>As a senior partner, Joe Buys has been an innovator in Cross-Functional Team Development, Creative Problem Solving, and Leadership Development. More recently, he’s been working on developing strategies for companies to implement Lean processes into both areas of production and administration. He has been an expert contributor on the www.Allexperts.com website for over 10 years.<br>
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
                                    Time Management/Denmark - Certified as trainer’s trainer</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- container -->
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
            let imgWidth = '';
            let imgHeight = '';
            let maxImgWidth = '';

            if ($(window).width() >= 768) {
                $('.founders-cards .card-container').css({
                    'transition': 'all 0.3s',
                    'flex': '0 0 33.33333%',
                    'maxWidth': '33.33333%'
                });
            } else {
                $('.founders-cards .card-container').css({
                    'transition': 'all 0.3s',
                    'flex': '0 0 100%',
                    'maxWidth': '100%'
                })
            }

            function getFoundersImageSize() {
                if (imgWidth !== $('.founders-cards .card .card-heading').width()) {
                    imgWidth = $('.founders-cards .card .card-heading').width();
                    imgHeight = $('.founders-cards .card .card-heading').height();

                    if (maxImgWidth === '' || maxImgWidth === 0 || maxImgWidth !== imgWidth) {
                        maxImgWidth = imgWidth;
                    }
                }

                if ($(window).width() >= 768) {
                    $('.founders-cards .card .card-heading img').width(maxImgWidth);
                } else {
                    $('.founders-cards .card .card-heading img').width('100%');
                }

            }
            getFoundersImageSize();

            function animateCSS(element, animationName, callback) {
                const node = element;
                node.addClass('animated').addClass(animationName);

                function handleAnimationEnd() {
                    node.removeClass('animated').removeClass(animationName);
                    node.off('animationend', handleAnimationEnd);
                    node.removeClass(animationName);

                    if (typeof callback === 'function') callback()
                }

                node.on('animationend', handleAnimationEnd)
            }

            // EXPAND CARD
            $(document).on('click', '.founders-cards .card:not(.card-close)', function(e) {
                let ths = $(this);
                if ($(window).width() >= 768) {
                    let animateElement = $(document).find('.founders-cards .card').not(this);
                    if(!ths.hasClass('active')) {
                        animateCSS(animateElement, 'zoomOut', function() {
                            $('.founders-cards .card-container').css({
                                'flex': '0 0 0',
                                'maxWidth': '0'
                            })
                            ths.parent('.card-container').css({
                                'transition': 'all 0.3s',
                                'flex': '0 0 100%',
                                'maxWidth': '100%'
                            });
                            animateElement.hide();
                            $('.founder-cards .card:not(.active)').css({
                                'flex': '0 0 33.333333%',
                                'maxWidth': '33.333333%'
                            });
                            ths.addClass('active');
                            setTimeout(function() {
                                ths.find('.card-body p').slideDown();
                                ths.find('.card-heading .headings').fadeIn('fast').css('display', 'inline-block');
                            }, 250);
                            ths.find('.card-body h4, .card-body h6').fadeOut('fast').slideUp();
                            ths.find('.card-close i').fadeIn('fast');
                        });
                    }
                } else {
                    if (ths.hasClass('activated')) {
                        ths.find('.card-body p').slideToggle();
                        ths.removeClass('activated');
                    } else {

                        $(document).find('.founders-cards .card .card-body p').slideUp();
                        $(document).find('.founders-cards .card').removeClass('activated');

                        setTimeout(function() {
                            $('html, body').animate({
                                scrollTop: ths.offset().top - 100
                            });
                        }, 400);

                        ths.find('.card-body p').slideToggle();
                        ths.addClass('activated');
                    }

                }
            });

            // CLOSE EXPANDED CARD
            $(document).on('click', '.founders-cards .card.active .card-close', function(e) {
                e.stopImmediatePropagation();
                let ths = $(this).parent('.card');
                let animateElement = $(document).find('.founders-cards .card:not(.active)');
                if (ths.hasClass('active')) {
                    $('.founders-cards .card-container').css({
                        'transition': 'all 0.3s',
                        'flex': '0 0 33.33333%',
                        'maxWidth': '33.33333%'
                    })
                    ths.find('.card-body p').hide();
                    setTimeout(function() {
                        $('.founder-cards .card:not(.active)').css({
                            'flex': '0 0 33.333333%',
                            'maxWidth': '33.333333%'
                        });
                        animateElement.show();
                        animateCSS(animateElement, 'zoomIn');
                    }, 500);
                    ths.removeClass('active');
                    ths.find('.card-body h4, .card-body h6').fadeIn('fast');
                    ths.find('.card-heading .headings').css('display', 'none');
                }
                ths.find('.card-close i').fadeOut('fast');
            });

            // WINDOW RESIZE
            $(window).on('resize', function() {
                getFoundersImageSize();
                if($(window).width() >= 768) {
                    $('.founders-cards .card-container').css({
                        'transition': 'all 0.3s',
                        'flex': '0 0 33.33333%',
                        'maxWidth': '33.33333%'
                    })
                } else {
                    $('.founders-cards .card-container').css({
                        'transition': 'all 0.3s',
                        'flex': '0 0 100%',
                        'maxWidth': '100%'
                    })
                }
            });
        });

    </script>
</body>

</html>
