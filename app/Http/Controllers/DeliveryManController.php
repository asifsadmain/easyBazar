<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Transaction;
use App\DeliveryMan;
use Illuminate\Support\Facades\DB;

class DeliveryManController extends Controller
{
    public function showRoute($oid)
    {
        $order = DB::table('requests')->find($oid);
        $seller = User::find($order->product_owner_id);

        return view('dm.showRoute', ['seller' => $seller, 'order' => $order]);
    }

    public function changeStatus()
    {
        $dm = DeliveryMan::find(auth('dm')->user()->id);

        $dm->availability = 1 - $dm->availability;
        $dm->save();

        return redirect('/dm/home');
    }

    public function orderStatus()
    {
        $trx = Transaction::find(auth('dm')->user()->trx_id);
        $dm = DeliveryMan::find(auth('dm')->user()->id);

        if($trx->product_received && $trx->seller_paid && $trx->delivered_product && $trx->payment_received)
        {
            $dm->trx_id = NULL;
            $dm->on_duty = NULL;
            $dm->save();
        }

        return view('dm.orderStatus', ['transaction' => $trx]);
    }

    public function viewProfile($id)
    {
        $dm = DeliveryMan::find($id);

        return view('dm.viewProfile', ['dm' => $dm]);
    }
}
