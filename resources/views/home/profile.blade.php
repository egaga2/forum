@extends('layouts.home')
@section('title','Profile - ')
@section('description', $site['site_description'])
@section('style')
    <link rel="stylesheet" href="{{ asset('public/theme/plugins/tags/jquery.tagsinput.css') }}">
@endsection
@section('content')
    <div class="main-body">
        <div class="container custom py-5 ">
            <nav class="navbar navbar-expand-sm navbar-dark background-main-color profile">
                <!-- Brand/logo -->
                <a class="navbar-brand" href="">
                    Profile
                </a>
                <!-- Links -->
                <ul class="navbar-nav nav nav-tabs  ml-auto profile" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="user-profile-tab" data-toggle="tab" href="#user-profile"
                           role="tab" aria-controls="user-profile" aria-selected="true">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="user-activity-tab" data-toggle="tab" href="#user-activity" role="tab"
                           aria-controls="user-activity" aria-selected="false">Activity</a>
                    </li>
                    @if(Auth::check() && Auth::user()->id == $data->id)
                        <li class="nav-item">
                            <a href="{{route('user.profile.edit',['id'=>$data->id])}}" class="nav-link">Edit
                                settings</a>
                        </li>
                    @endif
                </ul>
            </nav>
            <div class="user-panel main-inner-profiletext">
                <div class="content-wrapper">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="user-profile" role="tabpanel"
                             aria-labelledby="user-profile-tab">
                            <div class="container-fluid px-md-0">
                                <div class="row my-3 ">
                                    <div class="col-xl-3 col-md-6  my-2 my-xl-0">
                                        <div class="d-inline-block profileupper-option">
                                            <h6 class="text-uper-profile">
                                                <span class="icon-upper"><i class="icon ion-md-help"></i></span>
                                                <div class="content">
                                                    <div class="card-title is-tile text-right">
                                                        Questions
                                                        <div class="card-stat primary text-right">{{format_number_in_k(count($data->question))}}</div>
                                                    </div>
                                                </div>
                                                <div class="more">

                                                </div>
                                            </h6>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-md-6  my-2 my-xl-0">
                                        <div class="d-inline-block profileupper-option">
                                            <h6 class="text-uper-profile">
                                                <span class="icon-upper"><i class="icon ion-md-chatbubbles"></i></span>
                                                <div class="content">
                                                    <div class="card-title is-tile text-right">
                                                        Answers
                                                        <div class="card-stat primary text-right">{{format_number_in_k(count($data->answers))}}</div>
                                                    </div>
                                                </div>
                                                <div class="more">

                                                </div>
                                            </h6>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-md-6  my-2 my-xl-0">
                                        <div class="d-inline-block profileupper-option">
                                            <h6 class="text-uper-profile">
                                                <span class="icon-upper"><i class="icon ion-md-eye"></i></span>
                                                <div class="content">
                                                    <div class="card-title is-tile text-right">
                                                        Profile Views
                                                        <div class="card-stat primary text-right">{{format_number_in_k($data->views)}}</div>
                                                    </div>
                                                </div>
                                                <div class="more">

                                                </div>
                                            </h6>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-md-6  my-2 my-xl-0">
                                        <div class="d-inline-block profileupper-option">
                                            <h6 class="text-uper-profile">
                                                <span class="icon-upper"><i class="icon ion-md-people"></i></span>
                                                <div class="content">
                                                    <div class="card-title is-tile text-right">
                                                        People reached
                                                        <div class="card-stat primary text-right">{{format_number_in_k($data->peopleReached)}}</div>
                                                    </div>
                                                </div>
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div class="container custom tab-pane active px-0">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="profile-inner-main">
                                                    <img class="img-fluid user-picprofile"
                                                         src="{{ asset('public/uploads/users/') }}/{{$data->image}}"
                                                         alt="">
                                                    <h3 class="name-user-profile">{{$data->name}}</h3>
                                                    <ul class="generic-list-item">
                                                        @if(!empty($data->location))
                                                            <li><a
                                                                   class="d-inline-block"><span><i
                                                                                class="icon ion-md-pin"></i></span> {{$data->location}}
                                                                </a>
                                                            </li>
                                                        @endif
                                                        @if(!empty($data->website))
                                                            @php
                                                                $website = parse_url($data->website, PHP_URL_SCHEME);
                                                                if (empty($website)) {
                                                                    $data->website = 'http://' . ltrim($data->website, '/');
                                                                }
                                                            @endphp
                                                            <li><a target="_blank" href="{{$data->website}}"
                                                                   class="d-inline-block"><span><i
                                                                                class="fa fa-globe"></i></span> {{basename($data->website)}}
                                                                </a>
                                                            </li>
                                                        @endif
                                                        @if(!empty($data->facebook))
                                                            @php
                                                                $facebook = parse_url($data->facebook, PHP_URL_SCHEME);
                                                                if (empty($facebook)) {
                                                                    $data->facebook = 'https://www.facebook.com/' . ltrim($data->facebook, '/');
                                                            }
                                                            @endphp
                                                            <li><a target="_blank" href="{{$data->facebook}}"
                                                                   class="d-inline-block"><span><i
                                                                                class="fa fa-facebook"></i></span> {{basename($data->facebook)}}
                                                                </a>
                                                            </li>
                                                        @endif
                                                        @if(!empty($data->twitter))
                                                            @php

                                                                $twitter = parse_url($data->twitter, PHP_URL_SCHEME);
                                                                if (empty($twitter)) {
                                                                    $data->twitter = 'https://twitter.com/' . ltrim($data->twitter, '/');
                                                                }
                                                            @endphp
                                                            <li><a target="_blank" href="{{$data->twitter}}"
                                                                   class="d-inline-block"><span><i
                                                                                class="fa fa-twitter"></i></span> {{basename($data->twitter)}}
                                                                </a>
                                                            </li>
                                                        @endif
                                                        @if(!empty($data->instagram))
                                                            @php
                                                                $instagram = parse_url($data->instagram, PHP_URL_SCHEME);
                                                                if (empty($instagram)) {
                                                                    $data->instagram= 'https://www.instagram.com/' . ltrim($data['instagram'], '/');
                                                                }
                                                            @endphp
                                                            <li><a target="_blank" href="{{$data->instagram}}"
                                                                   class="d-inline-block"><span><i
                                                                                class="fa fa-instagram"></i></span> {{basename($data->instagram)}}
                                                                </a>
                                                            </li>
                                                        @endif
                                                        <li><a
                                                                    class="d-inline-block"><span><i
                                                                            class="fa fa-clock-o"
                                                                            aria-hidden="true"></i></span>
                                                                Registered {{timeAgo($data->on)}}</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="main-inner-profiletext">
                                                    <div class="row">
                                                        <div class="col-sm-8 col-md-8 col-lg-9">
                                                            <h3 class="heading-tags">
                                                                Top categories
                                                                <span>({{number_format(count($cate))}})</span>
                                                            </h3>
                                                        </div>
                                                        <div class="col-sm-4 col-md-4 col-lg-3 text-right">
                                                            <h3 class="heading-tags">
                                                                Reputation <span>{{ format_number_in_k($data->votes)}}</span>
                                                            </h3>
                                                        </div>
                                                    </div>
                                                    <ul class="tags-profile">
                                                        @foreach($cate as $k=>$v)

                                                            <li class="main-top">
                                                                <div class="row">
                                                                    <div class="col-sm-6">
                                                    <span class="tag">
                                                        <a href="{{route('home.category',['name'=>$v->catperma])}}">{{$v->categoryName}}</a>
                                                    </span>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="score-details text-sm-right">
                                                                            <ul class="pl-0">
                                                                                <li>
                                                                                    <span class="text">SCORE</span> {{$v->totalVotes}}
                                                                                </li>
                                                                                <li>
                                                                                    <span class="text">POSTS</span> {{$v->totalPosts}}
                                                                                </li>
                                                                                <li>
                                                                                    <span class="text">POSTS %</span> {{round((($v->totalPosts/count($data->question))*100),2)}}
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                    <!-- Tab panes -->
                                                    <div class="tab-content">
                                                        <div class="tab-pane container active px-sm-0" id="question">
                                                            <h3 class="heading-tags bordr-b">
                                                                Badges <span>({{$data->badgesGold+$data->badgesSilver+$data->badgesBronze}})</span>
                                                            </h3>
                                                            <div class="row">
                                                                <div class="col-sm-4 col-md-4 px-0">
                                                                    <div class="badges-number text-center">
                                                                        <span class="name">Gold</span>
                                                                        <span class="number">{{$data->badgesGold}}</span>
                                                                    </div>
                                                                    @if(count($gold)>0)
                                                                        <div class="rarest">
                                                                            <ul class="badges-list list-unstyled">
                                                                                @foreach($gold as $r)
                                                                                    <li>
                                                                                        <a title="bronze badge"
                                                                                           class="badge"><span
                                                                                                    class="badge3"></span>{{$r->name}}
                                                                                        </a>
                                                                                        <span class="badge-date">{{timeAgo($r->on)}}</span>
                                                                                    </li>
                                                                                @endforeach
                                                                            </ul>
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                                <div class="col-sm-4 col-md-4 px-0 bdr-badges">
                                                                    <div class="badges-number text-center">
                                                                        <span class="name">SILVER</span>
                                                                        <span class="number">{{$data->badgesSilver}}</span>
                                                                    </div>
                                                                    @if(count($sliver)>0)
                                                                        <div class="rarest">
                                                                            <ul class="badges-list list-unstyled">
                                                                                @foreach($sliver as $r)
                                                                                    <li>
                                                                                        <a title="bronze badge"
                                                                                           class="badge"><span
                                                                                                    class="badge3"></span>{{$r->name}}
                                                                                        </a>
                                                                                        <span class="badge-date">{{timeAgo($r->on)}}</span>
                                                                                    </li>
                                                                                @endforeach
                                                                            </ul>
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                                <div class="col-sm-4 col-md-4 px-0">
                                                                    <div class="badges-number text-center">
                                                                        <span class="name">BRONZE</span>
                                                                        <span class="number">{{$data->badgesBronze}}</span>
                                                                    </div>
                                                                    @if(count($bronze)>0)
                                                                        <div class="rarest">
                                                                            <ul class="badges-list list-unstyled">
                                                                                @foreach($bronze as $r)
                                                                                    <li>
                                                                                        <a title="bronze badge"
                                                                                           class="badge"><span
                                                                                                    class="badge3"></span>{{$r->name}}
                                                                                        </a>
                                                                                        <span class="badge-date">{{timeAgo($r->on)}}</span>
                                                                                    </li>
                                                                                @endforeach
                                                                            </ul>
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="user-panel mt-30px">
                                                            <label class="fs-15 text-black lh-20 fw-medium">About
                                                                me</label>
                                                            {!!  decodeContent($data->description) !!}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="user-activity" role="tabpanel"
                             aria-labelledby="user-activity-tab">
                            <div class="user-panel-main-bar">
                                <div class="row my-3 ">
                                    <div class="col-xl-3 col-md-6  my-2 my-xl-0">
                                        <div class="d-inline-block profileupper-option">
                                            <h6 class="text-uper-profile">
                                                <span class="icon-upper"><i class="icon ion-md-help"></i></span>
                                                <div class="content">
                                                    <div class="card-title is-tile text-right">
                                                        Questions
                                                        <div class="card-stat primary text-right">{{format_number_in_k(count($data->question))}}</div>
                                                    </div>
                                                </div>
                                                <div class="more">

                                                </div>
                                            </h6>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-md-6  my-2 my-xl-0">
                                        <div class="d-inline-block profileupper-option">
                                            <h6 class="text-uper-profile">
                                                <span class="icon-upper"><i class="icon ion-md-chatbubbles"></i></span>
                                                <div class="content">
                                                    <div class="card-title is-tile text-right">
                                                        Answers
                                                        <div class="card-stat primary text-right">{{format_number_in_k(count($data->answers))}}</div>
                                                    </div>
                                                </div>
                                                <div class="more">

                                                </div>
                                            </h6>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-md-6  my-2 my-xl-0">
                                        <div class="d-inline-block profileupper-option">
                                            <h6 class="text-uper-profile">
                                                <span class="icon-upper"><i class="icon ion-md-eye"></i></span>
                                                <div class="content">
                                                    <div class="card-title is-tile text-right">
                                                        Profile Views
                                                        <div class="card-stat primary text-right">{{format_number_in_k($data->views)}}</div>
                                                    </div>
                                                </div>
                                                <div class="more">

                                                </div>
                                            </h6>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-md-6  my-2 my-xl-0">
                                        <div class="d-inline-block profileupper-option">
                                            <h6 class="text-uper-profile">
                                                <span class="icon-upper"><i class="icon ion-md-people"></i></span>
                                                <div class="content">
                                                    <div class="card-title is-tile text-right">
                                                        People reached
                                                        <div class="card-stat primary text-right">{{format_number_in_k($data->peopleReached)}}</div>
                                                    </div>
                                                </div>
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="user-panel mb-40px">
                                    <div class="bg-gray p-3 rounded-rounded d-flex align-items-center justify-content-between">
                                        <h3 class="fs-17">Questions</h3>
                                        <div class="filter-option-box flex-grow-1 d-flex align-items-center justify-content-end lh-1">
                                            <label class="fs-14 fw-medium mr-2 mb-0">Sort</label>
                                            <div class="w-100px">
                                                <select class="select-container form-control" id="ques_sort">
                                                    <option selected="selected" value="Votes">Votes</option>
                                                    <option value="newest">Newest</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="summary-panel">
                                        <div class="vertical-list" id="activity_question">
                                        </div>
                                    </div><!-- end summary-panel -->
                                </div>
                                <div class="summary-panel">
                                    <div class="border-bottom border-bottom-gray p-3 d-flex align-items-center justify-content-between">
                                        <h4 class="fs-15 fw-regular">Answers</h4>
                                        <div class="filter-option-box flex-grow-1 d-flex align-items-center justify-content-end lh-1">
                                            <label class="fs-14 fw-medium mr-2 mb-0">Sort</label>
                                            <div class="w-100px">
                                                <select class="select-container form-control" id="ans_sort">
                                                    <option selected="selected" value="Votes">Votes</option>
                                                    <option value="newest">Newest</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="vertical-list" id="activity_answser">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        function fetch_data(page, type = 'question') {
            var sort = '';
            if (type == 'question') {
                sort = $('#ques_sort').val();
                var type = 'question';
            } else {
                sort = $('#ans_sort').val();
                var type = 'answers';
            }
            var url = "{{ route('user.get_activity') }}?page=" + page + "&userid={{$data->id}}&sort=" + sort + "&type=" + type;
            $.ajax({
                url: url,
                success: function (data) {
                    if (type == 'question') {
                        $('#activity_question').html(data);
                    } else {
                        $('#activity_answser').html(data);
                    }
                }
            });
        }

        $(document).ready(function () {
            fetch_data(1, 'question');
            fetch_data(1, 'answers');
        });
        $(document).on('click', '.page-link', function (event) {
            var type = $(this).attr('val');
            event.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            fetch_data(page, type);
        });
        $(document).on('change', '#ans_sort', function () {
            fetch_data(1, 'answers');
        });
        $(document).on('change', '#ques_sort', function () {
            fetch_data(1, 'question');
        });
    </script>
@endsection