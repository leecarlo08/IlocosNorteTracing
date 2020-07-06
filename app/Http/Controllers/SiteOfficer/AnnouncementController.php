<?php

namespace App\Http\Controllers\SiteOfficer;

use App\Announcement;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:spot');
    }

    public function getAnnouncements(){
        $ann = Announcement::all()->sortByDesc('updated_at');

        foreach ($ann as $a){
            $data[] = [
                'id' => $a->id,
                'title' => $a->title,
                'date' => date('F d Y', strtotime($a->updated_at)),
            ];
        }

        return $data;
    }

    public function announcementData($id){
        $ann = Announcement::find($id);
    }
}
