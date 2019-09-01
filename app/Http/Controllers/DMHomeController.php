<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DMHomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('dm');
    }

    public function index()
    {
        return view('dm.home');
    }
}
