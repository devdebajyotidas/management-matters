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

                        <!-- /.left-aside-column-->
                        <div class="right-aside" style="margin: 0">
                            <div class="clearfix"></div>
                            <div class="scrollable">
                                <div class="table-responsive">
                                    <table id="tickets-table" class="table m-t-30 table-hover contact-list"
                                           data-page-size="10" data-filter="#search-tickets">
                                        <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Learning Module</th>
                                            <th>Title</th>
                                            <th>Note</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        {{dd($assignments)}}
                                        @if(count($assignments) > 0)
                                            @foreach($assignments as $assignment)

                                                <tr>
                                                    <td>{{ $assignment->target_date }}</td>
                                                    <td>{{ $assignment->ticket->learning->title}}</td>
                                                    <td>{{ $assignment->ticket->title}}</td>
                                                    <td>{{ $assignment->note }}</td>
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
                buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
            });
        };
    </script>
@endsection