<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
//     public function userProfile()
// {
//     $title = 'Profil Pengguna';
//     $user = auth()->user();
//     return view('profile', compact('user', 'title'));
// }

// public function adminProfile()
// {
//     $title = 'Profil Admin';
//     $admin = auth()->user();
//     return view('backend.profile.index', compact('admin', 'title'));
// }

}
