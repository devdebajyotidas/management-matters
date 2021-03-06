@extends('layouts.app')
@section('content')
    @include('includes.main-menu')
    <div class="container-fluid">
        <div class="white-box  m-t-15">
            <div class="row">
                <div class="col-md-12">
                    <h3>Dashboard</h3>
                </div>
            </div>
        </div>
        <!-- .row -->
        <div class="row">
            <div class="col-lg-12 col-sm-12 col-xs-12">
                <div id="chart" style="box-shadow: 0 1px 3px rgba(0,0,0,.14)">
                </div>
            </div>
        </div>
        <div class="row m-t-15">
            <div class="col-lg-12 col-sm-12 col-xs-12">
                <div class="row">
                    <div class="col-lg-6 col-sm-6 col-xs-12">
                        <a href="{{url('learnings')}}">
                            <div class="white-box">
                                <h3 class="box-title">Active Learnings</h3>
                                <ul class="list-inline two-part">
                                    <li><i class="icon-book-open text-info"></i></li>
                                    <li class="text-right"><span class="counter">{{ $learnings }}</span></li>
                                </ul>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-xs-12">
                        <a href="{{url('tickets')}}">
                            <div class="white-box">
                                <h3 class="box-title">Outstanding Tickets</h3>
                                <ul class="list-inline two-part">
                                    <li><i class="icon-calender text-purple"></i></li>
                                    <li class="text-right"><span class="counter">{{ $outstandingTickets }}</span></li>
                                </ul>
                            </div>
                        </a>

                    </div>
                    <div class="col-lg-6 col-sm-6 col-xs-12">
                        <a href="{{url('tickets')}}">
                            <div class="white-box">
                                <h3 class="box-title">Ticket Activities</h3>
                                <ul class="list-inline two-part">
                                    <li><i class="icon-folder-alt text-danger"></i></li>
                                    <li class="text-right"><span class="counter">{{ $ticketAssignments }}</span></li>
                                </ul>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-xs-12">
                        <a href="{{url('tickets')}}">
                            <div class="white-box">
                                <h3 class="box-title">Archived Tickets</h3>
                                <ul class="list-inline two-part">
                                    <li><i class="ti-archive text-success"></i></li>
                                    <li class="text-right"><span class="counter">{{ $archivedTickets }}</span></li>
                                </ul>
                            </div>
                        </a>

                    </div>
                </div>
            </div>
        </div>

        @if(session('role') == 'admin')
            <div class="row">
                <div class="col-lg-12 col-sm-12 col-xs-12">
                    <div class="row">
                        <div class="col-lg-6 col-sm-6 col-xs-12">
                            <a href="{{url('organizations')}}">
                                <div class="white-box">
                                    <h3 class="box-title">Organizations</h3>
                                    <ul class="list-inline two-part">
                                        <li><i class="fa fa-users text-info"></i></li>
                                        <li class="text-right"><span class="counter">{{ $organizations }}</span></li>
                                    </ul>
                                </div>
                            </a>

                        </div>
                        <div class="col-lg-6 col-sm-6 col-xs-12">
                            <a href="{{url('learners')}}">
                                <div class="white-box">
                                    <h3 class="box-title">Learners</h3>
                                    <ul class="list-inline two-part">
                                        <li><i class="fa fa-user text-purple"></i></li>
                                        <li class="text-right"><span class="counter">{{ $learners }}</span></li>
                                    </ul>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if(session('role') == 'organization')
            <div class="row">
                <div class="col-lg-12 col-sm-12 col-xs-12">
                    <div class="row">
                        <div class="col-lg-6 col-sm-6 col-xs-12">
                            <a href="{{url('profile')}}">
                                <div class="white-box">
                                    <h3 class="box-title">Total Licenses</h3>
                                    <ul class="list-inline two-part">
                                        <li><i class="fa fa-users text-info"></i></li>
                                        <li class="text-right"><span class="counter">{{ $licenses }}</span></li>
                                    </ul>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-xs-12">
                            <a href="{{url('learners')}}">
                                <div class="white-box">
                                    <h3 class="box-title">Active Learners</h3>
                                    <ul class="list-inline two-part">
                                        <li><i class="fa fa-user text-purple"></i></li>
                                        <li class="text-right"><span class="counter">{{ $learners }}</span></li>
                                    </ul>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
    @endif
    <!-- /.row -->
        <!-- /.row -->
        <div class="row">
            <div class="col-md-12 col-lg-12 col-sm-12">
                <div class="white-box">
                    <div class="row row-in">
                        <div class="col-lg-3 col-sm-6 row-in-br">
                            <a href='{{url('learnings')}}'>
                                <div class="col-in row">
                                    <div class="col-md-6 col-sm-6 col-xs-6"><i class="ti-book"></i>
                                        <h5 class="text-muted vb">Quiz <br> Taken</h5></div>
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <h3 class="counter text-right m-t-15 text-danger">{{ $quiz }}</h3></div>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-danger" role="progressbar"
                                                 aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"
                                                 style="width: 40%"><span class="sr-only">40% Complete (success)</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>

                        </div>
                        <div class="col-lg-3 col-sm-6 row-in-br  b-r-none">
                            <a href="{{url('assessments')}}">
                                <div class="col-in row">
                                    <div class="col-md-6 col-sm-6 col-xs-6"><i class="ti-pencil-alt"></i>
                                        <h5 class="text-muted vb">Assessments Taken</h5></div>
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <h3 class="counter text-right m-t-15 text-info">{{ $assessments }}</h3></div>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-info" role="progressbar"
                                                 aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"
                                                 style="width: 40%"><span class="sr-only">40% Complete (success)</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>

                        </div>
                        <div class="col-lg-3 col-sm-6 row-in-br">
                            <a href="{{url('tickets')}}">
                                <div class="col-in row">
                                    <div class="col-md-6 col-sm-6 col-xs-6"><i class="ti-calendar"></i>
                                        <h5 class="text-muted vb">Tickets Completed</h5></div>
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <h3 class="counter text-right m-t-15 text-success">{{ $completedTickets }}</h3></div>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-success" role="progressbar"
                                                 aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"
                                                 style="width: 40%"><span class="sr-only">40% Complete (success)</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>

                        </div>
                        <div class="col-lg-3 col-sm-6  b-0">
                            <a href="{{url('awards')}}">
                                <div class="col-in row">
                                    <div class="col-md-6 col-sm-6 col-xs-6"><i class="ti-medall"></i>
                                        <h5 class="text-muted vb">Badges <br> Acquired</h5></div>
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <h3 class="counter text-right m-t-15 text-warning">{{ $awards }}</h3></div>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-warning" role="progressbar"
                                                 aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"
                                                 style="width: 40%"><span class="sr-only">40% Complete (success)</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--row -->
        <!-- /.row -->
    {{--<div class="row">--}}
    {{--<div class="col-md-7 col-lg-9 col-sm-12 col-xs-12">--}}
    {{--<div class="white-box">--}}
    {{--<h3 class="box-title">Subscriptions</h3>--}}
    {{--<ul class="list-inline text-right">--}}
    {{--<li>--}}
    {{--<h5><i class="fa fa-circle m-r-5" style="color: #00bfc7;"></i>Package 1</h5></li>--}}
    {{--<li>--}}
    {{--<h5><i class="fa fa-circle m-r-5" style="color: #fdc006;"></i>Package 2</h5></li>--}}
    {{--<li>--}}
    {{--<h5><i class="fa fa-circle m-r-5" style="color: #2c5ca9;"></i>Package 3</h5></li>--}}
    {{--</ul>--}}
    {{--<div id="morris-area-chart" style="height: 340px;"></div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="col-md-5 col-lg-3 col-sm-6 col-xs-12">--}}
    {{--<div class="bg-theme m-b-15">--}}
    {{--<div class="row weather p-20">--}}
    {{--<div class="col-md-6 col-xs-6 col-lg-6 col-sm-6 m-t-40">--}}
    {{--<h3>&nbsp;</h3>--}}
    {{--<h1>73<sup>°F</sup></h1>--}}
    {{--<p class="text-white">AHMEDABAD, INDIA</p>--}}
    {{--</div>--}}
    {{--<div class="col-md-6 col-xs-6 col-lg-6 col-sm-6 text-right"><i--}}
    {{--class="wi wi-day-cloudy-high"></i>--}}
    {{--<br/>--}}
    {{--<br/> <b class="text-white">SUNNEY DAY</b>--}}
    {{--<p class="w-title-sub">April 14</p>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="col-md-5 col-lg-3 col-sm-6 col-xs-12">--}}
    {{--<div class="bg-theme-dark m-b-15">--}}
    {{--<div id="myCarouse2" class="carousel vcarousel slide p-20">--}}
    {{--<!-- Carousel items -->--}}
    {{--<div class="carousel-inner ">--}}
    {{--<div class="active item">--}}
    {{--<h3 class="text-white">My Acting blown <span class="font-bold">Your Mind</span> and you--}}
    {{--also laugh at the moment</h3>--}}
    {{--<div class="twi-user"><img--}}
    {{--src="https://wrappixel.com/demos/admin-templates/pixeladmin/plugins/images/users/hritik.jpg"--}}
    {{--alt="user" class="img-circle img-responsive pull-left">--}}
    {{--<h4 class="text-white m-b-0">Govinda</h4>--}}
    {{--<p class="text-white">Actor</p>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="item">--}}
    {{--<h3 class="text-white">My Acting blown <span class="font-bold">Your Mind</span> and you--}}
    {{--also laugh at the moment</h3>--}}
    {{--<div class="twi-user"><img--}}
    {{--src="https://wrappixel.com/demos/admin-templates/pixeladmin/plugins/images/users/genu.jpg"--}}
    {{--alt="user" class="img-circle img-responsive pull-left">--}}
    {{--<h4 class="text-white m-b-0">Govinda</h4>--}}
    {{--<p class="text-white">Actor</p>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="item">--}}
    {{--<h3 class="text-white">My Acting blown <span class="font-bold">Your Mind</span> and you--}}
    {{--also laugh at the moment</h3>--}}
    {{--<div class="twi-user"><img--}}
    {{--src="https://wrappixel.com/demos/admin-templates/pixeladmin/plugins/images/users/ritesh.jpg"--}}
    {{--alt="user" class="img-circle img-responsive pull-left">--}}
    {{--<h4 class="text-white m-b-0">Govinda</h4>--}}
    {{--<p class="text-white">Actor</p>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    <!--row -->
        <!-- row -->
    {{--<div class="row">--}}
    {{--<div class="col-md-3 col-xs-12 col-sm-6">--}}
    {{--<div class="white-box text-center bg-purple">--}}
    {{--<h1 class="text-white counter">165</h1>--}}
    {{--<p class="text-white">counters</p>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="col-md-3 col-xs-12 col-sm-6">--}}
    {{--<div class="white-box text-center bg-info">--}}
    {{--<h1 class="text-white counter">2065</h1>--}}
    {{--<p class="text-white">counters</p>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="col-md-3 col-xs-12 col-sm-6">--}}
    {{--<div class="white-box text-center">--}}
    {{--<h1 class="counter">465</h1>--}}
    {{--<p class="text-muted">counters</p>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="col-md-3 col-xs-12 col-sm-6">--}}
    {{--<div class="white-box text-center bg-success">--}}
    {{--<h1 class="text-white counter">6555</h1>--}}
    {{--<p class="text-white">counters</p>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    <!-- /row -->
        <!--row -->
    {{--<div class="row">--}}
    {{--<div class="col-md-6 col-lg-6 col-sm-12">--}}
    {{--<div class="white-box">--}}
    {{--<h3 class="box-title">Recent Comments</h3>--}}
    {{--<div class="comment-center">--}}
    {{--<div class="comment-body">--}}
    {{--<div class="user-img"><img--}}
    {{--src="https://wrappixel.com/demos/admin-templates/pixeladmin/plugins/images/users/pawandeep.jpg"--}}
    {{--alt="user" class="img-circle"></div>--}}
    {{--<div class="mail-contnet">--}}
    {{--<h5>Pavan kumar</h5> <span class="mail-desc">Donec ac condimentum massa. Etiam pellentesque pretium lacus. Phasellus ultricies dictum suscipit. Aenean commodo dui pellentesque molestie feugiat.</span>--}}
    {{--<span class="label label-rouded label-info">PENDING</span><a href="javacript:void(0)"--}}
    {{--class="action"><i--}}
    {{--class="ti-close text-danger"></i></a> <a href="javacript:void(0)"--}}
    {{--class="action"><i--}}
    {{--class="ti-check text-success"></i></a><span class="time pull-right">April 14, 2016</span>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="comment-body">--}}
    {{--<div class="user-img"><img--}}
    {{--src="https://wrappixel.com/demos/admin-templates/pixeladmin/plugins/images/users/sonu.jpg"--}}
    {{--alt="user" class="img-circle"></div>--}}
    {{--<div class="mail-contnet">--}}
    {{--<h5>Sonu Nigam</h5> <span class="mail-desc">Donec ac condimentum massa. Etiam pellentesque pretium lacus. Phasellus ultricies dictum suscipit. Aenean commodo dui pellentesque molestie feugiat.</span><span--}}
    {{--class="label label-rouded label-success">APPROVED</span><a--}}
    {{--href="javacript:void(0)" class="action"><i class="ti-close text-danger"></i></a>--}}
    {{--<a href="javacript:void(0)" class="action"><i--}}
    {{--class="ti-check text-success"></i></a><span class="time pull-right">April 14, 2016</span>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="comment-body">--}}
    {{--<div class="user-img"><img--}}
    {{--src="https://wrappixel.com/demos/admin-templates/pixeladmin/plugins/images/users/arijit.jpg"--}}
    {{--alt="user" class="img-circle"></div>--}}
    {{--<div class="mail-contnet">--}}
    {{--<h5>Arijit Sinh</h5> <span class="mail-desc">Donec ac condimentum massa. Etiam pellentesque pretium lacus. Phasellus ultricies dictum suscipit. Aenean commodo dui pellentesque molestie feugiat. </span><span--}}
    {{--class="label label-rouded label-danger">REJECTED</span><a--}}
    {{--href="javacript:void(0)" class="action"><i class="ti-close text-danger"></i></a>--}}
    {{--<a href="javacript:void(0)" class="action"><i--}}
    {{--class="ti-check text-success"></i></a><span class="time pull-right">April 14, 2016</span>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="comment-body b-none">--}}
    {{--<div class="user-img"><img--}}
    {{--src="https://wrappixel.com/demos/admin-templates/pixeladmin/plugins/images/users/pawandeep.jpg"--}}
    {{--alt="user" class="img-circle"></div>--}}
    {{--<div class="mail-contnet">--}}
    {{--<h5>Pavan kumar</h5> <span class="mail-desc">Donec ac condimentum massa. Etiam pellentesque pretium lacus. Phasellus ultricies dictum suscipit. Aenean commodo dui pellentesque molestie feugiat.</span>--}}
    {{--<span class="label label-rouded label-info">PENDING</span> <a href="javacript:void(0)"--}}
    {{--class="action"><i--}}
    {{--class="ti-close text-danger"></i></a> <a href="javacript:void(0)"--}}
    {{--class="action"><i--}}
    {{--class="ti-check text-success"></i></a><span class="time pull-right">April 14, 2016</span>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="col-md-6 col-lg-6 col-sm-12">--}}
    {{--<div class="white-box">--}}
    {{--<h3 class="box-title">Recent sales--}}
    {{--<div class="col-md-3 col-sm-4 col-xs-6 pull-right">--}}
    {{--<select class="form-control pull-right row b-none">--}}
    {{--<option>March 2016</option>--}}
    {{--<option>April 2016</option>--}}
    {{--<option>May 2016</option>--}}
    {{--<option>June 2016</option>--}}
    {{--<option>July 2016</option>--}}
    {{--</select>--}}
    {{--</div>--}}
    {{--</h3>--}}
    {{--<div class="row sales-report">--}}
    {{--<div class="col-md-6 col-sm-6 col-xs-6">--}}
    {{--<h2>March 2016</h2>--}}
    {{--<p>SALES REPORT</p>--}}
    {{--</div>--}}
    {{--<div class="col-md-6 col-sm-6 col-xs-6 ">--}}
    {{--<h1 class="text-right text-success m-t-15">$3,690</h1></div>--}}
    {{--</div>--}}
    {{--<div class="table-responsive">--}}
    {{--<table class="table">--}}
    {{--<thead>--}}
    {{--<tr>--}}
    {{--<th>#</th>--}}
    {{--<th>NAME</th>--}}
    {{--<th>STATUS</th>--}}
    {{--<th>DATE</th>--}}
    {{--<th>PRICE</th>--}}
    {{--</tr>--}}
    {{--</thead>--}}
    {{--<tbody>--}}
    {{--<tr>--}}
    {{--<td>1</td>--}}
    {{--<td class="txt-oflo">Pixel admin</td>--}}
    {{--<td><span class="label label-success label-rouded">SALE</span></td>--}}
    {{--<td class="txt-oflo">April 18, 2016</td>--}}
    {{--<td><span class="text-success">$24</span></td>--}}
    {{--</tr>--}}
    {{--<tr>--}}
    {{--<td>2</td>--}}
    {{--<td class="txt-oflo">Real Homes WP Theme</td>--}}
    {{--<td><span class="label label-info label-rouded">EXTENDED</span></td>--}}
    {{--<td class="txt-oflo">April 19, 2016</td>--}}
    {{--<td><span class="text-info">$1250</span></td>--}}
    {{--</tr>--}}
    {{--<tr>--}}
    {{--<td>3</td>--}}
    {{--<td class="txt-oflo">Medical Pro WP Theme</td>--}}
    {{--<td><span class="label label-danger label-rouded">TAX</span></td>--}}
    {{--<td class="txt-oflo">April 20, 2016</td>--}}
    {{--<td><span class="text-danger">-$24</span></td>--}}
    {{--</tr>--}}
    {{--<tr>--}}
    {{--<td>4</td>--}}
    {{--<td class="txt-oflo">Hosting press html</td>--}}
    {{--<td><span class="label label-warning label-rouded">SALE</span></td>--}}
    {{--<td class="txt-oflo">April 21, 2016</td>--}}
    {{--<td><span class="text-success">$24</span></td>--}}
    {{--</tr>--}}
    {{--<tr>--}}
    {{--<td>5</td>--}}
    {{--<td class="txt-oflo">Helping Hands WP Theme</td>--}}
    {{--<td><span class="label label-success label-rouded">member</span></td>--}}
    {{--<td class="txt-oflo">April 22, 2016</td>--}}
    {{--<td><span class="text-success">$24</span></td>--}}
    {{--</tr>--}}
    {{--<tr>--}}
    {{--<td>6</td>--}}
    {{--<td class="txt-oflo">Digital Agency PSD</td>--}}
    {{--<td><span class="label label-success label-rouded">SALE</span></td>--}}
    {{--<td class="txt-oflo">April 23, 2016</td>--}}
    {{--<td><span class="text-danger">-$14</span></td>--}}
    {{--</tr>--}}
    {{--<tr>--}}
    {{--<td>7</td>--}}
    {{--<td class="txt-oflo">Helping Hands WP Theme</td>--}}
    {{--<td><span class="label label-warning label-rouded">member</span></td>--}}
    {{--<td class="txt-oflo">April 22, 2016</td>--}}
    {{--<td><span class="text-success">$64</span></td>--}}
    {{--</tr>--}}
    {{--</tbody>--}}
    {{--</table>--}}
    {{--<a href="#">Check all the sales</a></div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    <!-- /.row -->
        <!-- .row -->
    {{--<div class="row">--}}
    {{--<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">--}}
    {{--<div class="white-box">--}}
    {{--<h3 class="box-title">Daily Sales</h3>--}}
    {{--<div class="text-right"><span class="text-muted">Todays Income</span>--}}
    {{--<h1><sup><i class="ti-arrow-up text-success"></i></sup> $12,000</h1></div>--}}
    {{--<span class="text-success">20%</span>--}}
    {{--<div class="progress m-b-0">--}}
    {{--<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="50"--}}
    {{--aria-valuemin="0" aria-valuemax="100" style="width:20%;"><span--}}
    {{--class="sr-only">20% Complete</span></div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">--}}
    {{--<div class="white-box">--}}
    {{--<h3 class="box-title">Weekly Sales</h3>--}}
    {{--<div class="text-right"><span class="text-muted">Weekly Income</span>--}}
    {{--<h1><sup><i class="ti-arrow-down text-danger"></i></sup> $5,000</h1></div>--}}
    {{--<span class="text-danger">30%</span>--}}
    {{--<div class="progress m-b-0">--}}
    {{--<div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="50"--}}
    {{--aria-valuemin="0" aria-valuemax="100" style="width:30%;"><span class="sr-only">230% Complete</span>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">--}}
    {{--<div class="white-box">--}}
    {{--<h3 class="box-title">Monthly Sales</h3>--}}
    {{--<div class="text-right"><span class="text-muted">Monthly Income</span>--}}
    {{--<h1><sup><i class="ti-arrow-up text-info"></i></sup> $10,000</h1></div>--}}
    {{--<span class="text-info">60%</span>--}}
    {{--<div class="progress m-b-0">--}}
    {{--<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="50"--}}
    {{--aria-valuemin="0" aria-valuemax="100" style="width:60%;"><span--}}
    {{--class="sr-only">20% Complete</span></div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">--}}
    {{--<div class="white-box">--}}
    {{--<h3 class="box-title">Yearly Sales</h3>--}}
    {{--<div class="text-right"><span class="text-muted">Yearly Income</span>--}}
    {{--<h1><sup><i class="ti-arrow-up text-inverse"></i></sup> $9,000</h1></div>--}}
    {{--<span class="text-inverse">80%</span>--}}
    {{--<div class="progress m-b-0">--}}
    {{--<div class="progress-bar progress-bar-inverse" role="progressbar" aria-valuenow="50"--}}
    {{--aria-valuemin="0" aria-valuemax="100" style="width:80%;"><span class="sr-only">230% Complete</span>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    <!-- /.row -->

        <!-- .row -->
    {{--<div class="row">--}}
    {{--<div class="col-md-4 col-sm-12 col-xs-12">--}}
    {{--<div class="white-box">--}}
    {{--<h3 class="box-title">Weather</h3>--}}
    {{--<div class="weather-box">--}}
    {{--<div class="weather-top">--}}
    {{--<h2 class="pull-left">Monday <br>--}}
    {{--<small>7th May 2016</small>--}}
    {{--</h2>--}}
    {{--<div class="today_crnt pull-right">--}}
    {{--<canvas class="sleet" width="44" height="44"></canvas>--}}
    {{--<span>32<sup>°F</sup></span></div>--}}
    {{--</div>--}}
    {{--<div class="weather-info">--}}
    {{--<h5 class="font-bold">Weather info</h5>--}}
    {{--<div class="row">--}}
    {{--<div class="col-xs-6 p-r-10">--}}
    {{--<div class="row">--}}
    {{--<div class="col-md-12">--}}
    {{--<p class="pull-left">Wind</p>--}}
    {{--<p class="pull-right font-bold">16km/h</p>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="row">--}}
    {{--<div class="col-md-12">--}}
    {{--<p class="pull-left">Sunrise</p>--}}
    {{--<p class="pull-right font-bold">05:20</p>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="row">--}}
    {{--<div class="col-md-12">--}}
    {{--<p class="pull-left">Humanfeel</p>--}}
    {{--<p class="pull-right font-bold">32 <sup>°F</sup></p>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="col-xs-6 p-l-10">--}}
    {{--<div class="row">--}}
    {{--<div class="col-md-12">--}}
    {{--<p class="pull-left">Sunset</p>--}}
    {{--<p class="pull-right font-bold">21:05</p>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="row">--}}
    {{--<div class="col-md-12">--}}
    {{--<p class="pull-left">Pressure </p>--}}
    {{--<p class="pull-right font-bold">22 in</p>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="weather-time">--}}
    {{--<ul class="list-unstyled weather-days row">--}}
    {{--<li class="col-xs-4 col-sm-2"><span>Tue</span>--}}
    {{--<canvas class="sleet" width="30" height="30"></canvas>--}}
    {{--<span>32<sup>°F</sup></span></li>--}}
    {{--<li class="col-xs-4 col-sm-2"><span>Wed</span>--}}
    {{--<canvas class="clear-day" width="30" height="30"></canvas>--}}
    {{--<span>34<sup>°F</sup></span></li>--}}
    {{--<li class="col-xs-4 col-sm-2"><span>Thu</span>--}}
    {{--<canvas class="partly-cloudy-day" width="30" height="30"></canvas>--}}
    {{--<span>35<sup>°F</sup></span></li>--}}
    {{--<li class="col-xs-4 col-sm-2"><span>Fri</span>--}}
    {{--<canvas class="cloudy" width="30" height="30"></canvas>--}}
    {{--<span>34<sup>°F</sup></span></li>--}}
    {{--<li class="col-xs-4 col-sm-2"><span>Sat</span>--}}
    {{--<canvas class="snow" width="30" height="30"></canvas>--}}
    {{--<span>30<sup>°F</sup></span></li>--}}
    {{--<li class="col-xs-4 col-sm-2"><span>Sun</span>--}}
    {{--<canvas class="wind" width="30" height="30"></canvas>--}}
    {{--<span>26<sup>°F</sup></span></li>--}}
    {{--</ul>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="col-md-4 col-sm-12 col-xs-12">--}}
    {{--<div class="white-box">--}}
    {{--<h3 class="box-title">User Activity</h3>--}}
    {{--<div class="steamline">--}}
    {{--<div class="sl-item">--}}
    {{--<div class="sl-left"><img class="img-circle" alt="user"--}}
    {{--src="https://wrappixel.com/demos/admin-templates/pixeladmin/plugins/images/users/genu.jpg">--}}
    {{--</div>--}}
    {{--<div class="sl-right">--}}
    {{--<div><a href="#">Gohn Doe</a> <span class="sl-date">5 minutes ago</span></div>--}}
    {{--<p>Contrary to popular belief</p>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="sl-item">--}}
    {{--<div class="sl-left"><img class="img-circle" alt="user"--}}
    {{--src="https://wrappixel.com/demos/admin-templates/pixeladmin/plugins/images/users/ritesh.jpg">--}}
    {{--</div>--}}
    {{--<div class="sl-right">--}}
    {{--<div><a href="#">Gohn Doe</a> <span class="sl-date">5 minutes ago</span></div>--}}
    {{--<p>Lorem Ipsum is simply dummy</p>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="sl-item">--}}
    {{--<div class="sl-left"><img class="img-circle" alt="user"--}}
    {{--src="https://wrappixel.com/demos/admin-templates/pixeladmin/plugins/images/users/sonu.jpg">--}}
    {{--</div>--}}
    {{--<div class="sl-right">--}}
    {{--<div><a href="#">Gohn Doe</a> <span class="sl-date">5 minutes ago</span></div>--}}
    {{--<p>The standard chunk of ipsum </p>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="sl-item">--}}
    {{--<div class="sl-left"><img class="img-circle" alt="user"--}}
    {{--src="https://wrappixel.com/demos/admin-templates/pixeladmin/plugins/images/users/ritesh.jpg">--}}
    {{--</div>--}}
    {{--<div class="sl-right">--}}
    {{--<div><a href="#">Gohn Doe</a> <span class="sl-date">5 minutes ago</span></div>--}}
    {{--<p>Contrary to popular belief</p>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="sl-item">--}}
    {{--<div class="sl-left"><img class="img-circle" alt="user"--}}
    {{--src="https://wrappixel.com/demos/admin-templates/pixeladmin/plugins/images/users/govinda.jpg">--}}
    {{--</div>--}}
    {{--<div class="sl-right">--}}
    {{--<div><a href="#">Gohn Doe</a> <span class="sl-date">5 minutes ago</span></div>--}}
    {{--<p>The generated lorem ipsum</p>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="col-md-4 col-sm-12 col-xs-12">--}}
    {{--<div class="white-box">--}}
    {{--<h3 class="box-title">Feeds</h3>--}}
    {{--<ul class="feeds">--}}
    {{--<li>--}}
    {{--<div class="bg-info"><i class="fa fa-bell-o text-white"></i></div>--}}
    {{--You have 4 pending tasks. <span class="text-muted">Just Now</span></li>--}}
    {{--<li>--}}
    {{--<div class="bg-success"><i class="ti-server text-white"></i></div>--}}
    {{--Server #1 overloaded.<span class="text-muted">2 Hours ago</span></li>--}}
    {{--<li>--}}
    {{--<div class="bg-warning"><i class="ti-shopping-cart text-white"></i></div>--}}
    {{--New order received.<span class="text-muted">31 May</span></li>--}}
    {{--<li>--}}
    {{--<div class="bg-danger"><i class="ti-user text-white"></i></div>--}}
    {{--New user registered.<span class="text-muted">30 May</span></li>--}}
    {{--<li>--}}
    {{--<div class="bg-inverse"><i class="fa fa-bell-o text-white"></i></div>--}}
    {{--New Version just arrived. <span class="text-muted">27 May</span></li>--}}
    {{--<li>--}}
    {{--<div class="bg-purple"><i class="ti-settings text-white"></i></div>--}}
    {{--You have 4 pending tasks. <span class="text-muted">27 May</span></li>--}}
    {{--</ul>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<!-- /row -->--}}
    {{--<!-- row -->--}}
    {{--<div class="row">--}}
    {{--<div class="col-md-3 col-xs-12 col-sm-6">--}}
    {{--<div class="white-box m-b-0 bg-danger">--}}
    {{--<h3 class="text-white box-title">Analysis <span class="pull-right"><i class="fa fa-caret-up"></i> 260</span>--}}
    {{--</h3>--}}
    {{--<div id="sparkline1dash"></div>--}}
    {{--</div>--}}
    {{--<div class="white-box">--}}
    {{--<div class="row">--}}
    {{--<div class="pull-left">--}}
    {{--<div class="text-muted m-t-15">Site Analysis</div>--}}
    {{--<h2>21000</h2></div>--}}
    {{--<div data-label="60%"--}}
    {{--class="css-bar css-bar-60 css-bar-lg m-b-0 css-bar-danger pull-right"></div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="col-md-3 col-xs-12 col-sm-6">--}}
    {{--<div class="white-box m-b-0 bg-info">--}}
    {{--<h3 class="text-white box-title">Sales <span class="pull-right"><i class="fa fa-caret-down"></i> 160</span>--}}
    {{--</h3>--}}
    {{--<div id="sparkline2dash" class="text-center"></div>--}}
    {{--</div>--}}
    {{--<div class="white-box">--}}
    {{--<div class="row">--}}
    {{--<div class="pull-left">--}}
    {{--<div class="text-muted m-t-15">TOTAL SALES</div>--}}
    {{--<h2>21000</h2></div>--}}
    {{--<div data-label="60%"--}}
    {{--class="css-bar css-bar-60 css-bar-lg m-b-0  css-bar-info pull-right"></div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="col-md-3 col-xs-12 col-sm-6">--}}
    {{--<div class="white-box m-b-0 bg-purple">--}}
    {{--<h3 class="text-white box-title">Site visits <span class="pull-right"><i class="fa fa-caret-up"></i> 260</span>--}}
    {{--</h3>--}}
    {{--<div id="sparkline3dash"></div>--}}
    {{--</div>--}}
    {{--<div class="white-box">--}}
    {{--<div class="row">--}}
    {{--<div class="pull-left">--}}
    {{--<div class="text-muted m-t-15">TOTAL visits</div>--}}
    {{--<h2>26000</h2></div>--}}
    {{--<div data-label="60%"--}}
    {{--class="css-bar css-bar-60 css-bar-lg m-b-0 css-bar-purple pull-right"></div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="col-md-3 col-xs-12 col-sm-6">--}}
    {{--<div class="white-box m-b-0 bg-inverse">--}}
    {{--<h3 class="text-white box-title">Power consumption <span class="pull-right"><i--}}
    {{--class="fa fa-caret-up"></i> 260</span></h3>--}}
    {{--<div id="sparkline4dash" class="text-center"></div>--}}
    {{--</div>--}}
    {{--<div class="white-box">--}}
    {{--<div class="row">--}}
    {{--<div class="pull-left">--}}
    {{--<div class="text-muted m-t-15">TOTAL consumption</div>--}}
    {{--<h2>61000</h2></div>--}}
    {{--<div data-label="60%"--}}
    {{--class="css-bar css-bar-60 css-bar-lg m-b-0 css-bar-inverse pull-right"></div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<!-- /row -->--}}
    {{--<!-- .row -->--}}
    {{--<div class="row">--}}
    {{--<div class="col-md-8 col-lg-9 col-sm-6 col-xs-12">--}}
    {{--<div class="white-box">--}}
    {{--<h3 class="box-title">SALES ANALYTICS</h3>--}}
    {{--<ul class="list-inline text-center">--}}
    {{--<li>--}}
    {{--<h5><i class="fa fa-circle m-r-5" style="color: #00bfc7;"></i>Site A View</h5></li>--}}
    {{--<li>--}}
    {{--<h5><i class="fa fa-circle m-r-5" style="color: #fdc006;"></i>Site B View</h5></li>--}}
    {{--</ul>--}}
    {{--<div id="morris-area-chart2" style="height: 370px;"></div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="col-md-4 col-lg-3 col-sm-6 col-xs-12">--}}
    {{--<div class="white-box">--}}
    {{--<h3 class="box-title">Total Sites Visit</h3>--}}
    {{--<div class="row">--}}
    {{--<div class="col-md-6 col-sm-6 col-xs-6  m-t-30">--}}
    {{--<h1 class="text-warning">6778</h1>--}}
    {{--<p class="text-muted">APRIL 2016</p> <b>(150-165 Sales)</b></div>--}}
    {{--<div class="col-md-6 col-sm-6 col-xs-6">--}}
    {{--<div id="sales1" class="text-center"></div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="col-md-4 col-lg-3 col-sm-6 col-xs-12">--}}
    {{--<div class="white-box">--}}
    {{--<h3 class="box-title">Sales Difference</h3>--}}
    {{--<div class="row">--}}
    {{--<div class="col-md-6 col-sm-6 col-xs-6  m-t-30">--}}
    {{--<h1 class="text-info">$2478</h1>--}}
    {{--<p class="text-muted">APRIL 2016</p> <b>(150-165 Sales)</b></div>--}}
    {{--<div class="col-md-6 col-sm-6 col-xs-6">--}}
    {{--<div id="sales2" class="text-center"></div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<!-- /.row -->--}}
    {{--<!-- .row -->--}}
    {{--<div class="row">--}}
    {{--<div class="col-md-4 col-sm-12 col-xs-12">--}}
    {{--<div class="white-box">--}}
    {{--<h3 class="box-title">--}}
    {{--<small class="pull-right m-t-10 text-success"><i class="fa fa-sort-asc"></i> 18% High then last--}}
    {{--month--}}
    {{--</small>--}}
    {{--Site Traffic--}}
    {{--</h3>--}}
    {{--<div class="stats-row">--}}
    {{--<div class="stat-item">--}}
    {{--<h6>Overall Growth</h6> <b>80.40%</b></div>--}}
    {{--<div class="stat-item">--}}
    {{--<h6>Montly</h6> <b>15.40%</b></div>--}}
    {{--<div class="stat-item">--}}
    {{--<h6>Day</h6> <b>5.50%</b></div>--}}
    {{--</div>--}}
    {{--<div id="sparkline8"></div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="col-md-4 col-sm-12 col-xs-12">--}}
    {{--<div class="white-box">--}}
    {{--<h3 class="box-title">--}}
    {{--<small class="pull-right m-t-10 text-danger"><i class="fa fa-sort-desc"></i> 18% High then last--}}
    {{--month--}}
    {{--</small>--}}
    {{--Site Traffic--}}
    {{--</h3>--}}
    {{--<div class="stats-row">--}}
    {{--<div class="stat-item">--}}
    {{--<h6>Overall Growth</h6> <b>80.40%</b></div>--}}
    {{--<div class="stat-item">--}}
    {{--<h6>Montly</h6> <b>15.40%</b></div>--}}
    {{--<div class="stat-item">--}}
    {{--<h6>Day</h6> <b>5.50%</b></div>--}}
    {{--</div>--}}
    {{--<div id="sparkline9"></div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="col-md-4 col-sm-12 col-xs-12">--}}
    {{--<div class="white-box">--}}
    {{--<h3 class="box-title">--}}
    {{--<small class="pull-right m-t-10 text-success"><i class="fa fa-sort-asc"></i> 18% High then last--}}
    {{--month--}}
    {{--</small>--}}
    {{--Site Traffic--}}
    {{--</h3>--}}
    {{--<div class="stats-row">--}}
    {{--<div class="stat-item">--}}
    {{--<h6>Overall Growth</h6> <b>80.40%</b></div>--}}
    {{--<div class="stat-item">--}}
    {{--<h6>Montly</h6> <b>15.40%</b></div>--}}
    {{--<div class="stat-item">--}}
    {{--<h6>Day</h6> <b>5.50%</b></div>--}}
    {{--</div>--}}
    {{--<div id="sparkline10"></div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<!-- /.row -->--}}
    {{--<!-- .row -->--}}
    {{--<div class="row">--}}
    {{--<div class="col-md-4 col-xs-12 col-sm-6">--}}
    {{--<div class="white-box">--}}
    {{--<h3 class="box-title">To Do List</h3>--}}
    {{--<ul class="list-task list-group" data-role="tasklist">--}}
    {{--<li class="list-group-item" data-role="task">--}}
    {{--<div class="checkbox checkbox-info">--}}
    {{--<input type="checkbox" id="inputSchedule" name="inputCheckboxesSchedule">--}}
    {{--<label for="inputSchedule"> <span>Schedule meeting</span> </label>--}}
    {{--</div>--}}
    {{--</li>--}}
    {{--<li class="list-group-item" data-role="task">--}}
    {{--<div class="checkbox checkbox-info">--}}
    {{--<input type="checkbox" id="inputCall" name="inputCheckboxesCall">--}}
    {{--<label for="inputCall"> <span>Call clients for follow-up</span> <span--}}
    {{--class="label label-danger">Today</span> </label>--}}
    {{--</div>--}}
    {{--</li>--}}
    {{--<li class="list-group-item" data-role="task">--}}
    {{--<div class="checkbox checkbox-info">--}}
    {{--<input type="checkbox" id="inputBook" name="inputCheckboxesBook">--}}
    {{--<label for="inputBook"> <span>Book flight for holiday</span> </label>--}}
    {{--</div>--}}
    {{--</li>--}}
    {{--<li class="list-group-item" data-role="task">--}}
    {{--<div class="checkbox checkbox-info">--}}
    {{--<input type="checkbox" id="inputForward" name="inputCheckboxesForward">--}}
    {{--<label for="inputForward"> <span>Forward important tasks</span> <span--}}
    {{--class="label label-warning">2 weeks</span> </label>--}}
    {{--</div>--}}
    {{--</li>--}}
    {{--<li class="list-group-item" data-role="task">--}}
    {{--<div class="checkbox checkbox-info">--}}
    {{--<input type="checkbox" id="inputRecieve" name="inputCheckboxesRecieve">--}}
    {{--<label for="inputRecieve"> <span>Recieve shipment</span> </label>--}}
    {{--</div>--}}
    {{--</li>--}}
    {{--<li class="list-group-item" data-role="task">--}}
    {{--<div class="checkbox checkbox-info">--}}
    {{--<input type="checkbox" id="inputForward2" name="inputCheckboxesd">--}}
    {{--<label for="inputForward2"> <span>Important tasks</span> <span--}}
    {{--class="label label-success">2 weeks</span> </label>--}}
    {{--</div>--}}
    {{--</li>--}}
    {{--</ul>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="col-md-4 col-xs-12 col-sm-6">--}}
    {{--<div class="white-box">--}}
    {{--<h3 class="box-title">You have 5 new messages</h3>--}}
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
    {{--<h5>Sonu Nigam</h5> <span class="mail-desc">I've sung a song! See you at</span> <span--}}
    {{--class="time">9:10 AM</span></div>--}}
    {{--</a>--}}
    {{--<a href="#">--}}
    {{--<div class="user-img"><img--}}
    {{--src="https://wrappixel.com/demos/admin-templates/pixeladmin/plugins/images/users/arijit.jpg"--}}
    {{--alt="user" class="img-circle"> <span--}}
    {{--class="profile-status away pull-right"></span></div>--}}
    {{--<div class="mail-contnet">--}}
    {{--<h5>Arijit Sinh</h5> <span class="mail-desc">I am a singer!</span> <span class="time">9:08 AM</span>--}}
    {{--</div>--}}
    {{--</a>--}}
    {{--<a href="#">--}}
    {{--<div class="user-img"><img--}}
    {{--src="https://wrappixel.com/demos/admin-templates/pixeladmin/plugins/images/users/genu.jpg"--}}
    {{--alt="user" class="img-circle"> <span--}}
    {{--class="profile-status online pull-right"></span></div>--}}
    {{--<div class="mail-contnet">--}}
    {{--<h5>Genelia Deshmukh</h5> <span class="mail-desc">I love to do acting and dancing</span>--}}
    {{--<span class="time">9:08 AM</span></div>--}}
    {{--</a>--}}
    {{--<a href="#" class="b-none">--}}
    {{--<div class="user-img"><img--}}
    {{--src="https://wrappixel.com/demos/admin-templates/pixeladmin/plugins/images/users/pawandeep.jpg"--}}
    {{--alt="user" class="img-circle"> <span--}}
    {{--class="profile-status offline pull-right"></span></div>--}}
    {{--<div class="mail-contnet">--}}
    {{--<h5>Pavan kumar</h5> <span class="mail-desc">Just see the my admin!</span> <span--}}
    {{--class="time">9:02 AM</span></div>--}}
    {{--</a>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="col-md-4 col-sm-12 col-xs-12">--}}
    {{--<div class="white-box">--}}
    {{--<h3 class="box-title">Chat</h3>--}}
    {{--<div class="chat-box">--}}
    {{--<ul class="chat-list slimscroll" style="overflow: hidden;" tabindex="5005">--}}
    {{--<li>--}}
    {{--<div class="chat-image"><img alt="male"--}}
    {{--src="https://wrappixel.com/demos/admin-templates/pixeladmin/plugins/images/users/sonu.jpg">--}}
    {{--</div>--}}
    {{--<div class="chat-body">--}}
    {{--<div class="chat-text">--}}
    {{--<h4>Sonu Nigam</h4>--}}
    {{--<p> Hi, All! </p> <b>10.00 am</b></div>--}}
    {{--</div>--}}
    {{--</li>--}}
    {{--<li class="odd">--}}
    {{--<div class="chat-image"><img alt="Female"--}}
    {{--src="https://wrappixel.com/demos/admin-templates/pixeladmin/plugins/images/users/genu.jpg">--}}
    {{--</div>--}}
    {{--<div class="chat-body">--}}
    {{--<div class="chat-text">--}}
    {{--<h4>Genelia</h4>--}}
    {{--<p> Hi, How are you Sonu? ur next concert? </p> <b>10.03 am</b></div>--}}
    {{--</div>--}}
    {{--</li>--}}
    {{--<li>--}}
    {{--<div class="chat-image"><img alt="male"--}}
    {{--src="https://wrappixel.com/demos/admin-templates/pixeladmin/plugins/images/users/ritesh.jpg">--}}
    {{--</div>--}}
    {{--<div class="chat-body">--}}
    {{--<div class="chat-text">--}}
    {{--<h4>Ritesh</h4>--}}
    {{--<p> Hi, Sonu and Genelia, </p> <b>10.05 am</b></div>--}}
    {{--</div>--}}
    {{--</li>--}}
    {{--</ul>--}}
    {{--<div class="row">--}}
    {{--<div class="col-sm-12">--}}
    {{--<div class="input-group">--}}
    {{--<input type="text" class="form-control" placeholder="Say something"> <span--}}
    {{--class="input-group-btn">--}}
    {{--<button class="btn btn-success" type="button">Send</button>--}}
    {{--</span></div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<!-- /.row -->--}}
    {{--<!-- .row -->--}}
    {{--<div class="row">--}}
    {{--<div class="col-md-4 col-lg-4 col-xs-12">--}}
    {{--<div class="white-box">--}}
    {{--<h3 class="box-title">Browser Stats</h3>--}}
    {{--<ul class="basic-list">--}}
    {{--<li>Google Chrome <span class="pull-right label-danger label">21.8%</span></li>--}}
    {{--<li>Mozila Firefox <span class="pull-right label-purple label">21.8%</span></li>--}}
    {{--<li>Apple Safari <span class="pull-right label-success label">21.8%</span></li>--}}
    {{--<li>Internet Explorer <span class="pull-right label-info label">21.8%</span></li>--}}
    {{--<li>Opera mini <span class="pull-right label-warning label">21.8%</span></li>--}}
    {{--<li>Mozila Firefox <span class="pull-right label-purple label">21.8%</span></li>--}}
    {{--</ul>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="col-sm-12 col-md-4 col-xs-12">--}}
    {{--<div class="white-box">--}}
    {{--<h3 class="box-title">Visits from countries</h3>--}}
    {{--<ul class="country-state">--}}
    {{--<li>--}}
    {{--<h2>6350</h2>--}}
    {{--<small>From India</small>--}}
    {{--<div class="pull-right">48% <i class="fa fa-level-up text-success"></i></div>--}}
    {{--<div class="progress">--}}
    {{--<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="50"--}}
    {{--aria-valuemin="0" aria-valuemax="100" style="width:48%;"><span class="sr-only">48% Complete</span>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</li>--}}
    {{--<li>--}}
    {{--<h2>3250</h2>--}}
    {{--<small>From UAE</small>--}}
    {{--<div class="pull-right">98% <i class="fa fa-level-up text-success"></i></div>--}}
    {{--<div class="progress">--}}
    {{--<div class="progress-bar progress-bar-inverse" role="progressbar" aria-valuenow="50"--}}
    {{--aria-valuemin="0" aria-valuemax="100" style="width:98%;"><span class="sr-only">98% Complete</span>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</li>--}}
    {{--<li>--}}
    {{--<h2>1250</h2>--}}
    {{--<small>From Australia</small>--}}
    {{--<div class="pull-right">75% <i class="fa fa-level-down text-danger"></i></div>--}}
    {{--<div class="progress">--}}
    {{--<div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="50"--}}
    {{--aria-valuemin="0" aria-valuemax="100" style="width:75%;"><span class="sr-only">75% Complete</span>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</li>--}}
    {{--<li>--}}
    {{--<h2>1350</h2>--}}
    {{--<small>From USA</small>--}}
    {{--<div class="pull-right">48% <i class="fa fa-level-up text-success"></i></div>--}}
    {{--<div class="progress">--}}
    {{--<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="50"--}}
    {{--aria-valuemin="0" aria-valuemax="100" style="width:48%;"><span class="sr-only">48% Complete</span>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</li>--}}
    {{--</ul>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="col-md-4 col-lg-4 col-xs-12">--}}
    {{--<div class="white-box">--}}
    {{--<div class="user-bg"><img--}}
    {{--src="https://wrappixel.com/demos/admin-templates/pixeladmin/plugins/images/large/img1.jpg"--}}
    {{--alt="user" style="100%">--}}
    {{--<div class="overlay-box">--}}
    {{--<div class="user-content">--}}
    {{--<a href="javascript:void(0)"><img alt="img" class="thumb-lg img-circle"--}}
    {{--src="https://wrappixel.com/demos/admin-templates/pixeladmin/plugins/images/users/genu.jpg"></a>--}}
    {{--<h4 class="text-white">User Name</h4>--}}
    {{--<h5 class="text-white">info@myadmin.com</h5></div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="user-btm-box">--}}
    {{--<div class="col-md-4 col-sm-4 text-center">--}}
    {{--<p class="text-purple"><i class="ti-facebook"></i></p>--}}
    {{--<h1>258</h1></div>--}}
    {{--<div class="col-md-4 col-sm-4 text-center">--}}
    {{--<p class="text-blue"><i class="ti-twitter"></i></p>--}}
    {{--<h1>125</h1></div>--}}
    {{--<div class="col-md-4 col-sm-4 text-center">--}}
    {{--<p class="text-danger"><i class="ti-dribbble"></i></p>--}}
    {{--<h1>556</h1></div>--}}
    {{--<div class="stats-row col-md-12 m-t-15 m-b-0 text-center">--}}
    {{--<div class="stat-item">--}}
    {{--<h6>Contact info</h6> <b><i class="ti-mobile"></i> 123-456-7890</b></div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    <!-- /.row -->
    </div>

    <script>
        window.onload = function () {

            var parsed = JSON.parse('{!! json_encode($cost) !!}');

            var cost = [];
            var date = [];
            var result = $.parseJSON('{!! json_encode($cost) !!}');
            $.each(result, function(k, v) {
                @if(session('role') == 'learner')
                date.push(moment(k).format("MM/DD/YYYY"));
                @else
                date.push(k);
                @endif
                cost.push(v);
            });

            Highcharts.setOptions({
                lang: {
                    thousandsSep: ','
                }
            });

            @if(session('role') != 'admin')

            Highcharts.chart('chart', {

                title: {
                    text: 'Cost of Not Managing Better'
                },
                subtitle: {
                    text: 'All data is reset every year on Jan 01'
                },
                xAxis: {
                    title: {
                        text: 'Date'
                    },
//                    categories: [1,2,3,4,5,6,7,8,9,10]
                    categories: date
                },
                yAxis: {
                    title: {
                        text: 'Total Impact($)'
                    },
                    labels: {
                        format: '{value:,.0f}'
                    }
                },
                legend: {
                    layout: 'vertical',
                    align: 'right',
                    verticalAlign: 'middle'
                },

                plotOptions: {
                    series: {
                        name: 'Dates',
                        data: date
                    }
                },

                series: [{
                    name: 'Cost',
                    data: cost
                    }
                ],
                exporting: {
                    fallbackToExportServer: false
                },
                responsive: {
                    rules: [{
                        condition: {
                            maxWidth: 500
                        },
                        chartOptions: {
                            legend: {
                                layout: 'horizontal',
                                align: 'center',
                                verticalAlign: 'bottom'
                            }
                        }
                    }]
                }

            });

        @else
         Highcharts.chart('chart', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Cost of Not Managing Better'
            },
            subtitle: {
                text: 'All data is reset every year on Jan 01'
            },
            xAxis: {
                categories: date,
//                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Total Impact($)'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>$ {point.y:,.0f}</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                name: 'Cost for Organization',
                data: cost
            }]
        });
        @endif
        }
    </script>
@endsection