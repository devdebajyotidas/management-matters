@extends('layouts.app-webview')
@section('content')
    @include('includes.main-menu')

    <style>
        .learn-banner {
            height: 50vh;
            width: calc(100% + 18px);
            margin: 0 -9px;
            background-size: cover;
            background-attachment: fixed;
        }

        .details-learn {
            position: absolute;
            top: 0;
            left:0;
            background: rgba(23,23,23, 0.5);
            width: 100%;
            height: 100%;
            color: #fff;
        }

        .panel-title, .panel-body {
            text-align: left;
        }
        /*.content-wrap section p, .content-wrap li span {*/
            /*margin: 0;*/
            /*padding: 0!important;*/
            /*color: black!important;*/
            /*font-family: Rubik, sans-serif;*/
        /*}*/

        body {
            color: #000;
        }

        strong{
            font-weight: 700;
        }

        nav{
            width: 100%;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: 50px;
            background: #fff;
            z-index: 99999;
        }
        nav > ul{
            height: 50px;
            list-style: none;
            padding: 0;
            overflow: auto;
            margin: 0;
            white-space: nowrap;
        }
        .tabs-style-linebox nav ul li{
            display: inline-block;
            padding: 10px;
            font-size: 15px;
        }
        .tabs-style-linebox nav a::after{
            display: none;
        }
        .tabs-style-linebox nav li.tab-current a{
            color: #f75b36;
        }
        .tabs-style-linebox nav li.tab-current{
            border-bottom: 1px solid red
        }
        #page-wrapper {
            margin: 0px!important;
        }
        ::-webkit-scrollbar {
            display: none;
        }
        footer{
           display: none;
        }
        #page-wrapper {
            margin: 0px!important;
            padding: 0px;
        }
    </style>

    <div class="row" >
        <div class="col-md-12">
            <div class="white-box p-0 m-t-0">
                <section class="m-t-40 learning-content">
                    <div class="tabs-style-linebox">
                        {{--<nav class="affix-top" data-spy="affix-top" data-offset-top="500">--}}
                        <nav>
                            <ul >
                                <li class="tab-current"><a href="javascript:void(0)" data-target="#chapter-introduction"><span>Introduction</span></a></li>
                                @foreach($learnings->chapters as $key => $chapter)
                                <li><a href="javascript:void(0)" data-target="#chapter-{{$key+1}}"><span>{{ $chapter['name'] }}</span></a></li>
                                @endforeach
                            </ul>
                        </nav>
                        <div class="content-wrap text-left">
                            <section id="chapter-introduction" class="content-current">
                                <p>
                                    @php
                                        $intro=!empty($learnings->introduction) ? $learnings->introduction : 'Introduction not available';
                                    @endphp
                                    @if(!empty(Auth::user()->account->department_id))
                                        {!! isset($learnings->orgintro->org_introduction) ? $learnings->orgintro->org_introduction : $intro !!}
                                    @else
                                        {!! $intro !!}
                                    @endif

                                </p>
                            </section>
                            @foreach($learnings->chapters as $key => $chapter)
                            <section id="chapter-{{$key+1}}">
                                <p>

                                        {!! $chapter['content'] !!}
                                </p>

                            </section>
                            @endforeach
                        </div>
                        <!-- /content -->
                    </div>
                    <!-- /tabs -->
                </section>
            </div>
        </div>
    </div>
    <div class="scroll-top"><i class="fa fa-chevron-up"></i></div>

    <script>
        window.onload = function () {
            $('nav > ul > li').click(function (e) {
                $('nav > ul > li').removeClass('tab-current');
                $(this).addClass('tab-current');
                var target = $(this).find('a').attr('data-target');

                $('.content-wrap > section').removeClass('content-current');
                $(target).addClass('content-current');
            });
        }
    </script>

@endsection