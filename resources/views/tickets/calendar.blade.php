@extends('layouts.app')
@section('content')
    <style>
        .edit-calendar-event{
            color:#fff;
            font-weight: bold;
            display: inline-block;
        }
        .remove-calendar-event{
            color:#fff;
            font-weight: bold;
            display: inline-block;
            float: right;
        }
        .calender-event-wrapper{
            padding: 0;
            list-style-type: none;
        }
        .scrollable{
            position: relative;
            float: left;
            width: calc(100% + 20px);
            margin-left: -5px;
        }
        .calendar-event{
            text-align: left;
        }
        .list-group-item{
            border: none;
        }
        .ticket-type{
            font-size: 14px;
            text-transform: uppercase;
            font-weight:400;
        }
    </style>
    @include('includes.main-menu')
    <div class="firework"></div>
    <div class="container-fluid">
        <div class="row m-t-15">
            <div class="col-md-12">
                <div class="white-box">
                    <div class="row">
                        <div class="col-lg-3 p-20">
                            <div class="m-b-0 m-t-0 btn-wrapper">
                                <button type="button" class="btn btn-success" id="add-event">Add Ticket</button>
                                <button type="button" class="btn btn-default m-l-10" id="event-list" onclick="$('#eventlistForm').submit()">All Tickets</button>
                                <div class="hidden">
                                    <form id="eventlistForm" action="{{url('tickets/events')}}" method="get">
                                        {{csrf_token()}}
                                    </form>
                                </div>
                            </div>
                            <hr>
                            <?php
                            $completed=array();
                            $archived=array();
                            $open=array();
                            foreach ($tickets as $ticket){
                                if($ticket->is_completed==1){
                                    array_push($completed,$ticket);
                                }
                                elseif($ticket->is_archived){
                                    array_push($archived,$ticket);
                                }
                                else{
                                    array_push($open,$ticket);
                                }
                            }
                            ?>
                            <div class="m-t-15">
                                @if(count($open) > 0)
                                    <a href="#open-tickets" data-toggle="collapse" class="ticket-type">Open tickets</a>
                                    <div class="m-t-5 collapse in" id="open-tickets">
                                        @foreach($open as $ticket)
                                            <div class="calendar-event draggble" data-id="{{$ticket->id}}" data-class="bg-custom">{{$ticket->title}} <a href="javascript:void(0);" class="remove-calendar-event"><i class="ti-close"></i></a> <a href="javascript:void(0);" data-id="{{$ticket->id}}" class="edit-calendar-event"><i class="ti-pencil"></i></a></div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>

                            <div class="m-t-15">
                                @if(count($completed) > 0)
                                    <a href="#archived-tickets" class="text-warning ticket-type" data-toggle="collapse">Archived tickets</a>
                                    <div class="m-t-5 collapse" id="archived-tickets">
                                        @foreach($completed as $ticket)
                                            <div class="calendar-event  bg-warning" data-id="{{$ticket->id}}" data-class="bg-custom" style="background-color: #ffc107">{{$ticket->title}} <a href="javascript:void(0);" class="remove-calendar-event"><i class="ti-close"></i></a> <a data-id="{{$ticket->id}}" href="javascript:void(0);" class="edit-calendar-event"><i class="ti-pencil"></i></a></div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>

                            <div class="m-t-15">
                                @if(count($completed) > 0)
                                    <a href="#completed-tickets" class="text-success ticket-type" data-toggle="collapse">Completed tickets</a>
                                    <div class="m-t-5 collapse" id="completed-tickets">
                                        @foreach($completed as $ticket)
                                            <div class="calendar-event" data-id="{{$ticket->id}}" data-class="bg-custom" style="background-color: #28a745;">{{$ticket->title}} <a href="javascript:void(0);" class="remove-calendar-event"><i class="ti-close"></i></a> <a data-id="{{$ticket->id}}" href="javascript:void(0);" class="edit-calendar-event"><i class="ti-pencil"></i></a> </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                            @foreach($tickets as $ticket)

                                @if($ticket->is_completed==1)
                                    <?php $title="<span class='text-success'>This ticket has been completed</span>" ?>
                                @elseif($ticket->is_archived)
                                    <?php $title="<span class='text-warning'>This ticket has been archived</span>" ?>
                                @else
                                    <?php $title="<span>Edit Ticket</span>" ?>
                               @endif
                                <div id="ticket-editor-{{$ticket->id}}" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                                     aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <form action="{{ url('tickets/' . $ticket->id) }}" method="post">

                                            {{ csrf_field() }}
                                            {{ method_field('put') }}

                                            <input type="hidden" name="ticket[learner_id]" value="{{ $learnerId }}">

                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    <h4 class="modal-title" id="myModalLabel"><?php echo $title?></h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label>Ticket Name</label>
                                                        <input id="ticket-title" class="form-control" type="text" name="ticket[title]" value="{{ $ticket->title }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Module</label>
                                                        <select id="learning-module" class="form-control" name="ticket[learning_id]">
                                                            @foreach($learnings as $learning)
                                                                <option value="{{ $learning->id }}" {{($ticket->learning_id==$learning->id) ? 'selected' : ''}}>
                                                                    {{ $learning->title }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Impact Level</label>
                                                        <select id="impact" class="form-control" name="ticket[impact_level]">
                                                            <option value="High" {{$ticket->impact_level=="High" ? "selected" : ''}}>High</option>
                                                            <option value="Medium" {{$ticket->impact_level=="Medium" ? "selected" : ''}}>Medium</option>
                                                            <option value="Low" {{$ticket->impact_level=="Low" ? "selected" : ''}}>Low</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="panel-group">
                                                            <div class="panel panel-default">
                                                                <div class="panel-heading">
                                                                    <h4 class="panel-title">
                                                                        <a data-toggle="collapse" href="#collapse1-{{$ticket->id}}">All Activity</a>
                                                                    </h4>
                                                                </div>
                                                                <div id="collapse1-{{$ticket->id}}" class="collapse">
                                                                    <ul class="list-group" id="activity">
                                                                        @if(count($ticket->assignments) > 0)
                                                                            @foreach($ticket->assignments as $assignment)
                                                                                <li class="row list-group-item"><span class="col-sm-3">{{$assignment->target_date}}</span> <span class="col-sm-9">{{!empty($assignment->note) ? $assignment->note : 'No activity'}}</span></li>
                                                                            @endforeach
                                                                        @else
                                                                            <li class="row list-group-item">No activity yet</li>
                                                                        @endif
                                                                    </ul>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Do's & Dont's:</label>
                                                        <a href="javascript:" class="dos-donts">Click here</a>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    @if($ticket->is_completed==0 && $ticket->is_archived==0)
                                                        <button id="archive-ticket" type="submit" name="ticket[archive]" value="true" class="btn btn-warning waves-effect pull-left">Acrhive</button>
                                                        <button id="complete-ticket" type="submit" name="ticket[complete]"  value="true" class="btn btn-success waves-effect pull-left">Mark Complete</button>
                                                        <button id="save-ticket" type="submit"  name="submit" value="true" class="btn btn-info waves-effect">Save</button>
                                                    @endif

                                                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancel</button>
                                                </div>
                                            </div>
                                            <input type="submit" class="hidden" id="submit">
                                            <!-- /.modal-content -->
                                        </form>
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                            @endforeach
                        </div>
                        <div class="col-lg-9 m-t-5">
                            <div class="clearfix"></div>
                            <div id="calendar"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="hidden">
        <form id="removeEventForm" action="{{ url('tickets/' . old('ticket.id')) }}" method="post">
            {{ csrf_field() }}
            {{ method_field('delete') }}
        </form>
    </div>

    <div id="assignment-editor" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form action="" method="post" id="assignmentForm">

                {{ csrf_field() }}
                {{ method_field('put') }}

                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title" id="myModalLabel">Ticket Assignment</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Ticket Name</label>
                            <input id="assignment-title" class="form-control" type="text" name="ticket[title]" value="{{ old('ticket.title') }}">
                        </div>
                        <div class="form-group">
                            <label>Target Date</label>
                            <input id="assignment-target-date" class="form-control" type="text" name="assignment[target_date]" value="{{ old('ticket.target_date') }}" readonly>
                        </div>
                        <div class="form-group">
                            <label>Note</label>
                            <textarea id="assignment-note" class="form-control" type="text" name="assignment[note]" value="{{ old('ticket.note') }}" ></textarea>
                        </div>
                        <div class="hidden">
                            <input type="hidden" name="assignment[id]" value="{{ old('assignment.id') }}">
                            <input type="hidden" name="assignment[ticket_id]" value="">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="delete-assignment" type="button" class="btn btn-danger waves-effect pull-left">Delete</button>
                        <button id="save-ticket" type="submit"  name="submit" value="true" class="btn btn-info waves-effect">Save</button>
                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
                <input type="submit" class="hidden" id="submit">
                <!-- /.modal-content -->
            </form>
            <div class="hidden">
                <form id="deleteAssignmentForm" action="" method="post">
                    {{ csrf_field() }}
                    {{ method_field('delete') }}
                    <input type="hidden" class="hidden-id">
                    <input type="submit" class="delete-ticket-submit" value="delete">
                </form>
            </div>
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div id="newticket-editor" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form action="{{ url('tickets') }}" method="post">

                {{ csrf_field() }}
                <input type="hidden" name="ticket[learner_id]" value="{{ $learnerId }}">


                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title" id="myModalLabel">Tickt Assignment</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Ticket Name</label>
                            <input id="ticket-title" class="form-control" type="text" name="ticket[title]" value="{{ old('ticket.title') }}">
                        </div>
                        <div class="form-group">
                            <label>Module</label>
                            <select id="learning-module" class="form-control" name="ticket[learning_id]">
                                @foreach($learnings as $learning)
                                    <option value="{{$learning->id}}">
                                        {{ $learning->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Impact Level</label>
                            <select id="impact" class="form-control" name="ticket[impact_level]">
                                <option value="High">High</option>
                                <option value="Medium">Medium</option>
                                <option value="Low">Low</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="save-ticket" type="submit"  name="submit" value="true" class="btn btn-info waves-effect">Save</button>
                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
                <input type="submit" class="hidden" id="submit">
                <!-- /.modal-content -->
            </form>
            {{--<div class="hidden">--}}
                {{--<form id="deleteTicketForm" action="" method="post">--}}
                    {{--{{ csrf_field() }}--}}
                    {{--<input type="hidden" class="hidden-id">--}}
                    {{--<input type="submit" class="delete-ticket-submit" value="delete">--}}
                {{--</form>--}}
            {{--</div>--}}
        </div>
        <!-- /.modal-dialog -->
    </div>


    <script>

        var selectedTicketDate = null;
        var tickets = [];
        var notes_arr={};

        var ticketsJSON = JSON.parse('{!! json_encode($assignments) !!}');
        var formAction = document.querySelector('#assignment-editor form').getAttribute('action');
        var tickets_arr=JSON.parse('{!! json_encode($tickets) !!}');

        for (var j=0;j<tickets_arr.length;j++){
            var id=tickets_arr[j]['id'];
            var noteslist='';
            for(var k=0;k<tickets_arr[j]['assignments'].length;k++){

                noteslist+='<li class="row list-group-item"><span class="col-sm-3">'+tickets_arr[j]['assignments'][k]['target_date']+'</span> <span class="col-sm-9">'+tickets_arr[j]['assignments'][k]['note'] +'</span></li>';

            }
            notes_arr[id] = noteslist
        }
        function initCalendar() {

            for(var i =0; i<ticketsJSON.length; i++){

                if(ticketsJSON[i].is_archived){
                    var color = '#ffc107';
                }
                else if(ticketsJSON[i].ticket.is_completed){
                    var color = '#28a745';
                }
                else{
                    var color = '#007bff';
                }
                var ticket = {
                    // Required params for FullCalendar Plugin
                    title: ticketsJSON[i].title,
                    start: (new Date(ticketsJSON[i].target_date)),
                    allDay: true,
                    color: color,

                    // Additional params for the application
                    id:  ticketsJSON[i].id,
                    learning_id: ticketsJSON[i].learning_id,
                    learner_id: ticketsJSON[i].learner_id,
                    target_date: moment(ticketsJSON[i].target_date).utc().toDate(),
                    note:ticketsJSON[i].note,
                    impact_level: ticketsJSON[i].impact_level,
                    is_archived: ticketsJSON[i].is_archived,
                    ticket: ticketsJSON[i].ticket,
                    notes:notes_arr[ticketsJSON[i].ticket.id]
                };
                tickets.push(ticket);
            }

            $('#calendar').fullCalendar({

                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                editable: true,
                droppable: true, // this allows things to be dropped onto the calendar
                eventLimit: true, // allow "more" link when too many events
                events: tickets,
                timezone: 'UTC',
                eventClick: function (calEvent, jsEvent, view) {
                    $("input[name='assignment[id]']").val(calEvent.id);
                    initTicketEditor(calEvent,'Edit');
                    $('#assignment-editor').modal('show');
                    $('#award-title').val(calEvent.title);
                    $('#assignment-editor').find('input[name="assignment[ticket_id]"]').val(calEvent.ticket.id);
                    $('#deleteAssignmentForm').attr('action', '{{ url('assignments/delete') }}' + '/' + calEvent.id);
                    $('#assignmentForm').attr('action', '{{ url('assignments') }}' + '/' + calEvent.id);
                },
                drop:function( date, jsEvent, ui, resourceId ) {
                    $('#assignment-editor input[name="_method"]').val('post');
                    $('#assignment-editor').find('input[name="assignment[target_date]"]').val((new Date(date)).toISOString().slice(0, 10));
                    $('#assignment-editor').find('input[name="assignment[ticket_id]"]').val($(this).data('id'));
                    $('#assignment-editor').find('form').attr('action','{{ url('assignments') }}');
                    $('#assignment-editor').find('#submit').trigger('click');
                },
                eventDrop: function(event, delta, revertFunc) {

                    $('#assignment-editor input[name="_method"]').val('put');
                    $('#assignment-editor').find('input[name="assignment[target_date]"]').val(event.start.format());
                    $('#assignment-editor').find('input[name="assignment[ticket_id]"]').val(event.ticket.id);
                    $('#assignment-editor').find('form').attr('action', '{{ url('assignments') }}' + '/' + event.id);
                    $('#assignment-editor').find('#submit').trigger('click');

                }

            });
        }
        window.onload=function () {


            var drag =  function() {
                $('.calendar-event').each(function() {

                    // store data so the calendar knows to render an event upon drop
                    $(this).data('event', {
                        title: $.trim($(this).text()), // use the element's text as the event title
                        stick: true // maintain when user navigates (see docs on the renderEvent method)
                    });

                    // make the event draggable using jQuery UI
                    if($(this).hasClass('draggble')){
                        $(this).draggable({
                            zIndex: 999,
                            revert: true,      // will cause the event to go back to its
                            revertDuration: 0  //  original position after the drag
                        });
                    }
                });
            };

            var removeEvent =  function() {
                $('.remove-calendar-event').click(function() {
                    var removeAction=document.querySelector('#removeEventForm').getAttribute('action');
                    var removeid=$(this).closest('.calendar-event').data('id');
                    var $this=$(this);
                    swal({
                        title: 'Delete Ticket?',
                        text: "You can't revert this later.",
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete'
                    }).then(function(result){
                        if(result.value){
                            $('#removeEventForm').attr('action',removeAction+"/"+removeid).submit();
                            $this.closest('.calendar-event').fadeOut();
                            return false;
                        }

                    })
                });
            };

            $(".add-event").keypress(function (e) {
                $("input[name='assignment[id]']").val('');
                if ((e.which == 13)&&(!$(this).val().length == 0)) {
                    $('<div class="calendar-event">' + $(this).val() + '<a href="javascript:void(0);" class="edit-calendar-event"><i class="ti-pencil"></i></a> <a href="javascript:void(0);" class="remove-calendar-event"><i class="ti-close"></i></a></div>').insertBefore(".add-event");
                    $(this).val('');
                } else if(e.which == 13) {
                    alert('Please enter event name');
                }
                drag();
                removeEvent();
            });


            drag();
            removeEvent();


            initCalendar();

            $('#save-ticket').click(function () {
                $('#calendar').fullCalendar('renderEvent', {
                    title: $('#ticket-name').val(),
                    start: selectedTicketDate, // new Date()
                    allDay: true
                });

                $('#ticket-editor').modal('hide');
            });
            $('#add-event').click(function(){
                $('#newticket-editor').modal('show');
            });

            @if(session()->has('success') || session('success'))
            @if(!empty(session('award')))
            firework();
            @endif
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

            $('#delete-assignment').click(function(){
                $('.delete-ticket-submit').trigger('click');
            })

            $('.edit-calendar-event').each(function(){
                $(this).click(function(){
                    var id=$(this).data('id');
                    $('#ticket-editor-'+id).modal('show');
                })
            })
        };

        function initTicketEditor(ticket = null) {
            var id = ticket ? ticket.ticket.id : '';
            var title = ticket ? ticket.title : '';
            var targetDate = ticket ? ticket.target_date : selectedTicketDate;
            var note = ticket ? ticket.note : '';
            var isArchived = ticket ? ticket.is_archived : false;
            var isCompleted = ticket ? ticket.ticket.is_completed : false;

            $('#assignment-title').val(title);
            $('#assignment-target-date').val(moment(targetDate).format('MM/DD/YYYY'));
            $('#assignment-note').val(note);

            if(isArchived || isCompleted){
                $("#assignment-note").parent().show();
                $('#save-ticket,#assignment-title,#assignment-target-date,#assignment-note,#delete-ticket').attr('readonly','');
                $('#assignment-editor .modal-footer').hide();
                if(isCompleted){
                    $('#assignment-editor').find('.modal-title').removeClass('text-warning')
                    $('#assignment-editor').find('.modal-title').text( 'This ticket has been completed').addClass('text-success');
                }
                else{
                    $('#assignment-editor').find('.modal-title').removeClass('text-success');
                    $('#assignment-editor').find('.modal-title').text( 'This ticket has been archived').addClass('text-warning');
                }

            }else{
                $("#assignment-note").parent().show();
                $('#save-ticket,#ticket-title,#assignment-note,#delete-ticket').removeAttr('readonly');
                $('#assignment-editor .modal-footer').show();
                $('#assignment-editor').find('.modal-title').removeClass('text-warning');
                $('#assignment-editor').find('.modal-title').removeClass('text-success');
            }

            // if(mode == 'Create'){
            //     $("#note").parent().hide();
            //     $('#archive-ticket').hide();
            //     $("#complete-ticket").hide();
            //     $("#delete-ticket").hide();
            //     $('#assignment-editor input[name="_method"]').val('post');
            //     $('#assignment-editor').find('.modal-title').text(mode + ' Ticket');
            // }
            // if(mode == 'Edit'){
            //     $('#assignment-editor form').attr('action', formAction + '/' + id);
            //     $('#archive-ticket').show();
            //     $("#complete-ticket").show();
            //     $("#delete-ticket").show();
            //     $("#note").parent().show();
            //     $('#assignment-editor input[name="_method"]').val('put');
            //     $('#assignment-editor').find('.modal-title').text(mode + ' Ticket');
            // }


        }

    </script>
@endsection