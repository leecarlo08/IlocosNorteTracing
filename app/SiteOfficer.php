<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class SiteOfficer extends Authenticatable
{
    use Notifiable;


    public function touristSpot(){
        return $this->belongsTo('App\TouristSpot');
    }
}
