<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\SiteOfficer;
use App\TouristSpot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function indexData(){
        $acc = SiteOfficer::all();

        foreach ($acc as $a){
            $data[] = [
                'id' => $a->id,
                'username' => $a->username,
                'spot' => TouristSpot::find($a->tourist_spot_id)->name,
            ];
        }

        return $data;
    }

    public function store(Request $request){
        $acc = new SiteOfficer();
        $acc->username = $request->username;
        $acc->tourist_spot_id = $request->tourist_spot_id;
        $acc->password = Hash::make($request->password);
        $acc->save();

        return 1;
    }
}
