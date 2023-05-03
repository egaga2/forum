@extends('layouts.home')
@section('title', 'Notifications - ')
@section('description', $site['site_description'])
@section('style')
    <link rel="stylesheet" href="{{ asset('public/theme/plugins/jqueryTextEditor/jquery-te.css') }}">
    <link rel="stylesheet" href="{{ asset('public/theme/plugins/jqueryConfirm/jquery-confirm.css') }}">
@endsection
@section('content')
    <section class="user-details-area pt-30px pb-30px">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 inner-question main p-3">
                    <div class="hero-content d-flex align-items-center pb-4">
                        <div class="icon-element shadow-sm flex-shrink-0 mr-3 border border-gray">
                            <svg class="svg-icon-color-5" height="30" viewBox="0 0 512 512" width="30"
                                 xmlns="http://www.w3.org/2000/svg">
                                <g>
                                    <path d="m411 262.862v-47.862c0-69.822-46.411-129.001-110-148.33v-21.67c0-24.813-20.187-45-45-45s-45 20.187-45 45v21.67c-63.59 19.329-110 78.507-110 148.33v47.862c0 61.332-23.378 119.488-65.827 163.756-4.16 4.338-5.329 10.739-2.971 16.267s7.788 9.115 13.798 9.115h136.509c6.968 34.192 37.272 60 73.491 60 36.22 0 66.522-25.808 73.491-60h136.509c6.01 0 11.439-3.587 13.797-9.115s1.189-11.929-2.97-16.267c-42.449-44.268-65.827-102.425-65.827-163.756zm-170-217.862c0-8.271 6.729-15 15-15s15 6.729 15 15v15.728c-4.937-.476-9.94-.728-15-.728s-10.063.252-15 .728zm15 437c-19.555 0-36.228-12.541-42.42-30h84.84c-6.192 17.459-22.865 30-42.42 30zm-177.67-60c34.161-45.792 52.67-101.208 52.67-159.138v-47.862c0-68.925 56.075-125 125-125s125 56.075 125 125v47.862c0 57.93 18.509 113.346 52.671 159.138z"></path>
                                    <path d="m451 215c0 8.284 6.716 15 15 15s15-6.716 15-15c0-60.1-23.404-116.603-65.901-159.1-5.857-5.857-15.355-5.858-21.213 0s-5.858 15.355 0 21.213c36.831 36.831 57.114 85.8 57.114 137.887z"></path>
                                    <path d="m46 230c8.284 0 15-6.716 15-15 0-52.086 20.284-101.055 57.114-137.886 5.858-5.858 5.858-15.355 0-21.213-5.857-5.858-15.355-5.858-21.213 0-42.497 42.497-65.901 98.999-65.901 159.099 0 8.284 6.716 15 15 15z"></path>
                                </g>
                            </svg>
                        </div>
                        <h2 class="section-title fs-30">Notifications</h2>
                    </div><!-- end hero-content -->
                    <div class="notification-content-wrap">
                        @foreach($data as $index=>$value)
                            <div class="media media-card media--card shadow-none rounded-0 align-items-center bg-transparent border-bottom"
                                 id="noti{{$value->id}}">
                                <div class="date-notify m-2">
                                    {{date('F d',strtotime($value->on))}}
                                </div>
                                <div class="media-body p-0 border-left-0">
                                    <small class="meta d-block lh-24">
                                        <span class="notify-type">{{$value->schema->title}}</span>
                                    </small>
                                    @if($value->schema->type =='question')
                                        @if(!isset($value->question->title))
                                            <div class="notify-allheading text-gray"><p>This question has been
                                                    deleted</p></div>
                                        @else
                                            <div class="notify-allheading"><a
                                                        href="{{route('home.question',['name'=>$value->question->permalink])}}">{{$value->question->title}}</a>
                                            </div>
                                        @endif
                                    @elseif($value->schema->type =='badge')
                                        <div class="notify-allheading"><a
                                                    href="{{route('user.profile',['id'=>Auth::user()->id])}}">{{str_replace('(badgeName)',$value->badges->name,$value->schema->description)}}</a>
                                        </div>
                                    @elseif($value->schema->type =='reputation')
                                        <div class="notify-allheading"><a
                                                    href="{{route('user.profile',['id'=>Auth::user()->id])}}">{{str_replace('(reputation)',$value->reputation->reputation,$value->schema->description)}}</a>
                                        </div>
                                    @endif
                                </div>
                                <a class="btn border border-gray fs-17 ml-2 btndelete" val="{{$value->id}}">
                                    <i class="fa fa-trash"></i></a>
                            </div><!-- end media -->
                        @endforeach
                    </div><!-- end notification-content-wrap -->
                    <div class="pager pt-20px">
                        {!! $data->links() !!}
                    </div>
                </div><!-- end col-lg-9 -->
                <div class="col-lg-3">
                    @include('partials.rightsidebar')
                </div><!-- end col-lg-3 -->
            </div><!-- end row -->
        </div><!-- end container -->
    </section>
@endsection
@section('scripts')
    <script type="text/javascript"
            src="{{ asset('public/theme/plugins/jqueryTextEditor/jquery-te-1.4.0.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/theme/plugins/jqueryConfirm/jquery-confirm.js') }}"></script>
    <script>
        function deleteAReply(arid) {
            $.confirm({
                title: 'Are you sure ?',
                content: 'You want to delete this notification?',
                buttons: {
                    deleteAnswer: {
                        text: 'delete notification',
                        action: function () {
                            var that = this;
                            var fd = new FormData();
                            fd.append('id', arid);
                            fd.append("_token", "{{ csrf_token() }}");
                            $.ajax({
                                url: '{{route('home.deletenotify')}}',
                                type: "POST",
                                data: fd,
                                processData: false,
                                contentType: false,
                                success: function (response) {
                                    if (response.type == 1) {
                                        $.alert(response.html);
                                        $('#noti' + arid).remove();
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
        $(document).on('click', '.btndelete', function () {
            var arid = $(this).attr('val');
            deleteAReply(arid);
        });

    </script>
@endsection
