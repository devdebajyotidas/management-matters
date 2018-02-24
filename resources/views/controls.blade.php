@extends('layouts.app')
@section('content')
    @include('includes.main-menu')
    <div class="container-fluid">
        <div class="white-box m-t-15">
            <div class="row m-t-10">
                <div class="col-sm-6 m-b-10">
                    <h3 class="box-title m-b-0">Actions</h3>
                </div>
                <div class="col-sm-6 m-b-10">
                    <form action="{{url('/organizations/resetassessmentall')}}" method="post">
                        {{ csrf_field() }}
                        <button class="btn btn-info waves-effect m-l-10" style="position: relative;float: right;">Reset Assessment</button>
                    </form>
                    <form action="{{url('/organizations/resetconmball')}}" method="post">
                        {{ csrf_field() }}
                        <button class="btn btn-info waves-effect m-l-10"  style="position: relative;float:right;">Reset CONMB</button>
                    </form>
                </div>

            </div>

        </div>
        <div class="white-box m-t-15">
            <form action="{{url('/quotes')}}" method="post">
                {{ csrf_field() }}
                <div class="row m-t-10">
                    <div class="col-sm-12  m-b-20">
                        <h3 class="box-title m-b-0">Quotes</h3>
                    </div>
                    <?php $days = [
                        'Sunday',
                        'Monday',
                        'Tuesday',
                        'Wednesday',
                        'Thursday',
                        'Friday',
                        'Saturday',
                    ]; ?>
                    @if(!empty($quotes) && count($quotes) > 0)
                        @foreach($quotes as $key=>$quote)
                            <div class="form-group">
                                <label for="usr-{{$key}}">{{$key}}:</label>
                                <input type="text" name="quotes[{{$key}}]" class="form-control" value="{{$quote}}" id="usr-{{$key}}">
                            </div>
                        @endforeach
                        @else
                        @foreach($days as $day)
                            <div class="form-group">
                                <label for="usr-{{$day}}">{{$day}}:</label>
                                <input type="text" name="quotes[{{$day}}]" class="form-control" id="usr-{{$day}}">
                            </div>
                        @endforeach
                    @endif


                </div>
                <div class="row m-t-10">
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-primary pull-right">Save</button>
                    </div>
                </div>
            </form>
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