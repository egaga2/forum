@extends('layouts.home')
@section('title', decodeContent($question->title) ?? '404 – Page Not Found')
@section('description', substr(strip_tags(html_entity_decode($question->description)), 0, 110))
@section('style')
    <link rel="stylesheet" href="{{ asset('public/theme/plugins/jqueryTextEditor/jquery-te.css') }}">
    <link rel="stylesheet" href="{{ asset('public/theme/plugins/jqueryConfirm/jquery-confirm.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.2.0/styles/default.min.css">
@endsection
@section('content')
    <section class="question-area pt-40px pb-40px">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="inner-question main">
                        <article class="article-question article-post clearfix question-type-normal p-0">
                            <div class="single-inner-content px-3">
                                <div class="row select-category single-head m-0">
                                    <div class="media-body">
                                        <h5 class="fs-24">{{ decodeContent($question->title) }}</h5>
                                        <div class="meta d-flex flex-wrap align-items-center fs-13 lh-20 py-1">
                                            <div class="pr-3">
                                                <span>Asked</span>
                                                <span class="text-black">{{timeAgo($question->on)}}</span>
                                            </div>
                                            <div class="pr-3">
                                                <span class="pr-1">Viewed</span>
                                                <span class="text-black">{{format_number_in_k($question['views'])}} times</span>
                                            </div>
                                        </div>
                                        <div class="tags pb-2">
                                            @php $tags = explode(',',$question->tags); @endphp
                                            @foreach($tags as $tag)
                                                <a href="#" class="tag-link">{{$tag}}</a>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="question-inner row px-3 pb-5">
                                <div class="col-sm-1 col-md-1 col-lg-1 col-6 px-lg-1 ">
                                    <div class=" question-image-vote px-sm-0 text-center vote-bg">
                                        <ul class="question-mobile question-vote">
                                            <li qid="{{$question->id}}" type="1"
                                                class="question-vote-up voteQuestion {{$vote == 1?"active":""}}">
                                                <a class="question_vote_up vote_not_user" title="Like"><i
                                                            class="fa fa-caret-up" aria-hidden="true"></i></a>
                                            </li>
                                            <li class="count-vote-mid">
                                                <span class="vote votesCount-{{$question->id}}">{{$question->votes}} </span>
                                            </li>
                                            <li qid="{{$question->id}}" type="0"
                                                class="question-vote-down voteQuestion {{$vote == 0?"active":""}}">
                                                <a class="question_vote_down vote_not_user" title="Dislike"><i
                                                            class="fa fa-caret-down" aria-hidden="true"></i></a>
                                            </li>
                                        </ul>
                                        <div class="vote-count text text-center "><span>Votes</span></div>
                                    </div>
                                </div>
                                <div class="col-md-2 col-lg-1 col-sm-2 col-6 text-center d-flex d-sm-none">
                                    <div class="question-image-vote ans-bg pt-4">
                                        <div class="vote-count ans text-center">
                                            <a href="#"><span
                                                        class="awnsersCount">{{$question->awnsers}}</span>
                                                <span class="ans-text">Answer{{($question->awnsers)>1?'s':''}}</span></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-11 col-md-11 col-lg-11 px-lg-1">
                                    <div class="question-content question-content-second pt-sm-4 pr-3">
                                        <div class="post-wrap-content">
                                            <div class="question-content-text">
                                                {!! decodeContent($question->description) !!}
                                            </div>

                                        </div>
                                        <div class="wpqa_error"></div>
                                        <div class="tagcloud">
                                            <div class="question-tags"><i class="icon-tags"></i>
                                                @php $tags = explode(',',$question->tags); @endphp
                                                @foreach($tags as $tag)
                                                    <a href="#" class="tag-link">{{$tag}}</a>
                                                @endforeach
                                            </div>
                                        </div>
                                        <footer class="question-footer row">
                                            <div class="col-md-7 d-none">
                                                <ul class="footer-meta">
                                                    <li><i class="icon ion-md-chatboxes"></i><a
                                                                class="awnsersCount"><?php echo $question['awnsers'];?></a><span
                                                                class="question-span"> <a
                                                                    href="#">Answer<?php echo $question['awnsers'] > 1 ? "s" : "";?></a></span>
                                                    </li>
                                                    <li><i class="fa fa-eye"
                                                           aria-hidden="true"></i><?php echo $question['views'];?> <span
                                                                class="question-span">View<?php echo $question['views'] > 1 ? "s" : "";?></span>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-md-12 col-lg-9">

                                                <div class="question-content question-content-first">
                                                    <div class="article-header">
                                                        <div class="question-header">
																<span class="author-image-span pull-left">
																	<img class="avatar avatar-42 photo" alt="name"
                                                                         width="21" height="21"
                                                                         src="{{asset('public/uploads/users/') . '/' . $question->user->image }} ">
																</span>

                                                            <a class="post-author"
                                                               href="{{route('user.profile',['id'=>$question->userid,'name'=>str_slug($question->user->name)])}}">{{$question->user->name}}</a>
                                                            <div class="post-meta">
                                                                @if(isset($recentBadges->name))<span
                                                                        class="badge-span"
                                                                        style="background-color: #ffbf00">{{$recentBadges->name}}</span>@endif
                                                                <span class="post-date"
                                                                      itemprop="dateCreated">Asked:
																{{timeAgo($question->on)}}</span>
                                                                <span class="byline"><span class="post-cat">In:
																<a href="{{route('home.category',['name'=>$cate->permalink])}}">{{$cate->name}}</a>
																</span>
                                                                    @if(Auth::check() && Auth::user()->id != $question->userid)
                                                                        @if($countReport >0)
                                                                            <span class="report-comment"
                                                                                  style="color: #ffbf01"><i
                                                                                        class="fa fa-exclamation-triangle"
                                                                                        aria-hidden="true"></i> Reported</span>
                                                                        @else
                                                                            <span qid="{{$question->id}}"
                                                                                  class="reportQuestion report-comment"><i
                                                                                        class="fa fa-exclamation-triangle"
                                                                                        aria-hidden="true"></i> Report</span>
                                                                        @endif
                                                                    @elseif(!Auth::check())
                                                                        <span data-toggle="modal" data-target="#signupModal" class="report-comment"> <i
                                                                                    class="fa fa-exclamation-triangle"
                                                                                    aria-hidden="true"></i> Report </span>
                                                                    @endif
                                                                    <?php if (Auth::check() && (Auth::user()->role == 2 || Auth::user()->id == $question->userid) ) {?>
                                                                        <span class="byline">
																	<a
                                                                            href="{{route('home.questions.edit',['id'=>$question->id])}}"><span
                                                                                class="ti-marker-alt"></span> Edit</a>
																</span>
                                                                        <span class="byline">
																	<span class="deleteQuestion"
                                                                          data-qid="<?php echo $question['id'];?>"><i
                                                                                class="fa fa-trash-o"
                                                                                aria-hidden="true"></i> Delete</span>
																</span>
                                                                <?php } ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @if(isset($edit->on))
                                                    <div class="clearfix fs-14 pl-3">
                                                        <span>Edited By : </span>
                                                        <span><a href=""><img class="avatar avatar-42 photo" alt="name"
                                                                              width="12" height="12"
                                                                              src="{{asset('public/uploads/users/') . '/' .$edit->User['image']}}"> {{$edit->User['name']}} </a>{{timeAgo($edit->on)}}																		</span>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="col-md-12 col-lg-3 p-0 text-right">
                                                <button class="meta-answer comment mx-2 my-1" id="replyQuestion"
                                                        href="#"><span><span class="ti-comments"></span></span> Reply
                                                </button>
                                                <a onclick="animateAwnser('#submitForm');"
                                                   class="meta-answer dropdown my-1"><span><i
                                                                class="icon ion-md-chatbubbles"></i></span> Answer</a>
                                            </div>
                                        </footer>
                                        <div style="display:none" class="main-comment" id="replyQuestion-textarea">
                                            <div class="form-group">
                                                <label>Your reply on this question:</label>
                                                <textarea id="replyTextQ" class="editorP answer w-100"
                                                          rows="2"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <button id="addReplyQuestion" class="btn btn-postcomment my-2">Add
                                                    Reply
                                                </button>
                                                <button id="cancelReplyQuestion" class="btn btn-cancelcomment my-2">
                                                    Cancel
                                                </button>
                                            </div>
                                        </div>
                                        <div class="comments-wrap">
                                            <ul class="comments-list question_comments-list">
                                                @if (count($reply)>0)
                                                    @foreach ($reply as $index=>$replyQ)
                                                        <li id="question-reply-main-head-{{$replyQ->id}}">
                                                            <div class="comment-body">
                                                                <span class="act-reply-{{$replyQ->id}} comment-copy">{{ decodeContent($replyQ->reply) }}</span>
                                                                <span class="comment-separated">-</span>
                                                                <a href="" class="comment-user owner"
                                                                   title="">{{$replyQ->User->name}}</a>
                                                                <span class="comment-separated">-</span>
                                                                <span>{{timeAgo($replyQ->on)}}</span>
                                                                @if (Auth::check())
                                                                    @if ($replyQ->userid == Auth::user()->id)
                                                                        <div class="replyQRecord-{{$replyQ->id}} d-none">
                                                                    <textarea id="replyq-{{$replyQ->id}}"
                                                                              class="editorP w-100"
                                                                              rows="5">{!! decodeContent($replyQ->reply) !!}</textarea>

                                                                            <a qrid="{{$replyQ->id}}"
                                                                               class="saveReplyQ btn btn-primary">Save</a>
                                                                            <a qrid="{{$replyQ->id}}"
                                                                               class=" cancelReplyQ btn btn-primary">Cancel</a>
                                                                        </div>
                                                                        - <span qrid="{{$replyQ->id}}"
                                                                                class="edit-replyq edit-reply"><span
                                                                                    class="ti-marker-alt"></span></span>
                                                                        <span qrid="{{$replyQ->id}}"
                                                                              class="delete-replyQ"><i
                                                                                    class="fa fa-trash-o"
                                                                                    aria-hidden="true"></i></span>
                                                                    @endif
                                                                @endif
                                                            </div>
                                                        </li>
                                                    @endforeach
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="subheader d-flex align-items-center justify-content-between">
                                <div class="subheader-title">
                                    <h3 class="fs-16"><span class="awnsersCount">{{$question->awnsers}}</span> Answer
                                    </h3>
                                </div><!-- end subheader-title -->
                                <div class="subheader-actions d-flex align-items-center lh-1">
                                    <label class="fs-13 fw-regular mr-1 mb-0">Order by</label>
                                    <div class="w-100px">
                                        <select class="select-container form-control" id="answer_sort">
                                            <option value="voted" selected="selected">Voted</option>
                                            <option value="recent">Recent</option>
                                            <option value="oldest">Oldest</option>
                                        </select>
                                    </div>
                                </div><!-- end subheader-actions -->
                            </div>
                            <div class="inner-question main">
                                <div id="recentAwnsers"></div>
                                <div id="submitForm" class="p-3">
                                    <form class="comment-leave">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <textarea id="answerEditor" class="w-100 text-comment"
                                                                  rows="6"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 text-center">
                                                <div class="form-group">
                                                    <button type="button" class="btn btn-leave-comment mb-1 btn-success"
                                                            id="submitAnswer">Submit an answer
                                                    </button>
                                                    <button class="btn btn-primary" type="button" value="" id="submitImages">Embed images in
                                                        Question
                                                    </button>
                                                </div>
                                            </div>

                                        </div>
                                    </form>
                                </div>
                            </div>
                        </article>
                    </div>
                </div>
                <div class="col-lg-3">
                    @include('partials.rightsidebar')
                </div><!-- end col-lg-3 -->
            </div><!-- end row -->
        </div><!-- end container -->
    </section><!-- end question-area -->
    <div id="replyEditQuestion" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="replyq-heading">
                        <h4 class="">Edit your Answer</h4>
                    </div>
                    <div class="main-replyq p-3">
                        <textarea id="editAnswer" class="editorP w-100" rows="5"></textarea>
                        <input type="hidden" value="" id="answerEditId">
                        <button id="updateAnswer" type="button" class="btn btn-edit-ans">Update</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
    @if(Auth::check())
        <div id="reportModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body p-0">
                        <div class="report-heading">
                            <h4 class="">Select reason to report an answer</h4>
                        </div>
                        <input type="hidden" id="answeridR" value=""/>
                        <div class="main-report-model">
                            @foreach($reportSchema as $r)
                                <div>
                                    <p class="heading-report">{{$r->name}}
                                        <input class="reportSelectedCheckboxes d-none" name="repAnswer" type="radio"
                                               id="check{{$r->id}}" value="{{$r->id}}">
                                        <label class="dom-checks" for="check{{$r->id}}"></label>
                                    </p>
                                    <p class="details-report-model">{{$r->description}}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="reportAnswer" type="button" class="btn btn-default">Report</button>
                    </div>
                </div>
            </div>
        </div>
        <div id="reportQModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body p-0">
                        <div class="report-heading">
                            <h4 class="">Select a reason to report this question</h4>
                        </div>
                        <div class="p-3">
                            <input type="hidden" id="qidR" value=""/>
                            <?php foreach ($reportSchema as $index=>$value) {?>
                            <div>
                                <p><strong><?php echo $value['name'];?></strong> <input name="reportSelectedCheckboxesq"
                                                                                        class="reportSelectedCheckboxesq"
                                                                                        type="radio"
                                                                                        value="<?php echo $value['id'];?>">
                                </p>
                                <p><?php echo $value['description'];?> </p>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="reportQ" type="button" class="btn btn-default">Report</button>
                    </div>
                </div>
            </div>
        </div>
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
    @endif
@endsection
@section('scripts')
    <script type="text/javascript"
            src="{{ asset('public/theme/plugins/jqueryTextEditor/jquery-te-1.4.0.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/theme/plugins/jqueryConfirm/jquery-confirm.js') }}"></script>
    <script src="//cdn.ckeditor.com/4.10.0/standard/ckeditor.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.2.0/highlight.min.js"></script>
    <!-- and it's easy to individually load additional languages -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.2.0/languages/go.min.js"></script>
    <script>
        var totalanswers ={{$question->awnsers}};
        var csrfName = "_token";
        var csrfHash = "{{ csrf_token() }}";
        $(document).ready(function () {
            // $('.editorP').jqte();
            CKEDITOR.replace('answerEditor', {allowedContent: true});
            CKEDITOR.replace('editAnswer', {allowedContent: true});
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
                                    CKEDITOR.instances.answerEditor.insertHtml(response.link);
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
        $(document).on('click', '.edit-replyq,.cancelReplyQ', function () {
            var qrid = $(this).attr('qrid');
            $('.replyQRecord-' + qrid).toggleClass('d-none');
        });
        $(document).on('click', '.reply-answer,.cancelReplyAnswer', function (e) {
            var answerId = $(this).attr('answerid');
            $("#" + answerId + '-answerReplyInput').toggleClass('d-none');
        });
        $(document).on('click', '.edit-replya,.cancelReplyA', function () {
            var arid = $(this).attr('arid');
            $('.replyARecord-' + arid).toggleClass('d-none');
        });
        $(document).on('click', '#replyQuestion,#cancelReplyQuestion', function () {
            $('#replyQuestion-textarea').toggle();
        });
        $(document).on('click', '.edit-reply-answer', function () {
            var answerid = $(this).attr('answerid');
            var answer = $('#answer-description-' + answerid).html();
            // $('#editAnswer').closest(".jqte").find(".jqte_editor").eq(0).html(answer);
            CKEDITOR.instances.editAnswer.setData(answer);
            $('#answerEditId').val(answerid);
            $('#replyEditQuestion').modal();
        });

        function animateAwnser(target) {
            $('html, body').animate({
                scrollTop: $(target).offset().top
            }, 500);
        }

        function load_awnser(id = "", sort = '') {
            $.ajax({
                url: "{{route('home.loadawnser')}}",
                method: "POST",
                data: {id: id, qid: "{{$question->id}}", sort: sort, "_token": "{{ csrf_token() }}"},
                success: function (data) {
                    $('#load_more_button').remove();
                    $('#recentAwnsers').append(data);
                }
            })
        }

        $(document).on('change', '#answer_sort', function () {
            var sort = $(this).val();
            $.ajax({
                url: "{{route('home.loadawnser')}}",
                method: "POST",
                data: {id: "", qid: "{{$question->id}}", sort: sort, "_token": "{{ csrf_token() }}"},
                success: function (data) {
                    $('#load_more_button').remove();
                    $('#recentAwnsers').html(data);
                }
            })
        });
        $(document).on('click', '#load_more_button', function () {
            var id = $(this).data('id');
            var sort = $('#answer_sort').val();
            $('#load_more_button').html('<b>Loading...</b>');
            load_awnser(id, sort);
        });
        $(document).ready(function () {
            var sort = $('#answer_sort').val();
            load_awnser(0, sort);
        });
        $(document).on('click', '#submitAnswer', function () {
            var element = $(this);
            element.html('<div class="ld ld-ring ld-spin-fast"></div>');
            var answerEditor = CKEDITOR.instances.answerEditor.getData();
            var question ={{$question->id}};
            var fd = new FormData();
            fd.append('answerEditor', answerEditor);
            fd.append('question', question);
            fd.append(csrfName, csrfHash);
            $.ajax({
                url: '{{route('home.postAnswer')}}',
                type: "POST",
                data: fd,
                processData: false,
                contentType: false,
                success: function (response) {
                    if (response.type == 1) {
                        var replyHtml = response['html'];
                        CKEDITOR.instances.answerEditor.setData('')
                        $('#recentAwnsers').prepend(replyHtml);
                        totalanswers++;
                        animateAwnser('#recentAwnsers');
                        $('.awnsersCount').html(totalanswers);
                    } else if (response.type == 2) {
                        $('#signupModal').modal();
                    } else {
                        $('#alert_content').html(response.html)
                        $('#alert_modal').modal('show');
                        //alert(response.html);
                    }
                    element.html('Submit an answer');
                }, error: (response) => {
                    if (response.status === 422) {
                        let errors = response.responseJSON.errors;
                        var html = '';
                        Object.keys(errors).forEach(function (key) {
                            html += errors[key][0];
                        });
                        $('#alert_content').html(html)
                        $('#alert_modal').modal('show');
                        element.html('Submit an answer');
                    } else {
                        if (window.confirm("This page is expired , Please click Yes to reload the page")) {
                            window.location.reload(true);
                        }
                    }
                }
            });
        });
        $(document).on('click', '#addReplyQuestion', function () {
            var element = $(this);
            element.html('<div class="ld ld-ring ld-spin-fast"></div>');
            var replyTextQ = $('#replyTextQ').val();
            var question ={{$question->id}};
            var fd = new FormData();
            fd.append('replyTextQ', replyTextQ);
            fd.append('question', question);
            fd.append(csrfName, csrfHash);
            $.ajax({
                url: '{{route('home.postquestionreply')}}',
                type: "POST",
                data: fd,
                processData: false,
                contentType: false,
                success: function (response) {
                    if (response.type == 1) {
                        var replyHtml = response['html'];
                        $('#replyTextQ').val('');
                        $('#replyQuestion-textarea').toggle();
                        $('.question_comments-list').prepend(replyHtml);
                    } else if (response.type == 2) {
                        $('#signupModal').modal();
                    } else {
                        $('#alert_content').html(response.html)
                        $('#alert_modal').modal('show');
                    }
                    element.html('Add Reply');
                }, error: (response) => {
                    if (response.status === 422) {
                        let errors = response.responseJSON.errors;
                        var html = '';
                        Object.keys(errors).forEach(function (key) {
                            html += errors[key][0];
                        });
                        $('#alert_content').html(html)
                        $('#alert_modal').modal('show');
                        element.html('Add Reply');
                    } else {
                        if (window.confirm("This page is expired , Please click Yes to reload the page")) {
                            window.location.reload(true);
                        }
                    }
                }
            });
        });

        function deleteQuestion(qid) {
            $.confirm({
                title: 'Are you sure ?',
                content: 'You want to delete this Question?',
                buttons: {
                    deleteAnswer: {
                        text: 'Delete Question',
                        action: function () {
                            var that = this;
                            var fd = new FormData();
                            fd.append('qid', qid);
                            fd.append('type', 'delete');
                            fd.append(csrfName, csrfHash);
                            $.ajax({
                                url: '{{route('home.updatequestion')}}',
                                type: "POST",
                                data: fd,
                                processData: false,
                                contentType: false,
                                success: function (response) {
                                    if (response.type == 1) {
                                        $.alert(response.html);
                                        window.location.href = "{{route('home.questions')}}";
                                    } else if (response.type == 2) {
                                        that.close();
                                        $('#signupModal').modal();
                                    } else {
                                        $.alert(response.html);
                                    }
                                }, error: (response) => {
                                    if (response.status === 422) {
                                        let errors = response.responseJSON.errors;
                                        var html = '';
                                        Object.keys(errors).forEach(function (key) {
                                            html += errors[key][0];
                                        });
                                        alert(html);
                                    } else {
                                        if (window.confirm("This page is expired , Please click Yes to reload the page")) {
                                            window.location.reload(true);
                                        }
                                    }
                                }
                            });
                            return false;
                        }
                    },
                    cancel: function () {
                    },
                }
            });
        }

        $(document).on('click', '.saveReplyQ', function () {
            var element = $(this);
            element.html('<div class="ld ld-ring ld-spin-fast"></div>');
            var qrid = $(this).attr('qrid');
            var elem = $(this).parent();
            var replyTextQ = $('#replyq-' + qrid).val();
            var question ={{$question->id}};
            var fd = new FormData();
            fd.append('replyTextQ', replyTextQ);
            fd.append('qrid', qrid);
            fd.append('type', 'edit');
            fd.append('question', question);
            fd.append(csrfName, csrfHash);
            $.ajax({
                url: '{{route('home.postquestionreply')}}',
                type: "POST",
                data: fd,
                processData: false,
                contentType: false,
                success: function (response) {
                    if (response.type == 1) {
                        $('.replyQRecord-' + qrid).toggleClass('d-none');
                        $('.act-reply-' + qrid).html(replyTextQ);
                        $('#replyq-' + qrid).val(replyTextQ);
                    } else if (response.type == 2) {
                        $('#signupModal').modal();
                    } else {
                        $('#alert_content').html(response.html)
                        $('#alert_modal').modal('show');
                    }
                    element.html('Save');
                },
                error: (response) => {
                    if (response.status === 422) {
                        let errors = response.responseJSON.errors;
                        var html = '';
                        Object.keys(errors).forEach(function (key) {
                            html += errors[key][0];
                        });
                        $('#alert_content').html(html)
                        $('#alert_modal').modal('show');
                        element.html('Save');
                    } else {
                        if (window.confirm("This page is expired , Please click Yes to reload the page")) {
                            window.location.reload(true);
                        }
                    }
                }
            });
        });
        $(document).on('click', '.saveReplyA', function () {
            var element = $(this);
            element.html('<div class="ld ld-ring ld-spin-fast"></div>');
            var arid = $(this).attr('arid');
            var elem = $(this).parent();
            var replyTextA = $('#replya-' + arid).val();
            var fd = new FormData();
            fd.append('replyTextA', replyTextA);
            fd.append('arid', arid);
            fd.append('type', 'editreply');
            fd.append(csrfName, csrfHash);
            $.ajax({
                url: '{{route('home.postAnswer')}}',
                type: "POST",
                data: fd,
                processData: false,
                contentType: false,
                success: function (response) {
                    if (response.type == 1) {
                        $('.replyARecord-' + arid).toggleClass('d-none');
                        $('.act-reply-' + arid).html(replyTextA);
                        $('#replya-' + arid).val(replyTextA);
                    } else if (response.type == 2) {
                        $('#signupModal').modal();
                    } else {
                        $('#alert_content').html(response.html)
                        $('#alert_modal').modal('show');
                    }
                    element.html('Save');
                }, error: (response) => {
                    if (response.status === 422) {
                        let errors = response.responseJSON.errors;
                        var html = '';
                        Object.keys(errors).forEach(function (key) {
                            html += errors[key][0];
                        });
                        $('#alert_content').html(html)
                        $('#alert_modal').modal('show');
                        element.html('Save');
                    } else {
                        if (window.confirm("This page is expired , Please click Yes to reload the page")) {
                            window.location.reload(true);
                        }
                    }
                }
            });
        });

        $(document).on('click', '.addReplyAnswer', function () {
            var element = $(this);
            element.html('<div class="ld ld-ring ld-spin-fast"></div>');
            var answerid = $(this).attr('answerid');
            var textareaT = $('#' + answerid + '-answerReplyInput').find('.reply');
            var answerReply = textareaT.val();
            var fd = new FormData();
            var question ={{$question->id}};
            fd.append('answerReply', answerReply);
            fd.append('answerid', answerid);
            fd.append('type', 'addreply');
            fd.append('question', question);
            fd.append(csrfName, csrfHash);
            $.ajax({
                url: '{{route('home.postAnswer')}}',
                type: "POST",
                data: fd,
                processData: false,
                contentType: false,
                success: function (response) {
                    if (response.type == 1) {
                        var replyHtml = response.html;
                        textareaT.val('');
                        $("#" + answerid + '-answerReplyInput').toggleClass('d-none');
                        $("#" + answerid + '-answerReplies').prepend(replyHtml);
                    } else if (response.type == 2) {
                        $('#signupModal').modal();
                    } else {
                        $('#alert_content').html(response.html)
                        $('#alert_modal').modal('show');
                    }
                    element.html('Reply');
                },
                error: (response) => {
                    if (response.status === 422) {
                        let errors = response.responseJSON.errors;
                        var html = '';
                        Object.keys(errors).forEach(function (key) {
                            html += errors[key][0];
                        });
                        $('#alert_content').html(html)
                        $('#alert_modal').modal('show');
                        element.html('Reply');
                    } else {
                        if (window.confirm("This page is expired , Please click Yes to reload the page")) {
                            window.location.reload(true);
                        }
                    }
                }
            });
        });

        $(document).on('click', '#updateAnswer', function () {
            var element = $(this);
            element.html('<div class="ld ld-ring ld-spin-fast"></div>');
            var answerid = $('#answerEditId').val();
            var answer = CKEDITOR.instances.editAnswer.getData();
            var fd = new FormData();
            var question ={{$question->id}};
            fd.append('answerid', answerid);
            fd.append('answer', answer);
            fd.append('type', 'edit');
            fd.append('question', question);
            fd.append(csrfName, csrfHash);
            $.ajax({
                url: '{{route('home.postAnswer')}}',
                type: "POST",
                data: fd,
                processData: false,
                contentType: false,
                success: function (response) {
                    if (response.type == 1) {
                        $('#answer-description-' + answerid).html(answer);
                        $('#replyEditQuestion').modal('toggle');
                        animateAwnser('#answer-main-head-' + answerid);
                    } else if (response.type == 2) {
                        $('#signupModal').modal();
                    } else {
                        $('#alert_content').html(response.html)
                        $('#alert_modal').modal('show');
                    }
                    element.html('Update');
                },
                error: (response) => {
                    if (response.status === 422) {
                        let errors = response.responseJSON.errors;
                        var html = '';
                        Object.keys(errors).forEach(function (key) {
                            html += errors[key][0];
                        });
                        $('#alert_content').html(html)
                        $('#alert_modal').modal('show');
                        element.html('Update');
                    } else {
                        if (window.confirm("This page is expired , Please click Yes to reload the page")) {
                            window.location.reload(true);
                        }
                    }
                }
            });
        });

        function deleteQReply(qrid) {
            $.confirm({
                title: 'Are you sure ?',
                content: 'You want to delete this question reply?',
                buttons: {
                    deleteAnswer: {
                        text: 'delete reply',
                        action: function () {
                            var that = this;
                            var fd = new FormData();
                            fd.append('qrid', qrid);
                            fd.append('type', 'delete');
                            fd.append('question', {{$question->id}});
                            fd.append(csrfName, csrfHash);
                            $.ajax({
                                url: '{{route('home.postquestionreply')}}',
                                type: "POST",
                                data: fd,
                                processData: false,
                                contentType: false,
                                success: function (response) {
                                    if (response.type == 1) {
                                        $.alert(response.html);
                                        $('#question-reply-main-head-' + qrid).remove();
                                        that.close();
                                    } else if (response.type == 2) {
                                        that.close();
                                        $('#signupModal').modal();
                                    } else {
                                        $.alert(response.html);
                                    }
                                },
                                error: function (xhr, data, error) {
                                    that.close();
                                    if (window.confirm("This page is expired , Please click Yes to reload the page")) {
                                        window.location.reload(true);
                                    }
                                }
                            });
                            return false;
                        }
                    },
                    cancel: function () {
                    },
                }
            });
        }

        function deleteAnswer(answerid) {
            $.confirm({
                title: 'Are you sure ?',
                content: 'You want to delete this answer?',
                buttons: {
                    deleteAnswer: {
                        text: 'delete answer',
                        action: function () {
                            var that = this;
                            var fd = new FormData();
                            fd.append('answerid', answerid);
                            fd.append('question',{{$question->id}});
                            fd.append('type', 'delete');
                            fd.append(csrfName, csrfHash);
                            $.ajax({
                                url: '{{route('home.postAnswer')}}',
                                type: "POST",
                                data: fd,
                                processData: false,
                                contentType: false,
                                success: function (response) {
                                    if (response.type == 1) {
                                        $.alert(response.html);
                                        totalanswers--;
                                        $('.awnsersCount').html(totalanswers);
                                        $('#answer-main-head-' + answerid).remove();
                                        that.close();
                                    } else if (response.type == 2) {
                                        that.close();
                                        $('#signupModal').modal();
                                    } else {
                                        that.close();
                                        $.alert(response.html);
                                    }
                                },
                                error: function (xhr, data, error) {
                                    that.close();
                                    if (window.confirm("This page is expired , Please click Yes to reload the page")) {
                                        window.location.reload(true);
                                    }
                                }
                            });
                            return false;
                        }
                    },
                    cancel: function () {
                    },
                }
            });
        }

        function deleteAReply(arid) {
            $.confirm({
                title: 'Are you sure ?',
                content: 'You want to delete this answer reply?',
                buttons: {
                    deleteAnswer: {
                        text: 'delete reply',
                        action: function () {
                            var that = this;
                            var fd = new FormData();
                            fd.append('arid', arid);
                            fd.append('type', 'deleteReply');
                            fd.append(csrfName, csrfHash);
                            $.ajax({
                                type: 'POST',
                                url: '{{route('home.postAnswer')}}',
                                type: "POST",
                                data: fd,
                                processData: false,
                                contentType: false,
                                success: function (response) {
                                    if (response.type == 1) {
                                        $.alert(response.html);
                                        $('#answer-reply-main-head-' + arid).remove();
                                        that.close();
                                    } else if (response.type == 2) {
                                        that.close();
                                        $('#signupModal').modal();
                                    } else {
                                        $.alert(response.html);
                                    }
                                },
                                error: function (xhr, data, error) {
                                    that.close();
                                    if (window.confirm("This page is expired , Please click Yes to reload the page")) {
                                        window.location.reload(true);
                                    }
                                }
                            });
                            return false;
                        }
                    },
                    cancel: function () {
                    },
                }
            });
        }

        $(document).on('click', '.voteQuestion', function (e) {
            e.preventDefault();
            var element = $(this);
            element.removeClass('voteQuestion');
            var question ={{$question->id}};
            var votesCount = parseFloat($('.votesCount-' + question).html().trim());
            if ($(this).hasClass('active')) {
                if (votesCount != 0) {
                    return false;
                }
            }
            var type = $(this).attr('type');
            var fd = new FormData();
            fd.append('votetype', type);
            fd.append('question', question);
            fd.append('type', 'vote');
            fd.append(csrfName, csrfHash);
            $.ajax({
                url: '{{route('home.updatequestion')}}',
                type: "POST",
                data: fd,
                processData: false,
                contentType: false,
                success: function (response) {
                    if (response.type == 1) {
                        $('.voteQuestion[qid=' + question + ']').removeClass('active');
                        element.addClass('active');
                        $('.votesCount-' + question).html(response.val);
                    } else if (response.type == 2) {
                        $('#signupModal').modal();
                    } else {
                        $('#alert_content').html(response.html)
                        $('#alert_modal').modal('show');
                    }
                    element.addClass('voteQuestion');
                },
                error: function (xhr, data, error) {
                    if (window.confirm("This page is expired , Please click Yes to reload the page")) {
                        window.location.reload(true);
                    } else {
                        element.addClass('voteQuestion');
                    }
                }
            });
        });

        $(document).on('click', '.answerVote', function (e) {
            e.preventDefault();
            var element = $(this);
            element.removeClass('answerVote');
            var qaid = $(this).attr('qaid');
            var votesCount = parseFloat($('.votes-answer-' + qaid).html().trim());
            if ($(this).hasClass('active')) {
                if (votesCount != 0) {
                    return false;
                }
            }
            var type = $(this).attr('type');
            var fd = new FormData();
            fd.append('votetype', type);
            fd.append('qaid', qaid);
            fd.append('type', 'ansvote');
            fd.append(csrfName, csrfHash);
            $.ajax({
                url: '{{route('home.updatequestion')}}',
                type: "POST",
                data: fd,
                processData: false,
                contentType: false,
                success: function (response) {
                    if (response.type == 1) {
                        $('.answerVote[qaid=' + qaid + ']').removeClass('active');
                        element.addClass('active');
                        $('.votes-answer-' + qaid).html(response.val);
                    } else if (response.type == 2) {
                        $('#signupModal').modal();
                    } else {
                        $('#alert_content').html(response.html)
                        $('#alert_modal').modal('show');
                    }
                    element.addClass('answerVote');
                },
                error: function (xhr, data, error) {
                    if (window.confirm("This page is expired , Please click Yes to reload the page")) {
                        window.location.reload(true);
                    } else {
                        element.addClass('answerVote');
                    }
                }
            });
        });
        $(document).on('click', '#reportAnswer', function () {
            var reportedReason = $('.reportSelectedCheckboxes:checked').val();
            if (reportedReason == undefined) {
                alert('Please select a reason');
                return false;
            }
            var element = $(this);
            element.html('<div class="ld ld-ring ld-spin-fast"></div>');
            var answerid = $('#answeridR').val();

            var fd = new FormData();
            fd.append('answerid', answerid);
            fd.append('reportedReason', reportedReason);
            fd.append('type', 'reportA');
            fd.append(csrfName, csrfHash);
            $.ajax({
                url: '{{route('home.postAnswer')}}',
                type: "POST",
                data: fd,
                processData: false,
                contentType: false,
                success: function (response) {
                    if (response.type == 1) {
                        alert(response.html);
                        $('.reportSelectedCheckboxes').prop('checked', false);
                        $('#reportModal').modal('toggle');
                    } else if (response.type == 2) {
                        $('#signupModal').modal();
                    } else {
                        $('#alert_content').html(response.html)
                        $('#alert_modal').modal('show');
                    }
                    element.html('Report');
                },
                error: function (xhr, data, error) {
                    if (window.confirm("This page is expired , Please click Yes to reload the page")) {
                        window.location.reload(true);
                    } else {
                        element.html('Report');
                    }
                }
            });
        });
        $(document).on('click', '#reportQ', function () {
            var reportedReason = $('.reportSelectedCheckboxesq:checked').val();
            if (reportedReason == undefined) {
                alert('Please select a reason');
                return false;
            }
            var element = $(this);
            element.html('<div class="ld ld-ring ld-spin-fast"></div>');
            var qid = $('#qidR').val();

            var fd = new FormData();
            fd.append('qid', qid);
            fd.append('reportedReason', reportedReason);
            fd.append('type', 'reportQ');
            fd.append(csrfName, csrfHash);
            $.ajax({
                url: '{{route('home.updatequestion')}}',
                type: "POST",
                data: fd,
                processData: false,
                contentType: false,
                success: function (response) {
                    if (response.type == 1) {
                        alert(response.html);
                        $('.reportSelectedCheckboxes').prop('checked', false);
                        $('#reportQModal').modal('toggle');
                    } else if (response.type == 2) {
                        $('#signupModal').modal();
                    } else {
                        $('#alert_content').html(response.html)
                        $('#alert_modal').modal('show');
                    }
                    element.html('Report');
                },
                error: function (xhr, data, error) {
                    if (window.confirm("This page is expired , Please click Yes to reload the page")) {
                        window.location.reload(true);
                    } else {
                        element.html('Report');
                    }
                }
            });
        });

        $(document).on('click', '.delete-replyA', function () {
            var arid = $(this).attr('arid');
            deleteAReply(arid);
        });
        $(document).on('click', '.delete-answer', function () {
            var answerid = $(this).attr('answerid');
            deleteAnswer(answerid);
        });
        $(document).on('click', '.delete-replyQ', function () {
            var qrid = $(this).attr('qrid');
            deleteQReply(qrid);
        });
        $(document).on('click', '.deleteQuestion', function () {
            var qid = $(this).attr('data-qid');
            deleteQuestion(qid);
        });
        $(document).on('click', '.reportAnswerMod', function () {
            var answerid = $(this).attr('answerid');
            $('#answeridR').val(answerid);
            $('#reportModal').modal();
        });
        $(document).on('click', '.reportQuestion', function () {
            var qid = $(this).attr('qid');
            $('#qidR').val(qid);
            $('#reportQModal').modal();
        });

        hljs.highlightAll();

    </script>
@endsection
