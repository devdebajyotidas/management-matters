@extends('layouts.app')
@section('content')
    @include('includes.main-menu')
    <style>
        .btn-group-vertical .btn{
            width: 300px;
            text-align: left;
            height: auto;
            margin: 10px 0;
            border: none;
        }
        .panel-footer{
            border:none;
        }
        .text-block{
            display: block;
            margin: 5px 0;
        }
        .list-group .label{
            float: right;
        }
        .col-sm-4 .list-group a{
            border-left: none;
            border-right: none;
            padding: 10px 20px;
            border-bottom:none ;
        }
        .col-sm-4 .list-group a:first-child {
            border-top:none;
        }
        .result-dis .list-group{
            text-align: left;
        }
        .result-dis .list-group li{
            border: none;
        }
        .result-dis .list-group li .text-block{
            margin-bottom: 5px;
            display: block;
        }
    </style>
    <div class="container-fluid">
        <form action="" method="post">
            @if(isset($_GET['retake']))
                {{ method_field('put') }}
            @endif
            {{ csrf_field() }}
            <div class="row" style="margin-top: 20px">
                <div class="col-sm-4">
                    <div class="panel panel-default">
                        <div class="panel-heading" style="height: 85px;line-height: 45px">
                            All quizes
                        </div>
                        <div class="panel-body" style="padding: 0">
                            <div class="list-group">
                                @foreach($learnings as $learning)
                                    <a href="{{ url('/learnings/'. $learning->id .'/quiz') }}" class="list-group-item" >
                                        <span class="pull-left">
                                            <span class="text-block text-dark">
                                            Quiz for {{$learning->title}}
                                            </span>
                                            <span class="text-block text-secondary">
                                                {{ count($learning->quiz) }} Questions
                                            </span>
                                        </span>
                                        <span class="pull-right">
                                            @if(isset($learning->quizTaken[0]) )
                                                @if($learning->quizTaken[0]->complete_flag==1)
                                                    <span class="label label-success text-block text-uppercase"> Complete</span>
                                                @else
                                                    <span class="text-block">
                                                    {{ number_format(($learning->quizTaken[0]->result/count($learning->quiz)),2) * 100 }}
                                                        % Scored
                                                </span>
                                                @endif
                                            @else
                                                <span class="label label-warning text-block text-uppercase"> Pending</span>
                                            @endif
                                        </span>
                                        <span class="clearfix"></span>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-sm-8">
                                    <span style="margin-top: 13px;display: block">Quiz for {{$active_learning->title}}</span>
                                    <input type="hidden" id="result-correct" name="result" value="0">
                                    <input type="hidden" id="result-incorrect" value="0">
                                    <input type="hidden" id="total-question" value="{{count($active_learning->quiz)}}">
                                </div>
                                <div class="col-sm-4">
                                    @if(isset($active_learning->quizTaken[0]))
                                        @if(isset($_GET['retake']))
                                            <span class="question-progress-text">1/{{ count($active_learning->quiz) }}</span>
                                            <div class="progress">
                                                <div class="progress-bar question-progress-bar progress-bar-success" role="progressbar" aria-valuenow="70"
                                                     aria-valuemin="0" aria-valuemax="100" style="width:{{abs((1/count($active_learning->quiz))*100)}}%">
                                                    <span class="sr-only">70% Complete</span>
                                                </div>
                                            </div>
                                        @else
                                            <span class="question-progress-text">{{intVal(count($active_learning->quiz))}}/{{intVal(count($active_learning->quiz))}}</span>
                                            <div class="progress">
                                                <div class="progress-bar question-progress-bar progress-bar-success" role="progressbar" aria-valuenow="70"
                                                     aria-valuemin="0" aria-valuemax="100" style="width:100%">
                                                    <span class="sr-only">70% Complete</span>
                                                </div>
                                            </div>
                                        @endif

                                    @else
                                        <span class="question-progress-text">1/{{ count($active_learning->quiz) }}</span>
                                        <div class="progress">
                                            <div class="progress-bar question-progress-bar progress-bar-success" role="progressbar" aria-valuenow="70"
                                                 aria-valuemin="0" aria-valuemax="100" style="width:{{abs((1/count($active_learning->quiz))*100)}}%">
                                                <span class="sr-only">70% Complete</span>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                @if(!isset($active_learning->quizTaken[0]) )
                                    @foreach($active_learning->quiz as $key=>$qdata)
                                        <div class="col-lg-12 question-block" id="goto-{{$key}}" data-toggle="{{$key}}" style="display: none">
                                            <h3>Q: {{$qdata['question']}}</h3>
                                            <div class="row">
                                                @foreach($qdata['content'] as $num => $anstable)
                                                    <div class="radio radio-custom"  style="margin:10px 0">
                                                        <input type="radio" name="qradio{{$key}}" value="{{$anstable['type']}}" data-toggle="collapse" data-target="#enlarge-{{$key.$num}}">
                                                        <label for=""> {{($num+1).". ".$anstable['answer']}} </label>
                                                    </div>
                                                @endforeach
                                            </div>
                                            @foreach($qdata['content'] as $num => $anstable)
                                                <div id="enlarge-{{$key.$num}}" class="panel-collapse collapse" style="margin-top: 20px">
                                                    {{"Note ".($num+1).": ".$anstable['note']}}
                                                </div>
                                            @endforeach
                                        </div>
                                    @endforeach
                                @else
                                    @if(isset($_GET['retake']))
                                        @foreach($active_learning->quiz as $key=>$qdata)
                                            <div class="col-lg-12 question-block" id="goto-{{$key}}" data-toggle="{{$key}}" style="display: none">
                                                <h3>Q: {{$qdata['question']}}</h3>
                                                <div class="btn-group-vertical">
                                                    @foreach($qdata['content'] as $num => $anstable)
                                                        <div class="radio radio-custom"  style="margin:10px 0">
                                                            <input type="radio" name="qradio{{$key}}" value="{{$anstable['type']}}" data-toggle="collapse" data-target="#enlarge-{{$key.$num}}">
                                                            <label for=""> {{($num+1).". ".$anstable['answer']}} </label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                @foreach($qdata['content'] as $num => $anstable)
                                                    <div id="enlarge-{{$key.$num}}" class="panel-collapse collapse" style="margin-top: 20px">
                                                        {{$anstable['note']}}
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="col-lg-12" style="text-align: center;">
                                            <div class="col-sm-3"></div>
                                            <div class="col-sm-6 result-dis" style="padding: 0">
                                                <h1>SCORE: {{number_format((($active_learning->quizTaken[0]->result)/intVal(count($active_learning->quiz))),2)*100}}%</h1>
                                                <ul class="list-group" style="text-align: left">
                                                    <li class="list-group-item">
                                                        <span class="text-block">Correct: {{ $active_learning->quizTaken[0]->result}}</span>
                                                        <div class="progress">
                                                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="70"
                                                                 aria-valuemin="0" aria-valuemax="100" style="width:{{abs((($active_learning->quizTaken[0]->result)/intVal(count($active_learning->quiz)))*100)}}%">
                                                                <span class="sr-only">70% Complete</span>
                                                            </div>
                                                        </div>
                                                    </li>


                                                    <li class="list-group-item">
                                                        <span class="text-block">Incorrect: {{ count($active_learning->quiz) - $active_learning->quizTaken[0]->result}}</span>
                                                        <div class="progress">
                                                            <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="70"
                                                                 aria-valuemin="0" aria-valuemax="100" style="width:{{abs(((count($active_learning->quiz) - $active_learning->quizTaken[0]->result)/count($active_learning->quiz))*100)}}%">
                                                                <span class="sr-only">70% Complete</span>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-sm-3"></div>
                                        </div>
                                    @endif

                                @endif
                            </div>

                        </div>
                        <div class="panel-footer" style="text-align: right">
                            <input type="submit" id="submit-result" name="submit" class="hidden btn btn-primary" value="Submit">
                            @if(!isset($active_learning->quizTaken[0]))
                                <button type="button" class="btn btn-primary btn-next disabled">Next</button>
                            @else
                                @if(isset($_GET['retake']))
                                    <button type="button" class="btn btn-primary btn-next disabled">Next</button>
                                @else
                                    <a href="?retake=true" type="button" class="btn btn-primary" >Retake</a>
                                @endif

                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="hidden">
                <input type="hidden" name="title" value="{{$active_learning->title}}">
            </div>
        </form>

    </div>
    <script>
        window.onload=function(){
            $('.question-block:eq(0)').stop(0).fadeIn('fast').addClass('active-question');
            $("input[type='radio']").each(function(){
                $(this).change(function(){
                    var $btnnext=$('.btn-next');
                    var $resultCorrect=$('#result-correct');
                    var $resultIncorrect=$('#result-incorrect');
                    if(!$(this).hasClass('disabled')){
                        $btnnext.removeClass('disabled');
                        $btnnext.addClass('active');
                        $(this).parent().siblings().addClass('disabled');
                        $(this).parent().siblings().find("input[type='radio']").attr('disabled',true);
                        if($(this).val()==='true'){
                            $(this).siblings().addClass('text-success');
                            var correct=$resultCorrect.val();
                            $resultCorrect.val(parseInt(correct)+1)
                        }
                        else{
                            $(this).siblings().addClass('text-danger');
                            var incorrect=$resultIncorrect.val();
                            $resultIncorrect.val(parseInt(incorrect)+1)
                        }
                    }
                })
            });
            $('.btn-next').click(function(){

                var total=$('#total-question').val();
                if(!$(this).hasClass('disabled')){
                    var currentq=$('.active-question').data('toggle');
                    var next=parseInt(currentq)+1;
                    var progress=parseInt(next)+1;
                    console.log(next+'/'+progress);
                    if(total >= next){
                        $(this).addClass('disabled');
                        $('#goto-'+currentq).removeClass('active-question').stop(0).fadeOut('fast',function(){
                            $('#goto-'+next).stop(0).fadeIn().addClass('active-question');
                        });
                        $('.question-progress-text').html(progress+'/'+total);
                        $('.question-progress-bar').css("width",parseInt((progress/total)*100)+"%");
                        if( parseInt(total) - parseInt(progress) == 0){
                            $("#submit-result").removeClass('hidden');
                            $(this).hide();
                        }
                    }

                }

            })


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
        }
    </script>
@endsection