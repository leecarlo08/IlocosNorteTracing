<?php

namespace App\Http\Controllers\SiteOfficer\Auth;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{

    use AuthenticatesUsers;
    protected  $redirectTo = '/site-officer';


    public function showLoginForm()
    {
        return view('spotOfficer.auth.login');
    }


    public function login(Request $request)
    {
        $this->validateLogin($request);
        if(Auth::guard('spot')->attempt(['email' => $request->email, 'password' => $request->password])){
            return redirect('/site-officer');
        }
        if(Auth::guard('spot')->attempt(['username' => $request->email, 'password' => $request->password])){
            return redirect('/site-officer');
        }

        $this->incrementLoginAttempts($request);
        return $this->sendFailedLoginResponse($request);
    }

    public function logout(Request $request)
    {
        $this->guard('spot')->logout();

        $request->session()->flush();

        $request->session()->regenerate();

        return redirect('/site-officer/login');
    }
}
