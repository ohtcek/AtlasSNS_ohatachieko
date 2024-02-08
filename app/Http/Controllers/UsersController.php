<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    //
    public function profile(Request $request)
    {
        return view('users.profile');
    }
    public function search(Request $request)
    {
        return view('users.search');
    }

    public function index(Request $request)
    {
        return view('users.search');
    }
}
