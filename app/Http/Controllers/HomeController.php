<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\DeliveryMan;
use App\Notifications\NotifyDM;
use Illuminate\Support\Facades\Notification;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home', ['categories' => Category::all()]);
    }

    public function notifyDM()
    {
        $deliverymen = DeliveryMan::all();

        foreach ($deliverymen as $dm) {
            $dm->notify(new NotifyDM(1));
        }
    }
}
