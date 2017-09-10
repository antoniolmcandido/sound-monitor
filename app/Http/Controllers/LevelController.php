<?php

namespace App\Http\Controllers;

class LevelController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        return view('level/index');
    }    
}
