@if(!empty($data))
    <div class="questions-snippet border-top border-top-gray">
        @foreach($data as $row)
            <?php $tags = explode(',', $row->tags);
            $tagt = '';
            foreach ($tags as $tag) {
                $tagt .= '<a href="' . route('home.tags', ['name' => $tag]) . '" class="tag-link">' . $tag . '</a>';
            }
            $answered = ($row->awnsers > 0) ? "answered" : "";
            ?>
            <div class="media media-card rounded-0 shadow-none mb-0 bg-transparent py-3 px-0 border-bottom border-bottom-gray">
                <div class="votes text-center votes-2">
                    <div class="vote-block">
                        <span class="vote-counts d-block text-center pr-0 lh-20 fw-medium">{{ format_number_in_k($row->votes) }}</span>
                        <span class="vote-text d-block fs-13 lh-18">votes</span>
                    </div>
                    <div class="answer-block {{ $answered }} my-2">
                        <span class="answer-counts d-block lh-20 fw-medium">{{ format_number_in_k($row->awnsers) }}</span>
                        <span class="answer-text d-block fs-13 lh-18">answers</span>
                    </div>
                    <div class="view-block">
                        <span class="view-counts d-block lh-20 fw-medium">{{ format_number_in_k($row->views) }}</span>
                        <span class="view-text d-block fs-13 lh-18">views</span>
                    </div>
                </div>
                <div class="media-body">
                    <h5 class="mb-2 fw-medium"><a
                                href="{{ route('home.question', ['name' => $row->permalink]) }}">{{ decodeContent($row->title) }}</a>
                    </h5>
                    <p class="mb-2 truncate lh-20 fs-15"><?php echo substr(strip_tags(html_entity_decode($row->description)), 0, 110) ?></p>
                    <div class="tags">
                        {!! $tagt !!}
                    </div>
                    <div class="media media-card user-media align-items-center px-0 border-bottom-0 pb-0">
                        <a href="{{route('user.profile',['id'=>$row->userid])}}" class="media-img d-block">
                            <img src="{{ asset('public/uploads/users/') }}/{{ $row->user->image }}" alt="avatar">
                        </a>
                        <div class="media-body d-flex flex-wrap align-items-center justify-content-between">
                            <div>
                                <h5 class="pb-1"><a
                                            href="{{route('user.profile',['id'=>$row->userid])}}">{{ $row->user->name }}</a>
                                </h5>
                                <div class="stats fs-12 d-flex align-items-center lh-18">
                                    <span class="text-black pr-2"
                                          title="Reputation score">{{ format_number_in_k($row->user->votes) }}</span>
                                    <span class="pr-2 d-inline-flex align-items-center" title="Gold badge"><span
                                                class="ball gold"></span>{{ format_number_in_k($row->user->badgesGold) }}</span>
                                    <span class="pr-2 d-inline-flex align-items-center" title="Silver badge"><span
                                                class="ball silver"></span>{{ format_number_in_k($row->user->badgesSilver) }}</span>
                                    <span class="pr-2 d-inline-flex align-items-center" title="Bronze badge"><span
                                                class="ball"></span>{{ format_number_in_k($row->user->badgesBronze) }}</span>
                                </div>
                            </div>
                            <small class="meta d-block text-right">
                                <span class="text-black d-block lh-18">asked</span>
                                <span class="d-block lh-18 fs-12">{{ timeAgo($row->on) }}</span>
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    </div><!-- end row -->
    <div class="pager pt-30px text-center" id="nextPage" val="{{$page}}">
        {!! $data->links() !!}
    </div>
@endif