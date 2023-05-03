@extends('layouts.home')
@section('title','Ask Question')
@section('description', $site['site_description'])
@section('style')
    <link rel="stylesheet" href="{{ asset('public/theme/plugins/tags/jquery.tagsinput.css') }}">
@endsection
@section('content')
    <div id="postImages" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="report-heading">
                        <h4 class="">Upload Images and Get Links to embed</h4>
                    </div>
                    <div class="image-upload-area">
                        <input type="file" id="imageFile" class="edit-image"/>
                        <span class="upload-info">Select an image from here and click upload button below</span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="uploadPic" type="button" class="btn btn-default">Upload</button>
                </div>
            </div>
        </div>
    </div>
    <section class="question-area pt-80px pb-40px">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="card card-item">
                        <form class="card-body">
                            <div class="form-group ask-q-filter">
                                <label>Question Category</label>
                                <div class="SumoSelect w-100 ask-qu" tabindex="0">
                                    <select id="category"
                                            class="search_test SumoUnder form-control input-rounded w-100">

                                        <option value="">Please Select Category</option>
                                        @foreach ($cate as $k=>$v)
                                            <option value="{{$k}}" {{$k == $question->catid?"selected":''}}>
                                                {{$v}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Question Title</label>
                                <input class="form-control" id="title" value="{{$question->title}}" type="text"
                                       placeholder="Question Title">
                            </div>
                            <div class="form-group">
                                <label>Question Description</label>
                                <div class="alert alert-info">All the html tags are allowed
                                </div>
                                <textarea name="editor" id="editor">{{decodeContent($question->description)}}</textarea>
                            </div>
                            <div class="form-group tage-input-main">
                                <label>Tags</label>
                                <input id="tags" value="{{$question->tags}}" class="tags-input w-100" type="text"
                                       placeholder="">
                                <p class="fs-13">Add commas between the tags</p>
                            </div>
                            <div class="form-group">
                                <div id="successQuestion" class="alert alert-success d-none questionMessages">
                                </div>
                                <div id="errorQuestion" class="alert alert-danger d-none questionMessages">
                                </div>
                                <button class="btn btn-success" type="button" value="" id="postQuestion">Update Question
                                </button>
                                <button class="btn btn-primary" type="button" value="" id="submitImages">Embed images in
                                    Question
                                </button>
                            </div>
                        </form>
                    </div><!-- end card -->
                </div><!-- end col-lg-8 -->
                <div class="col-lg-4">
                    <div class="sidebar">
                        <div class="card card-item p-4">
                            <h3 class="fs-17 pb-3">Step 1: Draft your question</h3>
                            <div class="divider"><span></span></div>
                            <p class="fs-14 lh-22 pb-2 pt-3">The community is here to help you with specific coding,
                                algorithm, or language problems.</p>
                            <p class="fs-14 lh-22">Avoid asking opinion-based questions.</p>
                            <div id="accordion" class="generic-accordion pt-4">
                                <div class="card">
                                    <div class="card-header" id="headingOne">
                                        <button class="btn btn-link fs-15" data-toggle="collapse"
                                                data-target="#collapseOne" aria-expanded="true"
                                                aria-controls="collapseOne">
                                            <span><span class="text-color pr-2 fs-16">1.</span> Summarize the problem</span>
                                            <i class="la la-angle-down collapse-icon"></i>
                                        </button>
                                    </div>
                                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                         data-parent="#accordion">
                                        <div class="card-body">
                                            <ul class="generic-list-item generic-list-item-bullet generic-list-item--bullet-2 fs-14">
                                                <li class="lh-18 text-black-50">Include details about your goal</li>
                                                <li class="lh-18 text-black-50">Describe expected and actual results
                                                </li>
                                                <li class="lh-18 text-black-50 mb-0">Include any error messages</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div><!-- end card -->
                                <div class="card">
                                    <div class="card-header" id="headingTwo">
                                        <button class="btn btn-link collapsed fs-15" data-toggle="collapse"
                                                data-target="#collapseTwo" aria-expanded="false"
                                                aria-controls="collapseTwo">
                                            <span><span class="text-color pr-2 fs-16">2.</span> Describe what you’ve tried</span>
                                            <i class="la la-angle-down collapse-icon"></i>
                                        </button>
                                    </div>
                                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                                         data-parent="#accordion">
                                        <div class="card-body">
                                            <p class="fs-14 lh-22 text-black-50">
                                                Show what you’ve tried and tell us what you found (on this site or
                                                elsewhere) and why it didn’t meet your needs. You can get better answers
                                                when you provide research.
                                            </p>
                                        </div>
                                    </div>
                                </div><!-- end card -->
                                <div class="card">
                                    <div class="card-header" id="headingThree">
                                        <button class="btn btn-link collapsed fs-15" data-toggle="collapse"
                                                data-target="#collapseThree" aria-expanded="false"
                                                aria-controls="collapseThree">
                                            <span><span class="text-color pr-2 fs-16">3.</span> Show some code</span>
                                            <i class="la la-angle-down collapse-icon"></i>
                                        </button>
                                    </div>
                                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                                         data-parent="#accordion">
                                        <div class="card-body">
                                            <p class="fs-14 lh-22 text-black-50">
                                                When appropriate, share the minimum amount of code others need to
                                                reproduce your problem (also called a
                                                <a href="#" class="text-color hover-underline">minimum</a>, <a href="#"
                                                                                                               class="text-color hover-underline">reproducible
                                                    example</a>)
                                            </p>
                                        </div>
                                    </div>
                                </div><!-- end card -->
                            </div><!-- end accordion -->
                        </div><!-- end card -->
                    </div><!-- end sidebar -->
                </div><!-- end col-lg-4 -->
            </div><!-- end row -->
        </div><!-- end container -->
    </section><!-- end question-area -->
@endsection
@section('scripts')
    <script src="//cdn.ckeditor.com/4.10.0/standard/ckeditor.js"></script>
    <script type="text/javascript"
            src="{{ asset('public/theme/plugins/animatedSelectBox/jquery.sumoselect.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/theme/plugins/tags/jquery.tagsinput.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#category').SumoSelect({search: true, searchText: 'Enter here.'});
            var csrfName = "_token";
            var csrfHash = "{{ csrf_token() }}";
            $('#tags').tagsInput();
            CKEDITOR.replace('editor', {allowedContent: true});
            $(document).on('click', '#postQuestion', function (e) {
                e.preventDefault();
                $('.questionMessages').addClass('d-none').html('');
                var description = CKEDITOR.instances.editor.getData();
                var title = $('#title').val().replace(/&lt;/g, '<').replace(/&gt;/g, '>');
                var category = $('#category').val();
                var tags = $('#tags').val();
                var fd = new FormData();
                fd.append('description', description);
                fd.append('title', title);
                fd.append('tags', tags);
                fd.append('type', 'update');
                fd.append('id',{{$question->id}});
                fd.append('category', category);
                fd.append(csrfName, csrfHash);
                $.ajax({
                    url: '{{route('home.postquestion')}}',
                    type: "POST",
                    data: fd,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        if (response.status) {
                            $('#successQuestion').html(response['html']);
                            $('#successQuestion').removeClass('d-none');
                            window.location.href = response.link;
                        } else {
                            $('#errorQuestion').html(response.html);
                            $('#errorQuestion').removeClass('d-none');
                        }
                    },
                    error: (response) => {
                        if (response.status === 422) {
                            let errors = response.responseJSON.errors;
                            var html = '';
                            Object.keys(errors).forEach(function (key) {
                                html += errors[key][0] + '<br>';
                            });
                            $('#errorQuestion').html(html);
                            $('#errorQuestion').removeClass('d-none');
                        } else {
                            if (window.confirm("This page is expired , Please click Yes to reload the page")) {
                                window.location.reload(true);
                            } else {
                                $('.questionMessages').addClass('d-none').html('');
                            }
                        }
                    }
                });
            });
            $(document).on('click', '#submitImages', function () {
                @if(Auth::check())
                $('#postImages').modal();
                @else
                $('#signupModal').modal();
                @endif
            });
            $(document).on('click', '#uploadPic', function (e) {
                var image = $('#imageFile').val();

                if (image == '') {
                    alert('Please select an image to upload');
                    return false;
                }
                var element = $(this);
                var size = $('#imageFile')[0].files[0].size;
                var ext = image.substr((image.lastIndexOf('.') + 1));
                if (ext == 'jpg' || ext == 'jpeg' || ext == 'png' || ext == 'gif' || ext == 'PNG' || ext == 'JPG' || ext == 'JPEG') {
                    if (size <= 1000000) {
                        element.html('<div class="ld ld-ring ld-spin-fast"></div>');
                        $('#successImageUploaded').html('').addClass('d-none');
                        $('#successImageUploadedDesc').addClass('d-none');
                        var fd = new FormData();
                        fd.append('image', $('#imageFile')[0].files[0]);
                        fd.append(csrfName, csrfHash);
                        $.ajax({
                            url: '{{route('question.postImagesToEmbed')}}',
                            type: "POST",
                            data: fd,
                            processData: false,
                            contentType: false,
                            success: function (response) {
                                if (response.type == 1) {
                                    // alert(response['html']);
                                    // $('#successImageUploaded').html(response.link).removeClass('d-none');
                                    // $('#successImageUploadedDesc').removeClass('d-none');
                                    $('#postImages').modal('hide');
                                    CKEDITOR.instances.editor.insertHtml(response.link);
                                } else if (response.type == 2) {
                                    $('#signupModal').modal();
                                } else {
                                    alert(response.html);
                                }
                                element.html('Upload');
                            },
                            error: function (xhr, data, error) {
                                if (window.confirm("This page is expired , Please click Yes to reload the page")) {
                                    window.location.reload(true);
                                }
                            }
                        });
                    } else {
                        alert('File size is too big');
                        $('#successImageUploaded').html('').addClass('d-none');
                        $('#successImageUploadedDesc').addClass('d-none');
                        return false;
                    }
                } else {
                    alert('Please upload only images with jpg,jpeg,png,gif,PNG,JPG,JPEG');
                    return false;
                }
            });
        });
    </script>
@endsection