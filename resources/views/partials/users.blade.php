<div class="row">
    @if(!empty($data))
        @foreach($data as $r)
            <div class="col-lg-3 responsive-column-half">
                <div class="media media-card p-3">
                    <a href="{{route('user.profile',['id'=>$r->id,'name'=>str_slug($r->name)])}}"
                       class="media-img d-inline-block flex-shrink-0">
                        <img src="{{ asset('public/uploads/users/') }}/{{$r->image}}" alt="{{$r->name}}">
                    </a>
                    <div class="media-body">
                        <h5 class="fs-16 fw-medium"><a href="{{route('user.profile',['id'=>$r->id,'name'=>str_slug($r->name)])}}">{{$r->name}}</a>
                        </h5>
                        <small class="meta d-block lh-24 pb-1"><span>{{format_number_in_k($r->votes)}} Points, {{format_number_in_k($r->voted)}} Voted</span></small>
                        <div class="stats fs-12 d-flex align-items-center lh-18">
                            <span class="text-black pr-2"
                                  title="Reputation score">{{format_number_in_k($r->badgesGold+$r->badgesSilver+$r->badgesBronze)}}</span>
                            <span class="pr-2 d-inline-flex align-items-center" title="Gold badge"><span
                                        class="ball gold"></span>{{format_number_in_k($r->badgesGold)}}</span>
                            <span class="pr-2 d-inline-flex align-items-center" title="Silver badge"><span
                                        class="ball silver"></span>{{format_number_in_k($r->badgesSilver)}}</span>
                            <span class="pr-2 d-inline-flex align-items-center" title="Bronze badge"><span
                                        class="ball"></span>{{format_number_in_k($r->badgesBronze)}}</span>
                        </div>
                    </div><!-- end media-body -->
                </div><!-- end media -->
            </div>
        @endforeach
    @endif
</div><!-- end row -->
<div class="pager pt-30px text-center" id="nextPage" val="{{$page}}">
    {!! $data->links() !!}
</div>