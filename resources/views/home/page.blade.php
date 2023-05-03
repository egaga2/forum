@extends('layouts.home')
@section('title', $page->title)
@section('description', $site['site_description'])
@section('content')
    <section class="question-area pt-40px pb-40px main-body">
        <div class="container ">
            <div class="card card-item">
                <div class="card-body row">
                    <div class="col-lg-3">
                        <ul class="js-scroll-nav js--scroll-nav">
                            @foreach($allpage as $k=>$r)
                                <li><a href="{{route('home.page',['slug'=>$r->slug])}}" class="page-scroll">{{$k+1}}
                                        . {{$r->title}}</a></li>
                            @endforeach
                        </ul>
                    </div><!-- end col-lg-3 -->
                    <div class="col-lg-9">
                        <div class="terms-panel-main-bar pl-3">
                            <div class="terms-panel mb-30px" id="information-we-collect-and-how-we-use-it">
                                <h3 class="fs-20 pb-3 fw-bold">{{$page->title}}</h3>
                                <div>{!! $page->details !!}</div>
                            </div><!-- end terms-panel -->
                        </div><!-- end terms-panel-main-bar -->
                    </div><!-- end col-lg-9 -->
                </div>
            </div>
        </div><!-- end container -->
    </section>
@endsection

