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
                            <h3>Quiz</h3>
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
                                                All Quiz
                                             </a>
                                            {{--<a href="javascript:void(0)" class="department" data-id="" data-name="Not Applicable">--}}
                                                {{--Not Applicable--}}
                                            {{--</a>--}}
                                        </li>

                                    @endif
                                    @if(session('role')=='organization')
                                            @if(isset($departments))
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
                                                All Quiz
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
                                            <th>Taken By</th>
                                            <th>Learning</th>
                                            <th>Score</th>
                                            <th>Completed</th>
                                            <th>Created On</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(isset($quizs) && count($quizs) > 0)
                                        @foreach($quizs as $quiz)
                                            <tr>
                                                @if(session('role') == "admin")
                                                    @if(isset($quiz->learner->department->organization->name))
                                                        <td>{{ $quiz->learner->department->organization->name }}</td>
                                                    @else
                                                        <td>Not Applicable</td>
                                                    @endif

                                                @else
                                                    @if(isset($quiz->learner->department->name))
                                                        <td>{{ $quiz->learner->department->name }}</td>
                                                    @else
                                                        <td>Not Applicable</td>
                                                    @endif
                                                @endif
                                                <td>{{ isset($quiz->learner->name) ? $quiz->learner->name : 'N/A' }}</td>
                                                <td>{{ isset($quiz->learning->title) ? $quiz->learning->title : 'N/A' }}</td>
                                                <td>{{number_format(floatval(((isset($quiz->result) ? $quiz->result : 0)/count(isset($quiz->learning->quiz) ? $quiz->learning->quiz : 0)) * 100) ,2) }} %</td>
                                                <td>{{ ($quiz->is_completed == 1) ? 'Yes' : 'No'  }}</td>
                                                <td>{{ $quiz->created_at->format('m/d/Y') }}</td>
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
    <div class="scroll-top"><i class="fa fa-chevron-up"></i></div>
    @if(session()->has('success') || session('success'))
        <script>
            window.onload = function () {
                setTimeout(function () {
                    showToast('Success', '{{ session('success') }}', 'success');
                }, 500);
                @if(session('role')=='learner')
                firework();
                @endif
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
                ticketTable.columns(0).search(name).draw();
                $('#department-list li').removeClass('box-label');
                $(this).parent('li').addClass('box-label');
            });
        };
    </script>
@endsection