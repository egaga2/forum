<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') {{$site['site_title']}} </title>
    <meta name="description" content="{{$site['site_description']}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('public/theme/images/favicon.png') }}">
    <meta name="keywords" content="">
    <meta name="robots" content="index,follow"/>

    <!-- ===== Style CSS ===== -->
    <link rel="stylesheet" type="text/css" href="{{ asset('public/theme/css/style.css') }}">
    <!-- ===== Responsive CSS ===== -->
    <link rel="stylesheet" type="text/css" href="{{ asset('public/theme/css/responsive.css') }}">

    {!! $site['before_head_tag'] !!}

</head>
<body>

{!! $site['after_head_tag'] !!}

<div class="wrapper">

    <header class="block header fixed">
        <div class="container">
            <div class="block_logo">
                <a href="{{ route('home.index',app()->getLocale()) }}" title="{{$site['site_title']}}">
                    <img alt="{{ config('app.name', 'Laravel') }}" src="{{ asset('public/theme/images/logo.png') }}">
                </a>
            </div><!-- /block-logo -->
            <div class="block_search_top">
                <div class="block_search">
                    <form action="{{ route('home.search',app()->getLocale()) }}" method="GET" class="form_search">
                        <input type="text" name="q" class="search_input"
                               placeholder="Enter App Name, Package Name, Package ID" required="">
                        <button type="submit" class="btn_search"><i class="fa fa-search"></i></button>
                    </form>
                </div><!-- /block_search -->
            </div><!-- /block_search_top-logo -->
            <div class="block_menu_top">
                <div class="nav-toogle">
                    <i class="fa"></i>
                </div>
                <ul class="nav_menu">
                    <li class="nav_menu_item">
                        <a title="hot game" href="{{ route('home.index',app()->getLocale()) }}"><i class="fa fa-home"
                                                                                style="font-size:20px;color:#ec2c3e"></i> {{ __('web.home') }}
                        </a>
                    </li>
                    <li class="nav_menu_item">
                        <a title="hot game" href="{{ route('home.toppic',app()->getLocale()) }}"><i class="fa fa-archive" style="font-size:20px;color:#ec2c3e"></i> {{ __('web.Toppic') }}
                        </a>
                    </li>
                </ul>

            </div><!-- /block_menu_top-logo -->
        </div>
    </header><!-- /header -->

    <main id="main" class="container">
        <div class="row">
            @yield('content')
            <div class="block_right col-sm-3 col-xs-12">
                <div class="block block_sidebar block_search-tags">
                    <div class="block_pad">
                        <div class="block_content">
                            <div class="block_search">
                                <form action="{{ route('home.search',app()->getLocale()) }}" method="GET" class="form_search">
                                    <input type="text" name="q" class="search_input"
                                           placeholder="Enter App Name, Package Name, Package ID" required="">
                                    <button type="submit" class="btn_search"><i class="fa fa-search"></i></button>
                                </form>

                            </div><!-- /block_search -->
                            {{--                            <div class="block_tags">--}}
                            {{--                                <a href="{{ route('home.search') }}?q=lucky">lucky</a>--}}
                            {{--                                <a href="{{ route('home.search') }}?q=youtube">youtube</a>--}}
                            {{--                                <a href="{{ route('home.search') }}?q=gta">gta</a>--}}
                            {{--                                <a href="{{ route('home.search') }}?q=snapchat">snapchat</a>--}}
                            {{--                                <a href="{{ route('home.search') }}?q=brawl stars">brawl stars</a>--}}
                            {{--                                <a href="{{ route('home.search') }}?q=pokemon">pokemon</a>--}}
                            {{--                                <a href="{{ route('home.search') }}?q=instagram">instagram</a>--}}
                            {{--                                <a href="{{ route('home.search') }}?q=gta san andreas">gta san andreas</a>--}}
                            {{--                                <a href="{{ route('home.search') }}?q=minecraft pocket edition">minecraft pocket--}}
                            {{--                                    edition</a>--}}
                            {{--                                <a href="{{ route('home.search') }}?q=clash royale">clash royale</a>--}}
                            {{--                                <a href="{{ route('home.search') }}?q=google play services">google play services</a>--}}
                            {{--                                <a href="{{ route('home.search') }}?q=리니지m">리니지m</a>--}}
                            {{--                                <a href="{{ route('home.search') }}?q=facebook">facebook</a>--}}
                            {{--                            </div><!-- /block_tags -->--}}
                        </div>
                    </div><!-- block_search-tags -->
                </div><!-- block_sidebar -->
                <div class="block">{!! $ad['above_right_column'] !!}</div>
                <div class="block block_sidebar block_hot_day">
                    <div class="blokck_pad_content">
                        <div class="block_title block_tab">
                            TOP »
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active"><a href="#Game" aria-controls="Game" role="tab"
                                                                          data-toggle="tab">{{ __('web.games') }}</a>
                                </li>
                                <li role="presentation"><a href="#Apps" aria-controls="Apps" role="tab"
                                                           data-toggle="tab">{{ __('web.apps') }}</a></li>
                            </ul>
                        </div>
                        <div class="block_content clearfix">
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="Game">
                                    <ul class="hot_day_list" id="topgame">
                                    </ul>
                                    <div class="block_more"><a
                                                href="{{ route('home.top', [app()->getLocale(),'games']) }}">{{ __('web.more') }} »</a>
                                    </div>
                                </div><!-- Game -->
                                <div role="tabpanel" class="tab-pane" id="Apps">
                                    <ul class="hot_day_list" id="topapp">
                                    </ul>
                                    <div class="block_more"><a
                                                href="{{ route('home.top', [app()->getLocale(),'apps']) }}">{{ __('web.more') }} »</a>
                                    </div>
                                </div><!-- Apps -->

                            </div>
                        </div>
                    </div>
                </div><!-- block_sidebar -->
                <div class="block block_sidebar block_popular_categories">
                    <div class="blokck_pad_content">
                        <div class="block_title">
                            <div class="title">{{ __('web.gamescate') }}</div>
                            {{ csrf_field() }}
                        </div>
                        <div class="block_content clearfix">
                            <ul class="popular_categories_list location" id="categoriesgame">

                            </ul>
                        </div>
                    </div>
                </div><!-- block_sidebar -->
                <div class="block block_sidebar block_popular_categories">
                    <div class="blokck_pad_content">
                        <div class="block_title">
                            <div class="title">{{ __('web.appscate') }}</div>
                        </div>
                        <div class="block_content clearfix">
                            <ul class="popular_categories_list location" id="categoriesapp">
                            </ul>
                        </div>
                    </div>
                </div><!-- block_sidebar -->
                <div class="block">{!! $ad['below_right_column'] !!}</div>
            </div><!-- /block_right -->
        </div>
    </main><!-- /#main -->

    <footer class="footer">
        <div class="footer_main">
            <div class="container">
                <div class="row">
                    <div class="col-sm-3 list_menu_footer">
                        <div class="menu_footer_items">
                            <p class="list_menu_footer_title">{{__('web.solutions')}}</p>
                            @if(count($pages)>0)
                                <ul>
                                    @foreach($pages as $r)
                                        <li><a href="{{ route('home.page', [app()->getLocale(),$r->slug]) }}"
                                               title="{{$r->title}}">{{$r->title}}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </div><!-- /list_menu_footer -->

                    <div class="col-sm-3 list_menu_footer">
                        <div class="menu_footer_items">
                            <p class="list_menu_footer_title">{{ __('web.follow') }}</p>
                            <ul class="follow">
                                <li>
                                    <a href="{{$site['facebook']}}" title="Facebook">
                                        <i class="fa fa-facebook"></i> Facebook
                                    </a>
                                </li>
                                <li>
                                    <a href="{{$site['twitter']}}" title="Twitter">
                                        <i class="fa fa-twitter"></i> Twitter
                                    </a>
                                </li>
                                <li>
                                    <a href="{{$site['google']}}" title="Google">
                                        <i class="fa fa-google-plus"></i> Google+
                                    </a>
                                </li>
                                <li>
                                    <a href="{{$site['instagram']}}" title="Instagram">
                                        <i class="fa fa-instagram"></i> Instagram
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div><!-- /list_menu_footer -->
                    <div class="col-sm-3 list_menu_footer">
                        <div class="menu_footer_items">
                            <p class="list_menu_footer_title">TOP {{ __('web.apps') }}</p>
                            <ul id="footerapp">
                            </ul>
                        </div>
                    </div><!-- /list_menu_footer -->
                    <div class="col-sm-3 list_menu_footer">
                        <div class="menu_footer_items">
                            <p class="list_menu_footer_title">TOP {{ __('web.games') }}</p>
                            <ul id="footergame">

                            </ul>
                        </div>
                    </div><!-- /list_menu_footer -->
                </div>
            </div>
        </div><!-- /footer_main -->
        <div class="footer_bot">
            <div class="container">
                <div class="row">
                    <div class="copyright">
                        Copyright © 2021-2025. All rights reserved.
                        {{--                        <a href="{{ route('home.page', ['dmca']) }}" rel="nofollow">DMCA Disclaimer</a>--}}
                        {{--                        <a href="{{ route('home.page', ['privacy-policy']) }}" rel="nofollow">Privacy Policy</a>--}}
                        {{--                        <a href="{{ route('home.page', ['terms']) }}" rel="nofollow">Term of Use</a>--}}
                    </div>
                </div>
            </div>
        </div><!-- /footer_main -->
    </footer><!-- /footer -->

    <a id="return-to-top" class="td-scroll-up" href="javascript:void(0)">
        <i class="fa fa-angle-up" aria-hidden="true"></i>
    </a>
    <!-- Return To Top -->

</div><!-- /wrapper -->

<!-- ===== JS ===== -->
<script src="{{ asset('public/theme/js/jquery.min.js') }}"></script>
<!-- ===== JS Bootstrap ===== -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<!-- ===== JS Owl ===== -->
<script src="{{ asset('public/theme/lib/owl/owl.carousel.min.js') }}"></script>
<!-- ===== JS Sticky ===== -->
<script src="{{ asset('public/theme/lib/sticky/jquery.sticky.js') }}"></script>
<!-- Js Common -->
<script src="{{ asset('public/theme/js/common.js') }}"></script>

@yield('scripts')
{!! $site['before_body_end_tag'] !!}

</body>
</html>
