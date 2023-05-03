@extends('layouts.home')
@section('title', 'Badges')
@section('description', $site['site_description'])
@section('content')
    <div class="">
        <div class="container custom py-5">
            <div class="filters pb-3">
                <div class="d-flex flex-wrap align-items-center justify-content-between pb-4">
                    <div class="pr-3">
                        <h3 class="fs-22 fw-medium">Badges System</h3>
                        <p class="fs-15 lh-22 my-2">Besides gaining reputation with your questions and answers, you
                            receive badges for being especially helpful.
                            <br> Badges appears on your profile page, questions &amp; answers.
                        </p>
                    </div>
                </div>
                <div class="d-flex flex-wrap align-items-center justify-content-between">

                        <div class="form-group">

                        </div>

                    <div class="btn-group btn--group mb-3" role="group" aria-label="Filter button group">
                        <a href="?sort=all" class="btn {{(!isset($_GET['sort']) || (isset($_GET['sort']) &&  $_GET['sort'] == 'all'))?"active":""}}">All</a>
                        <a href="?sort=bronze"
                           class="btn {{(isset($_GET['sort']) &&  $_GET['sort'] == 'bronze')?"active":""}}">Bronze</a>
                        <a href="?sort=silver" class="btn {{(isset($_GET['sort']) &&  $_GET['sort'] == 'silver')?"active":""}}">Silver</a>
                        <a href="?sort=gold" class="btn {{(isset($_GET['sort']) &&  $_GET['sort'] == 'gold')?"active":""}}">Gold</a>
                    </div>
                </div>
            </div>

            <div class="row">
                <?php $UserBtypes = ['badgesGold', 'gold', 'silver', 'bronze'];?>
                <?php foreach ($badges as $index=>$value) {?>
                <div class="col-md-6 col-lg-4 badge-content px-2">
                    <div class="border row mx-0">
                        <div class="col-md-12 question-cat">
							<span class="user-badge professor" style="">
								<?php echo $value['name'];?></span>
                            <?php if ($value['value'] > 0) {?>
                            <div class="main-point pull-right">
                                <span class="points-count d-block text-right"><?php echo $value['value']?> <i
                                            class="fa fa-star"></i></span>
                                <span class="star d-block text-right">points</span>
                            </div>
                            <?php } ?>
                            <br>
                            <span>Badge Type :<?php echo $UserBtypes[$value['priority']];?></span>
                        </div>
                        <div class="col-md-12">
                            <p><i class="fa fa-check"></i>
                                <?php echo str_replace("<value>", $value['value'], $value['description']);?>
                            </p>
                            <p>
                                <i class="fa fa-check"></i>
                                <?php echo $value['totalAwarded'];?> Awarded
                            </p>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>

@endsection
