<?php

namespace App\Http\Controllers;

use App\Classes;
use App\Userclass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $user = Auth::user();
        $classes = Userclass::where('user_id', $user->id)->get();
        return view('home')->with('classes', $classes);
    }

}
