<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AgarFloor extends Model
{
  protected $table = 'agar_floor';
  protected $fillable = [
    'floor_id',
    'floor_name',
    'status'
  ];

  public function agar(){
      return $this->belongsTo(Agar::class,'floor_id');
  }
}
