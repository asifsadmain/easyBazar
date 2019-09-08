<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Product;
use App\Notifications\RequestSeller;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\DB;

class NotificationController extends Controller
{
    public function requestSeller($uid, $pid)
    {
        $seller = User::find($uid);
        $product = Product::find($pid);

        DB::table('requests')->insert(
            ['user_id' => auth()->user()->id, 'product_id' => $pid]
        );

        $details = [
            'seller_id' => $uid,
            'product_id' => $pid,
            'product_name' => $product->name
        ];

        $seller->notify(new RequestSeller($details));

        return redirect("/advertisements/$pid");
    }
}
