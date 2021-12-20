<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
            'email' => 'required|email|unique:users,email,'.Auth::user()->id,
            'username' => 'required|alpha_dash|max:50|unique:users,username,'.Auth::user()->id,
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

    public function addFavorite(Request $request){
        $result = DB::connection('conn_proyek')
                ->table('user_favorite')
                ->where('id_user', Auth::user()->id)
                ->where('id_manga', $request->id)->first();

        if($result == null){
            DB::connection('conn_proyek')->table('user_favorite')->insert([
                "id_user"=>Auth::user()->id,
                "id_manga"=>$request->id
            ]);
            return response()->json(['success'=>'Fav Added']);
        }
        else{
            DB::connection("conn_proyek")->table('user_favorite')
                ->where('id_user','=',Auth::user()->id)
                ->where('id_manga','=',$request->id)
                ->delete();
            return response()->json(['success'=>'Fav Removed']);
        }
    }

    public function gotoFavorite(){
        return view('favorite');
    }
}
