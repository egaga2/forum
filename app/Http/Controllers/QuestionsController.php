<?php

namespace App\Http\Controllers;

use App\Answers;
use App\AwnserReplies;
use App\Questions;
use App\QuestionsReplies;
use App\VotedQuestions;
use Auth;
use App;
use App\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\ReportedQuestions;
use App\ReportedAnswers;
use function Symfony\Component\Translation\t;

class QuestionsController extends Controller
{
    private $limit;

    /** Create a new controller instance. */
    public function __construct()
    {
        $this->limit = 60;
        $this->middleware('auth:admin');
    }

    /**  Display a listing of the resource. */
    public function index()
    {
        $limit = $this->limit;
        $page = 0;
        $apps = Questions::orderBy('id', 'desc')->paginate($limit);
        return view('question.index', compact('apps', 'page'));
    }

    public function reportQ()
    {
        $data = ReportedQuestions::with('schema')->with('user')->with('question')->orderBy('id', 'DESC')->paginate(20);;
        // Return view
        return view('question.reportQ', compact('data'));
    }

    public function reportA()
    {
        $data = ReportedAnswers::with('schema')->with('user')->with('answer')->orderBy('id', 'DESC')->paginate(20);;
        // Return view
        return view('question.reportA', compact('data'));
    }

    public function postReport(Request $request)
    {
        if ($request->ajax()) {
            if(Auth::user()->email == 'demo@gmail.com'){
                return response()->json([
                    'status' => false,
                    'message' => 'Demo acount only view.'
                ]);
            }
            if ($request->type == 'question') {
                $qid = $request->id;
                $question = Questions::where('id', $qid)->count();
                if ($question == 0) {
                    return response()->json([
                        'status' => false,
                        'message' => 'Invalid question being tried to deleted'
                    ]);
                } else {
                    DB::beginTransaction();
                    try {
                        Questions::where('id', $qid)->delete();
                        Answers::where('qid', $qid)->delete();
                        AwnserReplies::where('qid', $qid)->delete();
                        QuestionsReplies::where('qid', $qid)->delete();
                        ReportedQuestions::where('qid', $qid)->delete();
                        DB::commit();
                        return response()->json([
                            'status' => true,
                            'message' => 'Delete question successful!'
                        ]);
                    } catch (\Exception $e) {
                        DB::rollback();
                        return response()->json([
                            'status' => false,
                            'message' => $e->getMessage()
                        ]);
                    }
                }
            } elseif($request->type =='report') {
                $data = ReportedQuestions::where('id', $request->id)->delete();
                return response()->json([
                    'status' => $data,
                    'message' => 'Delete report question successful!'
                ]);
            }elseif($request->type =='answer') {

                $data = Answers::where('id', $request->id)->delete();
                AwnserReplies::where('qaid', $request->id)->delete();
                ReportedAnswers::where('qaid', $request->id)->delete();
                return response()->json([
                    'status' => $data,
                    'message' => 'Delete report answer successful!'
                ]);
            }elseif($request->type =='reportA') {
                $data = ReportedAnswers::where('id', $request->id)->delete();
                return response()->json([
                    'status' => $data,
                    'message' => 'Delete report answer successful!'
                ]);
            }
        }
    }

    public function get_ajax_data(Request $request)
    {
        if ($request->ajax()) {
            $limit = $this->limit;
            if ($request->text !== '') {
                $apps = Questions::where('title', 'LIKE', "%$request->text%")->orderBy('id', 'desc')->paginate($limit);
            } else {
                $apps = Questions::orderBy('id', 'desc')->paginate($limit);
            }
            $page = ($request['page'] - 1) * $limit;
            return view('question.data', compact('apps', 'page'))->render();
        }
    }

    public function create()
    {
        // Return view

    }

    /**  Store a newly created resource in storage. */
    public function store(Request $request)
    {
    }

    /** Show the form for editing the specified resource. */
    public function edit($id)
    {

    }

    /**  Update the specified resource in storage. */
    public function update(Request $request, $id)
    {
    }

    public function show($id)
    {
    }

    public function updatequestion(Request $request)
    {
        if ($request->ajax()) {
            if(Auth::user()->email == 'demo@gmail.com'){
                return response()->json([
                    'status' => false,
                    'message' => 'Demo acount only view.'
                ]);
            }
            $id = $request->id;
            $type = $request->type;
            $val = $request->val;
            Questions::where('id', $id)->update([$type => $val]);
            // Clear cache
            Cache::flush();
            return response()->json([
                'status' => true,
                'message' => 'User deleted successfully!'
            ]);
        }
    }

    /** Remove the specified resource from storage. */
    public function destroy(Request $request)
    {
        if ($request->ajax()) {
            if(Auth::user()->email == 'demo@gmail.com'){
                return response()->json([
                    'status' => false,
                    'message' => 'Demo acount only view.'
                ]);
            }
            $id = $request->id;
            Questions::where('id', $id)->delete();
            Answers::where('qid', $id)->delete();
            AwnserReplies::where('qid', $id)->delete();
            QuestionsReplies::where('qid', $id)->delete();
            VotedQuestions::where('qid', $id)->delete();
            // Clear cache
            Cache::flush();
            return response()->json([
                'status' => true,
                'message' => 'User deleted successfully!'
            ]);
        }
    }

}
