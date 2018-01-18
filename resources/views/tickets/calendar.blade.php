@extends('layouts.app')
@section('content')
    @include('includes.main-menu')
    <div class="container-fluid">
        <div class="row m-t-20">
            <div class="col-md-12">
            <div class="white-box">

            <h3 class="box-title">Drag and drop your event</h3>
                <div class="m-t-20">
                    @foreach($tickets as $ticket)
                        <div class="calendar-event" data-id="{{$ticket->id}}" data-class="bg-custom">{{$ticket->title}} <a href="javascript:void(0);" class="remove-calendar-event"><i class="ti-close"></i></a></div>
                    @endforeach
                </div>
                <div class="m-t-20">
                    <button type="button" class="btn btn-success" id="add-event">Add Event</button>
                    <button type="button" class="btn btn-default m-l-10" id="event-list" onclick="$('#eventlistForm').submit()">All Events</button>
                    <div class="hidden">
                        <form id="eventlistForm" action="{{url('tickets/events')}}" method="get">
                            {{csrf_token()}}
                        </form>
                    </div>
                </div>

            </div>
            </div>
            <div class="col-md-12">
                <div class="white-box">
                    <div id="calendar"></div>
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
    <div id="ticket-editor" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form action="{{ url('tickets/' . old('ticket.id')) }}" method="post">

                {{ csrf_field() }}
                @if(old('ticket.id'))
                    {{ method_field('put') }}
                    <input type="hidden" name="ticket[id]" value="{{ old('ticket.id') }}">
                @else
                    {{ method_field('post') }}
                @endif

                <input type="hidden" name="ticket[learner_id]" value="{{ $learnerId }}">


                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title" id="myModalLabel">Create Ticket</h4>
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
                                    <option value="{{ $learning->id }}">
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
                        <div class="form-group">
                            <label>Note</label>
                            <textarea id="note" class="form-control" type="text" name="assignment[note]" value="{{ old('ticket.note') }}" ></textarea>
                        </div>
                        <div class="form-group">
                            <div class="panel-group">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" href="#collapse1">All Activity</a>
                                        </h4>
                                    </div>
                                    <div id="collapse1" class="panel-collapse collapse">
                                        <ul class="list-group" id="activity">
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Do's & Dont's:</label>
                            <a href="javascript:" class="dos-donts">Click here</a>
                        </div>

                        <div class="hidden">
                            <input type="hidden" name="assignment[id]" value="{{ old('assignment.id') }}">
                            <input type="hidden" name="assignment[ticket_id]" value="{{ old('assignment.ticket_id') }}">
                            <input type="hidden" name="assignment[target_date]" value="{{ old('assignment.target_date') }}">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="archive-ticket" type="submit" name="ticket[archive]" value="true" class="btn btn-warning waves-effect pull-left">Acrhive</button>
                        <button id="complete-ticket" type="submit" name="ticket[complete]"  value="true" class="btn btn-success waves-effect pull-left">Mark Complete</button>
                        <button id="save-ticket" type="submit"  name="submit" value="true" class="btn btn-info waves-effect">Save</button>
                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
                <input type="submit" class="hidden" id="submit">
                <!-- /.modal-content -->
            </form>
        </div>
        <!-- /.modal-dialog -->
    </div>

    <script>

        var selectedTicketDate = null;
        var tickets = [];
        var notes_arr={};

        var ticketsJSON = JSON.parse('{!! json_encode($assignments) !!}');
        var formAction = document.querySelector('#ticket-editor form').getAttribute('action');
        var tickets_arr=JSON.parse('{!! json_encode($tickets) !!}');

        for (var j=0;j<tickets_arr.length;j++){
            var id=tickets_arr[j]['id'];
            var noteslist='';
            for(var k=0;k<tickets_arr[j]['assignments'].length;k++){

                noteslist+='<li class="row list-group-item"><span class="col-sm-3">'+tickets_arr[j]['assignments'][k]['target_date']+'</span> <span class="col-sm-9">'+tickets_arr[j]['assignments'][k]['note']+'</span></li>';

            }
            notes_arr[id] = noteslist
        }
        function initCalendar() {

            for(var i =0; i<ticketsJSON.length; i++){

                if(ticketsJSON[i].is_archived){
                    var color = '#f8c255';
                }
                else if(ticketsJSON[i].ticket.is_completed){
                    var color = '#28A745';
                }
                else{
                    var color = '#008efa';
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
                    target_date: (new Date(ticketsJSON[i].target_date)),
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
                eventClick: function (calEvent, jsEvent, view) {
                     $("input[name='assignment[id]']").val(calEvent.id);
                    initTicketEditor(calEvent,'Edit');
                    $('#ticket-editor').modal('show');
                    $('#award-title').val(calEvent.title);
                },
                drop:function( date, jsEvent, ui, resourceId ) {
                    $('#ticket-editor input[name="_method"]').val('post');
                    $('#ticket-editor').find('input[name="assignment[target_date]"]').val((new Date(date)).toISOString().slice(0, 10));
                    $('#ticket-editor').find('input[name="assignment[ticket_id]"]').val($(this).data('id'));

                    $('#ticket-editor').find('form').attr('action','{{ url('assignments') }}');
                    $('#ticket-editor').find('#submit').trigger('click');
                },
                eventDrop: function(event, delta, revertFunc) {

                    $('#ticket-editor input[name="_method"]').val('put');
                    $('#ticket-editor').find('input[name="assignment[target_date]"]').val(event.start.format());
                    $('#ticket-editor').find('input[name="assignment[ticket_id]"]').val(event.ticket.id);
                    $('#ticket-editor').find('form').attr('action','{{ url('assignments') }}' + '/' + event.id);
                    $('#ticket-editor').find('#submit').trigger('click');

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
                    $(this).draggable({
                        zIndex: 1111999,
                        revert: true,      // will cause the event to go back to its
                        revertDuration: 0  //  original position after the drag
                    });
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
                    $('<div class="calendar-event">' + $(this).val() + '<a href="javascript:void(0);" class="remove-calendar-event"><i class="ti-close"></i></a></div>').insertBefore(".add-event");
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
                initTicketEditor();
                $('#ticket-editor').modal('show');
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

        function initTicketEditor(ticket = null, mode = 'Create') {
            var id = ticket ? ticket.ticket.id : '';
            var title = ticket ? ticket.title : '';
            var targetDate = ticket ? ticket.target_date : selectedTicketDate;
            var note = ticket ? ticket.note : '';
            var impactLevel = ticket ? ticket.impact_level : '';
            var isArchived = ticket ? ticket.is_archived : false;
            var isCompleted = ticket ? ticket.ticket.is_completed : false;
            var notes_in=ticket ? ticket.notes : '';

//            console.log(moment(selectedTicketDate).format('m/d/y'),selectedTicketDate, targetDate, targetDate.format('m/d/y'));

            $('#ticket-title').val(title);
            $('#target-date').val(moment(targetDate).format('MM/DD/YYYY'));
            $('#note').val(note);
            $('#activity').empty().append(notes_in);

            if(isArchived || isCompleted){
                mode = '';
                $("#note").parent().show();
                $('#archive-ticket,#save-ticket,#ticket-title,#target-date,#note,#impact,#learning-module').attr('readonly','');
                $('#ticket-editor .modal-footer').hide();
            }else{
                $("#note").parent().show();
                $('#archive-ticket,#save-ticket,#ticket-title,#note,#impact,#learning-module').removeAttr('readonly');
                $('#ticket-editor .modal-footer').show();
            }
            if(mode == 'Create'){
                $("#note").parent().hide();
                $('#archive-ticket').hide();
                $("#complete-ticket").hide();
                $('#ticket-editor input[name="_method"]').val('post');
            }
            if(mode == 'Edit'){
                $('#ticket-editor form').attr('action', formAction + '/' + id);
                $('#archive-ticket').show();
                $("#complete-ticket").show();
                $("#note").parent().show();
                $('#ticket-editor input[name="_method"]').val('put');
            }

            $('#ticket-editor').find('.modal-title').text(mode + ' Ticket');
        }



    </script>
@endsection