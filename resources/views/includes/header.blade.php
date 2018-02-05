<!-- Top Navigation -->
<nav class="navbar navbar-default navbar-static-top m-b-0">
    <div class="navbar-header">
        <a class="navbar-toggle hidden-sm hidden-md hidden-lg " href="javascript:void(0)"
           data-toggle="collapse" data-target=".navbar-collapse"><i class="ti-menu"></i></a>
        <div class="top-left-part">
            <a class="logo" href="{{url('/')}}">
                {{--<b>--}}
                    {{--<!--This is dark logo icon--><img src="http://ec2-54-245-205-243.us-west-2.compute.amazonaws.com/assets/img/mm-logo.png" alt="home" class="dark-logo" width="100">--}}
                    {{--<!--This is light logo icon--><img src="http://ec2-54-245-205-243.us-west-2.compute.amazonaws.com/assets/img/mm-logo.png" alt="home" class="light-logo" width="100">--}}
                {{--</b>--}}
                <span class="hidden-xs">
                        <!--This is dark logo text--><img src="http://ec2-54-245-205-243.us-west-2.compute.amazonaws.com/assets/img/mm-logo.png" alt="home" class="dark-logo" width="100">
                    <!--This is light logo text--><img src="http://ec2-54-245-205-243.us-west-2.compute.amazonaws.com/assets/img/mm-logo.png" alt="home" class="light-logo" width="100">
                     </span>
            </a>
        </div>
        <ul class="nav navbar-top-links navbar-left hidden-xs">
            <li><a href="javascript:void(0)" class="open-close hidden-xs waves-effect waves-light"><i class="ti-menu"></i></a></li>
        </ul>

        <ul class="nav navbar-top-links navbar-left hidden-xs" style="color: #fff;margin-left: sas;width: 400px">
            <marquee style="margin-top: 20px;">This is your daily motivational quote</marquee>
        </ul>

        <ul class="nav navbar-top-links navbar-right pull-right">

            @if(session('role')=='organization')
                <?php $tipscount=\App\Models\Ticket::whereIn('learner_id',auth()->user()->account->learners()->pluck('learners.id')->toArray())->whereDate('created_at','=',date('Y-m-d'))->count()?>
                @if($tipscount > 0)
                    <li style="border-right: 1px solid rgba(255,255,255,0.2)"><a class="dropdown-toggle waves-effect waves-light" data-toggle="dropdown" href="#" aria-expanded="false">
                            <i class="sticon ti-light-bulb"></i>
                            <div class="notify" style="margin-right: 7px"><span class="heartbit"></span><span class="point"></span></div>
                        </a>
                        <ul class="dropdown-menu dropdown-tasks animated slideInUp">
                            <li>
                                <a href="{{url('tickets')}}">
                                    <div>
                                        <p> There are {{$tipscount}} Managing Better Tickets scheduled for today within your managers in your organizatioin </p>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
            @endif
             <li class="p-20 text-white">
                @if(session('role')=='learner')
                    <span>Welcome, {{Auth::user()->account->name}}</span>
                @elseif(session('role')=='organization')
                    <span>Welcome, {{Auth::user()->account->name}} Admin</span>
                @else
                    <span>Welcome, SuperAdmin</span>
                @endif

            </li>
                <!-- /.dropdown-tasks -->
            <!-- /.dropdown -->

                @if(session("role")=='admin')
                    <li class="dropdown" style="border-left: 1px solid rgba(255,255,255,0.2)"><a class="waves-effect waves-light text-white"
                                            href="{{ url('logout') }}"><i class="fa fa-sign-out"></i>
                        </a>
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
        height: 100%;
    }
    .user-profile {
        padding: 5px 0;
    }
    .top-left-part a,.top-left-part span{
        font-size: inherit;
        text-transform: none;
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
        margin: 0 ;
        padding:0 7.5px;

    }
    .ti-icon{
        font-size: 20px;
        display: inline-block;
        margin-right: 10px;
        vertical-align: middle;
    }
    .sidebar{
        position: fixed;
        height: 100vh;
    }
    .sidebar .user-profile{
        background-color: #f7f7f7;
        padding: 15px 0;
    }
    #side-menu{
        /*display: flex;*/
        /*flex-direction: column;*/
    }
    #side-menu li{
        /*flex: 1;*/
    }
    #side-menu li a{
        /*height: 100%;*/
        /*width: 100%;*/
    }
    .navbar-header{
        background: #f75b36!important;
    }
    #side-menu li{
        /*line-height: 50px!important;*/
    }
    #side-menu>li>a {
        /*padding: 5px 30px 5px 15px!important;*/
    }
</style>
<script>
    window.onload=function(){
      fixSidebarHeight();
    };
    window.onresize=function(){
        fixSidebarHeight();
    }
    function fixSidebarHeight(){
        var sidebar=$('.sidebar').height();
        var sidemenu=$("#side-menu");
        var userprofile=$('.sidebar .user-profile').height();
        userprofile=(userprofile==null) ? 0 : userprofile;
        var menuheight=parseFloat(sidebar)-parseFloat(userprofile);
        sidemenu.css('height',menuheight);
        var lineheight=parseFloat($('#side-menu li a').height());
        $('#side-menu li').css('line-height',lineheight+'px');
    }
</script>