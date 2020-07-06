<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = 'refcitymun';
    protected $primaryKey = 'citymunCode';
    public $timestamps = false;
    public $incrementing = false;

    public function brgys(){
        return $this->hasMany('App\Brgy', 'citymunCode');
    }

    public function addresses(){
        return $this->hasMany('App\Address', 'citymun_id');
    }
}
