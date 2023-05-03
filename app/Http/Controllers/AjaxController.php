<?php

namespace App\Http\Controllers;

use App\Answers;
use App\AwardedBadges;
use App\AwnserReplies;
use App\Badges;
use App\Categories;
use App\EditedQuestionsList;
use App\Notifications;
use App\Questions;
use App\QuestionSchema;
use App\QuestionsReplies;
use App\ReportedAnswers;
use App\ReportedQuestions;
use App\ReportSchema;
use App\Setting;
use App\User;
use App\VotedAnswers;
use App\VotedQuestions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;
use Intervention\Image\ImageManagerStatic as Image;
use Hash;



class AjaxController extends Controller
{
    private $cate_time;

    public function __construct()
    {
        $this->cate_time = env('APP_CAHCE_TIME');
    }

    public function getData(Request $request)
    {
        $cate_time = $this->cate_time;
        if ($request->ajax()) {
            $content = Cache::remember($request->key . '___' . $request->val, 1000, function () use ($request) {
                if ($request->key == 'sidebar_right') {
                    if ($request->val == 'count_qa') {
                        $question = Questions::where('status', 1)->count();
                        $question_best = Answers::where('votes', '>', 0)->count();
                        $answers = Answers::count();
                        $user = User::where('status', 1)->count();
                        $data = ['q' => format_number_in_k($question), 'a' => format_number_in_k($answers), 'qb' => format_number_in_k($question_best), 'u' => format_number_in_k($user)];
                    }
                    if ($request->val == 'recent_question') {
                        $question = Questions::where('status', 1)->orderBy('id', 'desc')->with('User')->limit(3)->get()->toArray();
                        if (count($question) > 0) {
                            $html = '';
                            foreach ($question as $q) {
                                $html .= '<div class="media media-card media--card media--card-2">
                                            <div class="media-body">
                                                <h5><a href="' . route('home.question', ['name' => $q['permalink']]) . '">' . decodeContent($q['title']) . '</a></h5>
                                                <small class="meta">
                                                    <span class="pr-1">' . timeAgo($q['on']) . '</span>
                                                    <span class="pr-1">. by</span>
                                                    <a href="' . route('user.profile', ['id' => $q['userid'],'name'=>str_slug($q['user']['name'])]) . '" class="author">' . $q['user']['name'] . '</a>
                                                </small>
                                            </div>
                                        </div>';
                            }
                            $data = $html;
                        } else {
                            $data = '';
                        }
                    }
                    if ($request->val == 'trending_questions') {
                        $question = Questions::where('status', 1)->orderBy('votes', 'desc')->with('User')->limit(3)->get()->toArray();
                        if (count($question) > 0) {
                            $html = '';
                            foreach ($question as $q) {
                                $html .= '<div class="media media-card media--card media--card-2">
                                            <div class="media-body">
                                                <h5><a href="' . route('home.question', ['name' => $q['permalink']]) . '">' . decodeContent($q['title']) . '</a></h5>
                                                <small class="meta">
                                                    <span class="pr-1">' . timeAgo($q['on']) . '</span>
                                                    <span class="pr-1">. by</span>
                                                    <a href="' . route('user.profile', ['id' => $q['userid'],'name'=>str_slug($q['user']['name'])]) . '" class="author">' . $q['user']['name'] . '</a>
                                                </small>
                                            </div>
                                        </div>';
                            }
                            $data = $html;
                        } else {
                            $data = '';
                        }
                    }
                    if ($request->val == 'trending_tag') {
                        $question = Questions::select('tags')->where('status', 1)->orderBy('votes', 'desc')->limit(10)->get()->toArray();
                        if (count($question) > 0) {
                            $html = '';
                            $tags = [];
                            foreach ($question as $index => $value) {
                                $tags = array_merge($tags, explode(',', $value['tags']));
                                if (count($tags) > 20)
                                    break;
                            }
                            $tags = array_unique($tags);
                            foreach ($tags as $index => $tag) {
                                $html = '<a class="tag-cloud-link" href="' . route('home.tags', ['name' => $tag]) . '">' . $tag . '</a>';
                            }
                            $data = $html;
                        } else {
                            $data = '';
                        }
                    }
                    return response()->json([
                        'status' => true,
                        'data' => $data
                    ]);
                }
            });
            return $content;
        }
    }

    public function postProfile(Request $request)
    {
        if ($request->ajax()) {
            if (!Auth::check()) {
                return response()->json([
                    'type' => 2,
                    'html' => 'Please login to continue'
                ]);
            }
            if(Auth::user()->id == 1 OR Auth::user()->id == 101){
                return response()->json([
                    'type' => 0,
                    'html' => 'Demo acount only view.'
                ]);
            }

            if ($request->type == 'uppic') {
                if (isset($_FILES['image'])) {
                    if ($_FILES['image']['error'] == 0) {
                        $userid = Auth::user()->id;
                        $name = $_FILES['image']['name'];
                        $file_ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));
                        $genfileName = "profilePic_" . $userid . "." . $file_ext;
                        $siteRoot = public_path();
                        move_uploaded_file($_FILES['image']['tmp_name'], $siteRoot . '/uploads/users/' . $genfileName);
                        User::where('id', $userid)->update(['image' => $genfileName]);
                        return response()->json([
                            'type' => 1,
                            'html' => 'Your image was successfully saved'
                        ]);
                    } else {
                        return response()->json([
                            'type' => 0,
                            'html' => 'This file is corrupted , Please chose another'
                        ]);
                    }
                } else {
                    return response()->json([
                        'type' => 0,
                        'html' => 'Please choose an image to upload'
                    ]);
                }
            } elseif ($request->type == 'update') {
                $data['name'] = $request->name;
                $data['description'] = encodeContent($request->description);
                $data['facebook'] = $request->facebook;
                $data['instagram'] = $request->instagram;
                $data['website'] = $request->website;
                $data['twitter'] = $request->twitter;
                $data['location'] = $request->location;
                if (empty($data['name'])) {
                    return response()->json([
                        'type' => 0,
                        'html' => 'The Name field is required.'
                    ]);
                } else {
                    User::where('id', Auth::user()->id)->update($data);
                    return response()->json([
                        'type' => 1,
                        'html' => 'Your profile was successfully updated'
                    ]);
                }
            } elseif ($request->type == 'changePass') {
                $validatedData = $request->validate([
                    'current-password' => 'required',
                    'new-password' => 'required|string|min:8|confirmed',
                ]);
                if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
                    return response()->json([
                        'type' => 0,
                        'html' => 'Your current password does not matches with the password you provided. Please try again.'
                    ]);
                }
                if (strcmp($request->get('current-password'), $request->get('new-password')) == 0) {
                    return response()->json([
                        'type' => 0,
                        'html' => 'New Password cannot be same as your current password. Please choose a different password.'
                    ]);
                }
                //Change Password
                $user = Auth::user();
                $user->password = bcrypt($request->get('new-password'));
                $user->save();
                return response()->json([
                    'type' => 1,
                    'html' => 'Password changed successfully!'
                ]);
            }
        }
    }

    public function get_activity(Request $request)
    {
        if ($request->ajax()) {
            $userid = $request->userid;
            $limit = 10;
            if ($request->sort == 'newest') {
                $order = 'id';
                $orderType = 'desc';
            } else {
                $order = 'votes';
                $orderType = 'desc';
            }
            if ($request->type == 'question') {
                $type = 'q';
                $data = Questions::where('userid', $userid)->where('status', 1)->orderBy($order, $orderType)->paginate($limit);
            } else {
                $data = Answers::where('userid', $userid)->with('question')->orderBy($order, $orderType)->paginate($limit);
                $type = 'a';
            }
            return view('partials.activity', ['data' => $data, 'type' => $type])->render();
        }
    }

    public function updatequestion(Request $request)
    {
        if ($request->ajax()) {
            if (!Auth::check()) {
                return response()->json([
                    'type' => 2,
                    'html' => 'Please login to continue.'
                ]);
            }
            if(Auth::user()->id == 1 OR Auth::user()->id == 101){
                return response()->json([
                    'type' => 0,
                    'html' => 'Demo acount only view.'
                ]);
            }

            $qid = $request->qid;
            if ($request->type == 'reportQ') {

                $question = Questions::where('id', $qid)->where('status', 1)->First();
                if ($question == null) {
                    return response()->json([
                        'type' => 0,
                        'html' => 'Invalid question being tried to report'
                    ]);
                }
                $reportedReason = $request->reportedReason;
                $checkrsid = ReportSchema::where('id', $reportedReason)->count();
                if ($checkrsid == 0)
                    return response()->json([
                        'type' => 0,
                        'html' => 'Invalid reason selected for reporting'
                    ]);
                if (ReportedQuestions::where('qid', $qid)->where('userid', Auth::user()->id)->count() > 0)
                    return response()->json([
                        'type' => 0,
                        'html' => 'You have already reported this question!'
                    ]);
                DB::beginTransaction();
                try {
                    $reportQuestion = new ReportedQuestions;
                    $reportQuestion->qid = $qid;
                    $reportQuestion->userid = Auth::user()->id;
                    $reportQuestion->rsid = $reportedReason;
                    $reportQuestion->save();
                    $notifications = new Notifications;
                    $notifications->for = $question['userid'];
                    $notifications->by = Auth::user()->id;
                    $notifications->qid = $question['id'];
                    $notifications->nsId = 5;
                    $notifications->read = 0;
                    $notifications->save();
                    DB::commit();
                    return response()->json([
                        'type' => 1,
                        'html' => 'Question was successfully reported'
                    ]);
                } catch (\Exception $e) {
                    DB::rollback();
                    return response()->json([
                        'type' => 0,
                        'html' => $e->getMessage()
                    ]);
                }

            } elseif ($request->type == 'delete') {
                if (Auth::user()->role != 2) {
                    $checkquestion = Questions::where('id', $qid)->where('userid', Auth::user()->id)->count();
                } else {
                    $checkquestion = Questions::where('id', $qid)->count();
                }
                if ($checkquestion == 0) {
                    return response()->json([
                        'type' => 0,
                        'html' => 'Invalid question being tried to deleted'
                    ]);
                } else {
                    DB::beginTransaction();
                    try {
                        if (Auth::user()->role != 2) {
                            Questions::where('id', $qid)->where('userid', Auth::user()->id)->delete();
                        } else {
                            Questions::where('id', $qid)->delete();
                        }
                        Answers::where('qid', $qid)->delete();
                        AwnserReplies::where('qid', $qid)->delete();
                        QuestionsReplies::where('qid', $qid)->delete();
                        VotedQuestions::where('qid', $qid)->delete();
                        DB::commit();
                    } catch (\Exception $e) {
                        DB::rollback();
                        return response()->json([
                            'type' => 0,
                            'html' => $e->getMessage()
                        ]);
                    }
                    return response()->json([
                        'type' => 1,
                        'html' => 'Question was successfully deleted'
                    ]);

                }

            } elseif ($request->type == 'vote') {
                $q = Questions::where('id', $request->question)->First();
                if (empty($q)) {
                    return response()->json([
                        'type' => 0,
                        'html' => "Invalid question being tried to vote"
                    ]);
                }
                $userid = Auth::user()->id;
                $val = $request->votetype;
                $val = $val == 0 ? 0 : 1;
                $checkVoteExist = VotedQuestions::where('by', $userid)->where('qid', $request->question)->count();
                if ($checkVoteExist > 0) {
                    $v = VotedQuestions::where('by', $userid)->where('qid', $request->question)->update(['val' => $val]);
                    if ($v && $val == 0)
                        Questions::find($request->question)->decrement('votes');
                    elseif ($v && $val == 1)
                        Questions::find($request->question)->increment('votes');
                } else {
                    $vote = new VotedQuestions;
                    $vote->by = $userid;
                    $vote->qid = $request->question;
                    $vote->val = $val;
                    $vote->save();
                    $notifications = new Notifications;
                    $notifications->for = $q['userid'];
                    $notifications->by = Auth::user()->id;
                    $notifications->qid = $request->question;
                    $notifications->nsId = 13;
                    $notifications->read = 0;
                    $notifications->save();
                    if ($val == 0)
                        Questions::find($request->question)->decrement('votes');
                    elseif ($val == 1)
                        Questions::find($request->question)->increment('votes');
                }
                $voted = Questions::where('id', $request->question)->First();
                return response()->json([
                    'type' => 1,
                    'val' => $voted['votes']
                ]);
            } elseif ($request->type == 'ansvote') {
                $ans = Answers::where('id', $request->qaid)->First();
                if (empty($ans)) {
                    return response()->json([
                        'type' => 0,
                        'html' => "Invalid answer being tried to vote"
                    ]);
                }
                $userid = Auth::user()->id;
                $val = $request->votetype;
                $val = $val == 0 ? 0 : 1;
                $checkVoteExist = VotedAnswers::where('by', $userid)->where('qaid', $request->qaid)->count();
                if ($checkVoteExist > 0) {
                    $v = VotedAnswers::where('by', $userid)->where('qaid', $request->qaid)->update(['val' => $val]);
                    if ($v && $val == 0)
                        Answers::find($request->qaid)->decrement('votes');
                    elseif ($v && $val == 1)
                        Answers::find($request->qaid)->increment('votes');
                } else {
                    $vote = new VotedAnswers;
                    $vote->by = $userid;
                    $vote->qaid = $request->qaid;
                    $vote->val = $val;
                    $vote->save();
                    $notifications = new Notifications;
                    $notifications->for = $ans['userid'];
                    $notifications->by = Auth::user()->id;
                    $notifications->qid = $ans['qid'];
                    $notifications->qaid = $ans['id'];
                    $notifications->nsId = 14;
                    $notifications->read = 0;
                    $notifications->save();
                    if ($val == 0)
                        Answers::find($request->qaid)->decrement('votes');
                    elseif ($val == 1)
                        Answers::find($request->qaid)->increment('votes');
                }
                $voted = Answers::where('id', $request->qaid)->First();
                return response()->json([
                    'type' => 1,
                    'val' => $voted['votes']
                ]);
            }
        }
    }

    public function postQuestion(Request $request)
    {
        if (!Auth::check()) {
            return response()->json([
                'status' => false,
                'html' => 'Please login to continue.'
            ]);
        }
        if(Auth::user()->id == 1 OR Auth::user()->id == 101){
            return response()->json([
                'type' => 0,
                'html' => 'Demo acount only view.'
            ]);
        }

        $this->validate($request, [
            'category' => 'required',
            'title' => 'required|max:150|min:10',
            'description' => 'required|min:100',
            'tags' => 'required|max:200',
        ]);
        if (Categories::where('status', 1)->where('id', $request->category)->count() <= 0) {
            return response()->json([
                'status' => false,
                'html' => 'Invalid category posted.'
            ]);
        }
        if ($request->type == 'update') {
            $title = encodeContent($request->title);
            $id = $request->id;
            $slug = Str::slug($title);
            if (empty($slug))
                $slug = str_slug($title);
            if (Questions::where('permalink', $slug)->where('id', '!=', $id)->count() > 0) {
                return response()->json([
                    'status' => false,
                    'html' => 'This question already exists , Please choose another title'
                ]);
            }
            $description = encodeContent($request->description);
            $question = Questions::find($id);
            $question->title = $title;
            $question->permalink = $slug;
            $question->catid = $request->category;
            $question->description = $description;
            $question->tags = $request->tags;
            $question->save();
            if ($question->userid != Auth::user()->id) {
                $editl = EditedQuestionsList::where('qid', $question->id)->count();
                if ($editl > 0) {
                    EditedQuestionsList::where('qid', $question->id)->update(['userid' => Auth::user()->id]);
                } else {
                    $edit = new EditedQuestionsList;
                    $edit->qid = $question->id;
                    $edit->userid = Auth::user()->id;
                    $edit->save();
                }
            }
            return response()->json([
                'status' => $question,
                'link' => route('home.question', ['name' => $question->permalink]),
                'html' => 'Question was successfully posted, redirecting you to the question page.<br><a href="' . route('home.question', ['name' => $question->permalink]) . '">Click to open posted question</a>'
            ]);
        } else {
            $title = encodeContent($request->title);
            $slug = Str::slug($title);
            if (empty($slug))
                $slug = str_slug($title);

            if (Questions::where('permalink', $slug)->count() > 0) {
                return response()->json([
                    'status' => false,
                    'html' => 'This question already exists , Please choose another title'
                ]);
            }
            DB::beginTransaction();
            try {
                $tags = $request->tags;
                $description = encodeContent($request->description);
                $userid = Auth::user()->id;
                $question = new Questions;
                $question->title = $title;
                $question->permalink = $slug;
                $question->catid = $request->category;
                $question->userid = $userid;
                $question->status = 1;
                $question->description = $description;
                $question->tags = $tags;
                $question->save();
                DB::commit();
            } catch (\Exception $e) {
                DB::rollback();
                return response()->json([
                    'status' => false,
                    'html' => $e->getMessage()
                ]);
            }
            return response()->json([
                'status' => $question,
                'link' => route('home.question', ['name' => $question->permalink]),
                'html' => 'Question was successfully posted, redirecting you to the question page.<br><a href="' . route('home.question', ['name' => $question->permalink]) . '">Click to open posted question</a>'
            ]);
        }
    }

    public function load_awnser(Request $request)
    {
        $limit = 15;
        if ($request->ajax()) {
            $qid = $request->qid;
            if (!empty($request->sort)) {
                if ($request->sort == 'oldest') {
                    $oder = 'id';
                    $s = 'ASC';
                } elseif ($request->sort == 'recent') {
                    $oder = 'id';
                    $s = 'DESC';
                } else {
                    $oder = 'votes';
                    $s = 'DESC';
                }
            }
            if ($request->id > 0) {
                $data = Answers::where('qid', $qid)->with('user')->where('id', '<', $request->id)->orderBy($oder, $s)
                    ->limit($limit)
                    ->get();
            } else {
                $data = Answers::where('qid', $qid)->with('user')->orderBy($oder, $s)
                    ->limit($limit)
                    ->get();
            }
            $output = '';
            $last_id = '';
            $count_data = count($data);
            if (!$data->isEmpty()) {
                foreach ($data as $row) {
                    $vote = 3;
                    if (Auth::check()) {
                        $voted = VotedAnswers::select('val')->where('qaid', $row->id)->where('by', Auth::user()->id)->First();
                        if (isset($voted['val']))
                            $vote = $voted['val'];
                    }
                    $Areply = AwnserReplies::where('qaid', $row->id)->where('qid', $qid)->with('User')->get();
//                    $recentBadges = AwardedBadges::where('userid', $row->userid)->with('badges')->orderBy('badgeId', 'DESC')->First();
                    $recentBadges = DB::table('awardedBadges')
                        ->select('badges.name', 'awardedBadges.userid')
                        ->join('badges', 'badges.id', '=', 'awardedBadges.badgeId')
                        ->where('awardedBadges.userid', $row->userid)
                        ->orderByDesc('badges.value')
                        ->First();
                    $badges_name = '';
                    if (isset($recentBadges->name)) {
                        $badges_name = ' <span class="badge-span" style="background-color: #ffbf00">' . $recentBadges->name . '</span>';
                    }
                    $output .= '<article id="answer-main-head-' . $row->id . '" class="article-question article-post clearfix question-type-normal">
	<div class="single-inner-content">
		<div class="question-inner row">
			<div class="col-md-1 px-md-1 ">
				<div class="question-image-vote">
					<div class="author-image text-center">
						<a href="' . route('user.profile', ['id' => $row->userid,'name'=>str_slug($row->user->name)]) . '">
							<span class="author-image-span">
								<img class="avatar avatar-42 photo" alt="name" width="42" height="42" src="' . asset('public/uploads/users/') . '/' . $row->user['image'] . '">
							</span>
						</a>
						<ul class="question-mobile question-vote comment comment">
						<li qaid="' . $row->id . '" type="1" class="question-vote-up answerVote ' . ($vote == 1 ? "active" : "") . '">
							<a class="question_vote_up vote_not_user" title="Like"><i class="fa fa-caret-up " aria-hidden="true"></i></a>
						</li>
						<li class="votes-answer-' . $row->id . '  vote_result">' . $row->votes . '</li>
						<li qaid="' . $row->id . '" type="0" class="question-vote-down answerVote ' . ($vote == 0 ? "active" : "") . '">
							<a class="question_vote_down vote_not_user" title="Dislike"><i class="fa fa-caret-down" aria-hidden="true"></i></a>
						</li>
					</ul> 
					
					</div>
				</div>
				
				<div class="question-content question-content-first d-inline-block d-md-none">
					<header class="article-header">
						<div class="question-header">
							<a class="post-author" href="' . route('user.profile', ['id' => $row->userid,'name'=>str_slug($row->user->name)]) . '">' . $row->user['name'] . $badges_name . '</a>
						</div>
					</header>
				</div>
			</div>
			<div class="col-md-11">
				<div class="question-content question-content-first">
					<header class="article-header d-none d-md-block">
						<div class="question-header">
							<a class="post-author line-height-15" href="' . route('user.profile', ['id' => $row->userid,'name'=>str_slug($row->user->name)]) . '">' . $row->user['name'] . $badges_name . '</a>
							<a href="" class="comment-date p-0"> Added an answer on ' . timeAgo($row->on) . ' </a>
						</div>
					</header>
				</div>
				<div class="question-content question-content-second">
					<div class="post-wrap-content">
					    <div id="answer-description-' . $row->id . '" class="question-content-text comment">
							' . decodeContent($row->body) . '
						</div>
					</div>
					<div class="msg_error custom"></div>
					<span answerid="' . $row->id . '" class="reply-answer reply-comment">
						<i class="fa fa-share" aria-hidden="true"></i> Reply
					</span>
					';
                    if (Auth::check() && Auth::user()->id != $row->user['id']):
                        $countReport = ReportedAnswers::where('qaid', $row->id)->where('userid', Auth::user()->id)->count();
                        if ($countReport > 0) {
                            $output .= '
					<span class="report-comment" style="color: #ffbf01"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Reported
														</span>
					';
                        } else
                            $output .= '
					<span answerid="' . $row->id . '" class="reportAnswerMod report-comment">
															<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Report
														</span>
					';
                    elseif (!Auth::check()):
                        $output .= '<span data-toggle="modal" data-target="#signupModal" class="report-comment">
															<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Report
														</span>';
                    endif;
                    if (Auth::check() && (Auth::user()->id == $row->user['id'] || Auth::user()->role == 2)):
                        $output .= '
					<span answerid="' . $row->id . '" class="edit-reply-answer reply-comment">
															<span class="ti-pencil"></span> Edit
														</span>
					<span answerid="' . $row->id . '" class="delete-answer reply-comment">
															<span class="ti-trash"></span> Delete
														</span>
														';
                    endif;
                    $output .= '
                    <div answerid="' . $row->id . '" class="comment-form reply-answer">
                                    <div class="comment-link-wrap text-center">
                                        <a class="collapse-btn comment-link" data-toggle="collapse" href="#addCommentCollapseTwo" role="button" aria-expanded="false" aria-controls="addCommentCollapseTwo" title="Use comments to ask for more information or suggest improvements. Avoid answering questions in comments.">Add a comment</a>
                                    </div>
                                </div>
                    <div id="' . $row->id . '-answerReplyInput" class="main-comment reply d-none">
					<div class="form-group">
						<label>Your comment on this answer:</label>
						<textarea class="reply answer w-100" rows="2"></textarea>
					</div>  
					<div class="form-group">
						<button answerid="' . $row->id . '" class="addReplyAnswer btn btn-postcomment my-2">Add Comment</button>
						<button answerid="' . $row->id . '" class="cancelReplyAnswer btn btn-cancelcomment my-2">Cancel </button>
					</div>
				</div>
				</div>
					<div class="comments-wrap">
					<ul id="' . $row->id . '-answerReplies" class="comments-list">';
                    if (count($Areply) > 0) {
                        foreach ($Areply as $r) {
                            $output .= '<li id="answer-reply-main-head-' . $r->id . '">
                                <div class="comment-body">
                                    <span class="act-reply-' . $r->id . ' comment-copy">' . decodeContent($r->reply) . '</span>
                                    <span class="comment-separated">-</span>
                                    <a href="' . route('user.profile', ['id' => $r->userid,'name'=>str_slug($row->user->name)]) . '" class="comment-user owner" title="">' . $r->User->name . '</a>
                                    <span class="comment-separated">-</span>
                                    <span>' . timeAgo($r->on) . '</span>';
                            if (Auth::check() && Auth::user()->id == $r->userid) {
                                $output .= '
                                    - <span arid="' . $r->id . '" class="edit-replya edit-reply"><span class="ti-marker-alt"></span></span>
                                    <span arid="' . $r->id . '" class="delete-replyA"><i class="fa fa-trash-o" aria-hidden="true"></i></span>';
                            }
                            $output .= '      
                                    <div class="replyARecord-' . $r->id . ' d-none">
                                        <textarea id="replya-' . $r->id . '" class="editorP w-100" rows="5">' . decodeContent($r->reply) . '</textarea>
                                        <a arid="' . $r->id . '" class="saveReplyA  btn btn-primary">Save</a>
                                        <a arid="' . $r->id . '" class="cancelReplyA btn btn-primary">Cancel</a>
                                    </div></div>
                            </li>';
                        }
                    }
                    $output .= '
                    </ul>
				</div>
			</div>
		</div>								
	</div>
</article><script>hljs.highlightAll();</script>';
                    $last_id = $row->id;
                }
                if ($count_data >= $limit) {
                    $output .= '
                   <div id="load_more" class="loadmore-q text-center">
                    <button type="button" name="load_more_button" class="btn btn-success" data-id="' . $last_id . '" id="load_more_button">Load More Awnser</button>
                   </div>
                   ';
                }
            }
            echo $output;
        }

    }

    public function load_question(Request $request)
    {
        $limit = 20;
        if ($request->ajax()) {
            if (!empty($request->sort)) {
                if ($request->sort == 'newest') {
                    $oder = 'id';
                    $s = 'DESC';
                } elseif ($request->sort == 'latest') {
                    $oder = 'id';
                    $s = 'ASC';
                } elseif ($request->sort == 'votes') {
                    $oder = 'votes';
                    $s = 'DESC';
                } elseif ($request->sort == 'views') {
                    $oder = 'views';
                    $s = 'DESC';
                } elseif ($request->sort == 'awnsers') {
                    $oder = 'awnsers';
                    $s = 'DESC';
                } else {
                    $oder = 'awnsers';
                    $s = 'ASC';
                }
            }
            if ($request->id > 0) {
                if ($request->sort == 'unanswered') {
                    $data = Questions::where('status', 1)->with('User')->where('id', '<', $request->id)->where('awnsers', '<=', 0)->orderBy($oder, $s)
                        ->limit($limit)
                        ->get();
                } else {
                    $data = Questions::where('status', 1)->with('User')->where('id', '<', $request->id)->orderBy($oder, $s)
                        ->limit($limit)
                        ->get();
                }
            } else {
                if ($request->sort == 'unanswered') {
                    $data = Questions::where('status', 1)->where('awnsers', '<=', 0)->with('User')->orderBy($oder, $s)
                        ->limit($limit)
                        ->get();
                } else {
                    $data = Questions::where('status', 1)->with('User')->orderBy($oder, $s)
                        ->limit($limit)
                        ->get();
                }
            }
            $output = '';
            $last_id = '';
            $count_data = count($data);
            if (!$data->isEmpty()) {
                foreach ($data as $row) {
                    $tags = explode(',', $row->tags);
                    $tagt = '';
                    foreach ($tags as $tag) {
                        $tagt .= '<a href="' . route('home.tags', ['name' => $tag]) . '" class="tag-link">' . $tag . '</a>';
                    }
                    $answered = ($row->awnsers > 0) ? "answered" : "";
                    $output .= '
                    <div class="media media-card rounded-0 shadow-none mb-0 bg-transparent p-3 border-bottom border-bottom-gray">
                                <div class="votes text-center votes-2">
                                    <div class="vote-block">
                                        <span class="vote-counts d-block text-center pr-0 lh-20 fw-medium">' . format_number_in_k($row->votes) . '</span>
                                        <span class="vote-text d-block fs-13 lh-18">votes</span>
                                    </div>
                                    <div class="answer-block ' . $answered . ' my-2">
                                        <span class="answer-counts d-block lh-20 fw-medium">' . format_number_in_k($row->awnsers) . '</span>
                                        <span class="answer-text d-block fs-13 lh-18">answers</span>
                                    </div>
                                    <div class="view-block">
                                        <span class="view-counts d-block lh-20 fw-medium">' . format_number_in_k($row->views) . '</span>
                                        <span class="view-text d-block fs-13 lh-18">views</span>
                                    </div>
                                </div>
                                <div class="media-body">
                                    <h5 class="mb-2 fw-medium"><a href="' . route('home.question', ['name' => $row->permalink]) . '">' .decodeContent($row->title) . '</a></h5>
                                    <p class="mb-2 truncate lh-20 fs-15">' . substr(strip_tags(html_entity_decode($row->description)), 0, 110) . '</p>
                                    <div class="tags">
                                        ' . $tagt . '
                                    </div>
                                    
                                    <div class="media media-card user-media align-items-center px-0 border-bottom-0 pb-0">
                                        <a href="' . route('user.profile', ['id' => $row->userid,'name'=>str_slug($row->user->name)]) . '" class="media-img d-block">
                                            <img src="' . asset('public/uploads/users/') . '/' . $row->user->image . '" alt="avatar">
                                        </a>
                                        <div class="media-body d-flex flex-wrap align-items-center justify-content-between">
                                            <div>
                                                <h5 class="pb-1"><a href="' . route('user.profile', ['id' => $row->userid,'name'=>str_slug($row->user->name)]) . '">' . $row->user->name . '</a></h5>
                                                <div class="stats fs-12 d-flex align-items-center lh-18">
                                                    <span class="text-black pr-2" title="Reputation score">' . format_number_in_k($row->user->votes) . '</span>
                                                    <span class="pr-2 d-inline-flex align-items-center" title="Gold badge"><span class="ball gold"></span>' . format_number_in_k($row->user->badgesGold) . '</span>
                                                    <span class="pr-2 d-inline-flex align-items-center" title="Silver badge"><span class="ball silver"></span>' . format_number_in_k($row->user->badgesSilver) . '</span>
                                                    <span class="pr-2 d-inline-flex align-items-center" title="Bronze badge"><span class="ball"></span>' . format_number_in_k($row->user->badgesBronze) . '</span>
                                                </div>
                                            </div>
                                            <small class="meta d-block text-right">
                                                <span class="text-black d-block lh-18">asked</span>
                                                <span class="d-block lh-18 fs-12">' . timeAgo($row->on) . '</span>
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    ';
                    $last_id = $row->id;
                }
                if ($count_data >= $limit) {
                    $output .= '
                   <div id="load_more" class="loadmore-q text-center pt-3">
                    <button type="button" name="load_more_button" class="btn btn-success" data-id="' . $last_id . '" id="load_more_button">Load More Questions</button>
                   </div>
                   ';
                }
            }
            echo $output;
        }

    }

    public function PostQuestionReply(Request $request)
    {
        if ($request->ajax()) {
            if (!Auth::check()) {
                return response()->json([
                    'type' => 2,
                    'html' => 'Please login to continue'
                ]);
            }
            if(Auth::user()->id == 1 OR Auth::user()->id == 101){
                return response()->json([
                    'type' => 0,
                    'html' => 'Demo acount only view.'
                ]);
            }

            if ($request->type == 'edit') {
                $this->validate($request, [
                    'replyTextQ' => 'required',
                    'qrid' => 'required',
                    'question' => 'required',
                ], ['The reply question field is required.']);
                $q = Questions::where('id', $request->question)->where('status', 1)->First();
                if (empty($q)) {
                    return response()->json([
                        'type' => 0,
                        'html' => "Invalid question being tried to reply"
                    ]);
                }
                $replyTextQ = encodeContent($request->replyTextQ);
                $qrid = $request->qrid;
                $checkquestionr = QuestionsReplies::where('id', $qrid)->where('userid', Auth::user()->id)->count();
                if ($checkquestionr == 0) {
                    return response()->json([
                        'type' => 0,
                        'html' => "The reply you are trying to edit appears to be deleted or its not yours"
                    ]);
                } else {
                    $replyTime = date('Y-m-d H:i:s');
                    $reply = QuestionsReplies::find($qrid);
                    $reply->reply = $replyTextQ;
                    $reply->on = $replyTime;
                    $reply->save();
                    return response()->json([
                        'type' => 1,
                        'html' => "Successfully Updated"
                    ]);
                }
            } elseif ($request->type == 'delete') {
                $qrid = $request->qrid;
                $checkquestionr = QuestionsReplies::where('id', $qrid)->where('userid', Auth::user()->id)->count();
                if ($checkquestionr == 0) {
                    return response()->json([
                        'type' => 0,
                        'html' => "Invalid question reply being tried to deleted"
                    ]);
                } else {
                    QuestionsReplies::where('id', $qrid)->where('userid', Auth::user()->id)->delete();
                    return response()->json([
                        'type' => 1,
                        'html' => "Question reply was successfully deleted"
                    ]);
                }
            } else {
                $this->validate($request, [
                    'replyTextQ' => 'required',
                    'question' => 'required',
                ], ['The reply question field is required.']);
                $q = Questions::where('id', $request->question)->First();
                if (empty($q)) {
                    return response()->json([
                        'type' => 0,
                        'html' => "Invalid question being tried to reply"
                    ]);
                }
                $replyTextQ = encodeContent($request->replyTextQ);
                $questionSchema = QuestionSchema::select('*')->First();
                $canReplyAfter = $questionSchema['canReplyAfter'];
                $votes = User::where('id', Auth::user()->id)->First();
                if ($votes['votes'] < $canReplyAfter) {
                    return response()->json([
                        'type' => 0,
                        'html' => "You need " . $canReplyAfter . " reputation to reply on this question"
                    ]);
                }
                DB::beginTransaction();
                try {
                    $reply = new QuestionsReplies;
                    $reply->qid = $request->question;
                    $reply->reply = $replyTextQ;
                    $reply->userid = Auth::user()->id;
                    $reply->save();
                    $qrid = $reply->id;
                    $notifications = new Notifications;
                    $notifications->for = $q['userid'];
                    $notifications->by = Auth::user()->id;
                    $notifications->qid = $request->question;
                    $notifications->qrid = $qrid;
                    $notifications->nsId = 2;
                    $notifications->read = 0;
                    $notifications->save();
                    $replyTime = date('Y-m-d H:i:s');
                    $html = '
                    <li id="question-reply-main-head-' . $qrid . '">
                    <div class="comment-body">
                        <span class="act-reply-' . $qrid . ' comment-copy">' . decodeContent($replyTextQ) . '</span>
                        <span class="comment-separated">-</span>
                        <a href="' . route('user.profile', ['id' => Auth::user()->id,'name'=>str_slug(Auth::user()->name)]) . '" class="comment-user owner" title="">' . Auth::user()->name . '</a>
                        <span class="comment-separated">-</span>
                        <span>' . timeAgo($replyTime) . '</span>- <span qrid="' . $qrid . '" class="edit-replyq edit-reply"><span class="ti-marker-alt"></span></span>
                        <span qrid="' . $qrid . '" class="delete-replyQ"><i class="fa fa-trash-o" aria-hidden="true"></i></span>
                        <div class="replyQRecord-' . $qrid . ' d-none">
                            <textarea id="replyq-' . $qrid . '" class="editorP w-100" rows="5">' . decodeContent($replyTextQ) . '</textarea>
                            <a qrid="' . $qrid . '" class="saveReplyQ btn btn-primary">Save</a>
                            <a qrid="' . $qrid . '" class=" cancelReplyQ btn btn-primary">Cancel</a>
                        </div></div>
                </li>';
                    DB::commit();
                    return response()->json([
                        'type' => 1,
                        'html' => $html
                    ]);
                } catch (\Exception $e) {
                    DB::rollback();
                    return response()->json([
                        'type' => 0,
                        'html' => $e->getMessage()
                    ]);
                }
            }
        }
    }

    public function postAnswer(Request $request)
    {
        if ($request->ajax()) {
            if (!Auth::check()) {
                return response()->json([
                    'type' => 2,
                    'html' => 'Please login to continue'
                ]);
            }
            if(Auth::user()->id == 1 OR Auth::user()->id == 101){
                return response()->json([
                    'type' => 0,
                    'html' => 'Demo acount only view.'
                ]);
            }

            if ($request->type == 'reportA') {
                $answerid = $request->answerid;
                $answer = Answers::where('id', $answerid)->First();
                if ($answer == null) {
                    return response()->json([
                        'type' => 0,
                        'html' => 'Invalid answer being tried to report'
                    ]);
                }
                $reportedReason = $request->reportedReason;
                $checkrsid = ReportSchema::where('id', $reportedReason)->count();
                if ($checkrsid == 0)
                    return response()->json([
                        'type' => 0,
                        'html' => 'Invalid reason selected for reporting'
                    ]);
                if (ReportedAnswers::where('qaid', $answer['id'])->where('userid', Auth::user()->id)->count() > 0)
                    return response()->json([
                        'type' => 0,
                        'html' => 'You have already reported this answer!'
                    ]);
                DB::beginTransaction();
                try {
                    $reportAnswer = new ReportedAnswers;
                    $reportAnswer->qaid = $answer['id'];
                    $reportAnswer->userid = Auth::user()->id;
                    $reportAnswer->rsid = $reportedReason;
                    $reportAnswer->save();
                    $notifications = new Notifications;
                    $notifications->for = $answer['userid'];
                    $notifications->by = Auth::user()->id;
                    $notifications->qid = $answer['qid'];
                    $notifications->qaid = $answer['id'];;
                    $notifications->nsId = 6;
                    $notifications->read = 0;
                    $notifications->save();
                    DB::commit();
                    return response()->json([
                        'type' => 1,
                        'html' => 'Answer was successfully reported'
                    ]);
                } catch (\Exception $e) {
                    DB::rollback();
                    return response()->json([
                        'type' => 0,
                        'html' => $e->getMessage()
                    ]);
                }

            } elseif ($request->type == 'addreply') {
                $this->validate($request, [
                    'answerReply' => 'required',
                    'answerid' => 'required',
                    'question' => 'required',
                ], ['The reply answer question field is required.']);
                $q = Questions::where('id', $request->question)->First();
                if (empty($q)) {
                    return response()->json([
                        'type' => 0,
                        'html' => "Invalid question's answer being tried to reply"
                    ]);
                }
                $answerReply = encodeContent($request->answerReply);
                $questionSchema = QuestionSchema::select('*')->First();
                $canReplyAfter = $questionSchema['canReplyAfter'];
                $votes = User::where('id', Auth::user()->id)->First();
                if ($votes['votes'] < $canReplyAfter) {
                    return response()->json([
                        'type' => 0,
                        'html' => "You need " . $canReplyAfter . " reputation to reply on this Answer"
                    ]);
                }
                $ans = Answers::where('id', $request->answerid)->First();
                if (empty($ans)) {
                    return response()->json([
                        'type' => 0,
                        'html' => "Invalid answer being tried to reply"
                    ]);
                }
                DB::beginTransaction();
                try {
                    $reply = new AwnserReplies;
                    $reply->qid = $request->question;
                    $reply->qaid = $request->answerid;
                    $reply->reply = $answerReply;
                    $reply->votes = 0;
                    $reply->userid = Auth::user()->id;
                    $reply->save();
                    $arid = $reply->id;
                    $notifications = new Notifications;
                    $notifications->for = $q['userid'];
                    $notifications->by = Auth::user()->id;
                    $notifications->qid = $request->question;
                    $notifications->arid = $arid;
                    $notifications->nsId = 3;
                    $notifications->read = 0;
                    $notifications->save();
                    $replyTime = date('Y-m-d H:i:s');
                    $html = '<li id="answer-reply-main-head-' . $arid . '">
                    <div class="comment-body">
                        <span class="act-reply-' . $arid . ' comment-copy">' . decodeContent($answerReply) . '</span>
                        <span class="comment-separated">-</span>
                        <a href="' . route('user.profile', ['id' => Auth::user()->id,'name'=>str_slug(Auth::user()->name)]) . '" class="comment-user owner" title="">' . Auth::user()->name . '</a>
                        <span class="comment-separated">-</span>
                        <span>' . timeAgo($replyTime) . '</span>- <span arid="' . $arid . '" class="edit-replya edit-reply"><span class="ti-marker-alt"></span></span>
                        <span arid="' . $arid . '" class="delete-replyA"><i class="fa fa-trash-o" aria-hidden="true"></i></span>
                        <div class="replyARecord-' . $arid . ' d-none">
                            <textarea id="replya-' . $arid . '" class="editorP w-100" rows="5">' . decodeContent($answerReply) . '</textarea>
                            <a arid="' . $arid . '" class="saveReplyA  btn btn-primary">Save</a>
                            <a arid="' . $arid . '" class="cancelReplyA btn btn-primary">Cancel</a>
                        </div></div>
                </li>';
                    DB::commit();
                    return response()->json([
                        'type' => 1,
                        'html' => $html
                    ]);
                } catch (\Exception $e) {
                    DB::rollback();
                    return response()->json([
                        'type' => 0,
                        'html' => $e->getMessage()
                    ]);
                }
            } elseif ($request->type == 'editreply') {
                $this->validate($request, [
                    'replyTextA' => 'required',
                    'arid' => 'required',
                ], ['The Answer Reply field is required.']);

                $replyTextA = encodeContent($request->replyTextA);
                $arid = $request->arid;
                $checkquestionr = QuestionsReplies::where('id', $arid)->where('userid', Auth::user()->id)->count();
                if ($checkquestionr == 0) {
                    return response()->json([
                        'type' => 0,
                        'html' => "The reply you are trying to edit appears to be deleted or its not yours"
                    ]);
                } else {
                    $replyTime = date('Y-m-d H:i:s');
                    $reply = AwnserReplies::find($arid);
                    $reply->reply = $replyTextA;
                    $reply->on = $replyTime;
                    $reply->save();
                    return response()->json([
                        'type' => 1,
                        'html' => "Successfully Updated"
                    ]);
                }
            } elseif ($request->type == 'deleteReply') {
                $arid = $request->arid;
                $checkquestionr = AwnserReplies::where('id', $arid)->where('userid', Auth::user()->id)->count();
                if ($checkquestionr == 0) {
                    return response()->json([
                        'type' => 0,
                        'html' => "Invalid answer reply being tried to deleted"
                    ]);
                } else {
                    AwnserReplies::where('id', $arid)->where('userid', Auth::user()->id)->delete();
                    return response()->json([
                        'type' => 1,
                        'html' => "Answer reply was successfully deleted"
                    ]);
                }
            } elseif ($request->type == 'delete') {
                $q = Questions::where('id', $request->question)->First();
                if (empty($q)) {
                    return response()->json([
                        'type' => 0,
                        'html' => "Invalid question's answer being tried to deleted"
                    ]);
                }
                $answerid = $request->answerid;
                if (Auth::user()->role != 2) {
                    $checkquestionr = Answers::where('id', $answerid)->where('qid', $q['id'])->where('userid', Auth::user()->id)->count();
                } else {
                    $checkquestionr = Answers::where('id', $answerid)->where('qid', $q['id'])->count();
                }
                if ($checkquestionr == 0) {
                    return response()->json([
                        'type' => 0,
                        'html' => "Invalid answer being tried to deleted"
                    ]);
                } else {
                    if (Auth::user()->role != 2) {
                        Answers::where('id', $answerid)->where('qid', $q['id'])->where('userid', Auth::user()->id)->delete();
                    } else {
                        Answers::where('id', $answerid)->where('qid', $q['id'])->delete();
                    }
                    Questions::find($q->id)->decrement('awnsers');
                    AwnserReplies::where('qaid', $answerid)->delete();
                    VotedAnswers::where('qaid', $answerid)->delete();
                    return response()->json([
                        'type' => 1,
                        'html' => "Answers was successfully deleted"
                    ]);
                }
            } elseif ($request->type == 'edit') {
                $this->validate($request, [
                    'answer' => 'required',
                    'answerid' => 'required',
                ], ['The Question Answer field is required.']);
                $q = Questions::where('id', $request->question)->First();
                if (empty($q)) {
                    return response()->json([
                        'type' => 0,
                        'html' => "Invalid question's answer being tried to deleted"
                    ]);
                }
                $answerid = $request->answerid;
                if (Auth::user()->role != 2) {
                    $checkquestionr = Answers::where('id', $answerid)->where('qid', $q['id'])->where('userid', Auth::user()->id)->count();
                } else {
                    $checkquestionr = Answers::where('id', $answerid)->where('qid', $q['id'])->count();
                }
                if ($checkquestionr == 0) {
                    return response()->json([
                        'type' => 0,
                        'html' => "Invalid answer being tried to deleted"
                    ]);
                } else {
                    $answertext = encodeContent($request->answer);
                    $awnswerTime = date('Y-m-d H:i:s');
                    $answer = Answers::find($request->answerid);
                    $answer->body = $answertext;
                    $answer->on = $awnswerTime;
                    $answer->save();
                    return response()->json([
                        'type' => 1,
                        'html' => "Answer was successfully edited"
                    ]);
                }
            } else {
                $this->validate($request, [
                    'answerEditor' => 'required',
                    'question' => 'required',
                ], ['The Question Answer field is required.']);

                $q = Questions::where('id', $request->question)->First();
                if (empty($q)) {
                    return response()->json([
                        'type' => 0,
                        'html' => "Invalid question being tried to answer"
                    ]);
                }
                DB::beginTransaction();
                try {
                    $answerEditor = encodeContent($request->answerEditor);
                    $answers = new Answers;
                    $answers->qid = $request->question;
                    $answers->body = $answerEditor;
                    $answers->userid = Auth::user()->id;
                    $answers->save();
                    Questions::find($request->question)->increment('awnsers');
                    $qaid = $answers->id;
                    $notifications = new Notifications;
                    $notifications->for = $q['userid'];
                    $notifications->by = Auth::user()->id;
                    $notifications->qid = $request->question;
                    $notifications->qaid = $qaid;
                    $notifications->nsId = 1;
                    $notifications->read = 0;
                    $notifications->save();
                    $awnswerTime = date('Y-m-d H:i:s');
                    $html = '<article id="answer-main-head-' . $qaid . '" class="article-question article-post clearfix question-type-normal">
                            <div class="single-inner-content">
                                <div class="question-inner row">
                                    <div class="col-md-1 px-md-1 ">
                                        <div class="question-image-vote">
                                            <div class="author-image text-center">
                                                <a href="' . route('user.profile', ['id' => Auth::user()->id,'name'=>str_slug(Auth::user()->name)]) . '">
                                                    <span class="author-image-span">
                                                        <img class="avatar avatar-42 photo" alt="name" width="42" height="42" src="' . asset('public/uploads/users/') . '/' . Auth::user()->image . '">
                                                    </span>
                                                </a>
                                                <ul class="question-mobile question-vote comment comment">
                                                <li qaid="' . $qaid . '" type="1" class="question-vote-up answerVote">
                                                    <a class="question_vote_up vote_not_user" title="Like"><i class="fa fa-caret-up " aria-hidden="true"></i></a>
                                                </li>
                                                <li class="votes-answer-' . $qaid . '  vote_result">0</li>
                                                <li qaid="' . $qaid . '" type="0" class="question-vote-down answerVote">
                                                    <a class="question_vote_down vote_not_user" title="Dislike"><i class="fa fa-caret-down" aria-hidden="true"></i></a>
                                                </li>
                                            </ul> 
                                            
                                            </div>
                                        </div>
                                        
                                        <div class="question-content question-content-first d-inline-block d-md-none">
                                            <header class="article-header">
                                                <div class="question-header">
                                                    <a class="post-author" href="' . route('user.profile', ['id' => Auth::user()->id,'name'=>str_slug(Auth::user()->name)]) . '">' . Auth::user()->name . '</a>
                                                </div>
                                            </header>
                                        </div>
                                    </div>
                                    <div class="col-md-11">
                                        <div class="question-content question-content-first">
                                            <header class="article-header d-none d-md-block">
                                                <div class="question-header">
                                                    <a class="post-author" href="' . route('user.profile', ['id' => Auth::user()->id,'name'=>str_slug(Auth::user()->name)]) . '">' . Auth::user()->name . '</a>
                                                    <a href="" class="comment-date"> Added an answer on ' . timeAgo($awnswerTime) . ' </a>
                                                </div>
                                            </header>
                                        </div>
                                        <div class="question-content question-content-second">
                                            <div class="post-wrap-content">
                                                <div id="answer-description-' . $qaid . '" class="question-content-text comment">
                                                    ' . decodeContent($answerEditor) . '
                                                </div>
                                            </div>
                                            <div class="msg_error custom"></div>
                                            <span answerid="' . $qaid . '" class="reply-answer reply-comment">
                                                <i class="fa fa-share" aria-hidden="true"></i> Reply
                                            </span>
                                            <span answerid="' . $qaid . '" class="edit-reply-answer reply-comment">
                                                                                    <span class="ti-pencil"></span> Edit
                                                                                </span>
                                            <span answerid="' . $qaid . '" class="delete-answer reply-comment">
                                                                                    <span class="ti-trash"></span> Delete
                                                                                </span>
                                        </div>
                                        <div id="' . $qaid . '-answerReplyInput" class="main-comment reply d-none">
                                            <div class="form-group">
                                                <label>Your comment on this answer:</label>
                                                <textarea class="reply answer w-100" rows="5"></textarea>
                                            </div>  
                                            <div class="form-group">
                                                <button answerid="' . $qaid . '" class="addReplyAnswer btn btn-postcomment my-2">Add Comment</button>
                                                <button answerid="' . $qaid . '" class="cancelReplyAnswer btn btn-cancelcomment my-2">Cancel </button>
                                            </div>
                                        </div>
                                        <div class="comments">
                                            <ul id="' . $qaid . '-answerReplies"></ul>
                                        </div>
                                    </div>
                                </div>								
                            </div>
                        </article>';
                    DB::commit();
                    return response()->json([
                        'type' => 1,
                        'html' => $html
                    ]);
                } catch (\Exception $e) {
                    DB::rollback();
                    return response()->json([
                        'type' => 0,
                        'html' => $e->getMessage()
                    ]);
                }
            }
        }
    }

    public function get_ajax_user(Request $request)
    {
        if ($request->ajax()) {
            $limit = 20;
            if ($request->sort == 'name') {
                $order = 'name';
                $orderType = 'ASC';
            } elseif ($request->sort == 'new') {
                $order = 'id';
                $orderType = 'DESC';
            } elseif ($request->sort == 'votes') {
                $order = 'votes';
                $orderType = 'DESC';
            } else {
                $order = 'id';
                $orderType = 'ASC';
            }
            if ($request->text !== '') {
                if ($request->sort == 'mod') {
                    $data = User::where('status', 1)->where('role', 2)->where('name', 'LIKE', "%$request->text%")->orderBy($order, $orderType)->paginate($limit);
                } else {
                    $data = User::where('status', 1)->where('name', 'LIKE', "%$request->text%")->orderBy($order, $orderType)->paginate($limit);
                }
            } else {
                if ($request->sort == 'mod') {
                    $data = User::where('status', 1)->where('role', 2)->orderBy($order, $orderType)->paginate($limit);
                } else {
                    $data = User::where('status', 1)->orderBy($order, $orderType)->paginate($limit);
                }
            }
            $page = $request['page'];
            return view('partials.users', ['data' => $data, 'page' => $page])->render();
        }
    }

    public function get_ajax_cate(Request $request)
    {
        if ($request->ajax()) {
            $limit = 20;
            if ($request->sort == 'name') {
                $order = 'name';
                $orderType = 'ASC';
            } elseif ($request->sort == 'new') {
                $order = 'id';
                $orderType = 'DESC';
            } elseif ($request->sort == 'popular') {
                $order = 'question_count';
                $orderType = 'DESC';
            } else {
                $order = 'id';
                $orderType = 'ASC';
            }
            if ($request->text !== '') {
                $cate = Categories::where('status', 1)->where('name', 'LIKE', "%$request->text%")->withCount('question')->orderBy($order, $orderType)->paginate($limit);
            } else {
                $cate = Categories::where('status', 1)->withCount('question')->orderBy($order, $orderType)->paginate($limit);
            }
            $page = $request['page'];
            return view('partials.cate', ['cate' => $cate, 'page' => $page])->render();
        }
    }

    public function get_ajax_cate_question(Request $request)
    {
        if ($request->ajax()) {
            $limit = 20;
            if ($request->sort == 'name') {
                $order = 'title';
                $orderType = 'ASC';
            } elseif ($request->sort == 'new') {
                $order = 'id';
                $orderType = 'DESC';
            } elseif ($request->sort == 'popular') {
                $order = 'votes';
                $orderType = 'DESC';
            } else {
                $order = 'id';
                $orderType = 'DESC';
            }
            if ($request->text !== '') {
                if ($request->tags != '')
                    $data = Questions::where('status', 1)->where('tags', 'LIKE', "%$request->tags%")->where('title', 'LIKE', "%$request->text%")->with('User')->orderBy($order, $orderType)->paginate($limit);
                else
                    $data = Questions::where('status', 1)->where('title', 'LIKE', "%$request->text%")->with('User')->where('catid', $request->cate)->orderBy($order, $orderType)->paginate($limit);
            } else {
                if ($request->tags != '')
                    $data = Questions::where('status', 1)->with('User')->where('tags', 'LIKE', "%$request->tags%")->orderBy($order, $orderType)->paginate($limit);
                else
                    $data = Questions::where('status', 1)->with('User')->where('catid', $request->cate)->orderBy($order, $orderType)->paginate($limit);
            }
            $page = $request['page'];
            return view('partials.question', ['data' => $data, 'page' => $page])->render();
        }
    }

    public function getnotify(Request $request)
    {
        if ($request->ajax()) {
            if (Auth::check()) {
                $html = '';
                $data = Notifications::where('for', Auth::user()->id)->with('by')->with('schema')->with('reputation')->with('schema')->orderBy('id', 'DESC')->limit(3)->get();
                if (count($data) > 0) {
                    foreach ($data as $r) {
                        if ($r->schema->type == 'question') {
                            if (!isset($r->question->title)) {
                                $title = 'This question has been deleted';
                                $link = '#';
                            } else {
                                $title = $r->question->title;
                                $link = route('home.question', ['name' => $r->question->permalink]);
                            }
                            $html .= '<div class="dropdown-item-list">
                                        <a class="dropdown-item" href="' . $link . '">
                                            <div class="media media-card media--card shadow-none mb-0 rounded-0 align-items-center bg-transparent">
                                                <div class="media-body p-0 border-left-0">
                                                <small class="meta d-block lh-24">
                                                        <span>' . $r->schema->title . '</span> - ' . timeAgo($r->on) . '
                                                    </small>
                                               <h5 class="fs-14 fw-regular">' . $title . '</h5>     
                                                </div>
                                            </div>
                                        </a>
                                    </div>';
                        } elseif ($r->schema->type == 'badge') {
                            $badge_name = str_replace('(badgeName)', $r->badges->name, $r->schema->description);
                            $html .= '<div class="dropdown-item-list">
                                        <a class="dropdown-item" href="' . route('user.profile', ['id' => $r->for,'name'=>'view']) . '">
                                            <div class="media media-card media--card shadow-none mb-0 rounded-0 align-items-center bg-transparent">
                                                <div class="media-body p-0 border-left-0">
                                                <small class="meta d-block lh-24">
                                                        <span>' . $r->schema->title . '</span> - ' . timeAgo($r->on) . '
                                                    </small>
                                               <h5 class="fs-14 fw-regular">' . $badge_name . '</h5>
                                              </div>
                                              </div>
                                        </a>
                                    </div>';
                        } elseif ($r->schema->type == 'reputation') {
                            $html .= '<div class="dropdown-item-list">
                                        <a class="dropdown-item" href="' . route('user.profile', ['id' => $r->for,'name'=>'view']) . '">
                                            <div class="media media-card media--card shadow-none mb-0 rounded-0 align-items-center bg-transparent">
                                                <div class="media-body p-0 border-left-0">
                                               <small class="meta d-block lh-24">
                                                        <span>' . $r->schema->title . '</span> - ' . timeAgo($r->on) . '
                                                    </small>
                                               <h5 class="fs-14 fw-regular">' . str_replace('(reputation)', $r->reputation->reputation, $r->schema->description) . '</h5>
                                               </div>
                                            </div>
                                        </a>
                                    </div>';
                        }
                    }
                    $html .= '<a class="dropdown-item pb-1 border-bottom-0 text-center btn-text fw-regular"
                                       href="' . route('home.notifications') . '">View All Notifications <i
                                                class="fa fa-arrow-right icon ml-1"></i></a>';
                } else  $html = '<p class="px-3">No notifications found</p>';
            } else {
                $html = '<p class="px-3">No notifications found</p>';
            }
            return response()->json([
                'data' => $html
            ]);
        }
    }

    public function postImagesToEmbed(Request $request)
    {
        if ($request->ajax()) {
            if (!Auth::check()) {
                return response()->json([
                    'type' => 2,
                    'html' => 'Please login to continue'
                ]);
            }

            $setting = Setting::where('name','imgurClientId')->First();
            if(empty($setting['value'])){
                return response()->json([
                    'type' => 0,
                    'html' => 'There is some error in the configuration, Please try again later'
                ]);
            }
            if (isset($_FILES['image'])) {
                if ($_FILES['image']['error']==0) {
                    $client_id=$setting['value'];
                    $filetype = explode('/',mime_content_type($_FILES['image']['tmp_name']));
                    if ($filetype[0] !== 'image') {
                        die('Invalid image type');
                    }
                    $image = file_get_contents($_FILES['image']['tmp_name']);
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, 'https://api.imgur.com/3/image.json');
                    curl_setopt($ch, CURLOPT_POST, TRUE);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, array( "Authorization: Client-ID $client_id" ));
                    curl_setopt($ch, CURLOPT_POSTFIELDS, array( 'image' => base64_encode($image) ));
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                    $dataReturned = curl_exec($ch);
                    curl_close($ch);
                    $dataReturned = json_decode($dataReturned,true);
                    if (isset($dataReturned['data']))
                    {
                        $imgGet=$dataReturned['data'];
                        if(array_key_exists('link',$imgGet))
                        {
                            $imgCreate='<img src="'.$imgGet['link'].'"/>';
                            return response()->json([
                                'type' => 1,
                                'link' => $imgCreate,
                                'html' => 'Image was successfully uploaded'
                            ]);
                        } else {
                            return response()->json([
                                'type' => 0,
                                'html' => 'Unable to upload image as server is busy, Pleas try again later'
                            ]);
                        }
                    } else {
                        return response()->json([
                            'type' => 0,
                            'html' => 'Unable to upload image as server is busy, Pleas try again later'
                        ]);
                    }
                } else {
                    return response()->json([
                        'type' => 0,
                        'html' => 'This file is corrupted , Please chose another'
                    ]);
                }
            } else {
                return response()->json([
                    'type' => 0,
                    'html' => 'Please choose an image to upload'
                ]);
            }
        }
    }

    public function get_search(Request $request)
    {
        $questions = Questions::where('title', 'LIKE', "%$request->text%")->orderBy('id', 'desc')->paginate(20);
        if (count($questions) > 0) {
            $html = '<ul class="questions-drpdwn pl-0 mb-0">';
            foreach ($questions as $question) {
                $html .= '<li><a href="' . route('home.question', ['name' => $question->permalink]) . '">' . $question->title . '</a></li>';
            }
            $html .= '</ul>';
        } else {
            $html = '<ul class="questions-drpdwn pl-0 mb-0"><li class="not-found-search"><span><i class="fa fa-exclamation-triangle"></i></span> No Question found against your query!</li></ul>';
        }
        return response()->json([
            'status' => true,
            'html' => $html
        ]);
    }
}
