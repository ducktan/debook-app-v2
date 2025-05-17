<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    ////
    public function index()
    {
        return view('pages.admin.dashboard');
    }
    public function users()
    {
        $users = User::latest()->paginate(10);
        return view('pages.admin.userSetting', compact('users'));
    }

}
