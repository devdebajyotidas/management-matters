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
                            <h3>Tickets</h3>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 m-t-10 m-b-15">
                        <?php $filter=isset($_GET['filter']) ? $_GET['filter'] : '' ?>

                        <a href="{{url('tickets?filter=today')}}" class="btn {{$filter=='today' ? 'btn-success' : 'btn-default'}} pull-right m-l-5">Today</a>
                        <a href="{{url('tickets?filter=week')}}" class="btn {{$filter=='week' ? 'btn-success' : 'btn-default'}} pull-right m-l-5">This Week</a>
                        <a href="{{url('tickets?filter=month')}}" class="btn {{$filter=='month' ? 'btn-success' : 'btn-default'}} pull-right m-l-5">This Month</a>
                        <a href="{{url('tickets')}}" class="btn {{$filter=='' ? 'btn-success' : 'btn-default'}} pull-right m-l-5">All</a>
                    </div>
                </div>
                <div class="white-box p-0 m-t-10">
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
                                            {{--<a href="javascript:void(0)" class="department" data-id="0" data-name="Not Applicable">--}}
                                                {{--Not Applicable--}}
                                            {{--</a>--}}
                                        </li>
                                    @endif
                                        @if(session('role')=='organization')
                                            @if(isset($departments) && count($departments) > 0)
                                                @foreach($departments as $department)
                                                    <li>
                                                        <a href="javascript:void(0)" class="department"
                                                           data-id="{{ $department->id }}" data-name="{{ $department->name }}">
                                                            {{ $department->name }}
                                                        </a>
                                                    </li>
                                                @endforeach
                                            @endif
                                            <li class="box-label">
                                                <a href="javascript:void(0)" class="department" data-id="" data-name="">
                                                    All Tickets
                                                </a>
                                                {{--<a href="javascript:void(0)" class="department" data-id="" data-name="Not Applicable">--}}
                                                    {{--Not Applicable--}}
                                                {{--</a>--}}
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
                                            @if(session('role')=='admin')
                                                <th>Organization</th>
                                            @else
                                                <th>Department</th>
                                            @endif
                                            <th>Create By</th>
                                            <th>Title</th>
                                            <th>Impact Level</th>
                                            <th>Activity</th>
                                            <th>Status</th>
                                            <th>Created On</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @foreach($tickets as $ticket)
                                            <tr>
                                                @if(session('role')=='admin')
                                                    <td>{{ isset($ticket->learner->department->organization->name) ? $ticket->learner->department->organization->name : 'Not Applicable' }}</td>
                                                @else
                                                    <td>{{ isset($ticket->learner->department->name) ? $ticket->learner->department->name : 'Not Applicable'  }}</td>
                                                @endif

                                                <td>
                                                    @if(isset($ticket->learner->id))
                                                        <a href="{{ url('/learners/'.$ticket->learner->id)}}">
                                                            {{ $ticket->learner->name }}
                                                        </a>
                                                    @else
                                                        N/A
                                                    @endif
                                                </td>
                                                <td>{{ $ticket->title }}</td>
                                                <td>{{ $ticket->impact_level }}</td>
                                                <td>
                                                    @if(isset($ticket->assignments) && !empty($ticket->assignments))
                                                        @foreach($ticket->assignments as $assignment)
                                                            @php
                                                                $note=!empty($assignment->note) ? $assignment->note : 'No activity';
                                                                $date=date('m/d/Y',strtotime($assignment->target_date));
                                                            @endphp
                                                            {!! $date.' : '.$note !!}
                                                        @endforeach
                                                    @else
                                                        No activity
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($ticket->is_completed==1)
                                                        Completed
                                                    @elseif($ticket->is_archived)
                                                        Archived
                                                    @else
                                                        Open
                                                    @endif
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
    <div class="scroll-top"><i class="fa fa-chevron-up"></i></div>
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
                buttons: [
                    'copy',
                    {
                        extend: 'csv',
                        exportOptions: {
                            stripNewlines: false
                        }
                    },
                    {
                        extend: 'excel',
                        exportOptions: {
                            stripNewlines: false
                        }
                    },
                    {
                        extend: 'pdf',
                        exportOptions: {
                            stripNewlines: false
                        }
                    },
                    {
                        extend: 'print',
                        exportOptions: {
                            stripHtml: false
                        }
                    }
                ]
            });
            $('#department-list .department').click(function () {
                var name = $(this).attr('data-name');
                ticketTable.columns(0).search(name).draw();
                $('#department-list li').removeClass('box-label');
                $(this).parent('li').addClass('box-label');
            });
            $('.activity-view').click(function(){
                $(this).parent().find('.activity-modal').modal('show');
            })
        };
    </script>
@endsection