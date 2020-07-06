<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TouristSpot extends Model
{
    public function gallery(){
        return $this->hasOne('App\Gallery','id','gallery_id');
    }
}
