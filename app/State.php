<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
  protected $table = 'state';
  protected $fillable = [
    'state_id',
    'state_name',
    'status'
  ]; 

  public function city()
  {
      return $this->hasMany(city::class,'state_id');
  }

  public function location(){
      return $this->belongsTo(Location::class,'state_id');
  }

}
