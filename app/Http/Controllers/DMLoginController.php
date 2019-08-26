<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Auth;
use App\DeliveryMan;

class DMLoginController extends Controller
{
    public function index()
    {
        return view('dm.login');
    }

    function checklogin(Request $request)
    {
        $this->validate($request, [
        'email'   => 'required|email',
        'password'  => 'required|alphaNum|min:5'
        ]);

        $dmEmail = DeliveryMan::where('email', '=', $request->get('email'));
        $dmPassword = DeliveryMan::where('password', '=', $request->get('email'));


        if(($dmEmail == $request->get('email') && ($dmPassword == $request->get('password'))))
        {
            return view('dm.home');
        }
        else
        {
            return view('dm.home');
        }
    }

    function logout()
    {

    }
}
