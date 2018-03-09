@extends('layouts.app')
@section('content')
    @include('includes.main-menu')

    <style>
        .learning {
            position: relative;
            margin-bottom: 15px;
            background-image: url(http://localhost:8000/uploads/1516276915502.png);
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center top;
            background-color: rgba(0, 0, 0, 0.60);
            min-height: 300px;
        }

        .learning-thumbnail {
            max-height: 500px;
            height: auto;
            width: 100%;
            overflow: hidden;
        }

        .learning-title {
            display: block;
            color: #efefef;
        }

        .learning-details {
            margin-top: 10px;
            position: relative;
        }

        .learning-details span {
            color: #bbb;
            margin: 5px;
        }

        .learning-overlay a {
            position: absolute;
            left: 45%;
            top: 50%;
            margin-left: -60px;
            margin-top: -30px;
        }

        .learning-overlay{
            padding: 20px;
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            width: 100%;
            height: 100%;
            transition: all .5s;
            background-color: rgba(0, 0, 0, 0.60);
        }

        .learning-overlay {
            opacity: 0;
        }

        .start-learning {
            opacity: 0;
        }

        .learning:hover .learning-overlay {
            opacity: 1;
        }

        /*.learning:hover .start-learning {*/
            /*opacity: 1;*/
        /*}*/

        .learning-highlights {
            display: block;
        }

        .learning-highlights .highlight {
            display: inline-block;
            background: #f75b36;
            padding: 5px;
            margin: 5px;
            color: #fff;
            border-radius: 1px;
        }

    </style>

    <div class="container-fluid">
        <div class="row m-t-15 m-b-0">

            <div class="col-md-12" >
                <div class="white-box">
                    <div class="row">
                        <div class="col-md-12">
                            <h3>Learning Modules</h3>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default block1" style="box-shadow: 0 1px 3px rgba(0,0,0,0.14)">
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body text-center">
                            <p>
                                A new and innovative approach to learn and apply new skills to Coaching, Collaboration, Communication, Discipline, Engaging Today’s Workforce, Innovation and Creativity, Integrating Change, Meetings, Motivation, Performance Improvement, Problem Solving, Remote Supervising, Time Management, and Trust.
                            </p>
                        </div>
                        <div class="panel-footer text-center">
                            @if(session('role') == 'organization')
                                <p>
                                    As an Organization, you can customize our learning modules to ensure maximum impact on your learners. You can add images and text in the beginning of each modules.
                                </p>
                            @endif
                            @if(session('role') == 'learner')
                                <p>
                                    Study and learn how to better manage yourself and the people within your organization. Take quiz,
                                </p>
                            @endif
                            @if(session('role') == 'admin')
                                <hr>
                                <a href="{{ 'learnings/create' }}" class="btn btn-primary">Add Learning Module</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row m-t-0">
            {{--@foreach($learningBundle as $learnings)--}}
            @foreach($learnings as $learning)
                <div class="col-md-4 col-lg-4 col-xs-6 col-sm-6">
                    <div class="learning" style="{{!empty($learning->image) ? "background-image: url('". asset('uploads/'.$learning->image) . "')" : "" }}">
                    <div  style="box-shadow: 0 1px 3px rgba(0,0,0,0.14);background-color: rgba(0, 0, 0, 0.60); padding: 20px; min-height: 300px;">
                        <img src="{{asset('assets/icons/'.strtolower($learning->title).'.png')}}"  class="assessment-icon" style="display: inline;width: 50px;">
                            <h2 class="learning-title">
                                {{ $learning->title }}
                            </h2>
                            <div class="learning-highlights">
                                @if(isset($learning->highlights))
                                    @foreach($learning->highlights as $highlight)
                                        <span class="highlight">{{ $highlight }}</span>
                                        @endforeach
                                @endif
                            </div>
                            <div class="learning-details">
                                <span class="chapter-count">{{ count($learning->chapters) }} Chapters</span>
                                <span class="quiz-count">{{ count($learning->quiz) }} Quiz</span>
                                <span class="assessment-count">{{ count($learning->assessments) }} Assessments</span>
                            </div>
                        {{--</div>--}}
                        {{--<div class="start-learning">--}}
                        <div class="learning-overlay">
                            @if(session('role') == 'learner')
                                <a href="{{ url('learnings/'.$learning->id) }}" class="btn btn-lg btn-rounded btn-info"> Start Learning</a>
                            @endif
                            @if(session('role') == 'organization' || session('role') == 'admin')
                                    <a href="{{ url('learnings/'. $learning->id) }}" class="btn btn-lg btn-rounded btn-info"> View</a>
                                    <a href="{{ url('learnings/'. $learning->id .'/edit') }}" class="btn btn-lg btn-rounded btn-info" style="margin-left: 25px;"> Edit</a>
                            @endif
                        </div>
                        </div>
                    </div>
                </div>
            @endforeach
            {{--@endforeach--}}
        </div>
    </div>
    <div class="scroll-top"><i class="fa fa-chevron-up"></i></div>
@endsection