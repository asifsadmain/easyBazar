<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Product;
use App\Notifications\RequestSeller;
use App\Notifications\ConfirmOrder;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\DB;

class NotificationController extends Controller
{
    public function requestSeller($uid, $pid)
    {
        $seller = User::find($uid);
        $product = Product::find($pid);

        DB::table('requests')->insert(
            ['user_id' => auth()->user()->id, 'product_id' => $pid, 'product_owner_id' => $uid]
        );

        $order_id = DB::getPdo()->lastInsertId();;

        $details = [
            'seller_id' => $uid,
            'product_id' => $pid,
            'product_name' => $product->name,
            'order_id' => $order_id
        ];

        $seller->notify(new RequestSeller($details));

        return redirect("/advertisements/$pid");
    }

    public function acceptOrder($oid)
    {
        DB::table('requests')
            ->where('id', $oid)
            ->update(['dm_id' => auth('dm')->user()->id]);

        DB::table('notifications')->where('notifiable_id', '!=', auth('dm')->user()->id)->delete();

        $order = DB::table('requests')->find($oid);
        
        $seller = User::find($order->product_owner_id);
        $buyer = User::find($order->user_id);

        $details = [
            'order_id' => $order->id
        ];

        $seller->notify(new ConfirmOrder($details));
        $buyer->notify(new ConfirmOrder($details));

        return redirect("/showRoute/$oid");
    }
}
