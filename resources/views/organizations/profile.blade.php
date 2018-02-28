@extends('layouts.app')
@section('content')
    @include('includes.main-menu')

    <div class="container-fluid">
        <!-- row -->
        <div class="row m-t-15">
            <div class="col-md-4 col-xs-12">
                <div class="white-box">
                    <div class="row">
                        <div class="col-md-12">
                            <h3>Profile</h3>
                        </div>
                    </div>
                </div>
                <div class="white-box">
                    <div class="user-bg">
                        <img width="100%" alt="user"
                             src="{{ ($organization->image)? asset('uploads/'.$organization->image) : 'http://sanarch.in/public/images/defaultAvatar.png' }}">
                    </div>
                    <div class="user-btm-box">
                        <!-- .row -->
                        <div class="row text-center m-t-10">
                            <div class="col-md-6 b-r"><strong>Name</strong>
                                <p>{{ $organization->name }}</p>
                            </div>
                            <div class="col-md-6"><strong>Contact Person</strong>
                                <p>{{ $organization->contact_person }}</p>
                            </div>
                        </div>
                        <!-- /.row -->
                        <hr>
                        <!-- .row -->
                        <div class="row text-center m-t-10">
                            <div class="col-md-6 b-r"><strong>Email ID</strong>
                                <p>{{ $organization->user->email }}</p>
                            </div>
                            <div class="col-md-6"><strong>Phone</strong>
                                <p>{{ $organization->phone }}</p>
                            </div>
                        </div>
                        <!-- /.row -->
                        <hr>
                        <!-- .row -->
                        <!-- /.row -->
                        <div class="col-md-4 col-sm-4 text-center">
                            <p class="text-purple">Departments</p>
                            <h1>{{ $organization->departments()->count() }}</h1>
                        </div>
                        <div class="col-md-4 col-sm-4 text-center">

                            <p class="text-blue">Total Licenses</p>
                            <h1>{{ isset( $organization->subscription)? $organization->subscription->licenses : 0 }}</h1>
                        </div>
                        <div class="col-md-4 col-sm-4 text-center">

                            <p class="text-info">Active Learners</p>
                            <h1>{{ $organization->learners()->count() }}</h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8 col-xs-12">
                <div class="white-box">
                    <!-- .tabs -->
                    <ul class="nav nav-tabs tabs customtab">
                        <li class="active tab">
                            <a href="#settings" data-toggle="tab" aria-expanded="false"> <span class="visible-xs"><i
                                            class="fa fa-cog"></i></span> <span class="hidden-xs">Edit Detail</span>
                            </a>
                        </li>
                    </ul>
                    <!-- /.tabs -->
                    <div class="tab-content">
                        <!-- .tabs 1 -->
                        <div class="tab-pane" id="home">
                            <ul class="timeline">
                                <li>
                                    <div class="timeline-badge ">
                                        <img class="img-responsive" alt="user" src="{{asset('assets/img/title.png')}}">
                                    </div>
                                    <div class="timeline-panel">
                                        <div class="timeline-heading">
                                            <h4 class="timeline-title">Level 1 asdg ashdg af ga fdf yafsjhd</h4>
                                            <p>
                                                <small class="text-muted"><i class="fa fa-clock-o"></i> 15/06/2017
                                                </small>
                                            </p>
                                        </div>
                                        <div class="timeline-body">
                                            <p>You have earned this badge upon fully completing 10 assessments.</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="timeline-inverted">
                                    <div class="timeline-badge ">
                                        <img class="img-responsive" alt="user" src="{{asset('assets/img/medal.png')}}">
                                    </div>
                                    <div class="timeline-panel">
                                        <div class="timeline-heading">
                                            <h4 class="timeline-title">Level 1</h4>
                                            <p>
                                                <small class="text-muted"><i class="fa fa-clock-o"></i> 15/06/2017
                                                </small>
                                            </p>
                                        </div>
                                        <div class="timeline-body">
                                            <p>You have earned this badge upon fully completing 10 assessments.</p>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="timeline-badge ">
                                        <img class="img-responsive" alt="user"
                                             src="{{asset('assets/img/insignia.png')}}">
                                    </div>
                                    <div class="timeline-panel">
                                        <div class="timeline-heading">
                                            <h4 class="timeline-title">Level 1</h4>
                                            <p>
                                                <small class="text-muted"><i class="fa fa-clock-o"></i> 15/06/2017
                                                </small>
                                            </p>
                                        </div>
                                        <div class="timeline-body">
                                            <p>You have earned this badge upon fully completing 10 assessments.</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="timeline-inverted">
                                    <div class="timeline-badge ">
                                        <img class="img-responsive" alt="user"
                                             src="{{asset('assets/img/quality.png')}}">
                                    </div>
                                    <div class="timeline-panel">
                                        <div class="timeline-heading">
                                            <h4 class="timeline-title">Level 1</h4>
                                            <p>
                                                <small class="text-muted"><i class="fa fa-clock-o"></i> 15/06/2017
                                                </small>
                                            </p>
                                        </div>
                                        <div class="timeline-body">
                                            <p>You have earned this badge upon fully completing 10 assessments.</p>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <!-- /.tabs1 -->
                        <!-- .tabs2 -->
                        <div class="tab-pane" id="profile">
                            <div class="row">
                                <div class="col-md-3 col-xs-6 b-r"><strong>Full Name</strong>
                                    <br>
                                    <p class="text-muted">Johnathan Deo</p>
                                </div>
                                <div class="col-md-3 col-xs-6 b-r"><strong>Mobile</strong>
                                    <br>
                                    <p class="text-muted">(123) 456 7890</p>
                                </div>
                                <div class="col-md-3 col-xs-6 b-r"><strong>Email</strong>
                                    <br>
                                    <p class="text-muted">johnathan@admin.com</p>
                                </div>
                                <div class="col-md-3 col-xs-6"><strong>Location</strong>
                                    <br>
                                    <p class="text-muted">London</p>
                                </div>
                            </div>
                            <hr>
                            <p class="m-t-30">Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In
                                enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede
                                mollis pretium. Integer tincidunt.Cras dapibus. Vivamus elementum semper nisi. Aenean
                                vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend
                                ac, enim.</p>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum
                                has been the industry's standard dummy text ever since the 1500s, when an unknown
                                printer took a galley of type and scrambled it to make a type specimen book. It has
                                survived not only five centuries </p>
                            <p>It was popularised in the 1960s with the release of Letraset sheets containing Lorem
                                Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker
                                including versions of Lorem Ipsum.</p>
                            <h4 class="font-bold m-t-30">Skill Set</h4>
                            <hr>
                            <h5>Wordpress <span class="pull-right">80%</span></h5>
                            <div class="progress">
                                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="80"
                                     aria-valuemin="0" aria-valuemax="100" style="width:80%;"><span class="sr-only">50% Complete</span>
                                </div>
                            </div>
                            <h5>HTML 5 <span class="pull-right">90%</span></h5>
                            <div class="progress">
                                <div class="progress-bar progress-bar-custom" role="progressbar" aria-valuenow="90"
                                     aria-valuemin="0" aria-valuemax="100" style="width:90%;"><span class="sr-only">50% Complete</span>
                                </div>
                            </div>
                            <h5>jQuery <span class="pull-right">50%</span></h5>
                            <div class="progress">
                                <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="50"
                                     aria-valuemin="0" aria-valuemax="100" style="width:50%;"><span class="sr-only">50% Complete</span>
                                </div>
                            </div>
                            <h5>Photoshop <span class="pull-right">70%</span></h5>
                            <div class="progress">
                                <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="70"
                                     aria-valuemin="0" aria-valuemax="100" style="width:70%;"><span class="sr-only">50% Complete</span>
                                </div>
                            </div>
                        </div>
                        <!-- /.tabs2 -->
                        <!-- .tabs3 -->
                        <div class="tab-pane active" id="settings">
                            <form class="form-material" method="post" action="" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                {{ method_field('put') }}
                                <div class="modal-body">
                                    <div class="panel-group wiz-aco" id="accordion" role="tablist" aria-multiselectable="true">
                                        <div class="panel panel-default">
                                            <div class="panel-heading" role="tab" id="headingOne">
                                                <h4 class="panel-title">
                                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne" class="current">
                                                        Primary Information
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseOne" class="panel-collapse collapse in active" role="tabpanel" aria-labelledby="headingOne" aria-expanded="true">
                                                <div class="panel-body">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group text-center m-b-20">
                                                                <div class="fileupload">
                                                                    {{--<span><i class="ion-upload m-r-5"></i>Upload Image</span>--}}
                                                                    <img id="preview" src="http://sanarch.in/public/images/defaultAvatar.png" alt="">
                                                                    <input class="upload" type="file" name="organization[image]" onchange="previewImage(this)">
                                                                </div>
                                                            </div>
                                                            <div class="form-group  m-b-20">
                                                                <input type="text" class="form-control" name="organization[name]" placeholder="Organization Name"
                                                                       value="{{ $organization->name }}">
                                                            </div>
                                                            <div class="form-group m-b-20">
                                                                <input type="text" class="form-control" name="organization[contact_person]" placeholder="Contact Person"
                                                                       value="{{ $organization->contact_person }}">
                                                            </div>
                                                            <div class="form-group m-b-20">
                                                                <input type="text" class="form-control" name="organization[phone]" placeholder="Phone"
                                                                       value="{{ $organization->phone }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-default">
                                            <div class="panel-heading" role="tab" id="headingThree">
                                                <h4 class="panel-title">
                                                    <a class="collapsed disabled" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                        Account Details
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree" aria-expanded="false">
                                                <div class="panel-body">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group m-b-20">
                                                                <input type="email" class="form-control" name="user[email]" placeholder="Email"
                                                                       value="{{ $organization->user->email }}">
                                                            </div>
                                                            <div class="form-group m-b-20">
                                                                <input type="password" class="form-control" name="user[password]"
                                                                       placeholder="Password">
                                                            </div>
                                                            <div class="form-group m-b-20">
                                                                <input type="password" class="form-control" name="user[password_confirmation]"
                                                                       placeholder="Confirm Password">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-default">
                                            <div class="panel-heading" role="tab" id="headingFour">
                                                <h4 class="panel-title">
                                                    <a class="collapsed disabled" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                                        Billing Information
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour" aria-expanded="false">
                                                <div class="panel-body">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group m-b-20">
                                                                <input type="text" class="form-control" name="organization[name_on_card]" placeholder="Name on Card" value="{{ $organization->name_on_card }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group m-b-20">
                                                                <input type="number" class="form-control" name="organization[card_number]" placeholder="Credit Card Number" value="{{ $organization->card_number }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group m-b-20">
                                                                <input type="text" class="form-control" name="organization[expiry_date]" placeholder="Expiry Date (YYYY-MM)" value="{{ $organization->expiry_date }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if(session('role')=='organization')
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-info waves-effect">Update Profile</button>
                                    </div>
                                @endif

                            </form>
                            @if(session('role')=='admin')
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-info waves-effect add-license-btn">Add License</button>
                                    <button type="submit" class="btn btn-danger waves-effect reset-assessment-btn">Reset Assessment</button>
                                    <button type="submit" class="btn btn-danger waves-effect reset-conmb-btn">Reset CONMB</button>
                                </div>
                                <div class="hidden">
                                    <form action="{{url('/organizations/'.$organization->id.'/resetassessment')}}" method="post">
                                        {{ csrf_field() }}
                                        <input type="submit" id="reset-assessment-submit" value="submit">
                                    </form>
                                    <form action="{{url('/organizations/'.$organization->id.'/resetconmb')}}" method="post">
                                        {{ csrf_field() }}
                                        <input type="submit" id="reset-conmb-submit" value="submit">
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->

        <div id="add-license" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title" id="myModalLabel">Update License</h4>
                    </div>
                    <form class="form-horizontal" action="{{ url('/organizations/'.$organization->id.'/license') }}" method="post">
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="col-md-12">New License</label>
                                <div class="col-md-12">
                                    <input type="text" class="form-control" name="license" placeholder="New License"
                                           value="{{ old('license') }}">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-info waves-effect">Update</button>
                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    </div>
    <!-- /.container-fluid -->

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


            $('.add-license-btn').click(function(){
                $('#add-license').modal('show');
            });
            $('.reset-assessment-btn').click(function(){
                swal({
                    title: 'Reset assessment to default?',
                    text: "You can't revert this later.",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, Reset'
                }).then(function(result){
                    if(result.value){
                        $('#reset-assessment-submit').trigger('click');
                        return false;
                    }

                })
            });
            $('.reset-conmb-btn').click(function(){
                swal({
                    title: 'Reset conmb to default?',
                    text: "You can't revert this later.",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, Reset'
                }).then(function(result){
                    if(result.value){
                        $('#reset-conmb-submit').trigger('click');
                        return false;
                    }

                })
            });
        }
        function previewImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#preview').attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection