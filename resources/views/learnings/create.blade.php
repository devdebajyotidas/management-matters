@extends('layouts.app')
@section('content')
    @include('includes.main-menu')

    <div class="container-fluid">
        <div class="white-box m-t-15">
            <div class="row ">
                <div class="col-md-12">
                    @if(session('role')=='admin')
                        <h3>New Learning Module</h3>
                    @else
                        <h3>Edit Learning Module</h3>
                    @endif

                </div>
            </div>
        </div>
        <form action="" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            @if(isset($learning))
                {{ method_field('put') }}
            @endif

            @if(session('role')=="admin")
            <div class="row m-t-30">
                <div class="col-sm-12">
                    <div class="white-box">
                        @if(isset($learning))
                            <h3 class="box-title m-b-0">Edit Learning Module</h3>
                        @else
                            <h3 class="box-title m-b-0">Create New Learning Module</h3>
                        @endif
                        <small>You can set content on the fly.</small>
                        <hr>
                        <div class="form-group">
                            <input class="form-control" type="text" name="title" placeholder="Title"
                                   @if(isset($learning)) value="{{ $learning->title }}" @endif>
                        </div>
                        <div class="form-group">
                        <textarea class="form-control" name="description" id="" cols="30" rows="10"
                                  placeholder="Write a short description"
                                  @if(isset($learning))  @endif>{{ isset($learning) ? trim($learning->description): ''}}</textarea>
                        </div>
                        <div class="form-group">
                            <input class="form-control tags-input" type="text" name="highlights"
                                   value="@if(isset($learning->highlights)) {{ implode(',', $learning->highlights) }} @endif"
                                   placeholder="Key features (Type and press Return)"
                                   style="width: 100%!important;">
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
            @endif

            <div class="row m-t-10">
                <div class="col-sm-12">
                    <div class="white-box">
                        <h3 class="box-title m-b-0">Featured Image</h3>
                        <div class="m-b-0" id="image-preview">
                            @if(!empty($learning->image))
                                <img id="preview" src="{{asset('uploads/'.$learning->image)}}" alt="" style="max-height: 300px">
                            @endif
                        </div>
                        @if(session('role')=='admin')
                            <div class="m-b-0 m-t-15">
                                <button type="button" class="btn btn-primary waves-effect waves-light" onclick="$('#image-change').trigger('click')">Upload Image</button>
                                <input class="hidden" id="image-change" type="file" name="image" onchange="previewImage(this)">
                            </div>
                        @endif

                    </div>
                </div>
            </div>

            <div class="row m-t-10">
                <div class="col-sm-12">
                    <div class="white-box">
                        <h3 class="box-title m-b-0">Introduction</h3>
                        <small>You can set custom introduction for every module.</small>
                        <textarea id="introduction" name="introduction">
                                @php
                                    $intro=isset($learning->introduction) ? $learning->introduction : '';
                                @endphp
                                @if(session('role')=='organization')
                                    {{isset($learning->orgintro->org_introduction) ? $learning->orgintro->org_introduction : $intro }}
                                @else
                                    {{$intro}}
                                @endif
                        </textarea>
                    </div>
                </div>
            </div>

            @if(session('role')=="admin")
             <a href="javascript:void(0)" onclick="checkQuiz()">Check Quiz</a>
            <div class="row">
                <div class="col-sm-12">
                    <div class="white-box">
                        <h3 class="box-title">Learning Material</h3>
                        <div id="learning-content" class="vtabs">
                            <ul class="nav tabs-vertical">
                                <li class="tab active">
                                    <a data-toggle="tab" href="#vihome3" aria-expanded="true"> <span><i
                                                    class="fa fa-book"></i></span> Chapters</a>
                                </li>
                                <li class="tab">
                                    <a data-toggle="tab" href="#viprofile3" aria-expanded="false"> <span><i
                                                    class="fa fa-pencil"></i></span> Assessments</a>
                                </li>
                                <li class="tab">
                                    <a aria-expanded="false" data-toggle="tab" href="#vimessages3"> <span><i
                                                    class="fa fa-question"></i></span> Quiz</a>
                                </li>
                            </ul>
                            <div class="tab-content p-t-0">
                                <div id="vihome3" class="tab-pane active">
                                    <button id="add-chapter" class="btn btn-info btn-rounded"
                                            type="button">Add New Chapter
                                    </button>
                                    <div id="chapter-list" class="list-group m-t-10">
                                        @if(isset($learning))
                                            @if(isset($learning->chapters))
                                                <?php $chapters=array_values($learning->chapters);
                                                usort($chapters, function($a, $b) {
                                                    if(isset($a['index']))
                                                        return $a['index'] - $b['index'];
                                                    else
                                                        return 0;
                                                });
                                                //sort($chapters);
                                                ?>
                                                @foreach($chapters as $key => $chapter)
                                                    <a href="javascript:void(0)" class="list-group-item row chapter" data-id="{{ $key }}">
                                                        <span class="chapter-name col-sm-10">{{ $chapter['name'] }}</span>
                                                        <input type="hidden" name="chapters[{{ $key }}][index]" value="{{ isset($chapter['index'])? $chapter['index'] : 1 }}">
                                                        <input type="hidden" name="chapters[{{ $key }}][name]" value="{{ $chapter['name'] }}">
                                                        <input type="hidden" name="chapters[{{ $key }}][content]" value="{{ $chapter['content'] }}">
                                                        <span class="m-l-10 pull-right label label-danger remove btn waves-effect">Remove</span>
                                                        <span class="pull-right label label-info edit btn waves-effect">Edit</span>
                                                    </a>
                                                @endforeach
                                            @endif
                                        @endif
                                    </div>
                                </div>
                                <div id="viprofile3" class="tab-pane">
                                    <button id="add-assessment" class="btn btn-info btn-rounded"
                                            type="button">Add New Assessment
                                    </button>
                                    <div id="assessment-list" class="list-group m-t-10">
                                        @if(isset($learning) && is_array($learning->assessments))
                                            @foreach($learning->assessments as $key => $assessment)
                                            <div class="list-group-item row assessment" data-id="{{ $key }}">
                                                <span class="statement col-sm-10">{{ $assessment }}</span>
                                                <input type="hidden" name="assessments[{{ $key }}]" value="{{ $assessment }}">
                                                <span class="m-l-10 pull-right label label-danger remove btn waves-effect">Remove</span>
                                                <span class="pull-right label label-info edit btn waves-effect">Edit</span>
                                            </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                                <div id="vimessages3" class="tab-pane">
                                    <button id="add-question" class="btn btn-info btn-rounded"
                                            type="button">Add New Question
                                    </button>
                                    <div id="question-list" class="list-group m-t-10">
                                        @if(isset($learning))
                                            @if(!empty($learning->quiz) && count($learning->quiz) > 0)
                                                @if(is_array($learning->quiz))
                                                    @foreach($learning->quiz as $key => $quiz)
                                                        <div class="list-group-item row question" data-id="{{ $key }}">
                                                            <span class="qu-name col-sm-10"> {{ $quiz['question'] }} </span>
                                                            <input type="hidden" name="quiz[{{$key}}][question]" value="{{ $quiz['question'] }}">
                                                            @foreach($quiz['content'] as $k=>$ans)
                                                                <input type="hidden" class="answer-block" name="quiz[{{$key}}][content][{{$k}}][answer]" value="{{ $ans['answer'] }}">
                                                                <input type="hidden" name="quiz[{{$key}}][content][{{$k}}][type]" value="{{ $ans['type'] }}">
                                                                <input type="hidden" name="quiz[{{$key}}][content][{{$k}}][note]" value="{{ $ans['note'] }}">
                                                            @endforeach
                                                            <span class="m-l-10 pull-right label label-danger remove btn waves-effect">Remove</span>
                                                            <span class="pull-right label label-info edit btn waves-effect">Edit</span>
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <div href="javascript:void(0)" class="list-group-item row question" data-id="{{ $key }}">
                                                        <span class="qu-name col-sm-10"> {{ $quiz['question'] }} </span>
                                                        <input type="hidden" name="quiz[{{$key}}][question]" value="{{ $quiz['question'] }}">
                                                        @foreach($quiz['content'] as $k=>$ans)
                                                            <input type="hidden" class="answer-block" name="quiz[{{$key}}][content][{{$k}}][answer]" value="{{ $ans['answer'] }}">
                                                            <input type="hidden" name="quiz[{{$key}}][content][{{$k}}][type]" value="{{ $ans['type'] }}">
                                                            <input type="hidden" name="quiz[{{$key}}][content][{{$k}}][note]" value="{{ $ans['note'] }}">
                                                        @endforeach
                                                        <span class="m-l-10 pull-right label label-danger remove btn waves-effect">Remove</span>
                                                        <span class="pull-right label label-info edit btn waves-effect">Edit</span>
                                                    </div>
                                                @endif
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            <div class="row">
                <div class="col-md-12">
                    <div class="white-box">
                        <button type="submit" name="save" value="true" class="btn btn-success btn-rounded">Save Module
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div id="chapter-editor" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel">Add Chapter</h4>
                </div>

                <div class="modal-body">

                    <div class="form-group">
                        <label>Chapter Index</label>
                        <input id="chapter-index" type="number" class="form-control" name="index" placeholder="Index no.">
                    </div>

                    <div class="form-group">
                        <label>Name of Chapter</label>
                        <input id="chapter-name" type="text" class="form-control" name="name" placeholder="Name">
                    </div>

                    <div class="form-group">
                        <label>Content</label>
                        <div id="chapter-content">
                            <h3>Default Heading</h3>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="save-chapter" class="btn btn-info waves-effect">Save</button>
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancel</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div id="assessment-editor" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel">Add Assessment</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input id="assessment" type="text" class="form-control" name="name" placeholder="Statement">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="save-assessment" class="btn btn-info waves-effect">Save</button>
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancel</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div id="quiz-editor" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel">Add Question</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Question</label>
                        <input id="question" type="text" class="form-control" name="question[]" placeholder="Name">
                    </div>
                    <div class="form-content">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="save-quiz" class="btn btn-info waves-effect">Save</button>
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancel</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <script>
        window.onload = function () {

            $('.tags-input').tagsinput({
                maxChars: 50,
                confirmKeys: [13, 44]
            });

            $('.modal').on('hidden.bs.modal', function () {
                selectedChapter = null;
                selectedAssessment = null;
                selectedQuiz = null;
            });

            initEditor('#introduction');

            var selectedAssessment;
            $('#add-assessment').click(function () {
                initAssessmentEditor();
                $('#assessment-editor').modal('show');
            });

            $('#save-assessment').click(function () {
                var assessment = $('#assessment').val();

                if (assessment.trim() == '') {
                    swal('Error', 'Please enter a statement', 'error');
                    return;
                }

                if (selectedAssessment != null) {
                    $('#assessment-list > .assessment[data-id="' + selectedAssessment + '"]').find('.statement').text(assessment);
                    $('#assessment-list > .assessment[data-id="' + selectedAssessment + '"]').find('input[name="assessments[' + selectedAssessment + ']"]').val(assessment);
                } else {
                    var count = $('#assessment-list > .assessment').length;
                    var html = '<div class="list-group-item row assessment" data-id="' + count + '">' +
                        '<span class="statement col-sm-10">' + assessment + '</span>' +
                        '<input type="hidden" name="assessments[' + count + ']" value="' + assessment + '">' +
                        '<span class="m-l-10 pull-right label label-danger btn waves-effect remove">Remove</span>' +
                        '<span class="pull-right label label-info btn waves-effect edit">Edit</span>' +
                        '</div>';
                    $('#assessment-list').append(html);
                }
                selectedAssessment = null;
                $('#assessment-editor').modal('hide');
            });

            $(document).on('click', '#assessment-list > .assessment > .edit', function () {
                selectedAssessment = $(this).parent().attr('data-id');

                var name = $('#assessment-list > .assessment[data-id="' + selectedAssessment + '"]').find('input[name="assessments[' + selectedAssessment + ']"]').val();

                initAssessmentEditor(name, 'Edit');
                $('#assessment-editor').modal('show');
            });

            $(document).on('click', '#assessment-list > .assessment > .remove', function () {
                var that = this;
                swal({
                    title: 'Delete Assessment ?',
                    text: "You won't be able to revert this",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete assessment'
                }).then((result) => {
                    if (result.value){
                        $(that).parent().remove();
                    }
                });
            });


            var selectedChapter;
            $('#add-chapter').click(function () {
                initChapterEditor();
                $('#chapter-editor').modal('show');
            });

            $(document).on('click', '#chapter-list > .chapter > .edit', function () {
                selectedChapter = $(this).parent().attr('data-id');

                var index = $('#chapter-list > .chapter[data-id="' + selectedChapter + '"]').find('input[name="chapters[' + selectedChapter + '][index]"]').val();
                var name = $('#chapter-list > .chapter[data-id="' + selectedChapter + '"]').find('input[name="chapters[' + selectedChapter + '][name]"]').val();
                var content = $('#chapter-list > .chapter[data-id="' + selectedChapter + '"]').find('input[name="chapters[' + selectedChapter + '][content]"]').val();

                initChapterEditor(index, name, content, 'Edit');
                $('#chapter-editor').modal('show');
            });

            $(document).on('click', '#chapter-list > .chapter > .remove', function () {
                var that = this;
                swal({
                    title: 'Delete Chapter ?',
                    text: "You won't be able to revert this",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete chapter'
                }).then((result) => {
                    if (result.value){
                        $(that).parent().remove();
                    }
                });
            });
            $('#save-chapter').click(function () {
                var index = $('#chapter-index').val();
                var name = $('#chapter-name').val();
                var content = $('#chapter-content').froalaEditor('html.get').replace(/["']/g, "'");
                if (name.trim() == '') {
                    swal('Error', 'Please enter chapter name', 'error');
                    return;
                }
                if (selectedChapter != null) {
                    $('#chapter-list > .chapter[data-id="' + selectedChapter + '"]').find('.chapter-name').text(name);
                    $('#chapter-list > .chapter[data-id="' + selectedChapter + '"]').find('input[name="chapters[' + selectedChapter + '][index]"]').val(index);
                    $('#chapter-list > .chapter[data-id="' + selectedChapter + '"]').find('input[name="chapters[' + selectedChapter + '][name]"]').val(name);
                    $('#chapter-list > .chapter[data-id="' + selectedChapter + '"]').find('input[name="chapters[' + selectedChapter + '][content]"]').val(content);
                } else {
                    var count = $('#chapter-list > .chapter').length;
                    var html = '<div class="list-group-item row chapter" data-id="' + count + '">' +
                        '<span class="chapter-name col-sm-10">' + name + '</span>' +
                        '<input type="hidden" name="chapters[' + count + '][index]" value="' + index + '">' +
                        '<input type="hidden" name="chapters[' + count + '][name]" value="' + name + '">' +
                        '<input type="hidden" name="chapters[' + count + '][content]" value="' + content + '">' +
                        '<span class="m-l-10 pull-right label label-danger btn waves-effect remove">Remove</span>' +
                        '<span class="pull-right label label-info btn waves-effect edit">Edit</span>' +
                        '</div>';
                    $('#chapter-list').append(html);
                }
                selectedChapter = null;
                $('#chapter-editor').modal('hide');
            });

            $(document).on('click', '#assessment-list > .assessment > .edit', function () {
                selectedAssessment = $(this).parent().attr('data-id');
                
                var name = $('#assessment-list > .assessment[data-id="' + selectedAssessment + '"]').find('input[name="assessments[' + selectedAssessment + ']"]').val();

                initAssessmentEditor(name, 'Edit');
                $('#assessment-editor').modal('show');
            });

            //Quiz add update

            var selectedQuiz;
            $('#add-question').click(function () {
                initQuizEditor();
                $('#quiz-editor').modal('show');
            });


            $('#save-quiz').click(function () {
                var quiz = $('#question').val();
                var nonempty=$('#quiz-editor').find('input:text').filter(function() { return $(this).val() !== ""; });
                if ((quiz.trim() == '')) {
                    swal('Error', 'You must add a question', 'error');
                    return;
                }
                else if((parseInt(nonempty.length) < 4)){
                    swal('Error', 'You must add atleast two options', 'error');
                    return;
                }

                if (selectedQuiz != null) {
                    // $('#question-list > .question[data-id="' + selectedQuiz + '"]').find('.qu-name').text(quiz);
                    // $('#question-list > .question[data-id="' + selectedQuiz + '"]').find('input[name="quiz[' + selectedQuiz + '][question]"]').val(quiz);
                    // $('#question-list > .question[data-id="' + selectedQuiz + '"]').remove();
                    // var count = $('#question-list > .question').length;
                    var anstable='';
                    for(var i=0;i<4;i++){
                        var ans=$('#quiz-editor').find('input[name="content[answer]['+i+']"]').val();
                        var type=$('#quiz-editor').find('input[name="content[type]['+i+']"]:checked').val();
                        var note=$('#quiz-editor').find('input[name="content[note]['+i+']"]').val();
                        anstable +='<input type="hidden" class="answer-block" name="quiz['+selectedQuiz+'][content]['+i+'][answer]" value="'+ans+'">';
                        anstable+= '<input type="hidden" name="quiz['+selectedQuiz+'][content]['+i+'][type]" value="'+type+'">';
                        anstable+= '<input type="hidden" name="quiz['+selectedQuiz+'][content]['+i+'][note]" value="'+note+'">';
                    }
                    var html = '<div  class="list-group-item row question" data-id="' + selectedQuiz + '">' +
                        '<span class="qu-name col-sm-10">' + quiz + '</span>' +
                        '<input type="hidden" name="quiz[' + selectedQuiz + '][question]" value="' + quiz + '">' + anstable +
                        '<span class="m-l-10 pull-right label label-danger btn waves-effect remove">Remove</span>' +
                        '<span class="pull-right label label-info btn waves-effect edit">Edit</span>' +
                        '</div>';
                    $('#question-list > .question[data-id="' + selectedQuiz + '"]').replaceWith(html);


                } else {
                    var count = parseInt(parseInt($('#question-list > .question').length)+1);
                    var anstable='';
                    for(var i=0;i<4;i++){
                        var ans=$('#quiz-editor').find('input[name="content[answer]['+i+']"]').val();
                        var type=$('#quiz-editor').find('input[name="content[type]['+i+']"]:checked').val();
                        var note=$('#quiz-editor').find('input[name="content[note]['+i+']"]').val();
                        anstable +='<input type="hidden" class="answer-block" name="quiz['+count+'][content]['+i+'][answer]" value="'+ans+'">';
                        anstable+= '<input type="hidden" name="quiz['+count+'][content]['+i+'][type]" value="'+type+'">';
                        anstable+= '<input type="hidden" name="quiz['+count+'][content]['+i+'][note]" value="'+note+'">';
                    }
                    var html = '<div  class="list-group-item row question" data-id="' + count + '">' +
                        '<span class="qu-name col-sm-10">' + quiz + '</span>' +
                        '<input type="hidden" name="quiz[' + count + '][question]" value="' + quiz + '">' + anstable +
                        '<span class="m-l-10 pull-right label label-danger btn waves-effect remove">Remove</span>' +
                        '<span class="pull-right label label-info btn waves-effect edit">Edit</span>' +
                        '</div>';
                    $('#question-list').append(html);
                }
                selectedQuiz = null;
                $('#quiz-editor').modal('hide');
            });

            $(document).on('click', '#question-list > .question > .edit', function () {
                selectedQuiz = $(this).parent().attr('data-id');
                initQuizEditor(selectedQuiz,'Edit');
                $('#quiz-editor').modal('show');
            });
            $(document).on('click', '#question-list > .question > .remove', function () {
                var $this=$(this);
                swal({
                    title: 'Delete Question ?',
                    text: "You won't be able to revert this",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete question'
                }).then(function(result){
                    if(result.value){
                      $this.parent().remove();
                    }

                })
            });
            //Quiz ends

            function initChapterEditor(index= 1, name = '', content = '', mode = 'Add') {
                $('#chapter-editor').find('.modal-title').text(mode + ' Chapter');

                if ($('#chapter-content').data('froala.editor')) {
                    $('#chapter-content').froalaEditor('destroy');
                }

                $('#chapter-index').val(index).focus();
                $('#chapter-name').val(name).focus();
                $('#chapter-content').html(content);

                initEditor('#chapter-content');
            }

            function initAssessmentEditor(assessment = '', mode= 'Add') {
                $('#assessment-editor').find('.modal-title').text(mode + ' Assessment');
                $('#assessment').val(assessment);
            }

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

        function initQuizEditor(id='',mode= 'add') {
            $('#quiz-editor').find('.modal-title').text(mode + ' Question');
            var number_arr=['A','B','C','D','E','F','G','H','I'];
            var html='';
            if(mode==='add'){
                $('#question').val('');
                for(var i=0;i<4;i++){
                    html+='<div class="form-group">\n' +
                        '                                <label>Option '+number_arr[i]+'</label>\n' +
                        '                                <input type="text" class="form-control option" name="content[answer]['+i+']" placeholder="Answer">\n' +
                        '                                <label class="m-t-10">Note '+number_arr[i]+'</label>\n' +
                        '                                <input type="text" class="form-control option" name="content[note]['+i+']" placeholder="Note">\n' +
                        '                                <label class="radio-inline m-t-10"><input type="radio" name="content[type]['+i+']"  value="true" >True</label>\n' +
                        '                                <label class="radio-inline m-t-10"><input type="radio" name="content[type]['+i+']" value="false" checked>False</label>\n' +
                        '                            </div>';
                }

                $('#quiz-editor .form-content').empty().append(html);

            }
            else{
                var question=$('#question-list > .question[data-id="' + id + '"]').find('input[name="quiz['+id+'][question]"]').val();
                $('#question').val(question);
                var len=$('#question-list > .question[data-id="' + id + '"]').find('.answer-block').length;
                for(var i=0;i<len;i++){
                    var ans=$('#question-list > .question[data-id="' + id + '"]').find('input[name="quiz['+id+'][content]['+i+'][answer]"]').val();
                    var type=$('#question-list > .question[data-id="' + id + '"]').find('input[name="quiz['+id+'][content]['+i+'][type]"]').val();
                    var note=$('#question-list > .question[data-id="' + id + '"]').find('input[name="quiz['+id+'][content]['+i+'][note]"]').val();
                    var c1=(type==='true') ? "checked" : '';
                    var c2=(type==='false') ? "checked" : '';
                    html+='<div class="form-group">\n' +
                        '                                <label>Option '+number_arr[i]+'</label>\n' +
                        '                                <input type="text" class="form-control option" name="content[answer]['+i+']" value="'+ans+'">\n' +
                        '                                <label class="m-t-10">Note '+number_arr[i]+'</label>\n' +
                        '                                <input type="text" class="form-control option" name="content[note]['+i+']" value="'+note+'">\n' +
                        '                                <label class="radio-inline m-t-10"><input type="radio" name="content[type]['+i+']"  value="true" '+c1+'>True</label>\n' +
                        '                                <label class="radio-inline m-t-10"><input type="radio" name="content[type]['+i+']" value="false" '+c2+'>False</label>\n' +
                        '                            </div>';
                }
                $('#quiz-editor .form-content').empty().append(html);
            }

        }

        function initEditor(selector) {
            $(selector).froalaEditor({
                height: 300,
                toolbarStickyOffset: 60,
                fontFamily: {
                    "Roboto,sans-serif": 'Roboto',
                    "Oswald,sans-serif": 'Oswald',
                    "Montserrat,sans-serif": 'Montserrat',
                    "'Open Sans Condensed',sans-serif": 'Open Sans Condensed',
                    'Arial,Helvetica,sans-serif': 'Arial',
                    'Georgia,serif': 'Georgia',
                    'Impact,Charcoal,sans-serif': 'Impact',
                    'Tahoma,Geneva,sans-serif': 'Tahoma',
                    "'Times New Roman',Times,serif": 'Times New Roman',
                    'Verdana,Geneva,sans-serif': 'Verdana',
                    'Helvetica,Arial,sans-serif': 'Helvetica'
                },
                fontFamilySelection: true
            }).on('froalaEditor.image.beforeUpload', function (e, editor, files) {
                if (files.length) {
                    // Create a File Reader.
                    var reader = new FileReader();

                    // Set the reader to insert images when they are loaded.
                    reader.onload = function (e) {
                        var result = e.target.result;
                        editor.image.insert(result, null, null, editor.image.get());
                    };

                    // Read image as base64.
                    reader.readAsDataURL(files[0]);
                }

                // Stop default upload chain.
                return false;
            });
        }
        function previewImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    var img='<img id="preview" src="'+e.target.result+'" alt="" style="max-height: 300px">';
                    $('#image-preview').empty().append(img);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        function checkQuiz(){
            var arr=[];
           $('.question').each(function(){
               arr.push($(this).data('id'));
           });
           alert(arr.toString());
        }
    </script>

    <style>
        .fr-box > div:not(.fr-wrapper) > a{
            display:none!important;
        }

        .fr-popup.fr-active{
            z-index: 9999999999999!important;
        }
    </style>
@endsection