<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class DMLoginController extends Controller
{

    use AuthenticatesUsers;

    protected $redirectTo = '/dm/home';

    /**
     **_ Create a new controller instance.
     **
     **_ @return void
     **/
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    /**
     *
     * @return property guard use for login
     *
     */
    public function guard()
    {
        return Auth::guard('dm');
    }

    // login from for teacher
    public function showLoginForm()
    {
        return view('dm.login');
    }

}