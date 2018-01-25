<!-- Top Navigation -->
<nav class="navbar navbar-default navbar-static-top m-b-0">
    <div class="navbar-header">
        <a class="navbar-toggle hidden-sm hidden-md hidden-lg " href="javascript:void(0)"
           data-toggle="collapse" data-target=".navbar-collapse"><i class="ti-menu"></i></a>
        <div class="top-left-part">
            <a class="custom-logo" href="{{ url('/home') }}">
                <img src="{{ asset('assets/img/mm-logo.png') }}" alt="home" />
            </a>
        </div>
        <ul class="nav navbar-top-links navbar-right pull-right">
            <li class="p-20 text-dark">
                @if(session('role')=='learner')
                    <span>Welcome, {{Auth::user()->account->name}}</span>
                @elseif(session('role')=='organization')
                    <span>Welcome, {{Auth::user()->account->name}} Admin</span>
                @else
                    <span>Welcome, Superadmin</span>
                @endif

            </li>
                <!-- /.dropdown-tasks -->
            <!-- /.dropdown -->

                @if(session("role")=='admin')
                    <li class="dropdown"><a class="waves-effect waves-light text-dark"
                                            href="{{ url('logout') }}"><i class="fa fa-sign-out"></i>
                        </a>
                    </li>
                    @else
                    <li class="dropdown"><a class="dropdown-toggle waves-effect waves-light text-dark" data-toggle="dropdown"
                                            href="#"><i class="fa fa-user"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="{{url('profile')}}">My Account</a></li>
                            <li><a href="{{ url('logout') }}">Sign Out</a></li>
                        </ul>
                    </li>
                @endif
            <!-- /.dropdown -->
        </ul>
    </div>
    <div class="container">
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
    .content-wrapper .footer{
        left:0;
    }
    .container-fluid{
        margin:0;
        padding:0 15px
    }
</style>