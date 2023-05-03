<?php

namespace App\Http\Controllers;

use App\Ad;
use App\Answers;
use App\AwardedBadges;
use App\AwnserReplies;
use App\Badges;
use App\Categories;
use App\EditedQuestionsList;
use App\Home;
use App\News;
use App\Notifications;
use App\Page;
use App\Questions;
use App\QuestionSchema;
use App\QuestionsReplies;
use App\ReportedQuestions;
use App\ReportSchema;
use App\Setting;
use App\User;
use App\VotedAnswers;
use App\VotedQReplies;
use App\VotedQuestions;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use File;

class HomeController extends Controller
{
    public function __construct()
    {
        if (!file_exists(storage_path('installed'))) {
            redirect('/install')->send();
        }
        $pages = Page::orderBy('sort', 'ASC')->limit(4)->get();
        if (count($pages) <= 0) {
            $pages = Page::where('local', 'en')->orderBy('sort', 'ASC')->get();
        }
        $ads = Ad::orderBy('title', 'asc')->get();
        $ad = [];
        $site = Setting::orderBy('id', 'desc')->get();
        foreach ($site as $setting) {
            $setting_data[$setting->name] = $setting->value;
        }
        foreach ($ads as $r) {
            $ad[$r->title] = $r->code;
        }
        View::share(['pages' => $pages, 'ad' => $ad, 'site' => $setting_data]);
    }

    public function index()
    {
        $home = Home::orderBy('id', 'ASC')->get();
        foreach ($home as $r) {
            $home_data[$r->code] = $r->value;
        }
        $question = Questions::where('status', 1)->with('User')->orderBy('votes', 'DESC')->limit(3)->get();
        $blog = News::orderBy('created_at', 'DESC')->limit(3)->get();
        return view('home.index', ['home' => $home_data, 'question' => $question, 'blog' => $blog]);
    }

    public function questions()
    {
        $q_count = Questions::where('status', 1)->count();
        return view('home.questions', ['q_count' => $q_count]);
    }

    public function blogs()
    {
        $data = News::paginate(18);
        return view('home.blogs', ['data' => $data]);
    }

    public function blogsDetail($name)
    {
        $blog = News::where('slug', $name)->First();
        if ($blog == null) {
            return view('home.error');
        }
        $other = News::where('id', '!=', $blog['id'])->orderBy('id', 'DESC')->limit('3')->get();
        return view('home.blogDetail', ['data' => $blog, 'other' => $other]);
    }

    public function question_ask()
    {
        $cate = Categories::where('status', 1)->pluck('name', 'id');
        return view('home.ask', ['cate' => $cate]);
    }

    public function question_edit($id)
    {
        $cate = Categories::where('status', 1)->pluck('name', 'id');
        $question = Questions::where('id', $id)->First();
        if (Auth::check() && (Auth::user()->role == 2 || Auth::user()->id == $question->userid)) {
            return view('home.qedit', ['cate' => $cate, 'question' => $question]);
        } else {
            return redirect()->back();
        }
    }

    public function question($name)
    {
        $question = Questions::where('permalink', $name)->with('User')->First();
        if ($question == null) {
            return view('home.error');
        }
        if ($question['status'] == 2) {
            return view('home.error');
        } elseif ($question['status'] == 0) {
            if (Auth::check()) {
                if (Auth::user()->role == 1 && $question['userid'] != Auth::user()->id) {
                    return view('home.error');
                }
            } else {
                return redirect('/')->with(['login' => 'show']);
            }
        }
        $view_key = 'question_view_' . $question['id'];
        if (!Session::has($view_key)) {
            Questions::find($question->id)->increment('views');
            Session::put($view_key, 1);
        }
        $vote = 3;
        if (Auth::check()) {
            $voted = VotedQuestions::select('val')->where('qid', $question->id)->where('by', Auth::user()->id)->First();
            if (isset($voted['val']))
                $vote = $voted['val'];
        }
        $cate = Categories::where('id', $question->catid)->First();
        $reply = QuestionsReplies::where('qid', $question->id)->with('User')->orderBy('on', 'desc')->limit('5')->get();
        $replyId = QuestionsReplies::where('qid', $question->id)->pluck('id');
        $replyCount = QuestionsReplies::where('qid', $question->id)->count();
        $votedQReplies = VotedQReplies::wherein('qrid', $replyId)->pluck('id');
        $edit = EditedQuestionsList::where('qid', $question->id)->with('User')->First();
        //$recentBadges = AwardedBadges::where('userid', $question->userid)->with('badges')->orderBy('badgeId', 'DESC')->First();
        $reportSchema = ReportSchema::get();
        $recentBadges = DB::table('awardedBadges')
            ->select('badges.name', 'awardedBadges.userid')
            ->join('badges', 'badges.id', '=', 'awardedBadges.badgeId')
            ->where('awardedBadges.userid', $question->userid)
            ->orderByDesc('badges.value')
            ->First();
        if (Auth::check())
            $countReport = ReportedQuestions::where('qid', $question->id)->where('userid', Auth::user()->id)->count();
        else
            $countReport = 0;
        return view('home.question', ['question' => $question, 'countReport' => $countReport, 'recentBadges' => $recentBadges, 'reportSchema' => $reportSchema, 'vote' => $vote, 'cate' => $cate, 'reply' => $reply, 'replyCount' => $replyCount, 'votedQReplies' => $votedQReplies, 'edit' => $edit]);
    }

    public function page($slug)
    {
        $allpage = Page::orderBy('sort', 'ASC')->get();
        $page = Page::where('slug', $slug)->first();
        if ($page == null) {
            return view('home.error');
        }
        return view('home.page', ['page' => $page, 'allpage' => $allpage]);
    }

    public function badges(Request $request)
    {
        if ($request->sort) {
            if ($request->sort == 'bronze') {
                $data = Badges::where('priority', 3)->get();
            } elseif ($request->sort == 'gold') {
                $data = Badges::where('priority', 1)->get();
            } elseif ($request->sort == 'silver') {
                $data = Badges::where('priority', 2)->get();
            } else {
                $data = Badges::get();
            }

        } else {
            $data = Badges::get();
        }
        return view('home.badges', ['badges' => $data]);
    }

    public function category()
    {
        $limit = 20;
        $page = 1;
        $cate = Categories::where('status', 1)->withCount('question')->orderBy('id', 'ASC')->paginate($limit);
        return view('home.categories', ['cate' => $cate, 'page' => $page]);
    }

    public function listUsers()
    {
        $limit = 20;
        $page = 1;
        $data = User::where('status', 1)->orderBy('id', 'ASC')->paginate($limit);
        return view('home.users', ['data' => $data, 'page' => $page]);
    }

    public function categories($cat)
    {
        $limit = 20;
        $page = request()->get('page', 1);
        $cate = Categories::where('permalink', $cat)->where('status', 1)->first();
        if ($cate == null) {
            return view('home.error');
        }
        $data = Questions::where('status', 1)->with('User')->where('catid', $cate->id)->orderBy('id', 'DESC')->paginate($limit);
        return view('home.category', ['data' => $data, 'cate' => $cate, 'title' => $cate->title, 'page' => $page]);
    }

    public function tags($tag)
    {
        $limit = 20;
        $page = request()->get('page', 1);
        $data = Questions::where('status', 1)->with('User')->where('tags', 'LIKE', "%$tag%")->orderBy('id', 'DESC')->paginate($limit);
        return view('home.tags', ['data' => $data, 'title' => $tag, 'page' => $page]);
    }

    public function notifications()
    {
        $data = Notifications::where('for', Auth::user()->id)->with('by')->with('schema')->with('reputation')->with('schema')->paginate(25);
        return view('home.notifications', ['data' => $data]);
    }

    public function profile($id,$name)
    {
        $data = User::where('id', $id)->with('answers')->with('question')->First();
        if ($data == null) {
            return view('home.error');
        }
        $cate = DB::table('questions')
            ->select(DB::raw('sum(votes) as totalVotes'), DB::raw('count(*) as totalPosts'), 'categories.name as categoryName', 'categories.permalink as catperma')
            ->join('categories', 'categories.id', '=', 'questions.catid')
            ->where('questions.userid', $id)
            ->where('questions.status', 1)
            ->orderByDesc('totalVotes')
            ->limit(6)
            ->groupBy('questions.catid')
            ->get();
        $gold = DB::table('awardedBadges')
            ->select('awardedBadges.on', 'badges.name', 'badges.priority')
            ->join('badges', 'badges.id', '=', 'awardedBadges.badgeId')
            ->where('awardedBadges.userid', $id)
            ->where('badges.priority', 1)
            ->orderByDesc('awardedBadges.id')
            ->limit(3)
            ->get();
        $sliver = DB::table('awardedBadges')
            ->select('awardedBadges.on', 'badges.name', 'badges.priority')
            ->join('badges', 'badges.id', '=', 'awardedBadges.badgeId')
            ->where('awardedBadges.userid', $id)
            ->where('badges.priority', 2)
            ->orderByDesc('awardedBadges.id')
            ->limit(3)
            ->get();
        $bronze = DB::table('awardedBadges')
            ->select('awardedBadges.on', 'badges.name', 'badges.priority')
            ->join('badges', 'badges.id', '=', 'awardedBadges.badgeId')
            ->where('awardedBadges.userid', $id)
            ->where('badges.priority', 3)
            ->orderByDesc('awardedBadges.id')
            ->limit(3)
            ->get();
        $view_key = 'profile_view_' . $id;
        if (!Session::has($view_key)) {
            User::find($id)->increment('views');
            if (Auth::check()) {
                User::find($id)->increment('peopleReached');
            }
            Session::put($view_key, 1);
        }
        return view('home.profile', ['data' => $data, 'cate' => $cate, 'gold' => $gold, 'sliver' => $sliver, 'bronze' => $bronze]);
    }

    public function profile_edit($id)
    {
        $data = User::where('id', $id)->with('answers')->with('question')->First();
        return view('home.editprofile', ['data' => $data]);
    }

    public function deletenotify(Request $request)
    {
        if ($request->ajax()) {
            if(Auth::user()->email == 'demo@gmail.com'){
                return response()->json([
                    'status' => false,
                    'message' => 'Demo acount only view.'
                ]);
            }
            if (!Auth::check()) {
                return response()->json([
                    'type' => 2,
                    'html' => 'Please login to continue.'
                ]);
            }
            $id = $request->id;
            $t = Notifications::where('id', $id)->where('for', Auth::user()->id)->delete();
            if ($t)
                return response()->json([
                    'type' => 1,
                    'html' => 'Notification was successfully deleted'
                ]);
            else
                return response()->json([
                    'type' => 0,
                    'html' => 'An error occurred, please try again'
                ]);
        }
    }
}
