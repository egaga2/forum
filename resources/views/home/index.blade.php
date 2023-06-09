@extends('layouts.home')
@section('description', $site['site_description'])
@section('content')
    <section class="hero-area bg-dark overflow-hidden section-padding">
        <span class="icon-shape icon-shape-1 is-scale"></span>
        <span class="icon-shape icon-shape-2 is-bounce"></span>
        <span class="icon-shape icon-shape-3 is-swing"></span>
        <span class="icon-shape icon-shape-4 is-spin"></span>
        <span class="icon-shape icon-shape-5 is-spin"></span>
        <span class="icon-shape icon-shape-6 is-bounce"></span>
        <span class="icon-shape icon-shape-7 is-tilt"></span>
        <span class="stroke-shape stroke-shape-1 stroke-shape-white"></span>
        <span class="stroke-shape stroke-shape-2 stroke-shape-white"></span>
        <span class="stroke-shape stroke-shape-3 stroke-shape-white"></span>
        <span class="stroke-shape stroke-shape-4 stroke-shape-white"></span>
        <span class="stroke-shape stroke-shape-5 stroke-shape-white"></span>
        <span class="stroke-shape stroke-shape-6 stroke-shape-white"></span>
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mr-auto">
                    <div class="hero-content">
                        <h2 class="section-title fs-50 pb-3 text-white lh-65">{{$home['section1_title']}}</h2>
                        <p class="lh-26 text-white">{{$home['section1_sub']}}</p>
                        <div class="hero-btn-box pt-30px">
                            <a href="{{route('home.questions')}}" class="btn theme-btn mr-2 page-scroll">Find Question<i
                                        class="fa fa-search icon ml-1"></i></a>
                            <a data-toggle="modal" data-target="#signupModal" class="btn theme-btn bg-3" href="#">Join
                                Now <i
                                        class="fa fa-users icon ml-1"></i></a>
                        </div>
                    </div><!-- end hero-content -->
                </div><!-- end col-lg-6 -->
                <div class="col-lg-6 mr-auto">
                    <div class="generic-img-box h-100">
                        <img class="lazy"
                             src="{{ asset('public/theme/images/home3.jpeg')}}"
                             alt="image" style="">
                        <img class="lazy"
                             src="{{ asset('public/theme/images/home2.jpeg')}}"
                             alt="image" style="">
                        <img class="lazy"
                             src="{{ asset('public/theme/images/home5.jpeg')}}"
                             alt="image" style="">
                        <img class="lazy"
                             src="{{ asset('public/theme/images/home4.jpeg')}}"
                             alt="image" style="">
                        <img class="lazy"
                             src="{{ asset('public/theme/images/home1.jpeg')}}"
                             alt="image" style="">
                    </div>
                </div>
            </div><!-- end row -->
        </div><!-- end container -->
    </section>
    <section class="funfact-area">
        <div class="container">
            <div class="counter-box bg-white shadow-md rounded-rounded px-4">
                <div class="row">
                    <div class="col responsive-column-half border-right border-right-gray">
                        <div class="media media-card text-center px-0 py-4 shadow-none rounded-0 bg-transparent counter-item mb-0">
                            <div class="media-body">
                                <h5 class="fw-semi-bold pb-2">{{$home['section2_title1']}}</h5>
                                <p class="lh-20">{{$home['section2_sub1']}}</p>
                            </div>
                        </div>
                    </div><!-- end col -->
                    <div class="col responsive-column-half border-right border-right-gray">
                        <div class="media media-card text-center px-0 py-4 shadow-none rounded-0 bg-transparent counter-item mb-0">
                            <div class="media-body">
                                <h5 class="fw-semi-bold pb-2">{{$home['section2_title2']}}</h5>
                                <p class="lh-20">{{$home['section2_sub2']}}</p>
                            </div>
                        </div>
                    </div><!-- end col -->
                    <div class="col responsive-column-half border-right border-right-gray">
                        <div class="media media-card text-center px-0 py-4 shadow-none rounded-0 bg-transparent counter-item mb-0">
                            <div class="media-body">
                                <h5 class="fw-semi-bold pb-2">{{$home['section2_title3']}}</h5>
                                <p class="lh-20">{{$home['section2_sub3']}}</p>
                            </div>
                        </div>
                    </div><!-- end col -->
                    <div class="col responsive-column-half border-right border-right-gray">
                        <div class="media media-card text-center px-0 py-4 shadow-none rounded-0 bg-transparent counter-item mb-0">
                            <div class="media-body">
                                <h5 class="fw-semi-bold pb-2">{{$home['section2_title4']}}</h5>
                                <p class="lh-20">{{$home['section2_sub4']}}</p>
                            </div>
                        </div>
                    </div><!-- end col -->
                    <div class="col responsive-column-half">
                        <div class="media media-card text-center px-0 py-4 shadow-none rounded-0 bg-transparent counter-item mb-0">
                            <div class="media-body">
                                <h5 class="fw-semi-bold pb-2">{{$home['section2_title5']}}</h5>
                                <p class="lh-20">{{$home['section2_sub5']}}</p>
                            </div>
                        </div>
                    </div><!-- end col -->
                </div><!-- end row -->
            </div><!-- end counter-box -->
        </div><!-- end container -->
    </section>
    <section class="hero-area section-padding pt-5">
        <div class="text-center p-3">
            <h3 class="section-title pb-3">Questions & Answers</h3>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="questions-snippet mt-3">
                        @foreach($question as $row)
                            <?php $tags = explode(',', $row->tags);
                            $tagt = '';
                            foreach ($tags as $tag) {
                                $tagt .= '<a href="' . route('home.tags', ['name' => $tag]) . '" class="tag-link">' . $tag . '</a>';
                            }
                            $answered = ($row->awnsers > 0) ? "answered-accepted" : "";
                            ?>
                            <div class="media media-card media--card align-items-center">
                                <div class="votes {{$answered}}">
                                    <div class="vote-block d-flex align-items-center justify-content-between"
                                         title="Votes">
                                        <span class="vote-counts">{{ format_number_in_k($row->votes) }}</span>
                                        <span class="vote-icon"></span>
                                    </div>
                                    <div class="answer-block d-flex align-items-center justify-content-between"
                                         title="Answers">
                                        <span class="vote-counts">{{ format_number_in_k($row->awnsers) }}</span>
                                        <span class="answer-icon"></span>
                                    </div>
                                </div>
                                <div class="media-body">
                                    <h5>
                                        <a href="{{ route('home.question', ['name' => $row->permalink]) }}">{!!  decodeContent($row->title) !!}</a>
                                    </h5>
                                    <small class="meta">
                                        <span class="pr-1">{{ timeAgo($row->on) }}</span>
                                        <a class="author"
                                           href="{{route('user.profile',['id'=>$row->userid,'name'=>str_slug($row->user->name)])}}">{{ $row->user->name }}</a>
                                    </small>
                                    <div class="tags">
                                        {!! $tagt !!}
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div><!-- end row -->
                </div><!-- end col-lg-6 -->
                <div class="col-lg-6">
                    <div class="text-right">
                        <img src="{{ asset('public/theme/images/developer-tal.png')}}"
                             alt="Company profile page" class="img-fluid">
                    </div>
                </div>
            </div><!-- end row -->
        </div><!-- end container -->
    </section>
    <section class="get-started-area section--padding pattern-bg bg-gray pt-5">
        <div class="container">
            <div class="text-center">
                <h2 class="section-title pb-3">{{$home['section4_title']}}</h2>
                <p class="section-desc w-50 mx-auto">{{$home['section4_sub']}}
                </p>
            </div>
            <div class="row pt-50px">
                <div class="col-lg-4 responsive-column-half">
                    <div class="card card-item hover-y text-center">
                        <div class="card-body">
                            <svg width="70" xmlns="http://www.w3.org/2000/svg" version="1.1" x="0px" y="0px"
                                 viewBox="0 0 64 64" xml:space="preserve">
                            <g>
                                <g>
                                    <polygon style="fill:#F0BC5E;"
                                             points="18,36 18,24 11,24 11,41 47,41 47,36   "></polygon>
                                </g>
                                <g>
                                    <g>
                                        <path style="fill:#F0BC5E;" d="M23,21H11v-8h12V21z"></path>
                                    </g>
                                </g>
                                <g>
                                    <g>
                                        <path style="fill:#F0BC5E;" d="M38,21H26v-8h12V21z"></path>
                                    </g>
                                </g>
                                <g>
                                    <path d="M58,17h-7V1H7v16H6c-2.757,0-5,2.243-5,5v30c0,2.757,2.243,5,5,5h13v4h-4v2h34v-2h-4v-4h13c2.757,0,5-2.243,5-5V22    C63,19.243,60.757,17,58,17z M49,25h2v6h-2V25z M47,27H29v-2h18V27z M27,30.557l-5.713-2.142C21.115,28.35,21,28.184,21,28    s0.115-0.35,0.288-0.415L27,25.443V30.557z M29,29h18v2H29V29z M53,25h1c1.654,0,3,1.346,3,3s-1.346,3-3,3h-1V25z M27.818,23    l-7.232,2.712C19.638,26.067,19,26.987,19,28s0.638,1.933,1.585,2.288L27.818,33H49v10H9V11h40v12H27.818z M49,3v6H9V3H49z M6,19    h1v26h44V33h3c2.757,0,5-2.243,5-5s-2.243-5-5-5h-3v-4h7c1.654,0,3,1.346,3,3v27H3V22C3,20.346,4.346,19,6,19z M43,61H21v-4h22V61    z M58,55H6c-1.654,0-3-1.346-3-3v-1h58v1C61,53.654,59.654,55,58,55z"></path>
                                    <rect x="11" y="5" width="2" height="2"></rect>
                                    <rect x="15" y="5" width="2" height="2"></rect>
                                    <rect x="19" y="5" width="2" height="2"></rect>
                                    <rect x="11" y="23" width="7" height="2"></rect>
                                    <rect x="11" y="27" width="6" height="2"></rect>
                                    <rect x="11" y="31" width="7" height="2"></rect>
                                    <rect x="11" y="35" width="36" height="2"></rect>
                                    <rect x="45" y="39" width="2" height="2"></rect>
                                    <rect x="11" y="39" width="32" height="2"></rect>
                                </g>
                            </g>
                        </svg>
                            <h5 class="card-title pt-4 pb-2">{{$home['section4_item1_title']}}</h5>
                            <p class="card-text pb-4">
                                {{$home['section4_item1_sub']}}</p>
                            <a href="{{route('home.questions')}}" class="btn theme-btn">Browse questions <i
                                        class="la la-arrow-right icon ml-1"></i></a>
                        </div><!-- end card-body -->
                    </div><!-- end card -->
                </div><!-- end col-lg-4 -->
                <div class="col-lg-4 responsive-column-half">
                    <div class="card card-item hover-y text-center">
                        <div class="card-body">
                            <svg width="70" viewBox="0 0 128 128" xmlns="http://www.w3.org/2000/svg">
                                <path d="m18.393 38.405c-.055-.674-.09-1.353-.09-2.041a24.887 24.887 0 0 1 43.171-16.888 22.577 22.577 0 0 1 30.826 6.882 18.466 18.466 0 0 1 25.4 23.657 18.459 18.459 0 0 1 -18.184 32.132 18.453 18.453 0 0 1 -25.566 3.314 19.9 19.9 0 0 1 -35.15-2.028 24.895 24.895 0 1 1 -20.4-45.028z"
                                      fill="#f0f5f9"></path>
                                <path d="m1 62.146a24.91 24.91 0 0 0 37.8 21.291 19.892 19.892 0 0 0 35.15 2.02 18.442 18.442 0 0 0 25.565-3.31 18.467 18.467 0 0 0 26.975-20.417 18.461 18.461 0 0 1 -26.976 11.808 18.445 18.445 0 0 1 -25.565 3.31 19.882 19.882 0 0 1 -17.049 9.625c-8.041 0-11.776-2.155-11.509-9.358-3.765 2.285-13.42 4.268-18.141 4.268-12.285 0-23.844-11.866-25.874-23.562a25.252 25.252 0 0 0 -.376 4.325z"
                                      fill="#d9e2e9"></path>
                                <g fill="#2f3a5a">
                                    <path d="m56.906 96.09a20.952 20.952 0 0 1 -18.536-11.255 25.9 25.9 0 1 1 -21.028-47.135c-.027-.467-.039-.909-.039-1.336a25.887 25.887 0 0 1 44.344-18.156 23.577 23.577 0 0 1 30.992 6.874 19.222 19.222 0 0 1 8.061-1.749 19.47 19.47 0 0 1 18.238 26.267 19.459 19.459 0 0 1 -19.172 33.814 19.456 19.456 0 0 1 -25.539 3.471 20.733 20.733 0 0 1 -17.321 9.205zm-18.106-13.657a1 1 0 0 1 .91.585 18.9 18.9 0 0 0 33.386 1.926 1 1 0 0 1 1.457-.282 17.453 17.453 0 0 0 24.18-3.135 1 1 0 0 1 1.274-.252 17.46 17.46 0 0 0 17.193-30.393 1 1 0 0 1 -.423-1.259 17.461 17.461 0 0 0 -24.024-22.374 1 1 0 0 1 -1.294-.345 21.575 21.575 0 0 0 -29.459-6.578 1 1 0 0 1 -1.262-.171 23.887 23.887 0 0 0 -41.438 16.209c0 .6.028 1.244.087 1.959a1 1 0 0 1 -.7 1.035 23.894 23.894 0 1 0 19.585 43.22 1 1 0 0 1 .528-.145z"></path>
                                    <path d="m25.9 88.034a25.921 25.921 0 0 1 -25.9-25.891 1 1 0 0 1 2 0 23.895 23.895 0 0 0 44.876 11.43 1 1 0 0 1 1.756.958 25.9 25.9 0 0 1 -22.732 13.503z"></path>
                                    <path d="m95.953 39.672a1 1 0 0 1 -1-1 21.584 21.584 0 0 0 -39.182-12.5 1 1 0 0 1 -1.63-1.159 23.584 23.584 0 0 1 42.812 13.659 1 1 0 0 1 -1 1z"></path>
                                    <path d="m113.436 57.16a1 1 0 0 1 -.69-1.724 17.461 17.461 0 0 0 -12.046-30.1 1 1 0 0 1 0-2 19.46 19.46 0 0 1 13.425 33.55.992.992 0 0 1 -.689.274z"></path>
                                </g>
                                <path d="m64 39.039a20.832 20.832 0 0 0 -20.832 20.832v19.3h5.9v-19.3a14.93 14.93 0 1 1 29.859 0v19.3h5.9v-19.3a20.832 20.832 0 0 0 -20.827-20.832z"
                                      fill="#84879c"></path>
                                <path d="m84.831 80.172h-5.9a1 1 0 0 1 -1-1v-19.3a13.93 13.93 0 1 0 -27.859 0v19.3a1 1 0 0 1 -1 1h-5.9a1 1 0 0 1 -1-1v-19.3a21.832 21.832 0 1 1 43.663 0v19.3a1 1 0 0 1 -1.004 1zm-4.9-2h3.9v-18.3a19.832 19.832 0 1 0 -39.663 0v18.3h3.9v-18.3a15.93 15.93 0 1 1 31.859 0z"
                                      fill="#2f3a5a"></path>
                                <rect fill="#fac77c" height="43.593" rx="8.123" width="53.599" x="37.2"
                                      y="72.934"></rect>
                                <path d="m90.8 81.053v27.354a8.126 8.126 0 0 1 -8.13 8.119h-37.348a8.091 8.091 0 0 1 -6.61-3.408 7.862 7.862 0 0 0 2.576.421h37.352a8.135 8.135 0 0 0 8.13-8.129v-27.344a8.166 8.166 0 0 0 -1.509-4.722 8.154 8.154 0 0 1 5.539 7.709z"
                                      fill="#e5ae5c"></path>
                                <path d="m82.676 117.527h-37.353a9.133 9.133 0 0 1 -9.123-9.127v-27.342a9.133 9.133 0 0 1 9.123-9.123h37.353a9.133 9.133 0 0 1 9.124 9.123v27.342a9.133 9.133 0 0 1 -9.124 9.127zm-37.353-43.592a7.131 7.131 0 0 0 -7.123 7.123v27.342a7.131 7.131 0 0 0 7.123 7.123h37.353a7.131 7.131 0 0 0 7.124-7.123v-27.342a7.131 7.131 0 0 0 -7.123-7.123z"
                                      fill="#2f3a5a"></path>
                                <path d="m69.3 90.8a5.3 5.3 0 1 0 -7.564 4.782v8.385h4.519v-8.386a5.293 5.293 0 0 0 3.045-4.781z"
                                      fill="#84879c"></path>
                                <path d="m66.259 104.966h-4.519a1 1 0 0 1 -1-1v-7.789a6.3 6.3 0 1 1 6.519 0v7.789a1 1 0 0 1 -1 1zm-3.519-2h2.519v-7.385a1 1 0 0 1 .572-.9 4.264 4.264 0 0 0 2.469-3.881 4.3 4.3 0 0 0 -8.609 0 4.264 4.264 0 0 0 2.473 3.878 1 1 0 0 1 .572.9z"
                                      fill="#2f3a5a"></path>
                            </svg>
                            <h5 class="card-title pt-4 pb-2">{{$home['section4_item2_title']}}</h5>
                            <p class="card-text pb-4">{{$home['section4_item2_sub']}}</p>
                            <a href="{{route('home.badges')}}" class="btn theme-btn bg-3">View badges<i
                                        class="la la-arrow-right icon ml-1"></i></a>
                        </div><!-- end card-body -->
                    </div><!-- end card -->
                </div><!-- end col-lg-4 -->
                <div class="col-lg-4 responsive-column-half">
                    <div class="card card-item hover-y text-center">
                        <div class="card-body">
                            <svg width="70" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">
                                <g>
                                    <g>
                                        <g>
                                            <path d="m395.058 7.5h-254.439c-16.351 0-29.606 13.255-29.606 29.606v437.789c0 16.351 13.255 29.606 29.606 29.606h331.762c16.351 0 29.606-13.255 29.606-29.606v-360.466c0-7.852-3.119-15.383-8.672-20.935l-77.323-77.323c-5.551-5.552-13.082-8.671-20.934-8.671z"
                                                  fill="#f4fbff"></path>
                                            <g>
                                                <path d="m493.316 93.494-54.421-54.421v435.822c0 16.351-13.255 29.606-29.606 29.606h63.092c16.351 0 29.606-13.255 29.606-29.606v-360.466c0-7.852-3.119-15.383-8.671-20.935z"
                                                      fill="#e4f6ff"></path>
                                            </g>
                                            <path d="m493.316 93.494-77.323-77.323c-2.532-2.532-5.475-4.557-8.672-6.012v73.652c0 10.137 8.218 18.355 18.355 18.355h73.651c-1.454-3.197-3.48-6.14-6.011-8.672z"
                                                  fill="#e28086"></path>
                                        </g>
                                        <g>
                                            <g>
                                                <path d="m238.156 355.206h32.205v67.458h-32.205z" fill="#4a80aa"
                                                      transform="matrix(.707 -.707 .707 .707 -200.548 293.704)"></path>
                                                <path d="m362.134 459.681-68.185-68.185c-3.907-3.907-10.242-3.907-14.149 0l-22.981 22.981c-3.907 3.907-3.907 10.242 0 14.149l68.185 68.185c10.253 10.253 26.877 10.253 37.13 0 10.254-10.253 10.254-26.877 0-37.13z"
                                                      fill="#cc9675"></path>
                                                <circle cx="147.949" cy="282.625" fill="#bed8fb" r="138.005"></circle>
                                                <circle cx="147.949" cy="282.625" fill="#f4fbff" r="108.098"></circle>
                                            </g>
                                            <g>
                                                <g>
                                                    <g>
                                                        <g>
                                                            <g>
                                                                <g>
                                                                    <g>
                                                                        <path d="m171.088 333.057c-2.719-.341-4.764-2.645-4.776-5.385l-.105-24.931-38.093.161.105 24.931c.012 2.741-2.014 5.061-4.73 5.426 0 0-7.034 24.04 23.9 23.91 30.935-.132 23.699-24.112 23.699-24.112z"
                                                                              fill="#ffcbbe"></path>
                                                                        <path d="m204.404 340.347c-8.728-3.842-25.205-6.273-33.316-7.291l-.049.061c-12.168 15.221-35.292 15.289-47.55.14-8.102 1.086-24.559 3.656-33.253 7.571-9.038 4.072-14.24 12.968-14.429 22.303 40.774 36.602 102.669 36.788 143.657.558.162-10.334-5.578-19.168-15.06-23.342z"
                                                                              fill="#365e7d"></path>
                                                                    </g>
                                                                </g>
                                                            </g>
                                                        </g>
                                                    </g>
                                                </g>
                                                <g>
                                                    <g>
                                                        <path d="m176.889 224.928c0-6.01-4.872-10.883-10.883-10.883h-36.203c-14.551 0-26.347 11.796-26.347 26.347v19.609l8.999 6.899h70.36l8.999-15.154v-12.26c0-6.01-4.872-10.883-10.883-10.883h-.367c-2.03.001-3.675-1.645-3.675-3.675z"
                                                              fill="#4a80aa"></path>
                                                        <g>
                                                            <path d="m191.814 251.747-17.265-1.619c-7.326-.687-14.677 1.019-20.952 4.862-5.35 3.277-11.501 5.011-17.775 5.011h-32.366v15.634c0 3.164 2.565 5.729 5.729 5.729.984 0 1.81.758 1.871 1.74 1.189 19.173 17.106 34.357 36.578 34.357 19.49 0 35.418-15.211 36.536-34.408.055-.952.855-1.688 1.808-1.688h.094c3.218 0 5.821-2.609 5.799-5.82-.057-8.626-.057-23.798-.057-23.798z"
                                                                  fill="#ffddce"></path>
                                                        </g>
                                                    </g>
                                                </g>
                                            </g>
                                        </g>
                                        <path d="m315.371 102.166h-148.786c-4.766 0-8.63-3.864-8.63-8.63v-28.744c0-4.766 3.864-8.63 8.63-8.63h148.787c4.766 0 8.63 3.864 8.63 8.63v28.743c0 4.767-3.864 8.631-8.631 8.631z"
                                              fill="#ffe07d"></path>
                                    </g>
                                    <g>
                                        <path d="m453.324 194.709h-129.322c-4.142 0-7.499 3.358-7.499 7.499s3.358 7.499 7.499 7.499h129.323c4.142 0 7.499-3.358 7.499-7.499s-3.358-7.499-7.5-7.499z"></path>
                                        <path d="m453.324 239.922h-129.322c-4.142 0-7.499 3.358-7.499 7.499s3.358 7.499 7.499 7.499h129.323c4.142 0 7.499-3.358 7.499-7.499s-3.358-7.499-7.5-7.499z"></path>
                                        <path d="m460.824 292.634c0-4.142-3.358-7.499-7.499-7.499h-129.323c-4.142 0-7.499 3.358-7.499 7.499s3.358 7.499 7.499 7.499h129.323c4.141.001 7.499-3.357 7.499-7.499z"></path>
                                        <path d="m324.002 330.348c-4.142 0-7.499 3.358-7.499 7.499s3.358 7.499 7.499 7.499h64.661c4.142 0 7.499-3.358 7.499-7.499s-3.358-7.499-7.499-7.499z"></path>
                                        <path d="m498.619 88.191-77.321-77.321c-6.87-6.875-16.283-10.87-26.24-10.87h-254.439c-20.46 0-37.105 16.646-37.105 37.106v76.781c0 4.142 3.358 7.499 7.499 7.499s7.499-3.358 7.499-7.499v-76.781c0-12.19 9.917-22.107 22.107-22.107h254.439c1.618 0 3.209.173 4.764.516v68.296c0 14.256 11.598 25.854 25.854 25.854h68.288c.346 1.565.523 3.168.523 4.764v360.466c0 12.189-9.917 22.107-22.107 22.107h-100.748c8.769-13.111 7.373-31.055-4.195-42.623l-68.185-68.185c-4.966-4.966-12.195-6.3-18.396-4.038l-14.68-14.68c41.416-57.512 35.309-137.086-15.341-187.737-56.213-56.212-148.443-57.332-205.774 0-56.732 56.732-56.732 149.042 0 205.774 50.606 50.607 130.256 56.622 187.732 15.336l14.685 14.685c-2.262 6.201-.928 13.43 4.039 18.396l63.072 63.072h-173.97c-12.189 0-22.107-9.917-22.107-22.107v-24.035c0-4.142-3.358-7.499-7.499-7.499s-7.499 3.358-7.499 7.499v24.035c0 20.46 16.646 37.105 37.105 37.105h331.762c20.46 0 37.106-16.646 37.106-37.105v-360.466c0-9.732-3.862-19.237-10.868-26.238zm-442.951 286.716c-50.884-50.884-50.884-133.678 0-184.563 51.532-51.532 134.24-50.322 184.563 0 46.854 46.855 51.219 121.3 10.152 173.166-6.304 7.961-13.579 15.239-21.549 21.549-51.535 40.803-126.163 36.851-173.166-10.152zm188.936 16.484c4.241-3.775 8.286-7.812 12.137-12.139l12.35 12.35-12.167 12.167-12.349-12.35c.01-.01.019-.02.029-.028zm85.703 100.117-68.184-68.184c-.977-.977-.979-2.564 0-3.544l.099-.099c.002-.002.004-.003.005-.005l22.877-22.877c.976-.977 2.567-.977 3.544 0l68.184 68.185c7.312 7.313 7.312 19.211 0 26.524-7.331 7.33-19.194 7.33-26.525 0zm84.514-407.697v-58.207l69.062 69.062h-58.206c-5.987 0-10.856-4.87-10.856-10.855z"></path>
                                        <path d="m315.372 48.663h-148.787c-8.894 0-16.13 7.236-16.13 16.13v28.743c0 8.894 7.236 16.13 16.13 16.13h148.787c8.894 0 16.13-7.236 16.13-16.13v-28.743c-.001-8.894-7.237-16.13-16.13-16.13zm1.13 44.872c0 .623-.507 1.131-1.131 1.131h-148.786c-.623 0-1.131-.507-1.131-1.131v-28.742c0-.623.507-1.131 1.131-1.131h148.787c.624 0 1.131.507 1.131 1.131v28.742z"></path>
                                        <path d="m229.688 364.365c45.072-45.071 45.072-118.408 0-163.479-45.072-45.072-118.407-45.072-163.479 0-17.536 17.537-28.782 39.726-32.522 64.17-.626 4.094 2.184 7.921 6.279 8.547 4.096.629 7.921-2.184 8.547-6.279 3.254-21.264 13.04-40.571 28.301-55.833 39.223-39.223 103.044-39.223 142.268 0 37.634 37.634 39.152 97.91 4.567 137.379-3.294-6.703-8.897-12.161-16.225-15.387-8.884-3.911-24.2-6.397-33.621-7.639l-.04-9.47c9.104-6.703 15.566-16.819 17.423-28.523 1.601-.665 3.07-1.648 4.328-2.915 2.511-2.528 3.88-5.881 3.857-9.442-.067-9.939-.058-26.412-.058-36.008 0-9.075-6.612-16.636-15.271-18.119-1.662-8.438-9.117-14.822-18.036-14.822h-36.203c-18.663 0-33.847 15.183-33.847 33.846v35.243c0 5.471 3.339 10.177 8.086 12.188 1.815 11.347 7.956 21.207 16.627 27.912l.044 10.333c-9.41 1.321-24.704 3.936-33.557 7.922-6.732 3.033-11.993 8.176-15.231 14.509-11.99-13.802-19.929-30.441-23.077-48.535-.71-4.08-4.594-6.813-8.674-6.103-4.081.71-6.813 4.594-6.103 8.674 4.092 23.514 15.205 44.894 32.139 61.829 45.269 45.272 118.606 44.876 163.478.002zm-99.885-142.82h36.203c1.866 0 3.384 1.518 3.384 3.384 0 6.162 5.013 11.175 11.175 11.175h.367c1.866 0 3.384 1.518 3.384 3.384v4.025l-9.065-.85c-8.88-.831-17.962 1.275-25.57 5.934-4.173 2.555-8.965 3.906-13.858 3.906h-24.867v-12.109c-.001-10.394 8.454-18.849 18.847-18.849zm-18.848 52.488v-6.533h24.867c7.66 0 15.16-2.115 21.692-6.115 4.86-2.977 10.662-4.323 16.335-3.791l10.47.982c.006 4.619.018 10.713.044 15.429-4.175.733-7.424 4.252-7.679 8.612-.893 15.334-13.653 27.345-29.049 27.345-15.364 0-28.143-12.001-29.094-27.323-.268-4.318-3.467-7.815-7.586-8.606zm36.68 50.928c3.851 0 7.59-.506 11.16-1.439l.018 4.182c.008 1.94.453 3.791 1.241 5.455-3.729 2.516-8.146 3.904-12.777 3.918-.023 0-.046 0-.069 0-4.588 0-8.972-1.351-12.688-3.814.774-1.671 1.208-3.523 1.2-5.463l-.019-4.484c3.802 1.071 7.806 1.645 11.934 1.645zm-63.967 35.043c1.089-5.487 4.592-10.06 9.646-12.338 5.102-2.297 14.929-4.604 27.305-6.432 7.07 6.939 16.537 10.841 26.586 10.841h.114c10.124-.03 19.642-4.016 26.704-11.066 12.392 1.724 22.238 3.947 27.359 6.202 5.739 2.526 9.449 7.338 10.358 13.202-37.113 30.482-91.109 30.343-128.072-.409z"></path>
                                    </g>
                                </g>
                            </svg>
                            <h5 class="card-title pt-4 pb-2">{{$home['section4_item3_title']}}</h5>
                            <p class="card-text pb-4">{{$home['section4_item3_sub']}}</p>
                            <a href="{{route('home.users')}}" class="btn theme-btn">Find users<i
                                        class="la la-arrow-right icon ml-1"></i></a>
                        </div><!-- end card-body -->
                    </div><!-- end card -->
                </div><!-- end col-lg-4 -->
            </div><!-- end row -->
        </div><!-- end container -->
    </section>
    @if(count($blog)>0)
        <section class="blog-area pt-40px pb-50px">
            <div class="container">
                <h2 class="section-title fs-30">Blogs</h2>
                <div class="row mt-40px">
                    @foreach($blog as $r)
                        <div class="col-lg-4 responsive-column-half">
                            <div class="card card-item hover-y">
                                <a href="{{route('home.blogsDetail',['name'=>$r->slug])}}" class="card-img">
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
                </div><!-- end row -->
            </div><!-- end container -->
        </section>
    @endif
    <section class="get-started-area pt-80px pb-50px pattern-bg bg-gray">
        <span class="icon-shape icon-shape-1 is-scale"></span>
        <span class="icon-shape icon-shape-2 is-bounce"></span>
        <span class="icon-shape icon-shape-3 is-swing"></span>
        <span class="icon-shape icon-shape-4 is-spin"></span>
        <span class="icon-shape icon-shape-5 is-spin"></span>
        <span class="icon-shape icon-shape-6 is-bounce"></span>
        <span class="icon-shape icon-shape-7 is-tilt"></span>
        <div class="container">
            <div class="text-center">
                <h2 class="section-title">{{$home['section6_title']}}</h2>
            </div>
            <div class="row pt-50px">
                <div class="col-lg-4 responsive-column-half">
                    <div class="card card-item hover-y text-center">
                        <div class="card-body">
                            <img src="{{ asset('public/theme/images/bubble.png')}}"
                                 alt="bubble">
                            <h5 class="card-title pt-4 pb-2">{{$home['section6_item1_title']}}</h5>
                            <p class="card-text">{{$home['section6_item1_sub']}}</p>
                        </div><!-- end card-body -->
                    </div><!-- end card -->
                </div><!-- end col-lg-4 -->
                <div class="col-lg-4 responsive-column-half">
                    <div class="card card-item hover-y text-center">
                        <div class="card-body">
                            <img src="{{ asset('public/theme/images/vote.png')}}"
                                 alt="vote">
                            <h5 class="card-title pt-4 pb-2">{{$home['section6_item2_title']}}</h5>
                            <p class="card-text">{{$home['section6_item2_sub']}}</p>
                        </div><!-- end card-body -->
                    </div><!-- end card -->
                </div><!-- end col-lg-4 -->
                <div class="col-lg-4 responsive-column-half">
                    <div class="card card-item hover-y text-center">
                        <div class="card-body">
                            <img src="{{ asset('public/theme/images/check.png')}}"
                                 alt="check">
                            <h5 class="card-title pt-4 pb-2">{{$home['section6_item3_title']}}</h5>
                            <p class="card-text">{{$home['section6_item2_sub']}}</p>
                        </div><!-- end card-body -->
                    </div><!-- end card -->
                </div><!-- end col-lg-4 -->
            </div><!-- end row -->
        </div><!-- end container -->
    </section>
@endsection
