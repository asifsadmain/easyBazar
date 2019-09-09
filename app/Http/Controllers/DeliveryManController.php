<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Transaction;

class DeliveryManController extends Controller
{
    public function showRoute($id)
    {
        $seller = User::find($id);

        return view('dm.showRoute', ['seller' => $seller]);
    }
}
