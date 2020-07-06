<?php

namespace App\Http\Controllers;

use App\Accommodation;
use App\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getSchedules(){
        $schedules = Schedule::whereTouristId(Auth::id())->latest('arrival')->get();
        $data=[];
        $user = Auth::user();
        if(is_null($user->sick)){
            $status = 0;
        } else {
            if($user->sick == 1){
                $status = 2;
            } else {
                $status = 1;
            }
        }
        foreach ($schedules as $sched){
            $data[] = [
                'id' => $sched->id,
                'arrival' => date('M d, Y',strtotime($sched->arrival)),
                'departure' => date('M d, Y',strtotime($sched->departure)),
            ];
        }
        return [ 'sched' => $data, 'status' => $status];
    }

    public function getData($id){
        $sched = Schedule::find($id);
        $accomm = Accommodation::find($sched->accommodation_id);
            $data = [
                'id' => $id,
                'arrivalm' => date('M d, Y',strtotime($sched->arrival)),
                'departurem' => date('M d, Y',strtotime($sched->departure)),
                'arrival' => date('Y-m-d',strtotime($sched->arrival)),
                'departure' => date('Y-m-d',strtotime($sched->departure)),
                'transportation' => $sched->transportation,
                'accommodation' => $accomm->name,
                'accommodationId' => $accomm->id,
                'address' => $accomm->address,
            ];

        return $data;
    }

    public function store(Request $request){
        if($request->accommodationId){

        $sched = new Schedule();
        $sched->tourist_id = Auth::id();
        $sched->arrival = date('Y-m-d',strtotime($request->arrival));
        $sched->departure = date('Y-m-d',strtotime($request->departure));
        $sched->transportation = $request->transportation;
        $sched->accommodation_id = $request->accommodationId;
        $sched->token = base64_encode(date('ymd his', strtotime(now())));
        $sched->save();
        } else {
            $accom = new Accommodation();
            $accom->name = strtoupper($request->accommodation);
            $accom->address = $request->address;
            $accom->save();

            $sched = new Schedule();
            $sched->tourist_id = Auth::id();
            $sched->arrival = date('Y-m-d',strtotime($request->arrival));
            $sched->departure = date('Y-m-d',strtotime($request->departure));
            $sched->transportation = $request->transportation;
            $sched->accommodation_id = $accom->id;
            $sched->token = base64_encode(date('ymd his', strtotime(now())));
            $sched->save();
        }

        return 1;
    }
    public function update($id, Request $request){
        if($request->accommodationId){

        $sched = Schedule::find($id);
        $sched->tourist_id = Auth::id();
        $sched->arrival = date('Y-m-d',strtotime($request->arrival));
        $sched->departure = date('Y-m-d',strtotime($request->departure));
        $sched->transportation = $request->transportation;
        $sched->accommodation_id = $request->accommodationId;
        $sched->save();
        } else {
            $accom = new Accommodation();
            $accom->name = strtoupper($request->accommodation);
            $accom->address = $request->address;
            $accom->save();

            $sched = Schedule::find($id);
            $sched->tourist_id = Auth::id();
            $sched->arrival = date('Y-m-d',strtotime($request->arrival));
            $sched->departure = date('Y-m-d',strtotime($request->departure));
            $sched->transportation = $request->transportation;
            $sched->accommodation_id = $accom->id;
            $sched->save();
        }

        return 1;
    }

    public function destroy($id){
        $sched = Schedule::find($id)->delete();

        return 1;
    }
}
