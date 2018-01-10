@extends('layouts.app')
@section('content')
    @include('includes.main-menu')

    <div class="container-fluid">
        <!-- row -->
        <div class="row m-t-20">
            <div class="col-md-12">
                <div class="white-box p-0">
                    <!-- .left-right-aside-column-->
                    <div class="page-aside">
                        <!-- .left-aside-column-->
                        <div class="left-aside">
                            <div class="scrollable">
                                <ul id="department-list" class="list-style-none">
                                    @if(session('role')=='admin')
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
                                                All Tickets
                                            </a>
                                        </li>
                                    @endif
                                        @if(session('role')=='organization')
                                            @if(isset($departments))
                                                @if(is_array($departments))
                                                    @foreach($departments as $department)
                                                        <li>
                                                            <a href="javascript:void(0)" class="department"
                                                               data-id="{{ $department->id }}" data-name="{{ $department->name }}">
                                                                {{ $department->name }}
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                @else
                                                    <li>
                                                        <a href="javascript:void(0)" class="department"
                                                           data-id="{{ $departments->id }}" data-name="{{ $departments->name }}">
                                                            {{ $departments->name }}
                                                       </a>
                                                    </li>
                                                @endif

                                            @endif
                                            <li class="box-label">
                                                <a href="javascript:void(0)" class="department" data-id="" data-name="">
                                                    All Tickets
                                               </a>
                                            </li>
                                        @endif

                                </ul>
                            </div>
                        </div>
                        <!-- /.left-aside-column-->
                        <div class="right-aside">
                            <div class="clearfix"></div>
                            <div class="scrollable">
                                <div class="table-responsive">

                                    <table id="tickets-table" class="table m-t-30 table-hover contact-list"
                                           data-page-size="10" data-filter="#search-learner">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            @if($role=='admin')
                                                <th>Organization</th>
                                            @else
                                                <th>Department</th>
                                            @endif
                                            <th>Create By</th>
                                            <th>Title</th>
                                            <th>Impact Level</th>
                                           <th>Activity</th>
                                            <th>Created On</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @foreach($tickets as $ticket)
                                            <tr>
                                                <td>{{ $ticket->id }}</td>
                                                @if($role=='admin')
                                                    <td>{{ $ticket->learner->department->organization->name }}</td>
                                                @else
                                                    <td>{{ $ticket->learner->department->name }}</td>
                                                @endif

                                                <td>
                                                    <a href="{{ url('/learners/'. $ticket->learner->id) }}">
                                                        {{ $ticket->learner->name }}
                                                    </a>
                                                </td>
                                                <td>{{ $ticket->title }}</td>
                                                <td>{{ $ticket->impact_level }}</td>
                                                <td>
                                                    <span class="activity-view text-primary" style="cursor: pointer;">{{count($ticket->assignments)}} Assignments</span>
                                                    <div id="activity-modal" class="activity-modal modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                                                         aria-hidden="true">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                    <h4 class="modal-title" id="myModalLabel">Activity</h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                    @if(isset($ticket->assignments))
                                                                        @foreach($ticket->assignments as $assignment)
                                                                            <div class="row form-group">
                                                                                <div class="col-sm-2">{{$assignment->target_date}}</div>
                                                                                <div class="col-sm-10">{{!empty($assignment->note) ? $assignment->note : 'No activity'}}</div>
                                                                            </div>
                                                                        @endforeach
                                                                    @endif
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                                                                </div>
                                                            </div>
                                                            <!-- /.modal-content -->
                                                        </div>
                                                        <!-- /.modal-dialog -->
                                                    </div>
                                                </td>
                                                <td>{{ $ticket->created_at->format('m/d/Y') }}</td>
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

    @if(session()->has('success') || session('success'))
        <script>
            window.onload = function () {
                setTimeout(function () {
                    showToast('Success', '{{ session('success') }}', 'success');
                }, 500);
            };
        </script>
    @endif

    <script>
        var ticketTable;
        window.onload = function () {
            ticketTable = $('#tickets-table').DataTable({
                dom: 'Bfrtip',
                buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
            });
            $('#department-list .department').click(function () {
                var name = $(this).attr('data-name');
                ticketTable.columns(1).search(name).draw();
                $('#department-list li').removeClass('box-label');
                $(this).parent('li').addClass('box-label');
            });
            $('.activity-view').click(function(){
                $(this).parent().find('.activity-modal').modal('show');
            })
        };
    </script>
@endsection