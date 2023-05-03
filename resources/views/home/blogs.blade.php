@extends('layouts.home')
@section('title', 'Blogs - ')
@section('description', $site['site_description'])
@section('content')
    <section class="hero-area shadow-sm overflow-hidden pt-40px">
        <span class="stroke-shape stroke-shape-1"></span>
        <span class="stroke-shape stroke-shape-2"></span>
        <span class="stroke-shape stroke-shape-3"></span>
        <span class="stroke-shape stroke-shape-4"></span>
        <span class="stroke-shape stroke-shape-5"></span>
        <span class="stroke-shape stroke-shape-6"></span>
        <div class="container">
            <div class="hero-content text-left">
                <h2 class="section-title pb-3">Blogs</h2>
                <ul class="breadcrumb-list">
                    <li><a href="{{route('home.index')}}">Home</a><span><svg xmlns="http://www.w3.org/2000/svg"
                                                                             height="19px"
                                                                             viewBox="0 0 24 24" width="19px"
                                                                             fill="#000000"><path
                                        d="M0 0h24v24H0V0z" fill="none"></path><path
                                        d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6-6-6z"></path></svg></span></li>
                    <li>Blogs</li>
                </ul>
            </div><!-- end hero-content -->
        </div><!-- end container -->
    </section>
    <section class="blog-area pt-20px pb-30px">
        <div class="container">
            <div class="row">
                @foreach($data as $r)
                    <div class="col-lg-4 responsive-column-half">
                        <div class="card card-item hover-y">
                            <a href="{{route('home.blogsDetail',['name'=>$r->slug])}}" class="card-img">
                                <img class="lazy"
                                     src="{{ asset('public/uploads/news').'/'.$r->image }}"
                                     alt="{{$r->title}}">
                            </a>
                            <div class="card-body pt-2">
                                <h5 class="card-title fw-medium"><a href="{{route('home.blogsDetail',['name'=>$r->slug])}}">{{$r->title}}</a></h5>
                                <div class="media-body">
                                    <h5 class="fs-14 fw-medium">{{$r->description}}</h5>
                                    <small class="meta d-block lh-20">
                                        <span>{{timeAgo($r->created_at)}}</span>
                                    </small>
                                </div>
                            </div><!-- end card-body -->
                        </div><!-- end card -->
                    </div><!-- end col-lg-4 -->
                @endforeach
            </div><!-- end row -->
            <div class="pager text-center pt-30px">
                {!! $data->links() !!}
            </div>
        </div><!-- end container -->
    </section>
@endsection
