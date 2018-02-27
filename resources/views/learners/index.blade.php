@extends('layouts.app')
@section('content')
    @include('includes.main-menu')

    <div class="container-fluid">
        <!-- row -->
        <div class="row m-t-15">
            <div class="col-md-12">
                <div class="white-box">
                    <div class="row">
                        <div class="col-md-12">
                            <h3>Learners</h3>
                        </div>
                    </div>
                </div>
                <div class="white-box p-0">
                    <!-- .left-right-aside-column-->
                    <div class="page-aside">
                        <!-- .left-aside-column-->
                        <div class="left-aside">
                            <div class="scrollable">
                                <ul id="department-list" class="list-style-none">
                                    @if(isset($organizations))
                                        @foreach($organizations as $organization)
                                            <li>
                                                <a href="javascript:void(0)" class="department"
                                                   data-id="{{ $organization->id }}" data-name="{{ $organization->name }}">
                                                    {{ $organization->name }}
                                                </a>
                                            </li>
                                        @endforeach
                                    @endif
                                    <li class="box-label">
                                        <a href="javascript:void(0)" class="department" data-id="" data-name="">
                                            All Learners
                                        </a>
                                        <a href="javascript:void(0)" class="department" data-id="" data-name="N/A">
                                            Not Applicable
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
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Organization</th>
                                            <th>Joining date</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($learners as $learner)

                                            <tr class="{{ $learner->trashed()? 'bg-warning':'' }}">
                                                <td>
                                                    <a href="{{ url('/learners/'. $learner->id)}}">
                                                        <img src="{{ ($learner->image)? asset('uploads/'.$learner->image) : 'http://sanarch.in/public/images/defaultAvatar.png' }}"
                                                             alt="user" class="img-circle"/>
                                                        {{ $learner->name }}
                                                    </a>
                                                </td>
                                                <td>{{ isset($learner->user->email) ? $learner->user->email : 'N/A' }}</td>
                                                <td>{{ $learner->phone }}</td>
                                                <td>
                                                    @if($learner->department)
                                                        <a href="{{ url('/organizations/'.$learner->department->organization->id) }}">
                                                                    <span class="label label-info">
                                                                    {{ $learner->department->organization->name }}
                                                                    </span>
                                                        </a>
                                                    @else
                                                        <span class="label label-warning">
                                                                N/A
                                                            </span>
                                                    @endif
                                                </td>
                                                <td>{{ $learner->created_at->format('m/d/Y') }}</td>
                                                <td>
                                                    <a href="{{ url('/learners/'. $learner->id)}}"
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
                                                        <form action="{{  url('/learners/' . $learner->id)}}"
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

                            {{--<div class="col-md-12 m-b-20">--}}
                                {{--<label for="sel1">Select Organization:</label>--}}
                                {{--<select class="form-control" name="learner[organization]" id="sel1">--}}
                                    {{--<option value="">Not Applicable</option>--}}
                                    {{--@foreach($organizations as $org)--}}
                                        {{--@if(!empty($org))--}}
                                            {{--<option value="{{$org->id}}">{{$org->name}}</option>--}}
                                        {{--@endif--}}
                                    {{--@endforeach--}}
                                {{--</select>--}}
                            {{--</div>--}}
                            <div class="col-md-12 m-b-20">
                                <input type="text" class="form-control" name="learner[name_on_card]"
                                       placeholder="Name on Card" value="{{ old('learner.name_on_card') }}">
                            </div>
                            <div class="col-md-6 m-b-20">
                                <input type="number" class="form-control" name="learner[card_number]"
                                       placeholder="Credit card number" value="{{ old('learner.card_number') }}">
                            </div>
                            <div class="col-md-6 m-b-20">
                                <input type="text" class="form-control" name="learner[expiry_date]"
                                       placeholder="Expiry Date (YYYY-MM)" value="{{ old('learner.expiry_date') }}">
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
    <div class="scroll-top"><i class="fa fa-chevron-up"></i></div>



    <script>
        window.onload = function () {

            @if(session()->has('success') || session('success'))
            setTimeout(function () {
                showToast('Success', '{{ session('success') }}', 'success');
            }, 500);
            @endif

            @if(isset($errors) && count($errors->all()) > 0 && $timeout = 700)
            $('#add-learner').modal('show');
            @foreach ($errors->all() as $key => $error)
            setTimeout(function () {
                showToast('Error', '{{ $error }}', 'error');
            }, {{ $timeout * $key }});
            @endforeach
            @endif

            $('.learner-check').click(function(){
                $('#add-learner').modal('show');
            })
        };
    </script>

@endsection