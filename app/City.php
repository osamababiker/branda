<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
  protected $table = 'city';
  protected $fillable = [
    'city_id',
    'state_id',
    'city_name',
    'status'
  ];

  public function state(){
      return $this->belongsTo(State::class,'state_id','state_id');
  }

  public function location(){
      return $this->belongsTo(City::class,'city_id');
  }

}
