<!-- Top Navigation -->
<nav class="navbar navbar-default navbar-static-top m-b-0">

    <div class="navbar-header">
        <a class="navbar-toggle hidden-sm hidden-md hidden-lg " href="javascript:void(0)"
           data-toggle="collapse" data-target=".navbar-collapse"><i class="ti-menu"></i></a>
        <div class="top-left-part">
            {{--<a class="logo" href="{{ url('/home') }}">--}}
                {{--<img src="{{ asset('assets/img/mm-logo.png') }}" alt="home" class="dark-logo"/>--}}
            {{--</a>--}}

            {{--<a class="logo" href="index.html">--}}
                {{--<b>--}}
                    {{--<img src="https://wrappixel.com/demos/admin-templates/pixeladmin/plugins/images/pixeladmin-logo.png"--}}
                         {{--alt="home" class="dark-logo"/>--}}
                    {{--<img src="https://wrappixel.com/demos/admin-templates/pixeladmin/plugins/images/pixeladmin-logo-dark.png"--}}
                         {{--alt="home" class="light-logo"/>--}}
                {{--</b>--}}
                {{--<span class="hidden-xs">--}}
                        {{--<img src="https://wrappixel.com/demos/admin-templates/pixeladmin/plugins/images/pixeladmin-text.png"--}}
                             {{--alt="home" class="dark-logo"/>--}}
                        {{--<img src="https://wrappixel.com/demos/admin-templates/pixeladmin/plugins/images/pixeladmin-text-dark.png"--}}
                             {{--alt="home" class="light-logo"/>--}}
                    {{--</span>--}}
            {{--</a>--}}
            {{--<div class="user-profile">--}}
                {{--<div class="dropdown user-pro-body">--}}
                    {{--<div><img src="https://wrappixel.com/demos/admin-templates/pixeladmin/plugins/images/users/varun.jpg" alt="user-img" class="img-circle"></div> <a href="#" class="dropdown-toggle u-dropdown" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Steave Gection <span class="caret"></span></a>--}}
                    {{--<ul class="dropdown-menu animated flipInY">--}}
                        {{--<li><a href="#"><i class="ti-user"></i> My Profile</a></li>--}}
                        {{--<li><a href="#"><i class="ti-wallet"></i> My Balance</a></li>--}}
                        {{--<li><a href="#"><i class="ti-email"></i> Inbox</a></li>--}}
                        {{--<li role="separator" class="divider"></li>--}}
                        {{--<li><a href="#"><i class="ti-settings"></i> Account Setting</a></li>--}}
                        {{--<li role="separator" class="divider"></li>--}}
                        {{--<li><a href="login.html"><i class="fa fa-power-off"></i> Logout</a></li>--}}
                    {{--</ul>--}}
                {{--</div>--}}
            {{--</div>--}}
        </div>
        {{--<ul class="nav navbar-top-links navbar-left hidden-xs">--}}
            {{--<li><a href="javascript:void(0)" class="open-close hidden-xs waves-effect waves-light"><i--}}
                            {{--class="ti-menu"></i></a></li>--}}
        {{--</ul>--}}
        <ul class="nav navbar-top-links navbar-right pull-right">
            {{--<li class="dropdown"><a class="dropdown-toggle waves-effect waves-light" data-toggle="dropdown"--}}
                                    {{--href="#"><i--}}
                            {{--class="icon-envelope"></i>--}}
                    {{--<div class="notify"><span class="heartbit"></span><span class="point"></span></div>--}}
                {{--</a>--}}
                {{--<ul class="dropdown-menu mailbox animated flipInY">--}}
                    {{--<li>--}}
                        {{--<div class="drop-title">You have 4 new Notifications</div>--}}
                    {{--</li>--}}
                    {{--<li>--}}
                        {{--<div class="message-center">--}}
                            {{--<a href="#">--}}
                                {{--<div class="user-img"><img--}}
                                            {{--src="https://wrappixel.com/demos/admin-templates/pixeladmin/plugins/images/users/pawandeep.jpg"--}}
                                            {{--alt="user" class="img-circle"> <span--}}
                                            {{--class="profile-status online pull-right"></span></div>--}}
                                {{--<div class="mail-contnet">--}}
                                    {{--<h5>Pavan kumar</h5> <span class="mail-desc">Just see the my admin!</span> <span--}}
                                            {{--class="time">9:30 AM</span></div>--}}
                            {{--</a>--}}
                            {{--<a href="#">--}}
                                {{--<div class="user-img"><img--}}
                                            {{--src="https://wrappixel.com/demos/admin-templates/pixeladmin/plugins/images/users/sonu.jpg"--}}
                                            {{--alt="user" class="img-circle"> <span--}}
                                            {{--class="profile-status busy pull-right"></span></div>--}}
                                {{--<div class="mail-contnet">--}}
                                    {{--<h5>Sonu Nigam</h5> <span class="mail-desc">I've sung a song! See you at</span>--}}
                                    {{--<span class="time">9:10 AM</span></div>--}}
                            {{--</a>--}}
                            {{--<a href="#">--}}
                                {{--<div class="user-img"><img--}}
                                            {{--src="https://wrappixel.com/demos/admin-templates/pixeladmin/plugins/images/users/arijit.jpg"--}}
                                            {{--alt="user" class="img-circle"> <span--}}
                                            {{--class="profile-status away pull-right"></span></div>--}}
                                {{--<div class="mail-contnet">--}}
                                    {{--<h5>Arijit Sinh</h5> <span class="mail-desc">I am a singer!</span> <span--}}
                                            {{--class="time">9:08 AM</span></div>--}}
                            {{--</a>--}}
                            {{--<a href="#">--}}
                                {{--<div class="user-img"><img--}}
                                            {{--src="https://wrappixel.com/demos/admin-templates/pixeladmin/plugins/images/users/pawandeep.jpg"--}}
                                            {{--alt="user" class="img-circle"> <span--}}
                                            {{--class="profile-status offline pull-right"></span></div>--}}
                                {{--<div class="mail-contnet">--}}
                                    {{--<h5>Pavan kumar</h5> <span class="mail-desc">Just see the my admin!</span> <span--}}
                                            {{--class="time">9:02 AM</span></div>--}}
                            {{--</a>--}}
                        {{--</div>--}}
                    {{--</li>--}}
                    {{--<li>--}}
                        {{--<a class="text-center" href="javascript:void(0);"> <strong>See all notifications</strong> <i--}}
                                    {{--class="fa fa-angle-right"></i> </a>--}}
                    {{--</li>--}}
                {{--</ul>--}}
                <!-- /.dropdown-messages -->
            {{--</li>--}}
            <!-- /.dropdown -->
            {{--<li class="dropdown"><a class="dropdown-toggle waves-effect waves-light" data-toggle="dropdown"--}}
                                    {{--href="#"><i--}}
                            {{--class="icon-note"></i>--}}
                    {{--<div class="notify"><span class="heartbit"></span><span class="point"></span></div>--}}
                {{--</a>--}}
            {{--</li>--}}
                {{--<ul class="dropdown-menu dropdown-tasks animated flipInX">--}}
                    {{--<li>--}}
                        {{--<a href="#">--}}
                            {{--<div>--}}
                                {{--<p><strong> Quiz 1</strong> <span--}}
                                            {{--class="pull-right text-muted">40% Complete</span></p>--}}
                                {{--<div class="progress progress-striped active">--}}
                                    {{--<div class="progress-bar progress-bar-success" role="progressbar"--}}
                                         {{--aria-valuenow="40"--}}
                                         {{--aria-valuemin="0" aria-valuemax="100" style="width: 40%"><span--}}
                                                {{--class="sr-only">40% Complete (success)</span>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</a>--}}
                    {{--</li>--}}
                    {{--<li class="divider"></li>--}}
                    {{--<li>--}}
                        {{--<a href="#">--}}
                            {{--<div>--}}
                                {{--<p><strong> Quiz 2</strong> <span--}}
                                            {{--class="pull-right text-muted">20% Complete</span></p>--}}
                                {{--<div class="progress progress-striped active">--}}
                                    {{--<div class="progress-bar progress-bar-info" role="progressbar"--}}
                                         {{--aria-valuenow="20"--}}
                                         {{--aria-valuemin="0" aria-valuemax="100" style="width: 20%"><span--}}
                                                {{--class="sr-only">20% Complete</span>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</a>--}}
                    {{--</li>--}}
                    {{--<li class="divider"></li>--}}
                    {{--<li>--}}
                        {{--<a href="#">--}}
                            {{--<div>--}}
                                {{--<p><strong> Quiz 3</strong> <span--}}
                                            {{--class="pull-right text-muted">60% Complete</span></p>--}}
                                {{--<div class="progress progress-striped active">--}}
                                    {{--<div class="progress-bar progress-bar-warning" role="progressbar"--}}
                                         {{--aria-valuenow="60"--}}
                                         {{--aria-valuemin="0" aria-valuemax="100" style="width: 60%"><span--}}
                                                {{--class="sr-only">60% Complete (warning)</span>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</a>--}}
                    {{--</li>--}}
                    {{--<li class="divider"></li>--}}
                    {{--<li>--}}
                        {{--<a href="#">--}}
                            {{--<div>--}}
                                {{--<p><strong> Quiz 4</strong> <span--}}
                                            {{--class="pull-right text-muted">80% Complete</span></p>--}}
                                {{--<div class="progress progress-striped active">--}}
                                    {{--<div class="progress-bar progress-bar-danger" role="progressbar"--}}
                                         {{--aria-valuenow="80"--}}
                                         {{--aria-valuemin="0" aria-valuemax="100" style="width: 80%"><span--}}
                                                {{--class="sr-only">80% Complete (danger)</span>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</a>--}}
                    {{--</li>--}}
                    {{--<li class="divider"></li>--}}
                    {{--<li>--}}
                        {{--<a class="text-center" href="#"> <strong>See All Quiz</strong> <i--}}
                                    {{--class="fa fa-angle-right"></i> </a>--}}
                    {{--</li>--}}
                {{--</ul>--}}
                <!-- /.dropdown-tasks -->
            <!-- /.dropdown -->

                @if(session("role")=='admin')
                    <li class="dropdown"><a class="waves-effect waves-light"
                                            href="{{ url('logout') }}"><i class="fa fa-sign-out"></i>
                        </a>
                    </li>
                    @else
                    <li class="dropdown"><a class="dropdown-toggle waves-effect waves-light" data-toggle="dropdown"
                                            href="#"><i class="fa fa-user"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="{{url('profile')}}">My Profile</a></li>
                            <li><a href="{{ url('logout') }}">Sign Out</a></li>
                        </ul>
                    </li>
                @endif

            {{--<li class="right-side-toggle"><a class="waves-effect waves-light" href="javascript:void(0)">--}}
                    {{--<i class="ti-settings"></i></a></li>--}}
            <!-- /.dropdown -->
        </ul>
    </div>
    <div class="container">
        {{--<div class="row">--}}
        {{--<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">--}}
        {{--<div class="sttabs tabs-style-iconbox">--}}
        {{--<nav>--}}
        {{--<ul>--}}
        {{--<li class="tab-current"><a href="#section-iconbox-1" class="sticon ti-home"><span>Home</span></a></li>--}}
        {{--<li><a href="#section-iconbox-2" class="sticon ti-gift"><span>Deals</span></a></li>--}}
        {{--<li><a href="#section-iconbox-3" class="sticon ti-upload"><span>Upload</span></a></li>--}}
        {{--<li><a href="#section-iconbox-4" class="sticon ti-trash"><span>Delete</span></a></li>--}}
        {{--<li><a href="#section-iconbox-5" class="sticon ti-settings"><span>Settings</span></a></li>--}}
        {{--</ul>--}}
        {{--</nav>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
    </div>
    <!-- /.navbar-header -->
    <!-- /.navbar-top-links -->
    <!-- /.navbar-static-side -->
</nav>
<!-- End Top Navigation -->

<style>
    .tabs-style-iconbox nav ul li a {
        padding: 15px 0px;
    }

    #page-wrapper {
        /*margin: 0px;*/
    }
    .content-wrapper .top-left-part{
        position: relative;
    }
    .navbar-left{
        margin-left: 220px;
    }
    .content-wrapper .navbar-left{
        margin-left: 0;
    }
    .top-left-part{
        position: absolute;
    }
    .user-profile {
        padding: 5px 0;
    }
    .top-left-part a,.top-left-part span{
        font-size: inherit;
        text-transform: none;
    }
    #side-menu{
        border-top: 1px solid #eee;
        margin-top: 40px;
    }
    .content-wrapper #side-menu{
        margin-top: 0;
    }

    @media (max-width: 767px) {
        .top-left-part {
            display: none;
        }
    }

    .timeline{
        padding: 25px;
    }
    .timeline>li>.timeline-badge{
        background-color: transparent;
    }
    .tabs-style-iconbox nav, .timeline-panel {
        background: #ffffff;
    }
</style>