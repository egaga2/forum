@extends('layouts.home')
@section('description', $site['site_description'])
@section('content')
    <div id="preloader" class="containers">
        <svg class="pre loader" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 340 340">
            <!-- <circle cx="170" cy="170" r="160" stroke="#fff"></circle>-->
            <circle cx="170" cy="170" r="135" stroke="#007ee5"></circle>
            <circle cx="170" cy="170" r="110" stroke="#fff"></circle>
            <circle cx="170" cy="170" r="85" stroke="#007ee5"></circle>
        </svg>
    </div>
    <div class="main-body">
        <div class="upper-search">
            <div class="container custom">
                <div class="row justify-content-sm-center">
                    <div class="col-sm-11 col-md-10 col-lg-10">
                        <h3 class="heading-main">
                            Share &amp; grow the world's knowledge!
                        </h3>
                        <p class="sub-heading">We want to connect the people who have knowledge to the people who need
                            it, to bring together people with different perspectives so they can understand each other
                            better, and to empower everyone to share their knowledge.</p>
                    </div>
                    <div class="col-sm-11 col-md-7">
                        <div class="inner-search row">
                            <input type="text" value="" name="txtsearch" id="search"
                                   class="col-9 col-sm-10 col-md-11 main-search"
                                   placeholder="Search" autocomplete="off"/>
                            <div id="loaderSearch" class="d-none loader-main-input">
                                <!-- Loader 5 -->
                                <div class=" loader-5 center"><span></span></div>
                            </div>
                            <button id="searchBtn" type="button" class="col-3 col-sm-2 col-md-1  btn btn-search-upper">
                                <i class="icon ion-md-search"></i></button>
                            <button id="clearSearch" type="button" class="d-none close-search"><span><i
                                            class="fa fa-times-circle" aria-hidden="true"></i></span></button>
                            <div id="searchDropdown" class="search-drpdon-main d-none"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="question-area pt-30px pb-30px">
        <div class="container">
            <div class="row">
                <div class="col-lg-2 pr-0">
                    @include('partials.leftsidebar')
                </div><!-- end col-lg-2 -->
                <div class="col-lg-7 px-0">
                    <div class="question-main-bar border-left border-left-gray pb-0">
                        <div class="filters pl-3 d-flex justify-content-between">
                            <div class="mr-3">
                                <h3 class="fs-18 fw-medium">All Questions</h3>
                                <p class="pt-1 fs-14 fw-medium lh-20">{{number_format($q_count)}} questions</p>
                            </div>
                            <div class="filter-option-box w-20 pb-3 pr-3">
                                <select class="form-control" id="q_sort">
                                    <option value="newest" selected="selected">Newest</option>
                                    <option value="latest">Latest</option>
                                    <option value="votes">Votes</option>
                                    <option value="views">Views</option>
                                    <option value="awnsers">Awnsers</option>
                                    <option value="unanswered">Unanswered</option>
                                </select>
                            </div><!-- end filter-option-box -->
                        </div><!-- end filters -->
                        <div class="questions-snippet border-top border-top-gray" id="post_data">
                        </div><!-- end questions-snippet -->
                    </div><!-- end question-main-bar -->
                </div><!-- end col-lg-7 -->
                <div class="col-lg-3">
                    @include('partials.rightsidebar')
                </div>
            </div><!-- end row -->
        </div><!-- end container -->
    </section>

@endsection
@section('scripts')
    <script>
        function load_data(id = "", sort = '') {
            $.ajax({
                url: "{{route('home.loadquestion')}}",
                method: "POST",
                data: {id: id, sort: sort, "_token": "{{ csrf_token() }}"},
                success: function (data) {
                    $('#load_more_button').remove();
                    $('#post_data').append(data);
                }, error: () => {
                    if (window.confirm("This page is expired , Please click Yes to reload the page")) {
                        window.location.reload(true);
                    }
                }
            })
        }

        $(document).on('click', '#load_more_button', function () {
            var id = $(this).data('id');
            var sort = $('#q_sort').val();
            $('#load_more_button').html('<b>Loading...</b>');
            load_data(id, sort);
        });
        var delay = (function () {
            var timer = 0;
            return function (callback, ms) {
                clearTimeout(timer);
                timer = setTimeout(callback, ms);
            };
        })();

        function search() {
            var search = $('#search').val().trim();
            if (search.length == 0) {
                $('#searchDropdown').addClass('d-none');
                $('#clearSearch').addClass('d-none');
                return false;
            }
            $('#clearSearch').addClass('d-none');
            $('#loaderSearch').removeClass('d-none');
            var text = $('#search').val().trim();
            $.ajax({
                url: "{{route('home.search_question')}}",
                type: 'POST',
                data: {
                    "text": text,
                    "_token": "{{ csrf_token() }}",
                },
                success: function (result) {
                    $('#searchDropdown').html(result.html);
                    $('#searchDropdown').removeClass('d-none');
                    $('#clearSearch').removeClass('d-none');
                    $('#loaderSearch').addClass('d-none');
                }, error: function (xhr, data, error) {
                    if (window.confirm("This page is expired , Please click Yes to reload the page")) {
                        window.location.reload(true);
                    } else {
                        $('#loaderSearch').addClass('d-none');
                    }
                }
            });
        }

        $(document).ready(function () {
            var sort = $('#q_sort').val();
            load_data(0, sort);
        });
        $(document).on('keyup keydown', '#search', function () {
            delay(function () {
                search();
            }, 400);
        });
        $(document).on('click', '#searchBtn', function () {
            search();
        });
        $(document).on('change', '#q_sort', function () {
            var sort = $(this).val();
            $.ajax({
                url: "{{route('home.loadquestion')}}",
                method: "POST",
                data: {sort: sort, "_token": "{{ csrf_token() }}"},
                success: function (data) {
                    $('#load_more_button').remove();
                    $('#post_data').html(data);
                }, error: () => {
                    if (window.confirm("This page is expired , Please click Yes to reload the page")) {
                        window.location.reload(true);
                    }
                }
            })
        });
        $(document).on('click', '#clearSearch', function () {
            $('#search').val('');
            $('#searchDropdown').html('');
            $(this).addClass('d-none');
        });

    </script>
@endsection
