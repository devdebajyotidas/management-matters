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
                                    <table id="tickets-table" class="table m-t-30 table-hover contact-list"
                                           data-page-size="10" data-filter="#search-tickets">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Title</th>
                                            <th>Impact Level</th>
                                            <th>Activity</th>
                                            <th>Created On</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(count($tickets) > 0)
                                            @foreach($tickets as $ticket)
                                                <tr>
                                                    <td>{{ $ticket->id }}</td>
                                                    <td>{{ $ticket->title}}</td>
                                                    <td>{{ $ticket->impact_level}}</td>
                                                    <td>
                                                        @if(count($ticket->assignments) > 0)
                                                            @foreach($ticket->assignments as $assignment)
                                                                @php
                                                                    $note=!empty($assignment->note) ? $assignment->note : 'No activity';
                                                                    $date=date('m/d/Y',strtotime($assignment->target_date));
                                                                @endphp
                                                                {!! $date.' : '.$note !!}<br>
                                                            @endforeach
                                                        @endif
                                                    </td>
                                                    <td>{{ date('m/d/Y',strtotime($ticket->created_at)) }}</td>
                                                </tr>
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
        };
    </script>
@endsection