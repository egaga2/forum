<?php

namespace App\Http\Controllers;

use File;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Validator, Redirect, Response;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Session;

class AuthController extends Controller
{
    public function postLogin(Request $request)
    {
        request()->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            // Authentication passed...
            if (Auth::User()->status != 1) {
                Auth::guard('web')->logout();
                return response()->json([
                    'status' => false,
                    'message' => 'Account not activated'
                ]);
            }
            //return redirect()->intended('/');
            return response()->json([
                'status' => true,
                'message' => 'These credentials do not match our records.'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'These credentials do not match our records.'
            ]);
        }
    }

    public function postRegister(Request $request)
    {
        request()->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ]);

        $data = $request->all();
        $check = $this->create($data);
        return Redirect::to("/");
    }

    public function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
            $finduser = User::where('google_id', $user->id)->first();
            if ($finduser) {
                Auth::login($finduser);
                return redirect('/');
            } else {
                $genfileName = NULL;
                if (isset($user->avatar)) {
                    $genfileName = "profilePic_" . $user->id . ".png";
                    $path = public_path() . '/uploads/users/' . $genfileName;
                    $fileContents = file_get_contents($user->avatar);
                    File::put($path, $fileContents);
                }
                $newUser = User::create(['name' => $user->name, 'email' => $user->email, 'google_id' => $user->id, 'image' => $genfileName, 'password' => Hash::make($user->id)]);
                Auth::login($newUser);
                return redirect('/');
            }
        } catch (Exception $e) {
            return redirect('/google');
        }
    }
    public function handleFacebookCallback()
    {
        try {
            $user = Socialite::driver('facebook')->user();
            $finduser = User::where('facebook_id', $user->id)->first();
            if ($finduser) {
                Auth::login($finduser);
                return redirect('/');
            } else {
                $genfileName = NULL;
                if (isset($user->avatar)) {
                    $genfileName = "profilePic_" . $user->id . ".png";
                    $path = public_path() . '/uploads/users/' . $genfileName;
                    $fileContents = file_get_contents($user->avatar);
                    File::put($path, $fileContents);
                }
                $newUser = User::create(['name' => $user->name, 'email' => $user->email, 'google_id' => $user->id, 'image' => $genfileName, 'password' => Hash::make($user->id)]);
                Auth::login($newUser);
                return redirect('/');
            }
        } catch (Exception $e) {
            return redirect('/facebook');
        }
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return Redirect('/');
    }
}
