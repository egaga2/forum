@extends('layouts.home')
@section('title', !empty($data->title_seo)?$data->title_seo:$data->title)
@section('description', !empty($data->description_seo)?$data->description_seo:$data->description)
@section('content')
    <section class="hero-area shadow-sm overflow-hidden pt-50px pb-30px">
        <span class="stroke-shape stroke-shape-1"></span>
        <span class="stroke-shape stroke-shape-2"></span>
        <span class="stroke-shape stroke-shape-3"></span>
        <span class="stroke-shape stroke-shape-4"></span>
        <span class="stroke-shape stroke-shape-5"></span>
        <span class="stroke-shape stroke-shape-6"></span>
        <div class="container">
            <div class="hero-content">
                <ul class="breadcrumb-list pb-2">
                    <li><a href="{{route('home.index')}}">Home</a><span><svg xmlns="http://www.w3.org/2000/svg"
                                                                             height="19px" viewBox="0 0 24 24"
                                                                             width="19px" fill="#000000"><path
                                        d="M0 0h24v24H0V0z" fill="none"></path><path
                                        d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6-6-6z"></path></svg></span></li>
                    <li><a href="{{route('home.blogs')}}">Blogs</a><span><svg xmlns="http://www.w3.org/2000/svg"
                                                                              height="19px" viewBox="0 0 24 24"
                                                                              width="19px" fill="#000000"><path
                                        d="M0 0h24v24H0V0z" fill="none"></path><path
                                        d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6-6-6z"></path></svg></span></li>
                    <li>{{$data->title}}</li>
                </ul>
                <h2 class="section-title">{{$data->title}}</h2>
                <small class="meta d-block lh-20">
                    <span class="mr-2">{{timeAgo($data->created_at)}}</span>
                </small>
            </div><!-- end hero-content -->
        </div><!-- end container -->
    </section>
    <section class="blog-area pt-0px pb-30px">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="card card-item">
                        <div class="card-body">
                            <p class="font-weight-bold">{{$data->description}}</p>
                            <div class="text-center p-3">
                                <img class="lazy" style="width: 100%; max-width: 500px;"
                                     src="{{ asset('public/uploads/news').'/'.$data->image }}"
                                     alt="{{$data->title}}">
                            </div>
                            {!! decodeContent($data->details) !!}
                        </div><!-- end card-body -->
                    </div><!-- end card -->
                    @if(!empty($other))
                                <h4 class="pb-3 fs-20">Related posts</h4>
                                <div class="row mt-0px">
                                    @foreach($other as $r)
                                        <div class="col-lg-4 responsive-column-half">
                                            <div class="card card-item hover-y">
                                                <a href="{{route('home.blogsDetail',['name'=>$r->slug])}}"
                                                   class="card-img">
                                                    <img class="lazy"
                                                         src="{{ asset('public/uploads/news').'/'.$r->image }}"
                                                         alt="{{$r->title}}">
                                                </a>
                                                <div class="card-body pt-2">
                                                    <h5 class="card-title fw-medium"><a
                                                                href="{{route('home.blogsDetail',['name'=>$r->slug])}}">{{$r->title}}</a>
                                                    </h5>
                                                    <small class="meta d-block lh-20">
                                                        <span>{{timeAgo($r->created_at)}}</span>
                                                    </small>
                                                </div><!-- end card-body -->
                                            </div><!-- end card -->
                                        </div><!-- end col-lg-4 -->
                                    @endforeach
                                </div>

                    @endif
                </div><!-- end col-lg-8 -->
                <div class="col-lg-3">
                    @include('partials.rightsidebar')
                </div><!-- end col-lg-4 -->
            </div><!-- end row -->
        </div><!-- end container -->
    </section>
@endsection
