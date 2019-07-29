<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Advertisement;
use App\Product;
use App\Items;
use App\Category;
use Illuminate\Support\Facades\DB;

class profileController extends Controller
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
        $profile = User::where('id', '=', auth()->id())->first();
        $adds = Advertisement::join('products', 'products.id', '=', 'advertisements.product_id')
            ->where('user_id', '=', auth()->id())->get();
        $currentMonth = date('m');
        $count = 0;
        // foreach ($adds as $key) {
        //     $mydate = $key . created_at;
        //     $month = date("m", strtotime($mydate));
        //     if ($currentMonth == $month) {
        //         $count++;
        //     }
        // }
        return view('profile', ['profile_full' => $profile, 'adds' => $adds, 'count' => $count]);
    }

    public function editAd($id)
    {
        $adDetails = DB::table('advertisements')
            ->join('products', 'advertisements.product_id', '=', 'products.id')
            ->select('advertisements.*', 'products.*', 'products.id as product_id')
            ->where('advertisements.product_id', $id)
            ->get();

        return view('editAd', ['advertisements' => $adDetails, 'categories' => Category::all()]);
    }
}
