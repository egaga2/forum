@extends('layouts.home')
@section('title', 'Users - ')
@section('description', $site['site_description'])
@section('content')
    <section class="question-area pt-40px pb-40px">
        <div class="container">
            <div class="filters pb-3">
                <div class="d-flex flex-wrap align-items-center justify-content-between pb-3">
                    <h3 class="fs-22 fw-medium">Users</h3>
                </div>
                <div class="d-flex flex-wrap align-items-center justify-content-between">
                    <div class="form-group">
                        <input class="form-control" type="text" placeholder="Filter by user" id="txtsearch" name="timkiem" autocomplete="off" value="">
                    </div>
                    <div class="btn-group btn--group mb-3" role="group" aria-label="Filter button group">
                        <a href="javascript:void(0)" type="all" class="btn active catfilter">All</a>
                        <a href="javascript:void(0)" type="new" class="btn catfilter">New Users</a>
                        <a href="javascript:void(0)" type="name" class="btn catfilter">Name</a>
                        <a href="javascript:void(0)" type="votes" class="btn catfilter">Votes</a>
                        <a href="javascript:void(0)" type="mod" class="btn catfilter">Moderators</a>
                    </div>
                </div>
            </div><!-- end filters -->
            <div id="table_data">
                @include('partials.users')
            </div>
        </div><!-- end container -->
    </section>
@endsection
@section('scripts')
    <script>
        $(document).ready(function () {
            function fetch_data(page) {
                var search = $('#txtsearch').val();
                var filter = $('.catfilter.active').attr('type');
                var condition = "&text=" + search + "&sort=" + filter;
                url = "{{ route('home.getlistuser') }}?page=" + page + condition;
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
