<?php

namespace App\Http\Controllers;

use App\Accommodation;
use App\Brgy;
use App\City;
use App\Schedule;
use App\Tourist;
use App\TouristSpot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('getCities', 'getBrgys');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('tourist.index');
    }
    public function getCities($id){
        return City::where('provCode',$id)->get();
    }
    public function getBrgys($id){
        return Brgy::where('citymunCode',$id)->get();
    }

    public function myQR(){
        $user = Auth::user();
        $schedules = Schedule::whereTouristId(Auth::id())->get()->count();
        if($schedules > 0){
            $data = [
                'status' => 1,
                'username' => $user->token
            ];
        } else {
            $data = [
                'status' => 0,
            ];
        }
        return $data;

    }

    public function getSpots(){
        $spots = TouristSpot::all();

        foreach ($spots as $s){
            if($s->gallery){
                if($s->gallery->images->count() >= 1){
                    $image = '/storage/'.$s->gallery->images->first()->src;
                } else {
                    $image = 0;
                }
            }

            $data[] = [
                'name' => $s->name,
                'description' => $s->description,
                'image' => $image
            ];
        }
        return $data;
    }

    public function agreeHealth(Request $request) {
        $tourist = Tourist::find(Auth::id());
        $tourist->visited_country = $request->country;
        $tourist->sick = $request->sick;
        $tourist->save();

        return 1;
    }

    public function allTourist(){
        $tourists = Tourist::all();

        foreach ($tourists as $t){
            $data[] = [
                'id' => $t->id,
                'name' => $t->firstname.' '.$t->lastname,
                'username' => '@'.$t->username
            ];
        }

        return collect($data);
    }

    public function findTourist(Request $request){
        $tourists = $this->allTourist();
        $term = $request->term;

        $result = $tourists->filter(function ($item) use ($term) {
            return false !== stristr($item['name'], $term);
        })->take(10)->values();

        return $result;
    }

    public function findAccommodation(Request $request){
        return Accommodation::where('name', 'like', '%'.$request->term.'%')->get()->take(10);
    }
}
