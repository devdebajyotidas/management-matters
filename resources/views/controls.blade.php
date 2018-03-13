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

                    <button class="btn btn-info waves-effect m-l-10 reset-assessment" style="position: relative;float: right;">Reset Assessment</button>
                    <button class="btn btn-info waves-effect m-l-10 reset-conmb"  style="position: relative;float:right;">Reset CONMB</button>
                    <div class="hidden">
                        <form id="assessmentForm" action="{{url('/organizations/resetassessmentall')}}" method="post">
                            {{ csrf_field() }}
                            <input type="submit" value="submit" id="assessment-submit">
                        </form>
                        <form id="conmbForm" action="{{url('/organizations/resetconmball')}}" method="post">
                            {{ csrf_field() }}
                            <input type="submit" value="submit" id="conmb-submit">
                        </form>
                    </div>

                </div>

            </div>

        </div>
        <div class="white-box m-t-15">


            <div class="row m-t-10">
                <form action="{{url('/quotes')}}" method="post">
                    {{ csrf_field() }}
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="quote">New Quote:</label>
                            <input type="text" class="form-control" name="name" id="quote">
                        </div>
                    </div>
                    <div class="col-sm-12 m-b-20">
                        <button type="submit" class="btn btn-primary pull-right">Add Quote</button>
                        <button type="button" class="btn btn-success pull-right m-r-20 new-broadcast">New Broadcast</button>
                    </div>
                </form>
                <div class="col-sm-12  m-b-20">
                    <h3 class="box-title m-b-0">Quotes</h3>
                </div>
                <div class="col-sm-12">
                    <ul class="list-group">
                        @foreach($quotes as $key=>$quote)
                            <li class="list-group-item row">
                                <span class="col-sm-10">{{$quote->name}}</span>
                                <div class="col-sm-2 text-right">
                                    @if($quote->is_active==1)
                                        <span class="badge bg-success m-r-10">Active</span>
                                    @endif
                                    <span class="badge remove-quote-btn" style="cursor: pointer" data-id="{{$quote->id}}"><i class="fa fa-close"></i></span>
                                </div>

                                <div class="hidden">
                                    <form action="{{url('quotes/'.$quote->id.'/delete')}}" method="post">
                                        {{ csrf_field() }}
                                        <input type="submit" class="remove-quote-{{$quote->id}}" value="submit">
                                    </form>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="hidden">
                    <form action="{{url('quotes/broadcast')}}" method="post">
                        {{ csrf_field() }}
                        <input type="submit" class="broadcast-submit" value="submit">
                    </form>
                </div>
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


            $('.new-broadcast').click(function(){
                $('.broadcast-submit').trigger('click');
            });

            $('.reset-assessment').click(function() {
                var $this=$(this);
                swal({
                    title: 'Reset assessment for all?',
                    text: "You can't revert this later.",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, reset'
                }).then(function(result){
                    if(result.value){
                        $('#assessment-submit').trigger('click');
                        return false;
                    }

                })
            });

            $('.reset-conmb').click(function() {
                swal({
                    title: 'Reset Cost of not for all?',
                    text: "You can't revert this later.",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, reset'
                }).then(function(result){
                    if(result.value){
                        $('#conmb-submit').trigger('click');
                        return false;
                    }

                })
            });

            $('.remove-quote-btn').click(function() {
                var id=$(this).data('id');
                swal({
                    title: 'Remove this quote?',
                    text: "You can't revert this later.",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, remove'
                }).then(function(result){
                    if(result.value){
                        $('.remove-quote-'+id).trigger('click');
                        return false;
                    }

                })
            });
        }
    </script>
@endsection