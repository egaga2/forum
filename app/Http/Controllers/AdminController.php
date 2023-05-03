<?php

namespace App\Http\Controllers;

use App\Answers;
use App\Categories;
use App\Home;
use App\News;
use App\Questions;
use App\ReportedAnswers;
use App\ReportedQuestions;
use App\Setting;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Intervention\Image\ImageManagerStatic as Image;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $totalq = Questions::count('id');
        $totala = Answers::count('id');
        $totalu = User::count('id');
        $totalc = Categories::count('id');
        $questions = Questions::orderBy('id', 'desc')->with('User')->limit(5)->get();
        $blog = News::orderBy('created_at', 'DESC')->First();
        $user = User::orderBy('on', 'DESC')->limit(36)->get();
        $answers = Answers::orderBy('id', 'desc')->with('User')->with('question')->limit(5)->get();
        $reportQ = ReportedQuestions::orderBy('id', 'desc')->with('schema')->with('question')->limit(5)->get();
        $reportA = ReportedAnswers::orderBy('id', 'desc')->with('schema')->with('answer')->limit(5)->get();
        return view('admin.admin', compact('totalc', 'reportQ', 'reportA', 'answers', 'blog', 'user', 'totalq', 'totalu', 'totala', 'questions'));
    }

    public function home()
    {
        // Retrieve settings
        $settings = Home::orderBy('id', 'ASC')->get();
        // Return view
        return view('admin.home')->with('settings', $settings);
    }

    public function update(Request $request)
    {
        foreach ($request->except(array('_token', '_method')) as $key => $value) {

            $value = addslashes($value);
            DB::update("update home set value = '$value' WHERE code = '$key'");
        }
        // Clear cache
        Cache::flush();
        // Redirect to settings page
        return redirect('admin/home')->with('success', 'Home site update successfully!');
    }
}
