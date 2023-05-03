@if(count($data) >0)
    @foreach($data as $r)
        <div class="item post p-0">
            <div class="media media-card media--card align-items-center shadow-none rounded-0 mb-0 bg-transparent">
                <div class="votes answered-accepted">
                    <div class="vote-block" title="Votes">
                        <span class="vote-counts">{{$r->votes}}</span>
                    </div>
                </div>
                <div class="media-body">
                    @if($type =='q')
                        <h5 class="fs-15"><a href="{{route('home.question',['name'=>$r->permalink])}}">{{decodeContent($r->title)}}</a><span class="votedate"> - {{timeAgo($r->on)}}</span>
                        </h5>
                    @else
                        <h5 class="fs-15"><a
                                    href="{{route('home.question',['name'=>$r->question->permalink])}}">{{decodeContent($r->question->title)}}</a><span class="votedate"> - {{timeAgo($r->on)}}</span>
                        </h5>
                    @endif
                </div>
            </div><!-- end media -->
        </div><!-- end item -->
    @endforeach
    <div class="pager pt-30px">
        @php $link =$data->links();
        if($type ==='q')
        $link = str_replace('<a', '<a val="question" ', $link);
        elseif($type ==='a')
         $link = str_replace("<a", "<a val='answer' ", $link)
        @endphp
        {!! $link !!}
    </div>
@endif