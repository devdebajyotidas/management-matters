@extends('layouts.app')
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
    </style>

    <div class="row" >
        <div class="col-md-12">
            <div class="white-box m-t-15 m-l-15 m-r-15">
                <div class="row">
                    <div class="col-md-9">
                        <h3>Learning Module</h3>
                    </div>
                </div>
            </div>
            <div class="white-box p-0 m-t-0 m-l-15 m-r-15" style="margin-top: -25px !important;">
                <div class="col-md-12 col-xs-12 col-sm-12" >
                    <div class="learn-banner" style="background-image: url({{isset($learnings) ? asset('uploads/'.$learnings->image) : 'emails'}})">
                    </div>
                    <div class="white-box details-learn">
                        <h3 class="m-t-15 m-b-20" style="color: #fff;">{{ $learnings->title }}</h3>
                        <p>{{ $learnings->description }}</p>
                        @if(session('role') == 'learner')
                            <a class="fcbtn btn btn-primary btn-outline btn-1b ticket" href="{{ url('tickets') }}">Create Ticket</a>
                            <a href="{{ url('learnings/'.$learnings->id.'/quiz') }}" class="fcbtn btn btn-primary btn-outline btn-1b quize">Take Quiz</a>
                       @endif
                    </div>
                </div>
                <section class="m-t-40 learning-content">
                    <div class="sttabs tabs-style-linebox">
                        {{--<nav class="affix-top" data-spy="affix-top" data-offset-top="500">--}}
                        <nav>
                            <ul >
                                <li class="tab-current"><a href="#chapter-introduction"><span>Introduction</span></a></li>
                                @if(is_array($learnings->chapters))
                                    @foreach($learnings->chapters as $key => $chapter)
                                    <li id="chapter-tab-{{$key+1}}"><a href="#chapter-{{$key+1}}"><span>{{ $chapter['name'] }}</span></a></li>
                                    @endforeach
                                @endif
                            </ul>
                        </nav>
                        <div class="content-wrap text-left fr-element fr-view all-chapters">
                            <section id="chapter-introduction" class="content-current">
                                <p>
                                    @php
                                        $intro=!empty($learnings->introduction) ? $learnings->introduction : 'Introduction not available';
                                    @endphp
                                    @if(!empty(Auth::user()->account->department_id) || session('role')=='organization')
                                        {!! isset($learnings->orgintro->org_introduction) ? $learnings->orgintro->org_introduction : $intro !!}
                                    @else
                                        {!! $intro !!}
                                    @endif

                                </p>
                            </section>
                            @if(is_array($learnings->chapters))
                            <?php
                            $chapters=array_values($learnings->chapters);
                            usort($chapters, function($a, $b) {
                                if(isset($a['index']))
                                    return $a['index'] - $b['index'];
                                else
                                    return 0;
                            });
                            ?>

                            @foreach($chapters as $key => $chapter)
                            <section id="chapter-{{$key+1}}" class="">
                                <p>

                                        {!! $chapter['content'] !!}
                                </p>

                            </section>
                            @endforeach
                            @endif
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
        window.onload=function(){

            @if(session()->has('success') || session('success'))
            setTimeout(function () {
                showToast('Success', '{{ session('success') }}', 'success');
            }, 500);
            @endif

            @if(isset($errors) && count($errors->all()) > 0 && $timeout = 700)
            @foreach ($errors->all() as $key => $error)
            setTimeout(function () {
                showToast('Error', '{{ $error }}', 'error');
            }, {{ $timeout * $key }});
            @endforeach
            @endif


           @if(session('role')=='learner')
           @if(isset($_GET['dos']) && $_GET['dos'])
            var tab=$('.all-chapters section').length - 1;
            $('#chapter-tab-'+tab).trigger('click');
            @endif
            @endif


        }
    </script>
@endsection