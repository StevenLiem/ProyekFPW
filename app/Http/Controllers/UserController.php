<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    public function addComment(Request $request){
        $comment = new Comment();
        $comment->id_user = Auth::user()->id;
        $comment->id_manga = $request->id;
        $comment->content = $request->comment;
        $comment->save();

        return response()->json(['success'=>'Comment Added']);
    }

    public function gotoProfile(){
        return view('profile');
    }

    public function updateProfile(Request $request){
        $validation = [
            'email' => 'required|email',
            'username' => 'required|alpha_dash|max:50',
            'password' => "required|confirmed",
            'password_confirmation' => "required"
        ];
        $this->validate($request, $validation);

        $user = Users::find($request->id);
        $result = $user->update([
            "email"=>$request->email,
            "username"=>$request->username,
            "password"=>Hash::make($request->password),
            "role"=>"user"
        ]);

        if ($result){
            return back()->with('msg', 'Update Success');
        }
    }
}
