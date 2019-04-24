
@extends('layouts.app')
@section('content')
    <script src="https://cdn.jsdelivr.net/npm/jquery.tagify@0.1.0/jquery.tagify.js" type="text/javascript"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jquery.tagify@0.1.0/jquery.tagify.css" type="text/css"/>
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
        .firework{
            position: fixed;
            top:0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 999999;
            background-color: transparent;
            display: none;
        }
        .tagify-tag{
            display: block !important;
        }
    </style>
    <div id="canvas" style="position: absolute;top:0;bottom: 0;z-index:99999;"></div>

    <div class="container-fluid">

        <div class="white-box m-t-15">
            <div class="row">
                <div class="col-md-12">
                    <h3>New Assessment</h3>
                </div>
            </div>
        </div>
        <div class="white-box m-t-15">
            @php $num = 1; $assessments = isset($assessmentSet) ? $assessmentSet->statements : []; @endphp
            <div class="row">
                <form id="assessmentForm"  action="{{ url('assessments/new') }}" method="post" onsubmit="return false">
                    {{ csrf_field() }}
                    <div class="col-md-12">
                        @foreach($assessments as $key => $assessment)
                            <h4>
                                {{ $assessment->assessor_statement }}
                            </h4>
                            <div class="assessment-wrapper">
                                {{--<img src="{{asset('assets/icons/'.strtolower($learning->title).'.png')}}"  class="assessment-icon">--}}

                                <br>
                                <div class="radio radio-custom">
                                    <input type="radio" id="rad1{{$key}}" name="assessments[{{ $assessment->module }}][{{  $key }}]" value="1" required>
                                    <label for="rad1{{$key}}"> Strongly Disagree </label>
                                </div>
                                <div class="radio radio-custom">
                                    <input type="radio" id="rad2{{$key}}" name="assessments[{{ $assessment->module }}][{{  $key }}]" value="2" required>
                                    <label for="rad2{{$key}}"> Disagree </label>
                                </div>
                                <div class="radio radio-custom">
                                    <input type="radio" id="rad3{{$key}}" name="assessments[{{ $assessment->module }}][{{  $key }}]" value="3" required>
                                    <label for="rad3{{$key}}"> Neutral </label>
                                </div>
                                <div class="radio radio-custom">
                                    <input type="radio" id="rad4{{$key}}" name="assessments[{{ $assessment->module }}][{{  $key }}]" value="4" required>
                                    <label for="rad4{{$key}}"> Agree </label>
                                </div>
                                <div class="radio radio-custom">
                                    <input type="radio" id="rad5{{$key}}" name="assessments[{{ $assessment->module }}][{{  $key }}]" value="5" required>
                                    <label for="rad5{{$key}}"> Strongly Agree </label>
                                </div>
                                <hr>
                            </div>
                        @endforeach
                    </div>
                    <div class="col-lg-2 col-sm-4 col-xs-12 pull-right text-center">
                        <input type="hidden" name="name" value="{{$assessmentSet->assessor->account->name}}">
                        <input type="hidden" name="email" value="{{$assessmentSet->assessor->email}}">
                        <button id="assessmentSubmit" type="submit" class="btn btn-block btn-outline btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Share Modal --}}

        <div id="share-assessment" class="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title" id="myModalLabel">Share assessment</h4>
                    </div>
                    <div class="modal-body">
                        <div class="alert text-center">
                            <i class="text-success fa fa-check-circle fa-5x"></i> <br>
                            <h3>Your assessment has been submitted</h3>
                        </div>
                        <div class="form-group text-center">
                            <label style="display: block">Enter emaill address to share the link (Press Enter to add)</label>
                            <textarea placeholder="Email" id="emailsInput" classs="form-control"></textarea><br>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="{{url('assessments')}}" class="btn btn-default waves-effect">See Results</a>
                        <button type="button" id="share-links" class="btn btn-info waves-effect">Share Links</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    </div>

    <script>
        let assessmentId = "{{$assessmentSet->id}}"
        $(function(){
            $('#assessmentSubmit').on('click', function(){
                NProgress.start();
                let name = $('input[name="name"]').val();
                let email = $('input[name="email"]').val();
                let url = '{{url('api/v1/assessments/shares/submit?name=')}}'+name+"&email="+email+"&assessment="+assessmentId+'&self=1';
                let formdata = $('#assessmentForm').serializeArray();
                let isAllCheckd = checkAllRadioCheckd();
                if(isAllCheckd){
                    $.post(url, formdata, function(response){
                        if(response['success']){
                            $('#assessmentForm')[0].reset();
                            $('#share-assessment').modal({
                                backdrop: 'static',
                                keyboard: false
                            });
                        }
                        NProgress.done();
                    }).error(function(xhr){
                        toastr.error('Something went wrong, Please try again later');
                        NProgress.done();
                    })
                }
                else{
                    toastr.info('All statements must be checked');
                    NProgress.done();
                }
            })

            $('#emailsInput').tagify({'templates': 'tag'})
                .on('add', function(e, tagName){
                    console.log('added', tagName)
                });

            $('#share-links').on('click', function(){
                NProgress.start();
                let emails = $('#emailsInput').val();
                let url = "{{url('api/v1/assessments/shares/email')}}";

                $.post(url, {emails: emails, assessmentId : assessmentId}, function(response){
                    if(response['success']){
                        $('#share-assessment').modal('hide');
                        toastr.success(response['message']);
                        NProgress.done();
                        setTimeout(function(){
                            window.location.href= "{{url('assessments')}}";
                        }, 500)
                    }
                    else{
                        NProgress.done();
                        toastr.error(response['message']);
                    }

                }).error(function(xhr){
                    toastr.error('Unable to send the emails. Please check if email addresses are correct.');
                    NProgress.done();
                })
            })


        })
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

            // $('.assessment-wrapper').shuffle();

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

        function checkAllRadioCheckd(){
            let names = [];
            $('input[type=radio]').each(function() {
                let name = $(this).attr('name');
                if($.inArray(name, names) == -1){
                    names.push(name);
                }
            });

            let checked = 0

            $.each(names, function(i, name){
                if($('input[name="'+name+'"]').is(':checked')){
                    checked += 1;
                }
            })


            if(checked == names.length){
                return true;
            }

            return false;
        }
    </script>
@endsection