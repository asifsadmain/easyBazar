<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Product;
use App\DeliveryMan;
use App\Transaction;
use App\Notifications\RequestSeller;
use App\Notifications\ConfirmOrder;
use App\Notifications\ProductReceived;
use App\Notifications\SellerPaid;
use App\Notifications\ProductDelivered;
use App\Notifications\BuyerPaid;
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

        $trx = Transaction::where('order_id', $oid)->first();

        $dm = DeliveryMan::find(auth('dm')->user()->id);
        $dm->on_duty = 1;
        $dm->trx_id = $trx->id;
        $dm->save();

        $seller = User::find($order->product_owner_id);
        $buyer = User::find($order->user_id);
        $seller->trx_id = $trx->id;
        $buyer->trx_id = $trx->id;
        $seller->save();
        $buyer->save();

        $details = [
            'order_id' => $order->id
        ];

        $seller->notify(new ConfirmOrder($details));
        $buyer->notify(new ConfirmOrder($details));

        return redirect('/dm/orderStatus');
    }

    public function receiveProduct()
    {
        $trx = Transaction::find(auth('dm')->user()->trx_id);

        $seller = User::find($trx->seller_id);
        $buyer = User::find($trx->buyer_id);

        $trx->product_received = 1;
        $trx->save();

        $details = [
            'transaction_id' => $trx->id
        ];

        $seller->notify(new ProductReceived($details));
        $buyer->notify(new ProductReceived($details));

        return redirect('/dm/orderStatus');
    }

    public function paySeller()
    {
        $trx = Transaction::find(auth('dm')->user()->trx_id);

        $seller = User::find($trx->seller_id);
        $buyer = User::find($trx->buyer_id);

        $trx->seller_paid = 1;
        $trx->save();

        $details = [
            'transaction_id' => $trx->id
        ];

        $seller->notify(new SellerPaid($details));
        $buyer->notify(new SellerPaid($details));

        return redirect('/dm/orderStatus');
    }

    public function deliverProduct()
    {
        $trx = Transaction::find(auth('dm')->user()->trx_id);

        $seller = User::find($trx->seller_id);
        $buyer = User::find($trx->buyer_id);

        $trx->delivered_product = 1;
        $trx->save();

        $details = [
            'transaction_id' => $trx->id
        ];

        $seller->notify(new ProductDelivered($details));
        $buyer->notify(new ProductDelivered($details));

        return redirect('/dm/orderStatus');
    }

    public function receivePayment()
    {
        $trx = Transaction::find(auth('dm')->user()->trx_id);

        $seller = User::find($trx->seller_id);
        $buyer = User::find($trx->buyer_id);

        $trx->payment_received = 1;
        $trx->save();

        $details = [
            'transaction_id' => $trx->id
        ];

        $seller->notify(new BuyerPaid($details));
        $buyer->notify(new BuyerPaid($details));

        return redirect('/dm/orderStatus');
    }
}
