@extends('layouts.app')
@section('content')
    @include('includes.main-menu')
    <div class="container-fluid">
        <!-- row -->
        <div class="row m-t-15">
            <div class="col-md-12">
                <div class="white-box p-0">
                        <div class="hidden">
                            <input type="hidden" class="user-role" value="{{$role}}">
                            @if(isset($organization->subscription->licenses))
                                <input type="hidden" id="learner-flag" value="{{ $organization->subscription->licenses > (count($organization->learners) - $organization->learners()->archived()->count()) ? '1' : '0'}}" >
                            @else
                                <input type="hidden" id="learner-flag" value="0" >
                            @endif
                        </div>
                    <!-- .left-right-aside-column-->
                    <div class="page-aside">
                        <!-- .left-aside-column-->
                        <div class="left-aside">
                            <div class="scrollable">
                                <ul id="department-list" class="list-style-none">
                                    @if($role=='organization' )
                                        <li class="text-primary">
                                            <a href="javascript:void(0)"  style="color:#0275D8">
                                                Total Licenses
                                                <span > {{isset($organization->subscription->licenses) ? $organization->subscription->licenses : '0' }} </span>
                                            </a>
                                        </li>
                                    @endif
                                    <li>
                                        <a href="javascript:void(0)" class="department" data-id="" data-name="archived">
                                            Archived Learners
                                            <span> {{ $organization->learners()->archived()->count() }} </span>
                                        </a>
                                    </li>
                                    <li class="divider"></li>

                                    @if(isset($organization->departments))
                                        @foreach($organization->departments as $department)
                                            <li>
                                                <a href="javascript:void(0)" class="department"
                                                   data-id="{{ $department->id }}" data-name="{{ $department->name }}">
                                                    {{ $department->name }}
                                                    {{--<span>{{ $department->learners()->count() }}</span>--}}
                                                    <span class="learner-count">{{  count($department->learners)? count($department->learners) : 0 }}</span>
                                                    {{--<span class="remove"><i class="ti-close" aria-hidden="true"></i></span>--}}
                                                    <span data-id="{{ $department->id }}"
                                                          data-name="{{ $department->name }}" class="edit">
                                                    <i class="ti-pencil" aria-hidden="true"></i>
                                                </span>
                                                </a>
                                            </li>
                                        @endforeach
                                    @endif
                                    <li class="box-label">
                                        <a href="javascript:void(0)" class="department" data-id="" data-name="">
                                            All Learners
                                            <span>{{ isset($organization->learners)? count($organization->learners) : 0}}</span>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="list-style-none">
                                    <li class="divider"></li>
                                    <li class="box-label">
                                        <a href="javascript:void(0)" data-toggle="modal" data-target="#add-department">
                                            + Add New Department
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- /.left-aside-column-->
                        <div class="right-aside">
                            <div class="clearfix"></div>
                            <div class="scrollable">
                                <div class="table-responsive">
                                    <table id="learners-table" class="table m-t-30 table-hover contact-list"
                                           data-page-size="10" data-filter="#search-learner">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Department</th>
                                            <th>Joining date</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @if(count($organization->departments) > 0)
                                            @foreach($organization->departments as $key => $department)
                                                @foreach($department->learners as $learner)
                                                    <tr class="{{ $learner->trashed()? 'bg-warning':'' }}">
                                                        <td>{{ $learner->id }}</td>
                                                        <td>
                                                            <a href="{{ url( '/learners/'. $learner->id) }}">
                                                                {{--<img src="https://wrappixel.com/demos/admin-templates/pixeladmin/plugins/images/users/genu.jpg"--}}
                                                                {{--alt="user" class="img-circle"/>--}}
                                                                {{ $learner->name }}
                                                            </a>
                                                        </td>
                                                        <td>{{ $learner->user->email }}</td>
                                                        <td>{{ $learner->phone }}</td>
                                                        <td>
                                                            <span class="label label-info">
                                                                {{ $learner->department->name }}
                                                            </span>
                                                        </td>
                                                        <td>{{ $learner->created_at->format('m/d/Y') }}</td>
                                                        <td>
                                                            <a href="{{ url( '/learners/'. $learner->id) }}"
                                                               class="btn btn-sm btn-icon btn-pure btn-outline"
                                                               data-toggle="tooltip" data-original-title="View">
                                                                <i class="ti-eye" aria-hidden="true"></i>
                                                            </a>
                                                            @if($learner->trashed())
                                                                <form action="{{  url('/learners/' . $learner->id . '/restore')}}"
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
                                                            <form action="{{  url('/learners/'. $learner->id)}}"
                                                                  method="post">
                                                                {{ method_field('delete') }}
                                                                {{ csrf_field() }}
                                                                {{--<input type="hidden" name="department_id" value="{{ $department->id }}">--}}
                                                                <a type="button"
                                                                   class="btn btn-sm btn-icon btn-pure btn-outline remove-learner"
                                                                   data-toggle="tooltip" data-original-title="Archive">
                                                                    <i class="ti-archive" aria-hidden="true"></i>
                                                                </a>
                                                            </form>
                                                            @endif
                                                            <form action="{{  url('/learners/'. $learner->id.'/remove')}}"
                                                                  method="post">
                                                                {{ method_field('delete') }}
                                                                {{ csrf_field() }}
                                                                {{--<input type="hidden" name="department_id" value="{{ $department->id }}">--}}
                                                                <a type="button"
                                                                   class="btn btn-sm btn-icon btn-pure btn-outline remove-learner"
                                                                   data-toggle="tooltip" data-original-title="Remove">
                                                                    <i class="ti-close" aria-hidden="true"></i>
                                                                </a>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endforeach
                                        @endif
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
                    <input type="hidden" class="form-control" name="organization_id" value="{{ $organization->id }}">

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
                    <input type="hidden" class="form-control" name="organization_id" value="{{ $organization->id }}">
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

    <div id="add-learner" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel">Add New Learner</h4>
                </div>
                <form class="form-horizontal form-material" method="post" action="">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="col-md-12">
                                <label class="col-md-12">Select Department</label>
                                <select class="form-control" name="learner[department_id]">
                                    @foreach($organization->departments as $department)
                                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12 m-b-20">
                                <input type="text" class="form-control" name="learner[name]" placeholder="Name"
                                       value="{{ old('learner.name') }}">
                            </div>
                            <div class="col-md-12 m-b-20">
                                <input type="email" class="form-control" name="user[email]" placeholder="Email"
                                       value="{{ old('user.email') }}">
                            </div>
                            <div class="col-md-12 m-b-20">
                                <input type="text" class="form-control" name="learner[phone]" placeholder="Phone"
                                       value="{{ old('learner.phone') }}">
                            </div>
                            <div class="col-md-12 m-b-20">
                                <input type="password" class="form-control" name="user[password]"
                                       placeholder="Password">
                            </div>
                            <div class="col-md-12 m-b-20">
                                <input type="password" class="form-control" name="user[password_confirmation]"
                                       placeholder="Confirm Password">
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


        <script>
            window.onload = function () {
                @if(session()->has('success') || session('success'))
                    setTimeout(function () {
                        showToast('Success', '{{ session('success') }}', 'success');
                    }, 500);
                @endif

                @if(count($errors->department->all()) > 0 && $timeout = 700 )
                    $('#add-department').modal('show');
                    @foreach ($errors->department->all() as $key => $error)
                    setTimeout(function () {
                        showToast('Error', '{{ $error }}', 'error');
                    }, {{ $timeout * $key }});
                    @endforeach
                @endif

                @if(count($errors->learner->all()) > 0 && $timeout = 700)
                    @foreach ($errors->learner->all() as $key => $error)
                    setTimeout(function () {
                        showToast('Error', '{{ $error }}', 'error');
                    }, {{ $timeout * $key }});
                    @endforeach
                @endif


                $('.learner-check').click(function(){
                    var addflag=$('#learner-flag').val();
                    var role=$('.user-role').val();
                    if(role==='organization'){
                        if(addflag==='1'){
                            $('#add-learner').modal('show');
                        }
                        else{
                            swal({
                                title: 'Information',
                                text: "You've used up all the licenses",
                                type: 'info',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Buy Licenses'
                            }).then(function(result){
                                if(result.value){
                                    window.location.href="{{url('subscription/').'/'.$organization->id.'/purchase'}}";
                                }

                            })
                        }
                    }
                    else{
                        $('#add-learner').modal('show');
                    }
                })
            };
        </script>
@endsection