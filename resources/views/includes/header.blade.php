<!-- Top Navigation -->
<nav class="navbar navbar-default navbar-static-top m-b-0">
    <div class="navbar-header">
        <a class="navbar-toggle hidden-sm hidden-md hidden-lg " href="javascript:void(0)"
           data-toggle="collapse" data-target=".navbar-collapse"><i class="ti-menu"></i></a>
        <div class="top-left-part">
            <a class="logo" href="{{url('/')}}" style="position: relative;float: left;width: 100%">
                {{--<b>--}}
                    {{--<!--This is dark logo icon--><img src="http://ec2-54-245-205-243.us-west-2.compute.amazonaws.com/assets/img/mm-logo.png" alt="home" class="dark-logo" width="100">--}}
                    {{--<!--This is light logo icon--><img src="http://ec2-54-245-205-243.us-west-2.compute.amazonaws.com/assets/img/mm-logo.png" alt="home" class="light-logo" width="100">--}}
                {{--</b>--}}
                <span class="hidden-xs text-center" style="display: block">
                        <!--This is dark logo text--><img src="http://ec2-54-245-205-243.us-west-2.compute.amazonaws.com/assets/img/mm-logo.png" alt="home" class="dark-logo" width="100">
                    <!--This is light logo text--><img src="http://ec2-54-245-205-243.us-west-2.compute.amazonaws.com/assets/img/mm-logo.png" alt="home" class="light-logo" width="100">
                     </span>
            </a>
        </div>
        <ul class="nav navbar-top-links navbar-left hidden-xs">
            <li><a href="javascript:void(0)" class="open-close hidden-xs waves-effect waves-light"><i class="ti-menu"></i></a></li>
        </ul>
        <ul class="nav navbar-top-links navbar-right pull-right">

            @if(session('role')!='admin')
                @if(session('role')=='organization')
                    <?php
                    $tickets=\App\Models\Ticket::with(['assignments'])->whereIn('learner_id',auth()->user()->account->learners()->pluck('learners.id')->toArray())->where("is_archived",0)->where('is_completed',0)->whereDate('created_at','=',date('Y-m-d'))->pluck('id');
                    $assignments=\App\Models\TicketAssignment::whereIn('ticket_id',$tickets)->where('target_date',date("Y-m-d"))->count();
                    ?>
                @else
                    <?php
                    $tickets=\App\Models\Ticket::where('learner_id',auth()->user()->account_id)->where("is_archived",0)->where('is_completed',0)->whereDate('created_at','=',date('Y-m-d'))->pluck('id');
                    $assignments=\App\Models\TicketAssignment::whereIn('ticket_id',$tickets)->where('target_date',date("Y-m-d"))->count();
                    ?>
                @endif

                   @if($assignments > 0)
                       <li><a class="dropdown-toggle waves-effect waves-light" data-toggle="dropdown" href="#" aria-expanded="false">
                               <i class="fas fa-lightbulb"></i>
                               <div class="notify"><span class="heartbit heartbit-white"></span><span class="point point-white"></span></div>
                           </a>
                           <ul class="dropdown-menu dropdown-tasks animated slideInUp">
                               <li>
                                   <a href="{{url('tickets')}}">
                                       <div>
                                           @if(session('role')=='learner')
                                               <p>You have {{$assignments}} Ticket(s) scheduled for today to Manage Better!</p>
                                           @else
                                               <p>Your organization has {{$assignments}} Ticket(s) schedulded for today to Manage Better! </p>
                                           @endif
                                       </div>
                                   </a>
                               </li>
                           </ul>
                       </li>
                   @endif

            @endif
                <?php
                $quotes=\App\Models\Quotes::where('is_active',1)->first();
                ?>
                @if(isset($quotes->name))
                    <?php $quote_arr=explode('.',$quotes->name) ?>
                <li><a class="dropdown-toggle waves-effect waves-light" data-toggle="dropdown" href="#" aria-expanded="false" title="Quote of the day">
                        <i class="fas fa-quote-right"></i>
                        <div class="notify"><span class="heartbit heartbit-white"></span><span class="point point-white"></span></div>
                    </a>
                    <ul class="dropdown-menu dropdown-tasks animated slideInUp">
                        <li>
                            <span class="quotes-text" style="display: block;padding: 10px 20px;"><b>{{$quote_arr[0]}}.</b><i>{{$quote_arr[1]}}</i></span>
                        </li>
                    </ul>
                </li>
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
            <li>
                <span class="dropdown-toggle u-dropdown" data-toggle="dropdown"  role="button"><img style="width: 30px;height: 30px;margin: 15px" src="{{!empty(auth()->user()->account->image) ? asset('uploads/'.auth()->user()->account->image) : asset('uploads/avatar.png') }}" alt="user-img" class="img-circle"></span>
                <ul class="dropdown-menu animated flipInY m-r-20" style="margin-top: -5px">
                    @if(session("role")!='admin')
                        <li><a href="javascript:void(0)">{{Auth::user()->account->name}}</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="{{url('profile')}}"><i class="ti-user"></i> My Profile</a></li>
                    @else
                        <li><a href="{{url('controls')}}"><i class="ti-settings"></i> Controls</a></li>
                    @endif
                    <li><a href="{{url('logout')}}"><i class="fa fa-power-off"></i> Logout</a></li>
                </ul>
            </li>
                <!-- /.dropdown-tasks -->
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
    body.modal-open {
        overflow: hidden;
    }
    .fr-toolbar.fr-sticky-on{
        top:60px!important;
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