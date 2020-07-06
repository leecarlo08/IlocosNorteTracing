<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    public function images(){
        return $this->hasMany('App\Image');
    }

    public function article(){
        return $this->hasOne('App\TouristSpot');
    }
}
