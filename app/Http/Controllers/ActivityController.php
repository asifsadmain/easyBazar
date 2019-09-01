<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Advertisement;

class ActivityController extends Controller
{
    public function updateQuantity(Request $request, $id, $pid)
    {
        $product = Product::find($pid);
        $ad = Advertisement::find($id);
        if ($product->quantity > $request->get('qty')) {
            $ad->isSold++;
        }
        $product->quantity = $request->get('qty');
        $product->save();
        $ad->save();

        return redirect('/userDashboard/activities');
    }
}
