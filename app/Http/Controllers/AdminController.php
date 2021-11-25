<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    function gotoAdmin(){
        return view('admin.adminHome');
    }
}
