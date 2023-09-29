<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostsController extends Controller
{
    //

    public function index(Request $request)
    {
        return view('layouts.login');
    }


    public function profile(Request $request)
    {
        return view('users.profile');
    }

    public function logout(Request $request)
    {
        if (Auth::logout()) {
            return redirect('auth.login');
        }
    }
}
