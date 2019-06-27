<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function submit(Request $request)
    {
        $category = new Category;
        $category->name = $request->input('category');
        
        $category->save();

        return redirect('/welcome');
    }
}
