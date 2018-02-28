@extends('layouts.app')
@section('content')
    @include('includes.main-menu')
    <style>
        .fr-box > div:not(.fr-wrapper) > a{
            display:none!important;
        }
    </style>
    <div class="container-fluid">
        <form action="" method="post">
            {{ csrf_field() }}
            {{ method_field('put') }}
            <div class="white-box m-t-15">
                <div class="row m-t-10">
                    <div class="col-sm-12">
                        <h3 class="box-title m-b-0">Cost of Not Managing Better</h3>
                        <small>Edit Content</small>
                        <textarea id="content" name="content">
                            {{ $content  }}
                        </textarea>
                    </div>
                </div>
                <div class="row m-t-10">
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
        window.onload = function () {

            initEditor('#content');

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

        function initEditor(selector) {
            $(selector).froalaEditor({
                height: 'auto',
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
    </script>
@endsection