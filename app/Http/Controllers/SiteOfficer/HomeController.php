<?php

namespace App\Http\Controllers\SiteOfficer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:spot');
    }

    public function index()
    {
        return view('spotOfficer.index');
    }

    public function getSiteInfo(){
        return Auth::guard('spot')->user()->touristSpot;
    }
}
