<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashbaordController extends Controller
{
    public function index(){
        return view('pages.dashboard');
    }

    public function landing(){
        return view('pages.dashbpard_home');
    }
}
