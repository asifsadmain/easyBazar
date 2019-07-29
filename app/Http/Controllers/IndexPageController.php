<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;

class IndexPageController extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {
        return view('index', ['categories' => Category::all()]);
    }
}
