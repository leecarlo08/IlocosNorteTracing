<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brgy extends Model
{
    protected $table = 'refbrgy';
    protected $primaryKey = 'brgyCode';
    public $timestamps = false;
    public $incrementing = false;

    public function addresses(){
        return $this->hasMany('App\Address', 'brgy_id');
    }
}
