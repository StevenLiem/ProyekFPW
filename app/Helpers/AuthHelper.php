<?php

use Illuminate\Support\Facades\Auth;

function loggedIn()
{
    if (Auth::check()){
        return true;
    }
    else{
        return false;
    }
}
