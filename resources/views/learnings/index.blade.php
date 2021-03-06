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
            height: 300px;
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

        .learning-overlay .btn {
            display: inline-block;
            margin: 0 5px ;
        }

        .learning-overlay{
            padding: 0;
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            width: 100%;
            height: 100%;
            transition: all .5s;
            background-color: rgba(0, 0, 0, 0.60);
            justify-content: center;
            align-items: center;
            display: flex;
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
            max-height: 80px;
            overflow: hidden;
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
                        <div class="panel-body text-left">
                            <p>
                                A new and innovative approach to learn and apply new skills to Coaching, Collaboration, Communication, Discipline, Engaging Today’s Workforce, Innovation and Creativity, Integrating Change, Meetings, Motivation, Performance Improvement, Problem Solving, Remote Supervising, Time Management, and Trust Building. Study and learn how to better manage yourself and the people within your organization. Learn, take quiz for knowledge attainment, and manager better through the Ticket Board!
                            </p>
                        </div>
                        @if(session('role') == 'admin')
                            <div class="panel-footer text-center">
                                <a href="{{ 'learnings/create' }}" class="btn btn-primary">Add Learning Module</a>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
        <div class="row m-t-0">
            {{--@foreach($learningBundle as $learnings)--}}
            @foreach($learnings as $learning)
                <div class="col-md-6 col-lg-6 col-xs-6 col-sm-6">
                    <div class="learning" style="{{!empty($learning->image) ? "background-image: url('". asset('uploads/'.$learning->image) . "')" : "" }}">
                    <div  style="box-shadow: 0 1px 3px rgba(0,0,0,0.14);background-color: rgba(0, 0, 0, 0.60); padding: 20px; min-height: 300px;">
                        <?php
                        $replace=str_replace("'",'',$learning->title);
                        $img=strtolower(str_replace(' ','-',$replace));
                        ?>
                        <img src="{{asset('assets/icons/'.$img.'.png')}}"  class="assessment-icon" style="display: inline;width: 50px;">
                            <h2 class="learning-title">
                                {{ $learning->title }}
                            </h2>
                            <div class="learning-highlights">
                                @if(isset($learning->highlights))
                                <?php $len=!empty($learning->highlights) ? count($learning->highlights) : 0 ?>
                                    @if($len > 3)
                                        @for($i=0;$i<3;$i++)
                                            <span class="highlight">{{ $learning->highlights[$i] }}</span>
                                        @endfor
                                        <span class="highlight">+{{$len - 3}} More</span>
                                    @else
                                        @foreach($learning->highlights as $highlight)
                                        <span class="highlight">{{ $highlight }}</span>
                                        @endforeach
                                    @endif
                                @endif
                            </div>
                            <div class="learning-details">
                                <span class="chapter-count">{{ !empty($learning->chapters) ? count($learning->chapters) : 0 }} Chapters</span>
                                <span class="quiz-count">{{ !empty($learning->quiz) ? count($learning->quiz) : 0 }} Quiz</span>
                                <span class="assessment-count">{{ !empty($learning->assessments) ? count($learning->assessments) : 0 }} Assessments</span>
                            </div>
                        {{--</div>--}}
                        {{--<div class="start-learning">--}}
                        <div class="learning-overlay">
                            @if(session('role') == 'learner')
                                <a href="{{ url('learnings/'.$learning->id) }}" class="btn btn-lg btn-rounded btn-info"> Start Learning</a>
                            @endif
                            @if(session('role') == 'organization' || session('role') == 'admin')
                                    <a href="{{ url('learnings/'. $learning->id) }}" class="btn btn-lg btn-rounded btn-info"> View</a>
                                    <a href="{{ url('learnings/'. $learning->id .'/edit') }}" class="btn btn-lg btn-rounded btn-info" > Edit</a>
                                    @if(session('role')=='admin')
                                        <a href="javascript:void(0)" class="btn btn-lg btn-rounded btn-info delete-learning" data-id="{{$learning->id}}"> Delete</a>
                                        <div class="hidden">
                                            <form id="learningDeleteForm" action="{{url('/learnings/'.$learning->id.'/delete')}}" method="post">
                                                {{ csrf_field() }}
                                                <input type="submit" id="submit-delete" value="submit">
                                            </form>
                                        </div>
                                    @endif
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

            $('.delete-learning').click(function() {
                var id=$(this).data('id');
                swal({
                    title: 'Are you sure?',
                    text: "You can't revert this later.",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete'
                }).then(function(result){
                    if(result.value){
                        var url="{{url('/learnings/')}}"+"/"+id+'/delete';
                        $('#learningDeleteForm').attr('action',url);
                        $('#submit-delete').trigger('click');
                        return false;
                    }

                })
            });
        }
    </script>
@endsection