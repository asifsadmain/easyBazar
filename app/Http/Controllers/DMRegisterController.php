<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Validator;
use App\DeliveryMan;

class DMRegisterController extends Controller
{
    public function index()
    {
        return view('dm.register');
    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'name'      =>  'required',
            'email'     =>  'required|email',
            'password'  =>  'required|alphaNum|min:5',
            'date_of_birth' => 'required',
            'address'   =>  'required',
            'mobile_no' =>  'required'
        ]);

        $dm = new DeliveryMan;

        $dm->name = $request->input('name');
        $dm->password = Hash::make($request->input('password'));
        $dm->email = $request->input('email');
        $dm->date_of_birth = $request->input('date_of_birth');
        $dm->mobile_no = $request->input('mobile_no');
        $dm->address = $request->input('address');
        if($request->input('availability') == 'TRUE')
        {
            $dm->availability = true;
        }
        else
        {
            $dm->availability = false;
        }

        if($request->input('preffered_loc1'))
        {
            $dm->preffered_loc1 = $request->input('preffered_loc1');
        }
        if($request->input('preffered_loc2'))
        {
            $dm->preffered_loc2 = $request->input('preffered_loc2');
        }
        if($request->input('preffered_loc3'))
        {
            $dm->preffered_loc3 = $request->input('preffered_loc3');
        }
        if($request->input('preffered_loc2'))
        {
            $dm->preffered_loc4 = $request->input('preffered_loc4');
        }

        $dm->save();

        return "success";
    }
}
