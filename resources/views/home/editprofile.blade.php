@extends('layouts.home')
@section('title','Profile')
@section('description', $site['site_description'])
@section('style')
    <link rel="stylesheet" href="{{ asset('public/theme/plugins/jqueryTextEditor/jquery-te.css') }}">
    <link rel="stylesheet" href="{{ asset('public/theme/plugins/jqueryConfirm/jquery-confirm.css') }}">
@endsection
@section('content')
    <div class="main-body">
        <div class="container custom py-5">
            <nav class="navbar navbar-expand-sm navbar-dark background-main-color profile">
                <!-- Brand/logo -->
                <a class="navbar-brand" href="">
                    Profile
                </a>
                <!-- Links -->
                <ul class="navbar-nav nav nav-tabs  ml-auto profile" role="tablist">
                    <li class="nav-item">
                        <a href="{{route('user.profile',['id'=>$data->id])}}" class="nav-link">User Profile</a>
                    </li>
                    @if(Auth::check() && Auth::user()->id == $data->id)
                        <li class="nav-item active">
                            <a href="{{route('user.profile.edit',['id'=>$data->id])}}" class="nav-link active">Edit
                                settings</a>
                        </li>
                    @endif
                </ul>
            </nav>
            <div class="user-panel main-inner-profiletext">
                <ul class="nav nav-tabs generic-tabs generic--tabs generic--tabs-2" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="edit-profile-tab" data-toggle="tab" href="#edit-profile"
                           role="tab" aria-controls="edit-profile" aria-selected="true">Edit Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="change-password-tab" data-toggle="tab" href="#change-password"
                           role="tab" aria-controls="change-password" aria-selected="false">Change Password</a>
                    </li>
                </ul>
                <div class="tab-content mb-50px" id="myTabContent">
                    <div class="tab-pane fade show active" id="edit-profile" role="tabpanel"
                         aria-labelledby="edit-profile-tab">
                        <div class="user-panel-main-bar">
                            <div class="user-panel">
                                <form method="post" class="pt-35px">
                                    <div class="settings-item mb-10px">
                                        <h4 class="fs-14 pb-2 text-gray text-uppercase">Public information</h4>
                                        <div class="divider"><span></span></div>
                                        <div class="row pt-4 align-items-center">
                                            <div class="col-lg-6">
                                                <div class="edit-profile-photo d-flex flex-wrap align-items-center">
                                                    <img src="{{ asset('public/uploads/users/') }}/{{$data->image}}"
                                                         alt="user avatar" class="profile-img mr-4" id="srcChange">
                                                    <div>
                                                        <div class="file-upload-wrap file--upload-wrap chooseimage">
                                                            <input type="file" name="files" id="chooseimageFile"
                                                                   class="file-upload-input"
                                                                   onchange="readImage(this);">
                                                            <span class="file-upload-text"><i
                                                                        class="la la-photo mr-2"></i>Choose Image</span>
                                                        </div>
                                                        <button id="uploadPic" type="button"
                                                                class="btn btn-success img-upload-profile d-none">Upload
                                                        </button>
                                                        <p class="fs-14">Maximum file size: 10 MB.</p>
                                                    </div>
                                                </div><!-- end edit-profile-photo -->
                                            </div><!-- end col-lg-6 -->
                                            <div class="col-lg-6">
                                                <div class="input-box">
                                                    <label class="fs-13 text-black lh-20 fw-medium">Display name</label>
                                                    <div class="form-group">
                                                        <input class="form-control form--control" type="text"
                                                               name="text" id="name" value="{{$data->name}}">
                                                    </div>
                                                </div>
                                                <div class="input-box">
                                                    <label class="fs-13 text-black lh-20 fw-medium">Location</label>
                                                    <div class="form-group">
                                                        <input class="form-control form--control" type="text"
                                                               name="text" id="location" value="{{$data->location}}">
                                                    </div>
                                                </div>
                                            </div><!-- end col-lg-6 -->
                                            <div class="col-lg-12">
                                                <div class="input-box">
                                                    <label class="fs-15 text-black lh-20 fw-medium">About me</label>
                                                    <div class="form-group">
                                                        <textarea id="editor" class="w-100 edit" rows="10"
                                                                  placeholder="About Me">{{decodeContent($data->description)}}</textarea>
                                                    </div>
                                                </div>
                                            </div><!-- end col-lg-12 -->
                                        </div><!-- end row -->
                                    </div><!-- end settings-item -->
                                    <div class="settings-item">
                                        <h4 class="fs-14 pb-2 text-gray text-uppercase">Web presence</h4>
                                        <div class="divider"><span></span></div>
                                        <div class="row pt-4">
                                            <div class="col-lg-6">
                                                <div class="input-box">
                                                    <label class="fs-13 text-black lh-20 fw-medium">Website link</label>
                                                    <div class="form-group">
                                                        <input class="form-control form--control pl-40px" type="text"
                                                               name="text" value="{{$data->website}}" id="website">
                                                        <span class="fa fa-link input-icon"></span>
                                                    </div>
                                                </div>
                                            </div><!-- end col-lg-6 -->
                                            <div class="col-lg-6">
                                                <div class="input-box">
                                                    <label class="fs-13 text-black lh-20 fw-medium">Twitter link</label>
                                                    <div class="form-group">
                                                        <input class="form-control form--control pl-40px" type="text"
                                                               name="text" value="{{$data->twitter}}" id="twitter">
                                                        <span class="fa fa-twitter input-icon"></span>
                                                    </div>
                                                </div>
                                            </div><!-- end col-lg-6 -->
                                            <div class="col-lg-6">
                                                <div class="input-box">
                                                    <label class="fs-13 text-black lh-20 fw-medium">Facebook
                                                        link</label>
                                                    <div class="form-group">
                                                        <input class="form-control form--control pl-40px" type="text"
                                                               name="text" value="{{$data->facebook}}" id="facebook">
                                                        <span class="fa fa-facebook input-icon"></span>
                                                    </div>
                                                </div>
                                            </div><!-- end col-lg-6 -->
                                            <div class="col-lg-6">
                                                <div class="input-box">
                                                    <label class="fs-13 text-black lh-20 fw-medium">Instagram
                                                        link</label>
                                                    <div class="form-group">
                                                        <input class="form-control form--control pl-40px" type="text"
                                                               name="text" value="{{$data->instagram}}" id="instagram">
                                                        <span class="fa fa-instagram input-icon"></span>
                                                    </div>
                                                </div>
                                            </div><!-- end col-lg-6 -->
                                            <div class="col-lg-12">
                                                <div id="successProfile"
                                                     class="alert alert-success d-none profileMessages">
                                                </div>
                                                <div id="errorProfile"
                                                     class="alert alert-danger d-none profileMessages">
                                                </div>
                                                <div class="submit-btn-box pt-3">
                                                    <button class="btn theme-btn" type="button" id="updateProfile">Save
                                                        changes
                                                    </button>
                                                </div>
                                            </div><!-- end col-lg-12 -->
                                        </div><!-- end row -->
                                    </div><!-- end settings-item -->
                                </form>
                            </div><!-- end user-panel -->
                        </div><!-- end user-panel-main-bar -->
                    </div><!-- end tab-pane -->
                    <div class="tab-pane fade" id="change-password" role="tabpanel"
                         aria-labelledby="change-password-tab">
                        <div class="user-panel-main-bar">
                            <div class="user-panel">
                                <form method="post" class="pt-20px">
                                    <div class="settings-item mb-30px">
                                        <div class="form-group">
                                            <label class="fs-13 text-black lh-20 fw-medium">Current Password</label>
                                            <input class="form-control form--control password-field" type="password"
                                                   name="password" placeholder="Current password" id="current-password">
                                        </div>
                                        <div class="form-group">
                                            <label class="fs-13 text-black lh-20 fw-medium">New Password</label>
                                            <input class="form-control form--control password-field" type="password"
                                                   name="password" placeholder="New password" id="new-password">
                                        </div>
                                        <div class="form-group">
                                            <label class="fs-13 text-black lh-20 fw-medium">New Password
                                                Confirmation</label>
                                            <input class="form-control form--control password-field" type="password"
                                                   name="password" placeholder="New password again"
                                                   id="confirm-password">
                                        </div>

                                        <div id="successPass" class="alert alert-success d-none profileMessages">
                                        </div>
                                        <div id="errorPass" class="alert alert-danger d-none profileMessages">
                                        </div>

                                        <div class="submit-btn-box pt-3">
                                            <button class="btn theme-btn" type="button" id="changePass">Change
                                                Password
                                            </button>
                                        </div>
                                    </div><!-- end settings-item -->
                                </form>
                            </div><!-- end user-panel -->
                        </div><!-- end user-panel-main-bar -->
                    </div><!-- end tab-pane -->
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript"
            src="{{ asset('public/theme/plugins/jqueryTextEditor/jquery-te-1.4.0.min.js') }}"></script>
    <script type="text/javascript"
            src="{{ asset('public/theme/plugins/jqueryConfirm/jquery-confirm.js') }}"></script>
    <script>
        var csrfName = "_token";
        var csrfHash = "{{ csrf_token() }}";
        var userid ={{$data->id}};

        function readImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#srcChange')
                        .attr('src', e.target.result);

                };
                reader.readAsDataURL(input.files[0]);
                $('#uploadPic').removeClass('d-none');
                $('.chooseimage').addClass('d-none');
            }
        }

        $(document).ready(function () {
            $('#editor').jqte();
            $(document).on('click', '#uploadPic', function (e) {
                var imgname = $('#chooseimageFile').val();
                var size = $('#chooseimageFile')[0].files[0].size;
                var ext = imgname.substr((imgname.lastIndexOf('.') + 1));
                if (ext == 'jpg' || ext == 'jpeg' || ext == 'png' || ext == 'gif' || ext == 'PNG' || ext == 'JPG' || ext == 'JPEG') {
                    if (size <= 1000000) {
                        var fd = new FormData();
                        fd.append('image', $('#chooseimageFile')[0].files[0]);
                        fd.append('type', 'uppic');
                        fd.append(csrfName, csrfHash);
                        $.ajax({
                            url: '{{route('user.postProfile')}}',
                            type: "POST",
                            data: fd,
                            processData: false,
                            contentType: false,
                            success: function (response) {
                                if (response.type == 1) {
                                    alert(response.html);
                                    $('#uploadPic').addClass('d-none');
                                    $('.chooseimage').removeClass('d-none');
                                } else if (response.type == 2) {
                                    $('#signupModal').modal();
                                } else {
                                    $('#alert_content').html(response.html)
                                    $('#alert_modal').modal('show');
                                }
                            },
                            error: function (xhr, data, error) {
                                if (window.confirm("This page is expired , Please click Yes to reload the page")) {
                                    window.location.reload(true);
                                }
                            }
                        });
                    } else {
                        $('#alert_content').html('File size is too big')
                        $('#alert_modal').modal('show');
                        return false;
                    }
                } else {
                    $('#alert_content').html('Please upload only images with jpg,jpeg,png,gif,PNG,JPG,JPEG')
                    $('#alert_modal').modal('show');
                    return false;
                }
            });
            $(document).on('click', '#updateProfile', function (e) {
                $('.profileMessages').addClass('d-none').html('');
                var description = $('#editor').closest(".jqte").find(".jqte_editor").eq(0).html();
                var title = $('#title').val();
                var name = $('#name').val();
                var website = $('#website').val();
                var twitter = $('#twitter').val();
                var facebook = $('#facebook').val();
                var instagram = $('#instagram').val();
                var location = $('#location').val();

                var fd = new FormData();
                fd.append('description', description);
                fd.append('facebook', facebook);
                fd.append('instagram', instagram);
                fd.append('name', name);
                fd.append('website', website);
                fd.append('twitter', twitter);
                fd.append('location', location);
                fd.append('type', 'update');
                fd.append(csrfName, csrfHash);
                $.ajax({
                    url: '{{route('user.postProfile')}}',
                    type: "POST",
                    data: fd,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        if (response.type == 1) {
                            $('#successProfile').html(response.html);
                            $('#successProfile').removeClass('d-none');
                        } else {
                            $('#errorProfile').html(response.html);
                            $('#errorProfile').removeClass('d-none');
                        }
                    },
                    error: function (xhr, data, error) {
                        if (window.confirm("This page is expired , Please click Yes to reload the page")) {
                            window.location.reload(true);
                        }
                    }
                });
            });
            $(document).on('click', '#changePass', function () {
                var element = $(this);
                element.html('<div class="ld ld-ring ld-spin-fast"></div>');
                $('.profileMessages').addClass('d-none').html('');
                var currentpassword = $('#current-password').val();
                var newpassword = $('#new-password').val();
                var confirmpassword = $('#confirm-password').val();
                var fd = new FormData();
                fd.append('current-password', currentpassword);
                fd.append('new-password', newpassword);
                fd.append('new-password_confirmation', confirmpassword);
                fd.append('type', 'changePass');
                fd.append(csrfName, csrfHash);
                $.ajax({
                    url: '{{route('user.postProfile')}}',
                    type: "POST",
                    data: fd,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        if (response.type == 1) {
                            $('#successPass').html(response.html);
                            $('#successPass').removeClass('d-none');
                        } else {
                            $('#errorPass').html(response.html);
                            $('#errorPass').removeClass('d-none');
                        }
                        element.html('Change Password');
                    }, error: (response) => {
                        if (response.status === 422) {
                            let errors = response.responseJSON.errors;
                            var html = '';
                            Object.keys(errors).forEach(function (key) {
                                html += errors[key][0] + '<br>';
                            });
                            $('#errorPass').html(html);
                            $('#errorPass').removeClass('d-none');
                        } else {
                            if (window.confirm("This page is expired , Please click Yes to reload the page")) {
                                window.location.reload(true);
                            }
                        }
                        element.html('Change Password');
                    }
                });
            });
        });
    </script>
@endsection