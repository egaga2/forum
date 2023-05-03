<?php

namespace App\Http\Controllers;

use App;
use Auth;
use App\Ad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Storage;
use App\Categories;

class CategoriesController extends Controller
{

    /** Create a new controller instance. */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**  Display a listing of the resource. */
    public function index()
    {
        // List of pages
        $pages = Categories::orderBy('id', 'ASC')->paginate(20);
        // Return view
        return view('categories.index', compact('pages'));
    }

    public function getcate(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->id;
            $type = $request->type;
            if ($type == 'all') {
                $cate = Categories::Where('id', $id)->First();
                return response()->json($cate);
            } elseif ($type == 'slug') {
                $slug = Str::slug($id);
                if (empty($slug))
                    $slug = str_slug($id);
                return response()->json(['slug' => $slug]);
            }
        }
    }

    public function addcate(Request $request)
    {
        if ($request->ajax()) {
            if ($request->type == 'edit') {
                if(Auth::user()->email == 'demo@gmail.com'){
                    return response()->json([
                        'status' => false,
                        'message' => 'Demo acount only view.'
                    ]);
                }
                $id = $request->id;
                if (empty($request->get('name'))) {
                    return response()->json([
                        'status' => false,
                        'message' => 'The name field is required.'
                    ]);
                }
                if (empty($request->get('description'))) {
                    return response()->json([
                        'status' => false,
                        'message' => 'The description field is required.'
                    ]);
                }
                if (empty($request->get('permalink'))) {
                    return response()->json([
                        'status' => false,
                        'message' => 'The permalink field is required.'
                    ]);
                } elseif (!empty($request->get('permalink'))) {
                    $cate = Categories::where('permalink', $request->get('permalink'))->where('id', '!=', $id)->count();
                    if ($cate > 0)
                        return response()->json([
                            'status' => false,
                            'message' => 'This permalink is already used, please use another permalink.'
                        ]);
                }
                $page = Categories::Where('id', $id)->update(['name' => $request->get('name'), 'description' => $request->get('description')]);
                $mess = 'update category ' . $request->get('name') . ' successful';
            } elseif ($request->type == 'add') {
                if(Auth::user()->email == 'demo@gmail.com'){
                    return response()->json([
                        'status' => false,
                        'message' => 'Demo acount only view.'
                    ]);
                }
                if (empty($request->get('name'))) {
                    return response()->json([
                        'status' => false,
                        'message' => 'The name field is required.'
                    ]);
                }
                if (empty($request->get('description'))) {
                    return response()->json([
                        'status' => false,
                        'message' => 'The description field is required.'
                    ]);
                }
                if (empty($request->get('permalink'))) {
                    return response()->json([
                        'status' => false,
                        'message' => 'The permalink field is required.'
                    ]);
                } elseif (!empty($request->get('permalink'))) {
                    $cate = Categories::where('permalink', $request->get('permalink'))->count();
                    if ($cate > 0)
                        return response()->json([
                            'status' => false,
                            'message' => 'This permalink is already used, please use another permalink.'
                        ]);
                }
                $page = new Categories;
                $page->name = $request->get('name');
                $page->description = $request->get('description');
                $page->permalink = $request->get('permalink');
                $page->status = 1;
                $page->save();
                $mess = 'Add category ' . $request->get('name') . ' successful';
            }
            // Clear cache
            return response()->json([
                'status' => $page,
                'message' => $mess
            ]);
        }
    }

    /**  Show the form for creating a new resource. */
    public function create()
    {
        // Return view
        return view('categories.create');
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

    public function show()
    {
    }

    /** Remove the specified resource from storage. */
    public function destroy(Request $request)
    {
        if(Auth::user()->email == 'demo@gmail.com'){
            return response()->json([
                'status' => false,
                'message' => 'Demo acount only view.'
            ]);
        }
        if ($request->ajax()) {
            $id = $request->id;
            $page = Categories::Where('id', $id)->delete();
            // Clear cache
            Cache::flush();
            // Redirect to list of translations
            //return redirect()->route('translations.index')->with('success', 'Delete  '.$translate->language .' Successful');
            return response()->json([
                'status' => true,
                'message' => 'Delete category Successful!'
            ]);
        }
    }
}
