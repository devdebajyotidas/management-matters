@extends('layouts.app')
@section('content')
    @include('includes.main-menu')
    <style>
        .round-award{
            width: 50px;
            height: 50px;
            border: 2px solid #f75b36;
            border-radius: 25px;
            display: inline;
        }
        .awd-name{
            display: inline;
            padding-left: 10px;
        }
        .awd-pad{
            padding-bottom: 10px;
        }
    </style>
    <div class="container-fluid">
        <canvas id="world" style="position: absolute;top: 0;bottom: 0;left: 0;right: 0;"></canvas>
        <div class="row m-t-15">
            <div class="col-md-12">
                    <ul class="timeline">
                        <li>
                            <div class="timeline-badge ">
                                <img class="img-responsive" alt="user" src="{{asset('assets/img/title.png')}}">
                            </div>
                            <div class="timeline-panel">
                                <div class="awd-pad">
                                <img class="round-award" src="https://wrappixel.com/demos/admin-templates/pixeladmin/plugins/images/users/varun.jpg" alt="user-img">
                                <p class="awd-name">Ms Jhon Smith mgfh hnghy</p>
                                </div>
                                <div class="timeline-heading">
                                    <h4 class="timeline-title">Level 1 asdg ashdg af ga fdf yafsjhd</h4>
                                    <p>
                                        <small class="text-muted"><i class="fa fa-clock-o"></i> 15/06/2017
                                        </small>
                                    </p>
                                </div>
                                <div class="timeline-body">
                                    <p>You have earned this badge upon fully completing 10 assessments.</p>
                                </div>
                            </div>
                        </li>
                        <li class="timeline-inverted">
                            <div class="timeline-badge ">
                                <img class="img-responsive" alt="user" src="{{asset('assets/img/medal.png')}}">
                            </div>
                            <div class="timeline-panel">
                                <div class="awd-pad">
                                    <img class="round-award" src="https://wrappixel.com/demos/admin-templates/pixeladmin/plugins/images/users/varun.jpg" alt="user-img">
                                    <p class="awd-name">Ms Jhon Smith mgfh hnghy</p>
                                </div>
                                <div class="timeline-heading">
                                    <h4 class="timeline-title">Level 1</h4>
                                    <p>
                                        <small class="text-muted"><i class="fa fa-clock-o"></i> 15/06/2017
                                        </small>
                                    </p>
                                </div>
                                <div class="timeline-body">
                                    <p>You have earned this badge upon fully completing 10 assessments.</p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="timeline-badge ">
                                <img class="img-responsive" alt="user" src="{{asset('assets/img/insignia.png')}}">
                            </div>
                            <div class="timeline-panel">
                                <div class="awd-pad">
                                    <img class="round-award" src="https://wrappixel.com/demos/admin-templates/pixeladmin/plugins/images/users/varun.jpg" alt="user-img">
                                    <p class="awd-name">Ms Jhon Smith mgfh hnghy</p>
                                </div>
                                <div class="timeline-heading">
                                    <h4 class="timeline-title">Level 1</h4>
                                    <p>
                                        <small class="text-muted"><i class="fa fa-clock-o"></i> 15/06/2017
                                        </small>
                                    </p>
                                </div>
                                <div class="timeline-body">
                                    <p>You have earned this badge upon fully completing 10 assessments.</p>
                                </div>
                            </div>
                        </li>
                        <li class="timeline-inverted">
                            <div class="timeline-badge ">
                                <img class="img-responsive" alt="user" src="{{asset('assets/img/quality.png')}}">
                            </div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4 class="timeline-title">Level 1</h4>
                                    <p>
                                        <small class="text-muted"><i class="fa fa-clock-o"></i> 15/06/2017
                                        </small>
                                    </p>
                                </div>
                                <div class="timeline-body">
                                    <p>You have earned this badge upon fully completing 10 assessments.</p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="timeline-badge ">
                                <img class="img-responsive" alt="user" src="{{asset('assets/img/medal.png')}}">
                            </div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4 class="timeline-title">Level 1</h4>
                                    <p>
                                        <small class="text-muted"><i class="fa fa-clock-o"></i> 15/06/2017
                                        </small>
                                    </p>
                                </div>
                                <div class="timeline-body">
                                    <p>You have earned this badge upon fully completing 10 assessments.</p>
                                </div>
                            </div>
                        </li>
                        <li class="timeline-inverted">
                            <div class="timeline-badge ">
                                <img class="img-responsive" alt="user" src="{{asset('assets/img/premium.png')}}">
                            </div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4 class="timeline-title">Level 1</h4>
                                    <p>
                                        <small class="text-muted"><i class="fa fa-clock-o"></i> 15/06/2017
                                        </small>
                                    </p>
                                </div>
                                <div class="timeline-body">
                                    <p>You have earned this badge upon fully completing 10 assessments.</p>
                                </div>
                            </div>
                        </li>
                    </ul>
            </div>
        </div>
    </div>
@endsection