<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title') {{$site['site_title']}} </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="@yield('description')"/>
    <meta property="og:title" content="@yield('title') {{$site['site_title']}} "/>
    <meta property="og:type" content="website"/>
    <meta property="og:image" content="{{ asset('public/theme/images/logo.png') }}"/>
    <meta property="og:description" content="@yield('description')"/>
    <meta property="og:site_name" content="@yield('title') {{$site['site_title']}}"/>
    <link rel="shortcut icon" type="image/png" href="{{ asset('public/theme/images/favicon.png') }}"/>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/theme/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Maven+Pro:400,500&amp;subset=vietnamese" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Ropa+Sans" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/themify-icons/0.1.2/css/themify-icons.css" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="{{ asset('public/theme/plugins/animatedSelectBox/sumoselect.css') }}">
    <link rel="stylesheet" href="{{ asset('public/theme/plugins/loading.css') }}">
    <link rel="stylesheet" href="{{ asset('public/theme/plugins/loading-btn.css') }}">
    <link href="https://unpkg.com/ionicons@4.2.4/dist/css/ionicons.min.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i"
          rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('public/theme/css/fontawesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/theme/css/animation.css') }}">
    <link rel="stylesheet" href="{{ asset('public/theme/css/red.css') }}">

    {!! $site['before_head_tag'] !!}

    @yield('style')

</head>
<body>
<section class="header">
    <header>
        <div class="main-header-upper">
            <div class="container p-0">
                <div class="navbars uppernav ">
                    <ul class="navbar-navs options-nav  text-center pt-2 mb-0">
                        <li class="nav-item logo-main">
                            <a class="nav-link custom" href="{{ route('home.index') }}">
                                <img class="img-fluid logo" alt="logo"
                                     src="{{ asset('public/theme/images/logo.png') }}">
                            </a>
                        </li>
                        @if(Auth::check())
                            <li class="nav-item dropdown notification  pull-right d-none d-md-flex">
                                <a class="nav-link dropdown-toggle notify" href="#" id="navbarDropdown" role="button"
                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="ti-bell"></span>
                                    <span class="badge badge-light notify"><i class="fa fa-circle"
                                                                              aria-hidden="true"></i></span>
                                </a>
                                <div class="dropdown-menu dropdown--menu dropdown-menu-right mt-3 keep-open notification"
                                     aria-labelledby="notificationDropdown">
                                    <h6 class="dropdown-header"><i class="fa fa-bell pr-1 fs-16"></i>Notifications</h6>
                                    <div class="dropdown-divider border-top-gray mb-0"></div>
                                    <div id="notify"></div>
                                </div>
                            </li>
                        @endif
                        @if(!Auth::check())
                            <li class="nav-item pull-right d-none d-md-flex">
                                <a data-toggle="modal" data-target="#signupModal" class="nav-link custom text-white"
                                   href="#"> <i
                                            class="icon ion-ios-person"></i> Sign In </a>
                            </li>
                        @endif

                        <li class="nav-item pull-right ask-question-nav d-none d-md-flex">
                            @if(Auth::check())
                                <a href="{{route('questions.ask')}}" class="nav-link custom"> Ask a Question </a>
                            @else
                                <a data-toggle="modal" data-target="#signupModal" class="nav-link custom"> Ask a
                                    Question </a>
                            @endif
                        </li>

                        @if(Auth::check())
                            <li class="nav-item dropdown pull-right d-none d-md-flex">
                                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                                    <img src="{{ asset('public/uploads/users/') }}/{{Auth::User()->image}}"
                                         class="user-pic-nav"
                                         alt=""/>{{Auth::User()->name}}
                                </a>
                                <div class="dropdown-menu">
                                    <a href="{{route('user.profile', ['id' =>Auth::User()->id,'name'=>str_slug(Auth::User()->name)])}}"
                                       class="dropdown-item"> <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                                        Profile
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"><i
                                                class="fa fa-sign-in" aria-hidden="true"></i> Logout</a>
                                </div>
                            </li>
                        @endif

                    </ul>
                </div>
            </div>
        </div>
        <nav class="navbar navbar-expand-md py-0">
            @if(!Auth::check())
                <span class="nav-item pull-right d-flex d-md-none">
						<a data-toggle="modal" data-target="#signupModal" class="nav-link custom" href="#"> <i
                                    class="icon ion-ios-person"></i> Sign In </a>
					</span>
            @endif
            @if(Auth::check())
                <span class="nav-item dropdown pull-right d-flex d-md-none">
						<a class="nav-link dropdown-toggle text-black" href="#" id="navbardrop" data-toggle="dropdown">
							<img src="" class="user-pic-nav"
                                 alt=""/>{{Auth::User()->name}}
						</a>
						<div class="dropdown-menu">
							<a href=""
                               class="dropdown-item"> <i
                                        class="icon ion-md-help"></i>Profile </a>
							<a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
						</div>
					</span>
            @endif
            <span class="nav-item pull-right ask-question-nav  d-sm-flex d-md-none">
                @if(Auth::check())
                    <a href="{{route('questions.ask')}}"
                       class="nav-link custom">  Ask a Question </a>
                @else
                    <a data-toggle="modal" data-target="#signupModal" class="nav-link custom">  Ask a Question </a>
                @endif
				</span>

            <button class="navbar-toggler custom" type="button" data-toggle="collapse"
                    data-target="#collapsibleNavbars">
                <span class="ti-menu"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavbars">
                <div class="container">
                    <ul class="navbar-nav options-nav mx-auto custom">
                        <li class="nav-item pull-right ask-question-nav d-sm-none">
                            @if(Auth::check())
                                <a href="{{route('questions.ask')}}" class="nav-link custom"> Ask a Question </a>
                            @else
                                <a data-toggle="modal" data-target="#signupModal" class="nav-link custom"> Ask a
                                    Question </a>
                            @endif
                        </li>

                        <li class="nav-item">
                            <a class="nav-link custom {{ (\Request::is('/')) ? 'active' : '' }}"
                               href="{{route('home.index')}}"><span><i class="fa fa-home"
                                                                       aria-hidden="true"></i></span> Home</a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link custom {{ (\Request::is('questions')) ? 'active' : '' }}"
                               href="{{route('home.questions')}}"><span><i class="icon ion-md-list"></i></span>
                                Questions</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link custom {{ (\Request::is('categories')) ? 'active' : '' }}"
                               href="{{route('home.categories')}}"><span><i
                                            class="icon ion-md-pricetags"></i></span> Categories</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link custom {{ (\Request::is('users')) ? 'active' : '' }}"
                               href="{{route('home.users')}}"><span><i class="icon ion-md-contacts"></i></span>
                                Users</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link custom {{ (\Request::is('badges')) ? 'active' : '' }}"
                               href="{{route('home.badges')}}"><span><i class="icon ion-md-infinite"></i></span>
                                Badges</a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link custom {{ (\Request::is('blogs')) ? 'active' : '' }}"
                               href="{{route('home.blogs')}}"><span><i class="icon ion-md-book"></i></span> Blogs</a>
                        </li>
                        @if(Auth::check())
                            <li class="nav-item dropdown notification  d-md-none">
                                <a class="nav-link dropdown-toggle notify" href="#" id="navbarDropdown" role="button"
                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="ti-bell"></span>
                                    <span class="badge badge-light notify"><i class="fa fa-circle"
                                                                              aria-hidden="true"></i></span>
                                </a>
                                <div class="dropdown-menu notification" aria-labelledby="navbarDropdown">
                                    <div class="heading-notify htmlnotify">Notifications</div>
                                </div>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

    </header>
    {!! $site['after_head_tag'] !!}
</section>
@yield('content')
<footer class="custom">
    <div class="main-foter">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3 my-2">
                    <ul class="foter-option">
                        <li class="heading-fot nav-link">Company</li>
                        @foreach($pages as $k=>$r)
                            <li><a class="nav-link custom"
                                   href="{{route('home.page',['slug'=>$r->slug])}}">{{$r->title}}</a></li>
                        @endforeach

                    </ul>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3 my-2">
                    <ul class="foter-option">
                        <li class="heading-fot nav-link">Category</li>
                        <li>
                            <a class="nav-link custom" href="{{route('home.questions')}}"><span><i
                                            class="icon ion-md-list"></i></span> Questions</a>
                        </li>
                        <li>
                            <a class="nav-link custom" href="{{route('home.categories')}}"><span><i
                                            class="icon ion-md-pricetags"></i></span> Categories</a>
                        </li>
                        <li>
                            <a class="nav-link custom" href="{{route('home.users')}}"><span><i
                                            class="icon ion-md-contacts"></i></span> Users</a>
                        </li>

                    </ul>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3 my-2">
                    <ul class="foter-option">
                        <li class="heading-fot nav-link">Miscellaneous</li>
                        <li>
                            <a class="nav-link custom" href="{{route('home.badges')}}"><span><i
                                            class="icon ion-md-infinite"></i></span> Badges</a>
                        </li>
                        <li>
                            <a class="nav-link custom" href="{{route('home.blogs')}}"><span><i
                                            class="icon ion-md-infinite"></i></span> Blogs</a>
                        </li>

                    </ul>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3 my-2">
                    <ul class="foter-option">
                        <li class="heading-fot nav-link">Connect with us</li>
                        <li><a class="nav-link custom"  href="{{$site['facebook']}}"><i class="fa fa-facebook mr-1"></i> Facebook</a></li>
                        <li><a class="nav-link custom"  href="{{$site['twitter']}}"><i class="fa fa-twitter mr-1"></i> Twitter</a></li>
                        <li><a class="nav-link custom"  href="{{$site['instagram']}}"><i class="fa fa-instagram mr-1"></i> Instagram</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
<div class="modal fade" id="alert_modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header py-1">
                <h2 class="modal-title" id="exampleModalLongTitle">Alert</h2>
                <button type="button" class="close m-0 p-0" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="alert_content">
            </div>
        </div>
    </div>
</div>
@include('partials.login')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function () {
        $('#preloader').fadeOut('slow', function () {
            $(this).remove();
        });
        @if(session()->get('login') == 'show')
        $('#signupModal').modal('show');
        @endif
        $.ajax({
            url: "{{ route('ajax.getData') }}",
            method: "POST",
            data: {key: 'sidebar_right', val: 'count_qa', _token: "{{ csrf_token() }}"},
            success: function (data) {
                $('.sidebar_q').html(data.data.q);
                $('.sidebar_a').html(data.data.a);
                $('.sidebar_bq').html(data.data.qb);
                $('.sidebar_u').html(data.data.u);
            }
        });
        $.ajax({
            url: "{{ route('ajax.getData') }}",
            method: "POST",
            data: {key: 'sidebar_right', val: 'recent_question', _token: "{{ csrf_token() }}"},
            success: function (data) {
                $('#recent_question').html(data.data);
            }
        });
        $.ajax({
            url: "{{ route('ajax.getData') }}",
            method: "POST",
            data: {key: 'sidebar_right', val: 'trending_questions', _token: "{{ csrf_token() }}"},
            success: function (data) {
                $('#trending_questions').html(data.data);
            }
        });
        $.ajax({
            url: "{{ route('ajax.getData') }}",
            method: "POST",
            data: {key: 'sidebar_right', val: 'trending_tag', _token: "{{ csrf_token() }}"},
            success: function (data) {
                $('#trending_tag').html(data.data);
            }
        });
        $.ajax({
            url: "{{ route('home.getnotify') }}",
            method: "POST",
            data: {_token: "{{ csrf_token() }}"},
            success: function (data) {
                $('#notify').html(data.data);
                $('.htmlnotify').html(data.data);
            }
        });
    });
    $(document).on('click', '#forgotM', function () {
        $('#signupModal').modal('toggle');
        $('#forgetModal').modal();
    });
    $(document).on('submit', '#registerForm', function (e) {
        e.preventDefault();
        let formData = $(this).serializeArray();
        $("#registerForm input").removeClass("is-invalid");
        $.ajax({
            method: "POST",
            headers: {
                Accept: "application/json"
            },
            url: "{{ route('register') }}",
            data: formData,
            success: (response) => {
                $('#successSignup').html('Great! Your account has been successfully created.');
                $('#successSignup').removeClass('d-none');
                $('#errorSignup').addClass('d-none');
                window.location.reload();
            },
            error: (response) => {
                if (response.status === 422) {
                    let errors = response.responseJSON.errors;
                    $('#errorSignup').removeClass('d-none');
                    var html = '';
                    Object.keys(errors).forEach(function (key) {
                        $("#" + key + "S").addClass("is-invalid");
                        html += errors[key][0] + '<br>';
                    });
                    $('#errorSignup').html(html);
                } else {
                    window.location.reload();
                }
            }
        })
    });
    $(document).on('submit', '#loginForm', function (e) {
        e.preventDefault();
        let formData = $(this).serializeArray();
        $("#loginForm input").removeClass("is-invalid");
        $.ajax({
            method: "POST",
            headers: {
                Accept: "application/json"
            },
            url: "{{ route('postlogin') }}",
            data: formData,
            success: (response) => {
                if (response.status) {
                    $('#successLogin').html('Great! Login successful!');
                    $('#successLogin').removeClass('d-none');
                    $('#errorLogin').addClass('d-none');
                    window.location.reload(true);
                } else {
                    $('#errorLogin').removeClass('d-none');
                    $("#emailL").addClass("is-invalid");
                    $('#errorLogin').html(response.message);
                }
            },
            error: (response) => {
                if (response.status === 422) {
                    let errors = response.responseJSON.errors;
                    $('#errorLogin').removeClass('d-none');
                    var html = '';
                    Object.keys(errors).forEach(function (key) {
                        $("#" + key + "L").addClass("is-invalid");
                        html += errors[key][0] + '<br>';
                    });
                    $('#errorLogin').html(html);
                } else {
                    window.location.reload();
                }
            }
        })
    });
</script>

@yield('scripts')
{!! $site['before_body_end_tag'] !!}

</body>
</html>
