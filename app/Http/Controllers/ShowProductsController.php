<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Advertisement;
use App\Category;
use Illuminate\Support\Facades\DB;

class ShowProductsController extends Controller
{
    public function __construct()
    {

    }

    public function index($id)
    {
        $productsWithPrice = DB::table('products')
            ->join('advertisements', 'products.id', '=', 'advertisements.product_id')
            ->select('products.*', 'advertisements.proposed_price')
            ->where('products.category_id', $id)
            ->get();

        return view('showProducts', ['products' => $productsWithPrice, 'categories' => Category::all()]);
    }

    public function showSearchedProducts($name)
    {
        $productsWithPrice = DB::table('products')
            ->join('advertisements', 'products.id', '=', 'advertisements.product_id')
            ->select('products.*', 'advertisements.proposed_price')
            ->where('products.name', $name)
            ->get();

        return view('showProducts', ['products' => $productsWithPrice, 'categories' => Category::all()]);
    }
}
