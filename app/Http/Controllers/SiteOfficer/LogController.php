<?php

namespace App\Http\Controllers\SiteOfficer;

use App\Http\Controllers\Controller;
use App\Schedule;
use App\Tourist;
use App\TouristLog;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:spot');
    }

    public function logTourist($token){
        //$user = $request->tourist;

        $now = Carbon::now();



        $tourist = Tourist::whereToken($token)->first();
        $sched = Schedule::whereTouristId($tourist->id)->get();
        $spotId = Auth::guard('spot')->user()->tourist_spot_id;
        $hasLog = TouristLog::whereTouristId($tourist->id)->whereTouristSpotId($spotId)->first();
        foreach ($sched as $s){
            if($now >= $s->arrival && $now <= Carbon::make($s->departure)->addDays(5)){
                $check_sched = 1;
                break;
            } else {
                $check_sched = 0;
                $inout = null;
            }
        }

        if($check_sched === 1){
            if( !is_null($hasLog)){
                $inout = 0;
                $log = TouristLog::find($hasLog->id);
                $log->time_out = date('H:i:s', strtotime(now()));
                $log->save();
            } else {
                $inout = 1;
                $log = new TouristLog();
                $log->tourist_id = $tourist->id;
                $log->tourist_spot_id = $spotId;
                $log->time_in = date('H:i:s', strtotime(now()));
                $log->save();
            }
        }

        return [ 'tourist' => $tourist, 'in' => $inout, 'check_sched' => $check_sched];
    }

    public function getSiteLogs(Request $request){

        $date_now = Carbon::now();
        $data = [];

        $logs = TouristLog::whereTouristSpotId(Auth::guard('spot')->user()->tourist_spot_id)
            ->where('created_at', '>=', $date_now->subDay())
            ->get();

        foreach ($logs as $log){
            $tourist = Tourist::find($log->tourist_id);
            $data[] = [
                'name' => $tourist->firstname.' '.$tourist->lastname,
                'date' => date('F d, Y', strtotime($log->created_at)),
                'time_in' => date('H:i:s A', strtotime($log->time_in)),
                'time_out' => ($log->time_out)? date('H:i:s A', strtotime($log->time_out)) : '---',
            ];
        }

        return $data;
    }
}
