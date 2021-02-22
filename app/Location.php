<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $table = 'geo_loc';
    protected $fillable = [
      'geo_loc_id',
      'state_id',
      'city_id',
      'area',
      'lng',
      'lat'
    ];

    public function agar(){
        return $this->belongsTo(Agar::class,'geo_loc_id');
    }

    public function state(){
        return $this->hasOne(State::class,'state_id','state_id');
    }

    public function city(){ 
        return $this->hasOne(City::class,'city_id','city_id');
    }


}
