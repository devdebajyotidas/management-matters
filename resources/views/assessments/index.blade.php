@extends('layouts.app')
@section('content')
    @include('includes.main-menu')

    <div class="container-fluid">
        <div class="row m-t-15">
            <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="assessment-chart" style="box-shadow: 0 1px 3px rgba(0,0,0,0.14)"></div>
                        </div>
                    </div>
                <div class="row m-t-20">
                        <div class="col-md-12">
                            <div class="scrollable white-box">
                                @if($role == 'learner')
                                    <h3 class="box-title">
                                        <a href="{{ url('assessments/new') }}" class="btn btn-info">
                                            Take New Assessment
                                        </a>
                                    </h3>
                                @endif
                                <div class="table-responsive">
                                    <table id="organization-table" class="table m-t-30 table-hover contact-list"
                                           data-page-size="10" data-filter="#search-learner">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            @if($role != 'learner')
                                            <th>Learner</th>
                                            @endif
                                            <th>Score</th>
                                            <th>Taken On</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(isset($assessments))
                                            @foreach($assessments as $assessment)
                                                <tr>
                                                    <td>{{ $assessment->id }}</td>
                                                    @if($role != 'learner')
                                                    <td>{{ $assessment->learner->name }}</td>
                                                    @endif
                                                    <td>
                                                        @foreach($assessment->scores as $module => $score)
                                                            {{ $module }} : {{ number_format((float)$score, 2, '.', '') }}
                                                            <br>
                                                        @endforeach
                                                    </td>
                                                    <td>{{ $assessment->created_at->format('m/d/Y') }}</td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>

    <script>
        var CSS_COLOR_NAMES = ["AliceBlue", "AntiqueWhite", "Aqua", "Aquamarine", "Azure", "Beige", "Bisque", "Black", "BlanchedAlmond", "Blue", "BlueViolet", "Brown", "BurlyWood", "CadetBlue", "Chartreuse", "Chocolate", "Coral", "CornflowerBlue", "Cornsilk", "Crimson", "Cyan", "DarkBlue", "DarkCyan", "DarkGoldenRod", "DarkGray", "DarkGrey", "DarkGreen", "DarkKhaki", "DarkMagenta", "DarkOliveGreen", "Darkorange", "DarkOrchid", "DarkRed", "DarkSalmon", "DarkSeaGreen", "DarkSlateBlue", "DarkSlateGray", "DarkSlateGrey", "DarkTurquoise", "DarkViolet", "DeepPink", "DeepSkyBlue", "DimGray", "DimGrey", "DodgerBlue", "FireBrick", "FloralWhite", "ForestGreen", "Fuchsia", "Gainsboro", "GhostWhite", "Gold", "GoldenRod", "Gray", "Grey", "Green", "GreenYellow", "HoneyDew", "HotPink", "IndianRed", "Indigo", "Ivory", "Khaki", "Lavender", "LavenderBlush", "LawnGreen", "LemonChiffon", "LightBlue", "LightCoral", "LightCyan", "LightGoldenRodYellow", "LightGray", "LightGrey", "LightGreen", "LightPink", "LightSalmon", "LightSeaGreen", "LightSkyBlue", "LightSlateGray", "LightSlateGrey", "LightSteelBlue", "LightYellow", "Lime", "LimeGreen", "Linen", "Magenta", "Maroon", "MediumAquaMarine", "MediumBlue", "MediumOrchid", "MediumPurple", "MediumSeaGreen", "MediumSlateBlue", "MediumSpringGreen", "MediumTurquoise", "MediumVioletRed", "MidnightBlue", "MintCream", "MistyRose", "Moccasin", "NavajoWhite", "Navy", "OldLace", "Olive", "OliveDrab", "Orange", "OrangeRed", "Orchid", "PaleGoldenRod", "PaleGreen", "PaleTurquoise", "PaleVioletRed", "PapayaWhip", "PeachPuff", "Peru", "Pink", "Plum", "PowderBlue", "Purple", "Red", "RosyBrown", "RoyalBlue", "SaddleBrown", "Salmon", "SandyBrown", "SeaGreen", "SeaShell", "Sienna", "Silver", "SkyBlue", "SlateBlue", "SlateGray", "SlateGrey", "Snow", "SpringGreen", "SteelBlue", "Tan", "Teal", "Thistle", "Tomato", "Turquoise", "Violet", "Wheat", "White", "WhiteSmoke", "Yellow", "YellowGreen"];
        var scores = JSON.parse('{!! json_encode(($scores)) !!}');
        var dates = JSON.parse('{!! json_encode(($dates)) !!}');
        var chartData = [];
        var count = 0;

        function renderChart() {

            console.log(chartData,scores,dates);
            for(var i=0; i<dates.length; i++){
                dates[i] = moment(dates[i].date).format("MM/DD/YYYY");
            }

            Highcharts.chart('assessment-chart', {

                title: {
                    text: 'Statistics'
                },

                xAxis: {
                    title: {
                        text: 'Assessments'
                    },
//                    categories: [1,2,3,4,5,6,7,8,9,10]
                    categories: dates
                },
                yAxis: {
                    title: {
                        text: 'Score'
                    },
                    categories: [1,2,3,4,5]
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

            $('#organization-table').DataTable({
                dom: 'Bfrtip',
                buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
            });

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
        }
    </script>
@endsection