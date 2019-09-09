<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Advertisement;
use App\User;
use App\Category;
use App\Message;
use Illuminate\Support\Facades\DB;
use Auth;

class ShowAdController extends Controller
{
    public function __construct()
    {

    }

    public function index($id)
    {
        $ifRequested = array();
        if (auth()->user()) {
            $ifRequested = DB::table('requests')
                ->where('user_id', auth()->user()->id)
                ->where('product_id', $id)
                ->get();
        }

        $advertisementDetails = DB::table('advertisements')
            ->join('products', 'advertisements.product_id', '=', 'products.id')
            ->join('users', 'advertisements.user_id', '=', 'users.id')
            ->select('advertisements.*', 'products.*', 'products.name as product_name', 'users.*', 'users.name as user_name')
            ->where('advertisements.product_id', $id)
            ->get();

        return view('showAd', ['advertisements' => $advertisementDetails, 'ifRequested' => $ifRequested, 'categories' => Category::all()]);
    }

    public function sendMessage(Request $request, $id)
    {
        $message = new Message;

        $message->from = Auth::user()->id;
        $message->to = $id;
        $message->text = $request->input('text');

        $message->save();

        return redirect("/conversations");
    }
}
