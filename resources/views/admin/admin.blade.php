@extends('layouts.app')

@section('content')

@section('content_header', 'Dashboard')
<!-- Start Status area -->
<div class="notika-status-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <div class="wb-traffic-inner notika-shadow sm-res-mg-t-30 tb-res-mg-t-30">
                    <div class="website-traffic-ctn">
                        <h2><span class="counter">{{number_format($totalq)}}</span></h2>
                        <p>Total questions</p>
                    </div>
                    <div class="sparkline-bar-stats1">9,4,8,6,5,6,4,8,3,5,9,5</div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <div class="wb-traffic-inner notika-shadow sm-res-mg-t-30 tb-res-mg-t-30">
                    <div class="website-traffic-ctn">
                        <h2><span class="counter">{{number_format($totala)}}</span></h2>
                        <p>Total answers</p>
                    </div>
                    <div class="sparkline-bar-stats2">1,4,8,3,5,6,4,8,3,3,9,5</div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <div class="wb-traffic-inner notika-shadow sm-res-mg-t-30 tb-res-mg-t-30">
                    <div class="website-traffic-ctn">
                        <h2><span class="counter">{{number_format($totalu)}}</span></h2>
                        <p>Total Users</p>
                    </div>
                    <div class="sparkline-bar-stats3">1,4,8,3,5,6,4,8,3,3,9,5</div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <div class="wb-traffic-inner notika-shadow sm-res-mg-t-30 tb-res-mg-t-30">
                    <div class="website-traffic-ctn">
                        <h2><span class="counter">{{number_format($totalc)}}</span></h2>
                        <p>Total Category</p>
                    </div>
                    <div class="sparkline-bar-stats4">1,4,8,3,5,6,4,8,3,3,9,5</div>
                </div>
            </div>

        </div>
    </div>
</div>
<div class="breadcomb-area">

</div>
<!-- End Status area-->

<div class="notika-email-post-area">
    <div class="container">
        <div class="row aligned-row">
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <div class="recent-signup-inner notika-shadow">
                    <div class="realtime-ctn">
                        <div class="realtime-title widget-inner-wp signup-hd-wd">
                            <h2>Most Recent Signups</h2>
                        </div>
                    </div>
                    <div class="widget-signup-list">
                        @foreach($user as $r)
                            @if($r->image =='default-user-image.png')
                                <a class="signup-wd-mn" data-toggle="tooltip" data-placement="top" title="{{$r->name}}"
                                   href="{{route('user.profile',['id'=>$r->id,'name'=>$r->name])}}">{{substr($r->name, 0,1)}}</a>
                            @else
                                <a class="signup-wd-mn" data-toggle="tooltip" data-placement="top" title="{{$r->name}}"
                                   href="{{route('user.profile',['id'=>$r->id,'name'=>$r->name])}}"><img
                                            src="{{ asset('public/uploads/users').'/'.$r->image }}"
                                            alt="{{$r->name}}"/></a>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <div class="recent-post-wrapper notika-shadow sm-res-mg-t-30 tb-res-ds-n dk-res-ds">
                    <div class="recent-post-ctn">
                        <div class="recent-post-title">
                            <h2>Recent Answers</h2>
                        </div>
                    </div>
                    <div class="recent-post-items">
                        @foreach($answers as $k=>$row)
                            <div class="recent-post-signle mg-t-20">
                                <div class="recent-post-flex">
                                    <div class="recent-post-img">
                                       <a href="{{route('user.profile',['id'=>$row->userid,'name'=>$row->User->name])}}"> <img src="{{ asset('public/uploads/users').'/'.$row->User->image }}"
                                             alt="{{$row->User->name}}" style="max-width: 36px;height: auto;"></a>
                                    </div>
                                    <div class="recent-post-it-ctn">
                                        <h2><a href="{{route('user.profile',['id'=>$row->userid,'name'=>$row->User->name])}}">{{$row->User->name}}</a></h2>
                                        <p><a href="{{ route('home.question', ['name' => $row->question->permalink]) }}">{{$row->question->title}}</a></p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <div class="search-engine-int tb-res-ds-n dk-res-ds">
                    <div class="contact-hd search-hd-eg">
                        <h2>Recent Question</h2>
                    </div>
                    <div class="search-eg-table">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Question</th>
                                <th class="text-right">Answers</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($questions as $k=>$row)
                                <tr>
                                    <td>
                                        <a href="{{ route('home.question', ['name' => $row->permalink]) }}">{{$row->title}}</a>
                                    </td>
                                    <td class="text-right">
                                        <h4>{{number_format($row->awnsers)}}</h4>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="recent-post-signle">
                        <a href="{{action('QuestionsController@index')}}">
                            <div class="recent-post-flex rc-ps-vw">
                                <div class="recent-post-line rct-pt-mg">
                                    <p>View All</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<div class="realtime-statistic-area">
    <div class="container">
        <div class="row aligned-row">
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <div class="search-engine-int mg-t-30 tb-res-ds-n dk-res-ds">
                    <div class="contact-hd search-hd-eg">
                        <h2>Reported Questions</h2>
                    </div>
                    <div class="search-eg-table">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Question</th>
                                <th class="text-right">Reason</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($reportQ as $k=>$row)
                                <tr>
                                    <td>
                                        <a href="{{ route('home.question', ['name' => $row->question->permalink]) }}">{{$row->question->title}}</a>
                                    </td>
                                    <td class="text-right">
                                        <h4>{{$row->schema->name}}</h4>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="view-all-onging">
                        <a href="{{action('QuestionsController@reportQ')}}">View All</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <div class="search-engine-int mg-t-30 tb-res-ds-n dk-res-ds">
                    <div class="contact-hd search-hd-eg">
                        <h2>Reported Answers</h2>
                    </div>
                    <div class="search-eg-table">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Question</th>
                                <th class="text-right">Reason</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($reportA as $k=>$row)
                                <tr>
                                    <td>
                                        @php if(isset($row->answer->qid)){$Aquestion = \App\Questions::select('permalink','title')->where('id',$row->answer->qid)->First();
                                           $link =  route('home.question',['name'=>$Aquestion->permalink]);
                                        }else{$link='';} @endphp
                                        <a href="{{ $link }}">{{$Aquestion->title}}</a>
                                    </td>
                                    <td class="text-right">
                                        <h4>{{$row->schema->name}}</h4>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="view-all-onging">
                        <a href="{{action('QuestionsController@reportA')}}">View All</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <div class="blog-inner-list notika-shadow mg-t-30  tb-res-ds-n dk-res-ds">
                    <div class="blog-img">
                        <a href="{{route('home.blogsDetail',['name'=>$blog->slug])}}"> <img
                                    src="{{ asset('public/uploads/news').'/'.$blog->image }}" alt=""/></a>
                    </div>
                    <div class="blog-ctn">
                        <div class="blog-hd-sw">
                            <h2><a href="{{route('home.blogsDetail',['name'=>$blog->slug])}}">{{$blog->title}}</a></h2>
                            <a class="bg-au">{{timeAgo($blog->created_at)}}</a>
                        </div>
                        <p>{{$blog->description}}</p>
                    </div>
                    <div class="view-all-onging">
                        <a href="{{action('NewsController@index')}}">View All</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
