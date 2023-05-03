<?php

namespace App\Http\Controllers;

use App;
use App\Application;
use App\Page;
use App\Translation;
use Auth;
use Hash;
use App\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Intervention\Image\ImageManagerStatic as Image;
use Storage;
use App\Sitemap;

class SettingController extends Controller
{

    /** Create a new controller instance. */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**  Display a listing of the resource. */
    public function index()
    {
        // Retrieve settings
        $settings = Setting::orderBy('id', 'desc')->get();
        // Return view
        return view('settings.site')->with('settings', $settings);
    }

    public function accountsettingsform()
    {
        return view('settings.account');
    }

    public function genSitemap()
    {
        return view('settings.sitemap');
    }

    public function accountsettings(Request $request)
    {
        if(Auth::user()->email == 'demo@gmail.com'){
            return redirect()->back()->with("error", 'Demo acount only view.');
        }
        if ($request->get('email') != Auth::user()->email) {
            if ((Hash::check($request->get('current-password'), Auth::user()->password))) {
                //Change E-mail
                $user = Auth::user();
                $user->email = $request->get('email');
                $user->save();
                return redirect()->back()->with("success", 'E-mail changed successfully!');
            }
        }

        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error", 'Your current password does not matches with the password you provided. Please try again.');
        }

        if (strcmp($request->get('current-password'), $request->get('new-password')) == 0) {
            //Current password and new password are same
            return redirect()->back()->with("error", 'New Password cannot be same as your current password. Please choose a different password.');
        }

        $validatedData = $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|string|min:6|confirmed',
        ]);

        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();
        return redirect()->back()->with("success", 'Password changed successfully!');
    }

    /**  Update the specified resource in storage. */
    public function update(Request $request)
    {
        if(Auth::user()->email == 'demo@gmail.com'){
            return redirect()->back()->with("error", 'Demo acount only view.');
        }
        foreach ($request->except(array('_token', '_method')) as $key => $value) {

            $value = addslashes($value);

            // Update settings
            DB::update("update settings set value = '$value' WHERE name = '$key'");
            // Check if the default share image has been uploaded
            if ($request->hasFile('logo')) {
                $image = $request->file('logo');
                $filename = 'logo.png';
                $location = public_path('/theme/images/' . $filename);
                Image::make($image)->resize(292, 44)->save($location);
            }

            // Check if the default share image has been uploaded
            if ($request->hasFile('favicon')) {
                $image = $request->file('favicon');
                $filename = 'favicon.png';
                $location = public_path('/theme/images/' . $filename);
                Image::make($image)->resize(80, 80)->save($location);
            }
        }
        // Clear cache
        Cache::flush();
        // Redirect to settings page
        return redirect('admin/settings')->with('success', 'Settings site update successfully!');
    }

    public function siteMap()
    {
        ini_set('memory_limit', -1);
        $cate = App\Categories::get();
        $domain = url('/');
        $root_path = base_path();
        $sitemap = new Sitemap($domain, $root_path . '/sitemaps/');
        $sitemap->addItem('/', '1.0', 'daily', 'Today');

        foreach ($cate as $r) {
            $sitemap->addItem('/categories/' . $r->permalink, '0.8', 'monthly', $r->on);
        }
        $pages = Page::orderBy('sort', 'ASC')->get();
        foreach ($pages as $r) {
            $sitemap->addItem('/page/' . $r->slug, '0.8', 'monthly', $r->updated_at);
        }
        $questions = App\Questions::select('id', 'permalink', 'on')->get();
        foreach ($questions as $r) {
            $sitemap->addItem( '/question/' . ($r->permalink), '0.8', 'monthly', $r->on);
        }
        $sitemap->createSitemapIndex($domain . '/sitemaps' . "/", 'Today');
        echo 'Done';
    }

}
