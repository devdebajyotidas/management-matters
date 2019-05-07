<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from wrappixel.com/demos/admin-emails/pixeladmin/inverse/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 23 Sep 2017 07:57:18 GMT -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png"
          href="{{asset('assets/img/favicon.png')}}">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://wrappixel.com/demos/admin-templates/pixeladmin/plugins/bower_components/jquery/dist/jquery.min.js"></script>

    <title>{{ config('app.name', 'Laravel') }}</title>
    @include('includes.css')
</head>
<body>
<div class="preloader"></div>

@php
    $assessmentStatetments = isset($learning) ? $learning->statements : [];
@endphp
<div id="wrapper">
    <div class="container-fluid">
        @if(isset($error) && $error)
            <div class="row">
                <div class="col-md-12 text-center" style="height: 100vh; justify-content: center; align-items: center; display: flex;">
                    <div>
                        <span class="text-danger"><i class="fa fa-exclamation-circle fa-5x"></i></span>
                        <h3>{{$error}}</h3>
                    </div>
                </div>
            </div>
        @else
            <div class="row" id="assessment-get-started">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <div class="white-box m-t-15">
                            <div>
                                <h3>Hi, you're assessing {{isset($learning->assessor->account->name) ? $learning->assessor->account->name : 'User'}}</h3>
                                <label style="display: block; margin: 10px 0 30px 0; font-weight: normal">Please provide the informations below to get started</label>
                            </div>
                        <form id="shareForm" method="post" enctype="multipart/form-data" onsubmit="return false;">
                            <div class="form-group">
                                <label>Email</label>
                                <input class="form-control" name="email" type="email" required>
                            </div>
                            <div class="form-group">
                                <label>Name</label>
                                <input class="form-control" name="name" type="text" required>
                            </div>
                            <button type="submit" class="btn btn-success check-invitation">Continue</button>
                        </form>
                    </div>
                </div>
                <div class="col-md-3"></div>
            </div>

            <div id="assessment-details" class="assessment-details" style="display: none">
                <div class="row">
                    <div class="white-box col-md-12 m-t-15">
                        <h3>You're assessing <b>{{isset($learning->assessor->account->name) ? $learning->assessor->account->name : 'No Name'}}</b></h3>
                    </div>
                </div>

                <div class="row">
                    <form id="assessmentForm" action="{{ url('assessments/new') }}" method="post" onsubmit="return false;" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div id="assessment-wrapper"></div>
                        <div class="col-md-12 m-t-5 m-b-5 text-center">
                            <button type="submit" id="assessmentSubmit" class="btn btn-success" style="width: 250px">Submit</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="row" id="assessment-result" style="display: none">
                <div class="col-md-12 text-center" style="height: 100vh; justify-content: center; align-items: center; display: flex;">
                    <div>
                        <div class="assessment-success" style="display: none">
                            <span class="text-success m-b-5"><i class="fa fa-check-circle fa-5x"></i></span>
                            <h3 >Thanks for the participation. Your assessment has been saved.</h3>
                        </div>
                        <div class="assessment-error" style="display: none;">
                            <span class="text-danger m-b-5"><i class="fa fa-times-circle fa-5x"></i></span>
                            <h3 class="error-message" >Sorry, unable to submit your assessment.</h3>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
@include('includes.js')
<script>
    let assessor = "{{isset($learning->assessor) ? $learning->assessor->id : ''}}";
    let assessment_id = "{{isset($learning) ? $learning->id : ''}}";

    $(function () {
        $('.check-invitation').on('click', function(){
            NProgress.start();
            let url = "{{url('api/v1/assessments/shares/check')}}?ref={{Request::get('ref')}}&assessor="+assessor;
            let data = $('#shareForm').serializeArray();
            $.post(url, data, function(response){
                console.log(response);
                let html='';
                if(response['success']){
                    if(response['data']){
                        let statements = response['data']['statements'];
                        if(statements.length > 0){
                            $.each(statements, function(i, assessment){
                                 console.log(i, assessment);
                                 html += getAssessments(i, assessment['assessee_statement'], assessment['module']);
                            })
                        }
                    }

                    $("#assessment-get-started").stop(0).fadeOut('fast');
                    $(".assessment-details").stop(0).fadeIn('fast');
                    $('#assessment-wrapper').empty().append(html);
                }
                else{
                    $('#assessment-get-started').stop(0).fadeOut('fast', function(){
                        $('#assessment-result').stop(0).fadeIn('fast')
                        $('.assessment-error').stop(0).fadeIn('fast');
                        $('.error-message').html(response['message'])
                    })
                }
                NProgress.done();
            }).error(function(xhr){
                NProgress.done();
            })
        })

        $('#assessmentSubmit').on('click', function(){
            NProgress.start();
            let name = $('input[name="name"]').val();
            let email = $('input[name="email"]').val();
            let url = '{{url('api/v1/assessments/shares/submit?name=')}}'+name+"&email="+email+"&assessment="+assessment_id;
            let formdata = $('#assessmentForm').serializeArray();
            let isAllCheckd = checkAllRadioCheckd();
            if(isAllCheckd){
                $.post(url, formdata, function(response){
                    if(response['success']){
                        $('#assessment-details').stop(0).fadeOut('fast', function(){
                            $('#assessment-result').stop(0).fadeIn('fast')
                            $('.assessment-success').stop(0).fadeIn('fast');
                        })
                    }
                    else{
                        $('#assessment-get-started').stop(0).fadeOut('fast', function(){
                            $('#assessment-result').stop(0).fadeIn('fast')
                            $('.assessment-error').stop(0).fadeIn('fast');
                            $('.error-message').html(response['message'])
                        })
                    }
                    NProgress.done();
                }).error(function(xhr){
                    NProgress.done();
                    console.log(xhr);
                })
            }

        })
    })

    function getAssessments(key, statement, moudle){
        let html = '<div class="col-md-12 white-box m-t-5">\n' +
            '                                <h4 style="margin-bottom: 20px">\n' +statement+
            '                                </h4>\n' +
            '                                <div class="assessment-wrapper">\n' +
            '                                    <div class="radio radio-custom">\n' +
            '                                        <input type="radio" id="rad1'+key+'" name="assessments['+moudle+']['+key+']" value="1" required>\n' +
            '                                        <label for="rad1'+key+'"> Strongly Disagree </label>\n' +
            '                                    </div>\n' +
            '                                    <div class="radio radio-custom">\n' +
            '                                        <input type="radio" id="rad2'+key+'" name="assessments['+moudle+']['+key+']" value="2" required>\n' +
            '                                        <label for="rad2'+key+'"> Disagree </label>\n' +
            '                                    </div>\n' +
            '                                    <div class="radio radio-custom">\n' +
            '                                        <input type="radio" id="rad3'+key+'" name="assessments['+moudle+']['+key+']" value="3" required>\n' +
            '                                        <label for="rad3'+key+'"> Neutral </label>\n' +
            '                                    </div>\n' +
            '                                    <div class="radio radio-custom">\n' +
            '                                        <input type="radio" id="rad4'+key+'" name="assessments['+moudle+']['+key+']" value="4" required>\n' +
            '                                        <label for="rad4'+key+'"> Agree </label>\n' +
            '                                    </div>\n' +
            '                                    <div class="radio radio-custom">\n' +
            '                                        <input type="radio" id="rad5'+key+'" name="assessments['+moudle+']['+key+']" value="5" required>\n' +
            '                                        <label for="rad5'+key+'"> Strongly Agree </label>\n' +
            '                                    </div>\n' +
            '                                </div>\n' +
            '                            </div>'

        return html;
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
</body>
</html>