<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function thanks()
    {
        return view('/thanks');
    }

    // public function register()
    // {
    //     return view('/auth/verify-email');
    // }
}
