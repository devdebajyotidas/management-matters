@extends('layouts.app')
@section('content')
    @include('includes.main-menu')

    <div class="container-fluid">
        <!-- row -->
        <div class="row m-t-15">
            <div class="col-md-12">
                <div class="white-box p-0">
                    <!-- .left-right-aside-column-->
                    <div class="page-aside">
                        <!-- .left-aside-column-->
                        <!-- /.left-aside-column-->
                        <div class="right-aside" style="margin: 0">
                            <div class="clearfix"></div>
                            <div class="scrollable">
                                <div class="table-responsive">
                                    <table id="organization-table" class="table m-t-30 table-hover contact-list"
                                           data-page-size="10" data-filter="#search-learner">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Learners</th>
                                            <th>Joining date</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                                @foreach($organizations as $learner)
                                                    <tr class="{{ $learner->trashed()? 'bg-warning':'' }}">
                                                        <td>{{ $learner->id }}</td>
                                                        <td>
                                                         {{$learner->name}}
                                                        </td>
                                                        <td>{{ $learner->user->email }}</td>
                                                        <td>{{ $learner->phone }}</td>
                                                        <td>
                                                            <a href="{{  url('/organizations'.'/'. $learner->id . '/learners') }}">
                                                                <span class="label label-info">
                                                                    {{ $learner->learners()->count() }}
                                                                </span>
                                                            </a>
                                                        </td>
                                                        <td>{{ $learner->created_at->format('m/d/Y') }}</td>
                                                        <td>
                                                            <a href="{{ '/organizations/'. $learner->id}}"
                                                               class="btn btn-sm btn-icon btn-pure btn-outline"
                                                               data-toggle="tooltip" data-original-title="View">
                                                                <i class="ti-eye" aria-hidden="true"></i>
                                                            </a>
                                                            @if($learner->trashed())
                                                                <form action="{{  url('organizations').'/'.$learner->id.'/restore'}}"
                                                                      method="post">
                                                                    {{ method_field('put') }}
                                                                    {{ csrf_field() }}
                                                                    <a type="button"
                                                                       class="btn btn-sm btn-icon btn-pure btn-outline restore-learner"
                                                                       data-toggle="tooltip" data-original-title="Restore">
                                                                        <i class="fa fa-user-plus" aria-hidden="true"></i>
                                                                    </a>
                                                                </form>
                                                            @else
                                                                <form action="{{  url('organizations').'/'. $learner->id}}"
                                                                      method="post">
                                                                    {{ method_field('delete') }}
                                                                    {{ csrf_field() }}
                                                                    <a type="button"
                                                                       class="btn btn-sm btn-icon btn-pure btn-outline archive-learner"
                                                                       data-toggle="tooltip" data-original-title="Archive">
                                                                        <i class="ti-archive" aria-hidden="true"></i>
                                                                    </a>
                                                                </form>
                                                            @endif
                                                            <form action="{{  url('organizations').'/'.$learner->id.'/remove'}}"
                                                                  method="post">
                                                                {{ method_field('delete') }}
                                                                {{ csrf_field() }}
                                                                <a type="button"
                                                                   class="btn btn-sm btn-icon btn-pure btn-outline remove-learner"
                                                                   data-toggle="tooltip" data-original-title="Remove Organization">
                                                                    <i class="fa fa-close" aria-hidden="true"></i>
                                                                </a>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- .left-aside-column-->
                    </div>
                    <!-- /.left-right-aside-column-->
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div>

    <div id="add-department" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel">Add Department</h4>
                </div>
                <form class="form-horizontal" action="{{ url($prefix.'/departments') }}" method="post">
                    {{ csrf_field() }}


                    <div class="modal-body">
                        <div class="form-group">
                            <label class="col-md-12">Name of Department</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control" name="name" placeholder="Name"
                                       value="{{ old('name') }}">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-info waves-effect">Save</button>
                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div id="edit-department" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel">Edit Department</h4>
                </div>
                <form class="form-horizontal" action="{{ url( $prefix . '/departments/' . old('id') ) }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('put') }}

                    <input id="department-id" type="hidden" class="form-control" name="id" value="{{ old('id') }}">

                    <div class="modal-body">
                        <div class="form-group">
                            <label class="col-md-12">Name of Department</label>
                            <div class="col-md-12">
                                <input id="department-name" type="text" class="form-control" name="name"
                                       placeholder="Name" value="{{ old('name') }}">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-info waves-effect">Save</button>
                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div id="add-organization" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel">Add New Organization</h4>
                </div>
                <form class="form-material" method="post" action="" enctype="multipart/form-data">
                    {{ csrf_field() }}
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
                                                        <img id="preview" src="http://sanarch.in/public/images/defaultAvatar.png" alt="">
                                                        <input class="upload" type="file" name="organization[image]" onchange="previewImage(this)">
                                                    </div>
                                                </div>
                                                <div class="form-group  m-b-20">
                                                    <input type="text" class="form-control" name="organization[name]" placeholder="Organization Name"
                                                           value="{{ old('organization.name') }}">
                                                </div>
                                                <div class="form-group m-b-20">
                                                    <input type="text" class="form-control" name="organization[contact_person]" placeholder="Contact Person"
                                                           value="{{ old('organization.contact_person') }}">
                                                </div>
                                                <div class="form-group m-b-20">
                                                    <input type="text" class="form-control" name="organization[phone]" placeholder="Phone"
                                                           value="{{ old('organization.phone') }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingTwo">
                                    <h4 class="panel-title">
                                        <a class="collapsed disabled" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            Billing & Subscription
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo" aria-expanded="false">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group m-b-20">
                                                    <input type="text" class="form-control" name="organization[name_on_card]"
                                                           placeholder="Name on card">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group m-b-20">
                                                    <input type="number" class="form-control" name="organization[card_number]"
                                                           placeholder="Credit card number">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group m-b-20">
                                                    <input type="text" class="form-control" name="organization[expiry_date]"
                                                           placeholder="Expiry Date (YYYY-MM)">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group m-b-20">
                                                    <input type="number" class="form-control" name="subscription[licenses]"
                                                           placeholder="No. of Licenses">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group m-b-20">
                                                    <input type="number" class="form-control" name="subscription[billing_interval]"
                                                           placeholder="Billing Interval (Days)">
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
                                                           value="{{ old('user.email') }}">
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
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-info waves-effect">Save</button>
                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    @if(session()->has('success') || session('success'))
        <script>
            window.onload = function () {
                setTimeout(function () {
                    showToast('Success', '{{ session('success') }}', 'success');
                }, 500);
            };
        </script>
    @endif

    @if($errors)
        <script>
            window.onload = function () {

                @if(session()->has('success') || session('success'))
                setTimeout(function () {
                    showToast('Success', '{{ session('success') }}', 'success');
                }, 500);
                @endif

                @if(isset($errors) && count($errors->all()) > 0 && $timeout = 700)
                $('#add-organization').modal('show');
                @foreach ($errors->all() as $key => $error)
                setTimeout(function () {
                    showToast('Error', '{{ $error }}', 'error');
                }, {{ $timeout * $key }});
                @endforeach
                @endif

                $('#organization-table').DataTable({
                    dom: 'Bfrtip',
                    buttons: [
                        {
                            text: 'Add New Organization',
                            // className : 'btn btn-success btn-rounded',
                            action: function ( e, dt, node, config ) {
                                $('#add-organization').modal('show');
                            }
                        },
                        {
                            extend: 'copyHtml5',
                            exportOptions: {
                                columns: [ 0, 1, 2, 3, 4, 5]
                            }
                        },
                        {
                            extend: 'excelHtml5',
                            exportOptions: {
                                columns: [ 0, 1, 2, 3, 4, 5]
                            }
                        },
                        {
                            extend: 'pdfHtml5',
                            exportOptions: {
                                columns: [ 0, 1, 2, 3, 4, 5]
                            }
                        },
                        {
                            extend: 'csv',
                            exportOptions: {
                                columns: [ 0, 1, 2, 3, 4, 5]
                            }
                        },
                        {
                            extend: 'print',
                            exportOptions: {
                                columns: [ 0, 1, 2, 3, 4, 5]
                            }
                        }
                    ]
                });

                $('#organization-table').on('click', '.remove-learner', function() {

                    var that = $(this);
                    swal({
                        title: 'Remove Organization?',
                        text: "You won't be able to revert this!",
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, remove organization!'
                    }).then((result) => {
                        if (result.value) {
                        that.parent().submit();
                    }
                });
                });

                $('#organization-table').on('click', '.archive-learner', function() {

                    var that = $(this);
                    swal({
                        title: 'Archive Organization?',
                        text: "You can revert this later.",
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, archive'
                    }).then((result) => {
                        if (result.value) {
                        that.parent().submit();
                    }
                });
                });

                $('#organization-table').on('click', '.restore-learner', function() {

                    var that = $(this);
                    swal({
                        title: 'Restore Organization?',
                        text: "Are you sure?",
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, restore'
                    }).then((result) => {
                        if (result.value) {
                        that.parent().submit();
                    }
                });
                });

                $('#organization-table').on('click', '.remove-learner', function() {

                    var that = $(this);
                    swal({
                        title: 'Remove Organization?',
                        text: "Are you sure?",
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, remove'
                    }).then((result) => {
                        if (result.value) {
                        that.parent().submit();
                    }
                });
                });
            };

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
    @endif
@endsection