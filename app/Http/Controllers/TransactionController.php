<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;
use App\User;
use App\Product;
use App\Advertisement;
use App\DeliveryMan;
use Illuminate\Support\Facades\DB;
use App\Notifications\NotifyDM;
use Illuminate\Support\Facades\Notification;

class TransactionController extends Controller
{
    public function index($oid)
    {
        $deliverymen = DeliveryMan::where('availability', 1)->get();

        $order = DB::table('requests')->find($oid);
        $buyer = User::find($order->user_id);
        $product = Product::find($order->product_id);

        $transaction = new Transaction;

        $ad = DB::table('advertisements')->where('product_id', $product->id)->get();

        $transaction->order_id = $oid;
        $transaction->seller_id = auth()->user()->id;
        $transaction->buyer_id = $buyer->id;
        $transaction->product_id = $product->id;
        $transaction->payment_method = "cash";

        $transaction->save();

        $details = [
            'buyer_id' => $buyer->id,
            'buyer_name' => $buyer->name,
            'buyer_address' => $buyer->address,
            'product_id' => $product->id,
            'product_name' => $product->name,
            'order_id' => $oid
        ];

        foreach ($deliverymen as $dm) {
            $dm->notify(new NotifyDM($details));
        }

        return view('transaction', ['buyer' => $buyer, 'product' => $product, 'ad' => $ad, 'transaction' => $transaction]);
    }
}
