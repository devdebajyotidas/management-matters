@extends('layouts.app')
@section('content')
    @include('includes.main-menu')

    <style>
        .learning {
            position: relative;
            margin-bottom: 15px;
        }

        .learning-thumbnail {
            max-height: 250px;
            width: 100%;
        }

        .learning-title {
            display: block;
            color: #efefef;
        }

        .learning-details {
            padding-bottom: 10px;
            position: absolute;
            bottom: 15px;
        }

        .learning-details span {
            color: #bbb;
        }

        .start-learning a {
            position: absolute;
            left: 45%;
            top: 50%;
            margin-left: -60px;
            margin-top: -30px;
        }

        .learning-overlay, .start-learning {
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

        }

        .start-learning {
            opacity: 0;
        }

        .learning:hover .learning-overlay {
            opacity: 0;
        }

        .learning:hover .start-learning {
            opacity: 1;
        }

        .learning-highlights {
            display: block;
        }

        .learning-highlights .highlight {
            display: inline-block;
            background: #f75b36;
            padding: 5px;
            margin: 5px;
            color: #efefef;
            border-radius: 1px;
        }

    </style>

    <div class="container-fluid">
        <div class="row m-t-30">
            <div class="col-md-12">
                <div class="panel panel-default block1">
                    <div class="panel-heading text-center">Learning Modules</div>
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body text-center">
                            <p>
                                A new and innovative approach to learn and apply new skills to Coaching, Collaboration, Communication, Discipline, Engaging Today’s Workforce, Innovation and Creativity, Integrating Change, Meetings, Motivation, Performance Improvement, Problem Solving, Remote Supervising, Time Management, and Trust.
                            </p>
                        </div>
                        <div class="panel-footer text-center">
                            @if($role == 'organization')
                                <p>
                                    As an Organization, you can customize our learning modules to ensure maximum impact on your learners. You can add images and text in the beginning of each modules.
                                </p>
                            @endif
                            @if($role == 'learner')
                                <p>
                                    Study and learn how to better manage yourself and the people within your organization. Take quiz,
                                </p>
                            @endif
                            @if($role == 'admin')
                                <hr>
                                <a href="{{ 'learnings/create' }}" class="btn btn-primary">Add Learning Module</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row m-t-30">
            @foreach($learnings as $learning)
                <div class="col-md-4 col-lg-4 col-xs-6 col-sm-6">
                    <div class="learning">
                        <img class="learning-thumbnail img-responsive"
                             src="https://wrappixel.com/demos/admin-templates/pixeladmin/plugins/images/big/img1.jpg"
                             alt="">
                        <div class="learning-overlay">
                            <h2 class="learning-title">
                                {{ $learning->title }}
                            </h2>
                            <div class="learning-highlights">
                                @foreach($learning->highlights as $highlight)
                                    <span class="highlight">{{ $highlight }}</span>
                                @endforeach
                            </div>
                            <div class="learning-details">
                                <span class="chapter-count">{{ count($learning->chapters) }} Chapters</span>
                                <span class="quiz-count">{{ count($learning->quiz) }} Quiz</span>
                                <span class="assessment-count">{{ count($learning->assessments) }} Assessments</span>
                            </div>
                        </div>
                        <div class="start-learning">
                            @if($role == 'learner')
                                <a href="{{ url('learnings/'.$learning->id) }}" class="btn btn-lg btn-rounded btn-info"> Start Learning</a>
                            @endif
                            @if($role == 'organization' || $role == 'admin')
                                    <a href="{{ url('learnings/'. $learning->id) }}" class="btn btn-lg btn-rounded btn-info"> View</a>
                                    <a href="{{ url('learnings/'. $learning->id .'/edit') }}" class="btn btn-lg btn-rounded btn-info" style="margin-left: 25px;"> Edit</a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection