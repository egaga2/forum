<?php

namespace App\Http\Controllers;

use App;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Input;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\File;
use Storage;
use Auth;

class UsersController extends Controller
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
        $apps = User::orderBy('id', 'desc')->paginate($limit);
        return view('users.index', compact('apps', 'page'));
    }

    public function get_ajax(Request $request)
    {
        if ($request->ajax()) {
            $limit = $this->limit;
            if ($request->text !== '') {
                $apps = User::where('name', 'LIKE', "%$request->text%")->orwhere('email', 'LIKE', "%$request->text%")->orderBy('id', 'desc')->paginate($limit);
            } else {
                $apps = User::orderBy('id', 'desc')->paginate($limit);
            }
            $page = ($request['page'] - 1) * $limit;
            return view('users.data', compact('apps', 'page'))->render();
        }
    }


    /**  Show the form for creating a new resource. */
    public function create()
    {

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
    public function update(Request $request)
    {
    }

    public function updateuser(Request $request)
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
            User::where('id', $id)->update([$type => $val]);
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
            User::where('id', $id)->delete();
            // Clear cache
            Cache::flush();
            return response()->json([
                'status' => true,
                'message' => 'User deleted successfully!'
            ]);
        }
    }
}
