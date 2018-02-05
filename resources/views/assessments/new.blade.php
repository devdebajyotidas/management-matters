@extends('layouts.app')
@section('content')
    @include('includes.main-menu')
    <style>
        .checkbox, .radio {
            display: inline-block;
        }

        .btn-primary {
            float: right;
        }

        hr {
            background-color: #fff;
        }
        .assessment-icon{
            display: inline-block;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background-color:#4f5467;
            vertical-align: middle;
            padding: 2px;
            margin-right: 5px;
            margin-left: 0;
        }
        h4{
            display: inline-block;
            vertical-align: middle;
        }
    </style>
    <div class="container-fluid">
        <div class="white-box m-t-15">

            <div class="row">
                <form action="{{ url('assessments/new') }}" method="post">
                    {{ csrf_field() }}
                    <div class="col-md-12">

                        @foreach($learnings as $num=>$learning)
                            {{ ( ($assessments = $learning->assessments) && shuffle($assessments))   ? '' : '' }}

                            @foreach($assessments as $key => $assessment)
                                @if($key == 3) @break @endif
                            <div class="assessment-wrapper">
                                {{--<img src="{{asset('assets/icons/'.strtolower($learning->title).'.png')}}"  class="assessment-icon">--}}
                                <h4>
                                    {{ $assessment }}
                                </h4>
                                <br>
                                <div class="radio radio-custom">
                                    <input type="radio" id="rad1{{$num.$key}}" name="assessments[{{ $learning->title }}][{{  $key }}]" value="1" required>
                                    <label for="rad1{{$num.$key}}"> Strongly Disagree </label>
                                </div>
                                <div class="radio radio-custom">
                                    <input type="radio" id="rad2{{$num.$key}}" name="assessments[{{ $learning->title }}][{{  $key }}]" value="2" required>
                                    <label for="rad2{{$num.$key}}"> Disagree </label>
                                </div>
                                <div class="radio radio-custom">
                                    <input type="radio" id="rad3{{$num.$key}}" name="assessments[{{ $learning->title }}][{{  $key }}]" value="3" required>
                                    <label for="rad3{{$num.$key}}"> Neutral </label>
                                </div>
                                <div class="radio radio-custom">
                                    <input type="radio" id="rad4{{$num.$key}}" name="assessments[{{ $learning->title }}][{{  $key }}]" value="4" required>
                                    <label for="rad4{{$num.$key}}"> Agree </label>
                                </div>
                                <div class="radio radio-custom">
                                    <input type="radio" id="rad5{{$num.$key}}" name="assessments[{{ $learning->title }}][{{  $key }}]" value="5" required>
                                    <label for="rad5{{$num.$key}}"> Strongly Agree </label>
                                </div>
                                <hr>
                            </div>
                                @endforeach
                        @endforeach
                    </div>
                    <div class="col-lg-2 col-sm-4 col-xs-12 pull-right">
                        <button type="submit" class="btn btn-block btn-outline btn-primary">Results</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        window.onload = function () {

            $.fn.shuffle = function() {

                var allElems = this.get(),
                    getRandom = function(max) {
                        return Math.floor(Math.random() * max);
                    },
                    shuffled = $.map(allElems, function(){
                        var random = getRandom(allElems.length),
                            randEl = $(allElems[random]).clone(true)[0];
                        allElems.splice(random, 1);
                        return randEl;
                    });

                this.each(function(i){
                    var el = $(shuffled[i]);
                    var text = el.find('h4').text();
                    el.find('h4').text( (i+1) + '. ' + text);
                    $(this).replaceWith(el);
                });

                return $(shuffled);

            };

            $('.assessment-wrapper').shuffle();

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