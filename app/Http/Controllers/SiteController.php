<?php

namespace App\Http\Controllers;

use App\Models\Manga;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class SiteController extends Controller
{
    //
    public function search(Request $request)
    {
        Session::forget('search');
        $manga_list = Manga::where('title', 'LIKE', "%$request->title%")->get();
        Session::put('search', $request->title);
        return view('home', ['manga_list'=>$manga_list]);
    }
    public function gotoDetail(Request $request)
    {
        Session::forget('search');
        $manga = Manga::find($request->id);
        return view('detail', ['manga'=>$manga]);
    }
    public function gotoHome(Request $request){
        Session::forget('search');
        $manga_list = Manga::all();
        return view('home',['manga_list'=>$manga_list]);
    }

    public function gotoLogin(){
        return view('login');
    }

    public function doLogin(Request $request){
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)){
            if (Auth::user()->status == "banned"){
                Auth::logout();
                return redirect('login')->with('error', 'your account is banned');
            }

            if (Auth::user()->role == "admin"){
                return redirect()->route('master');
            }
            else{
                return redirect('');
            }
        }
        else{
            return redirect('login')->with('error', 'something wrong i can feel it');
        }
    }

    public function gotoRegister(){
        return view('register');
    }

    public function doRegister(Request $request){
        $validation = [
            'email' => 'required|email|unique:users',
            'username' => 'required|unique:users|alpha_dash|max:50',
            'password' => "required|confirmed",
            'password_confirmation' => "required"
        ];
        $this->validate($request, $validation);

        $result = Users::create([
            "email"=>$request->email,
            "username"=>$request->username,
            "password"=>Hash::make($request->password),
            "role"=>"user"
        ]);

        if ($result){
            return back()->with('msg', 'Registration Success');
        }
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
