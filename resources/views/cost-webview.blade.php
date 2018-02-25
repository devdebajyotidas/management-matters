@extends('layouts.app')
@section('content')
    @include('includes.main-menu')
    <style>
        .goto-cal{
            position: fixed;
            top: 100px;
            right: 30px;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            font-size: 20px;
            line-height: 50px;
            background-color: #f75b36;
            color:#fff;
            text-align: center;
            cursor: pointer;
            box-shadow: 0 3px 7px rgba(0,0,0,.14);
        }
        nav, #mainTable_filter, #mainTable_info, #mainTable_paginate{
            display: none;
        }
        #page-wrapper {
            margin: 0px!important;
        }
    </style>

    <div class="container">
        <div class="row m-t-15">
            <div class="col-md-12">
                <div class="white-box">
                    {!! $content !!}

                    <p>Because we all are responsible for the bottom line, to one degree or another, the costs of doing business are
                        important to each and every one of us. It’s easy to find out the cost of wages, machines, tools, supplies and
                        services so our attention can become fixed on those tangible items. However, when it come to the performance of
                        people the costs are not so obvious. Management Matters makes a commitment to help you identify these costs in
                        all our Modules, when appropriate. </p>
                    <p>MUST PROVIDE SIMILAR TYPE WORKSHEET, RIGTH AFTER THIS EXAMPLE AND TEXT, THEN THIS SECTION TOTAL GETS TOTALED TO
                        THE DASHBOARD SECTION….CUMULATIVE TO THE NUMBER OF MODULES THEY HAVE PURCHASED.</p>
                    <hr>
                    <p>
                        <span> <b>A</b> = Behavior/Personality Issue or Concern </span>
                        <br>
                        <span> <b>B</b> = Average Hourly Wage ($) </span>
                        <br>
                        <span> <b>C</b> = X Number of Employees </span>
                        <br>
                        <span> <b>D</b> = Lost Hours Per Week </span>
                        <br>
                        <span> <b>X</b> = Total ($) </span>
                    </p>
                    <table id="mainTable" class="table editable-table table-bordered table-striped m-b-0" style="margin: 20px 0">
                        <thead>
                        <tr>
                            <th class="noedit">A</th>
                            <th>B</th>
                            <th>C</th>
                            <th>D</th>
                            <th>X</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(isset($cost['name']))
                            @foreach($cost['name'] as $key=>$name)
                                <tr>
                                    <td>{{$name}}</td>
                                    <td>{{$cost['hourly_wage'][$key]}}</td>
                                    <td>{{$cost['emp_num'][$key]}}</td>
                                    <td>{{$cost['lost_hours'][$key]}}</td>
                                    <td>{{$cost['hourly_wage'][$key]*$cost['emp_num'][$key]*$cost['lost_hours'][$key]}}</td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                        <tfoot>
                        <tr>
                            <th><strong>TOTAL</strong></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                        </tfoot>
                    </table>
                    <div class="hidden">
                        <form method="post" action="">
                            {{ csrf_field() }}
                            <input type="hidden" name="name" class="cost-name">
                            <input type="hidden" name="hourly_wage" class="hourly-wage">
                            <input type="hidden" name="emp_num" class="emp-num">
                            <input type="hidden" name="lost_hours" class="lost-hours">
                            <input type="hidden" name="total" class="cost-total">
                            <input type="submit" value="true" id="saveCost">
                        </form>
                    </div>
                    <button class="btn btn-block btn-primary" id="prepare-cost" style="margin: 20px 0">Save</button>
                </div>
            </div>
        </div>
    </div>

    <div class="goto-cal"><i class="fa fa-calculator"></i></div>

    <script>
        window.onscroll=function(){
            if (inView($("#mainTable"))) {
                $('.goto-cal').fadeOut('fast')
            } else {
               $('.goto-cal').fadeIn('fast')
            }
        }
        window.onload=function(){
            if (inView($("#mainTable"))) {
                $('.goto-cal').fadeOut('fast')
            }
            else{
                $('.goto-cal').fadeIn('fast')
            }
            $(".goto-cal").click(function(){
                navigationFn.goToSection('#mainTable');
            });
            $('#prepare-cost').click(function(){

                var $table=$('#mainTable tbody');
                var names = $table.find('td:first-child').map(function() {
                    return '"'+$(this).html()+'"';
                }).get();
                var wage = $table.find('td:nth-child(2)').map(function() {
                    return '"'+$(this).html()+'"';
                }).get();
                var empnum = $table.find('td:nth-child(3)').map(function() {
                    return '"'+$(this).html()+'"';
                }).get();
                var lost = $table.find('td:nth-child(4)').map(function() {
                    return '"'+$(this).html()+'"';
                }).get();

                var total=$('#mainTable tfoot').find('th:last-child').html();

                $('.cost-name').val('['+names.toString()+']');
                $('.hourly-wage').val('['+wage.toString()+']');
                $('.emp-num').val('['+empnum.toString()+']');
                $('.lost-hours').val('['+lost.toString()+']');
                $('.cost-total').val(total);
                $('#saveCost').trigger('click');
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
        };

        function inView(obj){
            var elementTop = obj.offset().top;
            var elementBottom = elementTop + obj.outerHeight();

            var viewportTop = $(window).scrollTop();
            var viewportBottom = viewportTop + $(window).height();

            return elementBottom > viewportTop && elementTop < viewportBottom;
        }
        var navigationFn = {
            goToSection: function(id) {
                $('html, body').animate({
                    scrollTop: $(id).offset().top
                }, 500);
            }
        }
    </script>
@endsection