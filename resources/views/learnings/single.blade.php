@extends('layouts.app')
@section('content')
    @include('includes.main-menu')

    <style>
        .learn-banner {
            height: 100vh;
            width: calc(100% + 18px);
            margin: 0 -9px;
            background-size: cover;
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
        .content-wrap section p, .content-wrap li span {
            margin: 0;
            padding: 0!important;
            color: black!important;
            font-family: Rubik, sans-serif;
        }

    </style>

    <div class="row">
        <div class="col-md-12">
            <div class="white-box p-0 m-t-0 m-l-15 m-r-15">
                <div class="col-md-12 col-xs-12 col-sm-12" >
                    <div class="learn-banner" style="background-image: url({{isset($learnings) ? asset('uploads/'.$learnings->image) : 'https://wrappixel.com/demos/admin-templates/pixeladmin/plugins/images/big/img1.jpg'}})">
                    </div>
                    <div class="white-box details-learn">
                        <h3 class="m-t-20 m-b-20" style="color: #fff;">{{ $learnings->title }}</h3>
                        <p>{{ $learnings->description }}</p>
                        @if($role == 'learner')
                            <a class="fcbtn btn btn-primary btn-outline btn-1b ticket" href="{{ url('tickets') }}">Create Ticket</a>
                            <a href="{{ url('learnings/'.$learnings->id.'/quiz') }}" class="fcbtn btn btn-primary btn-outline btn-1b quize">Take Quiz</a>
                       @endif
                    </div>
                </div>
                <section class="m-t-40 learning-content">
                    <div class="sttabs tabs-style-linebox">
                        <nav>
                            <ul>
                                <li class="tab-current"><a href="#chapter-introduction"><span>Introduction</span></a></li>
                                @foreach($learnings->chapters as $key => $chapter)
                                <li><a href="#chapter-{{$key+1}}"><span>{{ $chapter['name'] }}</span></a></li>
                                @endforeach
                            </ul>
                        </nav>
                        <div class="content-wrap text-left">
                            <section id="chapter-introduction" class="content-current">
                                <p>
                                    @if(!empty($learnings->introduction))
                                        {{$learnings->introduction}}
                                    @else
                                        Introduction not available
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
@endsection