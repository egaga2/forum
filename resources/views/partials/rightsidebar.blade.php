<div class="sidebar position-sticky top-0">
    <div class="card card-item">
        <div class="card-body">
            <h3 class="fs-17 pb-3"><i class="fa fa-line-chart"></i> Number Achievement</h3>
            <div class="divider"><span></span></div>
            <div class="row no-gutters text-center">
                <ul class="stats-inner m-0 p-0" style="list-style: none;">
                    <li class="stats-questions">
                        <div>
                            <span class="stats-text">Questions</span><span class="stats-value sidebar_q"></span>
                        </div>
                    </li>
                    <li class="stats-answers">
                        <div><span class="stats-text">Answers</span><span class="stats-value sidebar_a"></span>
                        </div>
                    </li>
                    <li class="stats-best_answers">
                        <div><span class="stats-text">Best Answers</span><span class="stats-value sidebar_bq"></span>
                        </div>
                    </li>
                    <li class="stats-users">
                        <div><span class="stats-text">Users</span><span class="stats-value sidebar_u"></span>
                        </div>
                    </li>
                </ul>
            </div><!-- end row -->
        </div>
    </div><!-- end card -->
    <div class="card card-item">
        <div class="card-body">
            <h3 class="fs-17 pb-3"><i class="icon ion-md-book"></i> Recent Questions</h3>
            <div class="divider"><span></span></div>
            <div class="sidebar-questions pt-3" id="recent_question">

            </div><!-- end sidebar-questions -->
        </div>
    </div><!-- end card -->
    <div class="card card-item">
        <div class="card-body">
            <h3 class="fs-17 pb-3"><i class="icon ion-md-cafe"></i> Trending Questions</h3>
            <div class="divider"><span></span></div>
            <div class="sidebar-questions pt-3" id="trending_questions">
            </div><!-- end sidebar-questions -->
        </div>
    </div><!-- end card -->
    <div class="card card-item">
        <div class="card-body">
            <h3 class="fs-17 pb-3"><i class="icon ion-md-pricetags"></i> Trending Tags</h3>
            <div class="divider"><span></span></div>
            <div class="tags pt-4">
                <div class="tagcloud" id="trending_tag">
                    <a class="tag-cloud-link" href="http://localhost/qa/tags/tag">tag</a>
                </div>
            </div>
        </div>
    </div><!-- end card -->
    <div class="ad-card">
        <h4 class="text-gray text-uppercase fs-13 pb-3 text-center">Advertisements</h4>
        {!!  $ad['below_right_column'] !!}
    </div><!-- end ad-card -->
</div><!-- end sidebar -->
