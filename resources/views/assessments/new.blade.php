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
    </style>
    <div class="container-fluid">
        <div class="white-box">

            <div class="row m-t-20">
                <form action="{{ url('assessments/new') }}" method="post">
                    {{ csrf_field() }}
                    <div class="col-md-12">
                        @foreach($learnings as $learning)
                            {{ ( ($assessments = $learning->assessments) && shuffle($assessments))   ? '' : '' }}
                            @foreach($assessments as $key => $assessment)
                                @if($key == 3) @break @endif
                            <h4>{{ $assessment }}</h4>
                            <div class="radio radio-custom">
                                <input type="radio" name="assessments[{{ $learning->title }}][{{  $key }}]" value="1" required>
                                <label for=""> Strongly Disagree </label>
                            </div>
                            <div class="radio radio-custom">
                                <input type="radio" name="assessments[{{ $learning->title }}][{{  $key }}]" value="2" required>
                                <label for=""> Disagree </label>
                            </div>
                            <div class="radio radio-custom">
                                <input type="radio" name="assessments[{{ $learning->title }}][{{  $key }}]" value="3" required>
                                <label for=""> Neutral </label>
                            </div>
                            <div class="radio radio-custom">
                                <input type="radio" name="assessments[{{ $learning->title }}][{{  $key }}]" value="4" required>
                                <label for=""> Agree </label>
                            </div>
                            <div class="radio radio-custom">
                                <input type="radio" name="assessments[{{ $learning->title }}][{{  $key }}]" value="5" required>
                                <label for=""> Strongly Agree </label>
                            </div>
                            <hr>
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