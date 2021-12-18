<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
}
