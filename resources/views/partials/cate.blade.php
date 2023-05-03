<div class="row">
    @if(!empty($cate))
        @foreach($cate as $r)
            <div class="col-lg-3 responsive-column-half">
                <div class="card card-item">
                    <div class="card-body">
                        <div class="tags pb-1">
                            <a href="{{route('home.category',['name'=>$r->permalink])}}" class="tag-link tag-link-md tag-link-blue">{{$r->name}}</a>
                        </div>
                        <p class="card-text fs-14 truncate-4 lh-24 text-black-50">
                            {{$r->description}}
                        </p>
                        <div class="d-flex tags-info fs-14 pt-3 border-top border-top-gray mt-3">
                            <p class="pr-1 lh-18">{{$r['question_count']}} questions</p>
                        </div>
                    </div><!-- end card-body -->
                </div><!-- end card -->
            </div><!-- end col-lg-3 -->
        @endforeach
    @endif
</div><!-- end row -->
<div class="pager pt-30px text-center" id="nextPage" val="{{$page}}">
    {!! $cate->links() !!}
</div>