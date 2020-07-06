<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $table = 'refprovince';
    protected $primaryKey = 'provCode';
    public $incrementing = false;
    public $timestamps = false;

    public function cities(){
        return $this->hasMany('App\City','provCode');
    }

    public function addresses() {
        return $this->hasMany('App\Address', 'prov_id');
    }
}
