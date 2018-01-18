@extends('layouts.app')
@section('content')
    @include('includes.main-menu')

    <div class="container-fluid">

        <form action="" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            @if(isset($learning))
                {{ method_field('put') }}
            @endif

            @if($role=="admin")
            <div class="row m-t-30">
                <div class="col-sm-12">
                    <div class="white-box">
                        <h3 class="box-title m-b-0">Create New Learning Module</h3>
                        <small>You can set content on the fly.</small>
                        <hr>
                        <div class="form-group">
                            <input class="form-control" type="text" name="title" placeholder="Name"
                                   @if(isset($learning)) value="{{ $learning->title }}" @endif>
                        </div>
                        <div class="form-group">
                        <textarea class="form-control" name="description" id="" cols="30" rows="10"
                                  placeholder="Write a short description"
                                  @if(isset($learning))  @endif>
                            {{ isset($learning) ? $learning->description: ''}}
                        </textarea>
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="text" name="highlights"
                                   value="@if(isset($learning->highlights)) {{ implode(',', $learning->highlights) }} @endif"
                                   data-role="tagsinput" placeholder="Key features (Type and press Return)"
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
                        <h3 class="box-title m-b-0">Representational Image</h3>
                        <div class="m-b-0">
                            <img id="preview" src="{{!empty($learning->image) ? asset('uploads/'.$learning->image) : 'https://wrappixel.com/demos/admin-templates/pixeladmin/plugins/images/big/img1.jpg'  }}" alt="" style="max-height: 300px">
                        </div>
                        <div class="m-b-0">
                            <input type="file" name="image" onchange="previewImage(this)">
                        </div>
                    </div>
                </div>

            </div>

            <div class="row m-t-10">
                <div class="col-sm-12">
                    <div class="white-box">
                        <h3 class="box-title m-b-0">Introduction</h3>
                        <small>You can set custom introduction for every module.</small>
                        <textarea id="introduction" name="introduction">
                            {{ isset($learning) ? $learning->introduction: ''}}
                        </textarea>
                    </div>
                </div>
            </div>

            @if($role=="admin")
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
                                            @foreach($learning->chapters as $key => $chapter)
                                                <a href="javascript:void(0)" class="list-group-item chapter" data-id="{{ $key }}">
                                                    <span class="chapter-name">{{ $chapter['name'] }}</span>
                                                    <input type="hidden" name="chapters[{{ $key }}][name]" value="{{ $chapter['name'] }}">
                                                    <input type="hidden" name="chapters[{{ $key }}][content]" value="{{ $chapter['content'] }}">
                                                    <span class="m-l-10 pull-right label label-danger remove">Remove</span>
                                                    <span class="pull-right label label-info edit">Edit</span>
                                                </a>
                                            @endforeach
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
                                            <a href="javascript:void(0)" class="list-group-item assessment" data-id="{{ $key }}">
                                                <span class="statement">{{ $assessment }}</span>
                                                <input type="hidden" name="assessments[{{ $key }}]" value="{{ $assessment }}">
                                                <span class="m-l-10 pull-right label label-danger remove">Remove</span>
                                                <span class="pull-right label label-info edit">Edit</span>
                                            </a>
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
                                            @if(count($learning->quiz) > 0)
                                                @if(is_array($learning->quiz))
                                                    @foreach($learning->quiz as $key => $quiz)
                                                        <a href="javascript:void(0)" class="list-group-item question" data-id="{{ $key }}">
                                                            <span class="qu-name"> {{ $quiz['question'] }} </span>
                                                            <input type="hidden" name="quiz[{{$key}}][question]" value="{{ $quiz['question'] }}">
                                                            @foreach($quiz['content'] as $k=>$ans)
                                                                <input type="hidden" name="quiz[{{$key}}][content][{{$k}}][answer]" value="{{ $ans['answer'] }}">
                                                                <input type="hidden" name="quiz[{{$key}}][content][{{$k}}][type]" value="{{ $ans['type'] }}">
                                                                <input type="hidden" name="quiz[{{$key}}][content][{{$k}}][note]" value="{{ $ans['note'] }}">
                                                            @endforeach

                                                            <span class="m-l-10 pull-right label label-danger remove">Remove</span>
                                                            <span class="pull-right label label-info edit">Edit</span>
                                                        </a>
                                                    @endforeach
                                                @else
                                                    <a href="javascript:void(0)" class="list-group-item question" data-id="{{ $key }}">
                                                        <span class="qu-name"> {{ $quiz['question'] }} </span>
                                                        <input type="hidden" name="quiz[{{$key}}][question]" value="{{ $quiz['question'] }}">
                                                        @foreach($quiz['content'] as $k=>$ans)
                                                            <input type="hidden" name="quiz[{{$key}}][content][{{$k}}][answer]" value="{{ $ans['answer'] }}">
                                                            <input type="hidden" name="quiz[{{$key}}][content][{{$k}}][type]" value="{{ $ans['type'] }}">
                                                            <input type="hidden" name="quiz[{{$key}}][content][{{$k}}][note]" value="{{ $ans['note'] }}">
                                                        @endforeach

                                                        <span class="m-l-10 pull-right label label-danger remove">Remove</span>
                                                        <span class="pull-right label label-info edit">Edit</span>
                                                    </a>
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
                    <div class="form-group">
                        <label>Option A</label>
                        <input type="text" class="form-control" name="content[answer][0]" placeholder="">
                        <label class="m-t-10">Note A</label>
                        <input type="text" class="form-control" name="content[note][0]" placeholder="">
                        <label class="radio-inline m-t-10"><input type="radio" name="content[type][0]"  value="true">True</label>
                        <label class="radio-inline m-t-10"><input type="radio" name="content[type][0]" value="false">False</label>
                    </div>

                    <div class="form-group">
                        <label>Option B</label>
                        <input type="text" class="form-control option" name="content[answer][1]" placeholder="">
                        <label class="m-t-10">Note B</label>
                        <input type="text" class="form-control option" name="content[note][1]" placeholder="">
                        <label class="radio-inline m-t-10"><input type="radio" name="content[type][1]"  value="true">True</label>
                        <label class="radio-inline m-t-10"><input type="radio" name="content[type][1]" value="false">False</label>
                    </div>

                    <div class="form-group">
                        <label>Option C</label>
                        <input type="text" class="form-control option" name="content[answer][2]" placeholder="">
                        <label class="m-t-10">Note C</label>
                        <input type="text" class="form-control option" name="content[note][2]" placeholder="">
                        <label class="radio-inline m-t-10"><input type="radio" name="content[type][2]"  value="true">True</label>
                        <label class="radio-inline m-t-10"><input type="radio" name="content[type][2]" value="false">False</label>
                    </div>

                    <div class="form-group">
                        <label>Option D</label>
                        <input type="text" class="form-control option" name="content[answer][3]" placeholder="">
                        <label class="m-t-10">Note D</label>
                        <input type="text" class="form-control option" name="content[note][3]" placeholder="">
                        <label class="radio-inline m-t-10"><input type="radio" name="content[type][3]"  value="true">True</label>
                        <label class="radio-inline m-t-10"><input type="radio" name="content[type][3]" value="false">False</label>
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
                    var html = '<a href="javascript:void(0)" class="list-group-item assessment" data-id="' + count + '">' +
                        '<span class="statement">' + assessment + '</span>' +
                        '<input type="hidden" name="assessments[' + count + ']" value="' + assessment + '">' +
                        '<span class="m-l-10 pull-right label label-danger remove">Remove</span>' +
                        '<span class="pull-right label label-info edit">Edit</span>' +
                        '</a>';
                    $('#assessment-list').append(html);
                }
                selectedAssessment = null;
                $('#assessment-editor').modal('hide');
            });

            $(document).on('click', '#assessment-list > .assessment > .edit', function () {
                selectedAssessment = $(this).parent().attr('data-id');

                console.log(selectedAssessment);
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

                console.log(selectedChapter);
                var name = $('#chapter-list > .chapter[data-id="' + selectedChapter + '"]').find('input[name="chapters[' + selectedChapter + '][name]"]').val();
                var content = $('#chapter-list > .chapter[data-id="' + selectedChapter + '"]').find('input[name="chapters[' + selectedChapter + '][content]"]').val();

                initChapterEditor(name, content, 'Edit');
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
                var name = $('#chapter-name').val();
                var content = $('#chapter-content').froalaEditor('html.get').replace(/["']/g, "'");
                console.log(name, content);
                if (name.trim() == '') {
                    swal('Error', 'Please enter chapter name', 'error');
                    return;
                }
                if (selectedChapter != null) {
                    $('#chapter-list > .chapter[data-id="' + selectedChapter + '"]').find('.chapter-name').text(name);
                    $('#chapter-list > .chapter[data-id="' + selectedChapter + '"]').find('input[name="chapters[' + selectedChapter + '][name]"]').val(name);
                    $('#chapter-list > .chapter[data-id="' + selectedChapter + '"]').find('input[name="chapters[' + selectedChapter + '][content]"]').val(content);
                } else {
                    var count = $('#chapter-list > .chapter').length;
                    var html = '<a href="javascript:void(0)" class="list-group-item chapter" data-id="' + count + '">' +
                        '<span class="chapter-name">' + name + '</span>' +
                        '<input type="hidden" name="chapters[' + count + '][name]" value="' + name + '">' +
                        '<input type="hidden" name="chapters[' + count + '][content]" value="' + content + '">' +
                        '<span class="m-l-10 pull-right label label-danger remove">Remove</span>' +
                        '<span class="pull-right label label-info edit">Edit</span>' +
                        '</a>';
                    $('#chapter-list').append(html);
                }
                selectedChapter = null;
                $('#chapter-editor').modal('hide');
            });

            $(document).on('click', '#assessment-list > .assessment > .edit', function () {
                selectedAssessment = $(this).parent().attr('data-id');

                console.log(selectedAssessment);
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
                if (quiz.trim() == '') {
                    swal('Error', 'Please enter a question', 'error');
                    return;
                }

                if (selectedQuiz != null) {
                    $('#question-list > .question[data-id="' + selectedQuiz + '"]').find('.qu-name').text(quiz);
                    $('#question-list > .question[data-id="' + selectedQuiz + '"]').find('input[name="quiz[' + selectedQuiz + '][question]"]').val(quiz);

                } else {
                    var count = $('#question-list > .question').length;
                    var anstable='';
                    for(var i=0;i<4;i++){
                        var ans=$('#quiz-editor').find('input[name="content[answer]['+i+']"]').val();
                        var type=$('#quiz-editor').find('input[name="content[type]['+i+']"]').val();
                        var note=$('#quiz-editor').find('input[name="content[note]['+i+']"]').val();
                        anstable +='<input type="hidden" name="quiz['+count+'][content]['+i+'][answer]" value="'+ans+'">';
                        anstable+= '<input type="hidden" name="quiz['+count+'][content]['+i+'][type]" value="'+type+'">';
                        anstable+= '<input type="hidden" name="quiz['+count+'][content]['+i+'][note]" value="'+note+'">';
                    }
                    var html = '<a href="javascript:void(0)" class="list-group-item question" data-id="' + count + '">' +
                        '<span class="qu-name">' + quiz + '</span>' +
                        '<input type="hidden" name="quiz[' + count + '][question]" value="' + quiz + '">' + anstable +
                        '<span class="m-l-10 pull-right label label-danger remove">Remove</span>' +
                        '<span class="pull-right label label-info edit">Edit</span>' +
                        '</a>';
                    $('#question-list').append(html);
                }
                selectedQuiz = null;
                $('#quiz-editor').modal('hide');
            });

            $(document).on('click', '#question-list > .question > .edit', function () {
                selectedQuiz = $(this).parent().attr('data-id');

                console.log(selectedQuiz);
                console.log(name);
                initQuizEditor(selectedQuiz,'Edit');
                $('#quiz-editor').modal('show');
            });

            //Quiz ends

            function initChapterEditor(name = '', content = '', mode = 'Add') {
                console.log(name, content, mode);
                $('#chapter-editor').find('.modal-title').text(mode + ' Chapter');

                if ($('#chapter-content').data('froala.editor')) {
                    console.log('note');
                    $('#chapter-content').froalaEditor('destroy');
                }

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

        function initQuizEditor(id='',mode= 'Add') {
            $('#quiz-editor').find('.modal-title').text(mode + ' Question');
            var question=$('#question-list > .question[data-id="' + id + '"]').find('input[name="quiz['+id+'][question]"]').val();
            $('#question').val(question);
            for(var i=0;i<4;i++){
                var ans=$('#question-list > .question[data-id="' + id + '"]').find('input[name="quiz['+id+'][content]['+i+'][answer]"]').val();
                var type=$('#question-list > .question[data-id="' + id + '"]').find('input[name="quiz['+id+'][content]['+i+'][type]"]').val();
                var note=$('#question-list > .question[data-id="' + id + '"]').find('input[name="quiz['+id+'][content]['+i+'][note]"]').val();
                $('#quiz-editor').find('input[name="content[answer]['+i+']"]').val(ans);
                $('#quiz-editor').find('input[name="content[type]['+i+']"][value='+type+']').prop('checked', true);
                $('#quiz-editor').find('input[name="content[note]['+i+']"]').val(note);
            }
        }

        function initEditor(selector) {
            $(selector).froalaEditor({
                height: 300,
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
            });
        }
        function previewImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#preview').attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection