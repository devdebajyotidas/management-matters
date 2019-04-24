@extends('layouts.app')
@section('content')
    @include('includes.main-menu')
    <div class="firework"></div>
    <div class="container-fluid">
        <div class="row m-t-15">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="white-box">
                    <div class="row">
                        <div class="col-md-12">
                            <h3>Assessments</h3>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div id="assessment-chart" style="box-shadow: 0 1px 3px rgba(0,0,0,0.14)"></div>
                    </div>
                </div>
                <div class="row m-t-20">
                    <div class="col-md-12">
                        <div class="scrollable white-box">
                            @if(session('role')== 'learner')
                                <h3 class="box-title">
                                    <a href="{{ url('assessments/take') }}" class="btn btn-info">
                                        Take New Assessment
                                    </a>
                                </h3>
                            @endif
                            @if(session('role')!='learner')
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
                                                        All Assessment
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
                                                        All Assessment
                                                    </a>
                                                    {{--<a href="javascript:void(0)" class="department" data-id="" data-name="Not Applicable">--}}
                                                        {{--Not Applicable--}}
                                                    {{--</a>--}}
                                                </li>
                                            @endif

                                        </ul>
                                    </div>
                                </div>
                                <div class="right-aside">
                                @endif
                                    <div class="table-responsive">
                                        <table id="organization-table" class="table m-t-30 table-hover contact-list"
                                               data-page-size="10" data-filter="#search-learner">
                                            <thead>
                                            <tr>
{{--                                                @if(session('role')=='admin')--}}
{{--                                                    <th>Organization</th>--}}
{{--                                                @elseif(session('role')=='organization')--}}
{{--                                                    <th>Department</th>--}}
{{--                                                @endif--}}
{{--                                                @if(session('role')!= 'learner')--}}
{{--                                                    <th>Learner</th>--}}
{{--                                                @endif--}}
                                                <th>Taken by</th>
                                                <th>Score</th>
                                                <th>Taken On</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @if(isset($assessments))
                                                @foreach($assessments as $assessment)
                                                    <tr>
                                                        <td>{{$assessment->is_self ? 'Self' : $assessment->name}}</td>
{{--                                                        @if(session('role') == "admin")--}}
{{--                                                            @if(isset($assessment->learner->department->organization->name))--}}
{{--                                                                <td>{{ $assessment->learner->department->organization->name }}</td>--}}
{{--                                                            @else--}}
{{--                                                                <td>Not Applicable</td>--}}
{{--                                                            @endif--}}

{{--                                                        @elseif(session('role')=='organization')--}}
{{--                                                            @if(isset($assessment->learner->department->name))--}}
{{--                                                                <td>{{ $assessment->learner->department->name }}</td>--}}
{{--                                                            @else--}}
{{--                                                                <td>Not Applicable</td>--}}
{{--                                                            @endif--}}
{{--                                                        @endif--}}
{{--                                                        @if(session('role') != 'learner')--}}
{{--                                                            <td>{{ $assessment->learner->name }}</td>--}}
{{--                                                        @endif--}}

                                                        <td>
                                                            @foreach(json_decode($assessment->result) as $module => $score)
                                                                @if($score < 2)
                                                                    <span class="text-danger">
                                                                        {{ $module }} : {{ number_format((float)$score, 2, '.', '') }}
                                                                    </span>
                                                                @elseif($score >= 2 && $score < 4)
                                                                    <span class="text-warning">
                                                                        {{ $module }} : {{ number_format((float)$score, 2, '.', '') }}
                                                                    </span>
                                                                @else
                                                                    <span class="text-success">
                                                                        {{ $module }} : {{ number_format((float)$score, 2, '.', '') }}
                                                                    </span>
                                                                @endif
                                                                <br>
                                                            @endforeach
                                                        </td>
                                                        <td>{{ $assessment->created_at->format('m/d/Y H:i') }}</td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                            </tbody>
                                        </table>
                                    </div>
                                @if(session('role')!='learner')
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="scroll-top"><i class="fa fa-chevron-up"></i></div>
    <script>
        var CSS_COLOR_NAMES = ["AliceBlue", "AntiqueWhite", "Aqua", "Aquamarine", "Azure", "Beige", "Bisque", "Black", "BlanchedAlmond", "Blue", "BlueViolet", "Brown", "BurlyWood", "CadetBlue", "Chartreuse", "Chocolate", "Coral", "CornflowerBlue", "Cornsilk", "Crimson", "Cyan", "DarkBlue", "DarkCyan", "DarkGoldenRod", "DarkGray", "DarkGrey", "DarkGreen", "DarkKhaki", "DarkMagenta", "DarkOliveGreen", "Darkorange", "DarkOrchid", "DarkRed", "DarkSalmon", "DarkSeaGreen", "DarkSlateBlue", "DarkSlateGray", "DarkSlateGrey", "DarkTurquoise", "DarkViolet", "DeepPink", "DeepSkyBlue", "DimGray", "DimGrey", "DodgerBlue", "FireBrick", "FloralWhite", "ForestGreen", "Fuchsia", "Gainsboro", "GhostWhite", "Gold", "GoldenRod", "Gray", "Grey", "Green", "GreenYellow", "HoneyDew", "HotPink", "IndianRed", "Indigo", "Ivory", "Khaki", "Lavender", "LavenderBlush", "LawnGreen", "LemonChiffon", "LightBlue", "LightCoral", "LightCyan", "LightGoldenRodYellow", "LightGray", "LightGrey", "LightGreen", "LightPink", "LightSalmon", "LightSeaGreen", "LightSkyBlue", "LightSlateGray", "LightSlateGrey", "LightSteelBlue", "LightYellow", "Lime", "LimeGreen", "Linen", "Magenta", "Maroon", "MediumAquaMarine", "MediumBlue", "MediumOrchid", "MediumPurple", "MediumSeaGreen", "MediumSlateBlue", "MediumSpringGreen", "MediumTurquoise", "MediumVioletRed", "MidnightBlue", "MintCream", "MistyRose", "Moccasin", "NavajoWhite", "Navy", "OldLace", "Olive", "OliveDrab", "Orange", "OrangeRed", "Orchid", "PaleGoldenRod", "PaleGreen", "PaleTurquoise", "PaleVioletRed", "PapayaWhip", "PeachPuff", "Peru", "Pink", "Plum", "PowderBlue", "Purple", "Red", "RosyBrown", "RoyalBlue", "SaddleBrown", "Salmon", "SandyBrown", "SeaGreen", "SeaShell", "Sienna", "Silver", "SkyBlue", "SlateBlue", "SlateGray", "SlateGrey", "Snow", "SpringGreen", "SteelBlue", "Tan", "Teal", "Thistle", "Tomato", "Turquoise", "Violet", "Wheat", "White", "WhiteSmoke", "Yellow", "YellowGreen"];
        var scores = JSON.parse('{!! str_replace("'", "\\'", json_encode($scores))  !!}');
        var dates = JSON.parse('{!! json_encode(($dates)) !!}');
        var chartData = [];
        var count = 0;

        console.log(scores);

        function renderChart() {

            for(var i=0; i<dates.length; i++){
                dates[i] = moment(dates[i].date).format("MM/DD/YYYY HH:mm");
            }

            Highcharts.chart('assessment-chart', {

                title: {
                    text: "{{ !empty(auth()->user()->account) ? auth()->user()->account->name : 'SuperAdmin' }}",
                },
                subtitle: {
                    text: "Assessment Report"
                },
                xAxis: {
                    title: {
                        text: 'Date'
                    },
//                    categories: [1,2,3,4,5,6,7,8,9,10]
                    categories: dates
                },
                yAxis: {
                    title: {
                        text: 'Score'
                    },
                                       categories: [1,2,3,4,5,6,7,8,9,10]
                },
                plotOptions: {
                    line: {
                        dataLabels: {
                            enabled: true
                        },
                        enableMouseTracking: false
                    },
                },
                series: scores,
                tickInterval: 1,
                min: 1,
                max: 100,
                exporting: {
                    fallbackToExportServer: false
                },
                responsive: {
                    rules: [{
                        condition: {
                            maxWidth: 500
                        },
                        chartOptions: {
                            legend: {
                                layout: 'horizontal',
                                align: 'center',
                                verticalAlign: 'bottom'
                            }
                        }
                    }]
                }

            });
        }

        window.onload = function () {
            renderChart();

            var ticketTable = $('#organization-table').DataTable({
                "order": [[ 1, "desc" ]],
                dom: 'Bfrtip',
                buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
            });
            $('#department-list .department').click(function () {
                var name = $(this).attr('data-name');
                ticketTable.columns(0).search(name).draw();
                $('#department-list li').removeClass('box-label');
                $(this).parent('li').addClass('box-label');
            });

            @if(session()->has('success') || session('success'))
            setTimeout(function () {
                showToast('Success', '{{ session('success') }}', 'success');
            }, 500);
            @if(session('role')=='learner')
            firework();
            @endif
            @endif

            @if(isset($errors) && count($errors->all()) > 0 && $timeout = 700)

            @foreach ($errors->all() as $key => $error)
            setTimeout(function () {
                showToast('Error', '{{ $error }}', 'error');
            }, {{ $timeout * $key }});
            @endforeach
            @endif

        }

    </script>
@endsection