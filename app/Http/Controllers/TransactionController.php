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
    public function index($bid, $pid)
    {
        $deliverymen = DeliveryMan::where('availability', 1)->get();

        $buyer = User::find($bid);
        $product = Product::find($pid);

        $transaction = new Transaction;
        $user = User::find($bid);
        $product = Product::find($pid);

        $ad = DB::table('advertisements')->where('product_id', $pid)->get();

        $transaction->seller_id = auth()->user()->id;
        $transaction->buyer_id = $bid;
        $transaction->product_id = $pid;
        $transaction->payment_method = "cash";

        $transaction->save();

        $details = [
            'buyer_id' => $bid,
            'buyer_name' => $buyer->name,
            'buyer_address' => $buyer->address,
            'product_id' => $pid,
            'product_name' => $product->name
        ];

        foreach ($deliverymen as $dm) {
            $dm->notify(new NotifyDM($details));
        }

        return view('transaction', ['buyer' => $user, 'product' => $product, 'ad' => $ad]);
    }
}
