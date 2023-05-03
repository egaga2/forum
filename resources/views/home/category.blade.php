@extends('layouts.home')
@section('title', $cate->name)
@section('description',$cate->description)
@section('content')
    <section class="question-area pt-30px pb-30px">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="question-main-bar pb-45px">
                        <div class="filters pb-4">
                            <div class="d-flex flex-wrap align-items-center justify-content-between pb-4">
                                <div class="pr-3">
                                    <h3 class="fs-22 fw-medium">{{$cate->name}}</h3>
                                    <p class="fs-15 lh-22 my-2">{{$cate->description}}</p>
                                </div>
                            </div>
                            <div class="d-flex flex-wrap justify-content-between">
                                <div class="form-group">
                                    <input class="form-control form--control form-control-sm h-auto lh-34" type="text"
                                           name="search" id="txtsearch" placeholder="Search Questions">
                                </div>
                                <div class="btn-group btn--group mb-3" role="group" aria-label="Filter button group">
                                    <a href="javascript:void(0)" type="all" class="btn active catfilter">All</a>
                                    <a href="javascript:void(0)" type="name" class="btn catfilter">Name</a>
                                    <a href="javascript:void(0)" type="popular" class="btn catfilter">Popular</a>
                                    <a href="javascript:void(0)" type="new" class="btn catfilter">New</a>
                                </div>
                            </div>
                        </div><!-- end filters -->
                        <div id="table_data">
                            @include('partials.question')
                        </div>
                    </div><!-- end question-main-bar -->
                </div><!-- end col-lg-9 -->
                <div class="col-lg-3">
                    @include('partials.rightsidebar')
                </div><!-- end col-lg-3 -->
            </div><!-- end row -->
        </div><!-- end container -->
    </section>
@endsection
@section('scripts')
    <script>
        $(document).ready(function () {
            function fetch_data(page) {
                var search = $('#txtsearch').val();
                var filter = $('.catfilter.active').attr('type');
                var condition = "&cate={{$cate->id}}&text=" + search + "&sort=" + filter;
                url = "{{ route('home.get_ajax_cate_question') }}?page=" + page + condition;
                $.ajax({
                    url: url,
                    success: function (data) {
                        $('#table_data').html(data);
                    }
                });
            }

            var delay = (function () {
                var timer = 0;
                return function (callback, ms) {
                    clearTimeout(timer);
                    timer = setTimeout(callback, ms);
                };
            })();
            $(document).on('keyup keydown', '#txtsearch', function () {
                var next = $('#nextPage').attr('val');
                delay(function () {
                    fetch_data(next);
                }, 400);
            });
            $(document).on('click', '.catfilter', function () {
                var next = $('#nextPage').attr('val');
                $('.catfilter').removeClass('active');
                $(this).addClass('active');
                fetch_data(0);
            });
            $(document).on('click', '.page-link', function (event) {
                event.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                fetch_data(page);
            });
        });
    </script>
@endsection