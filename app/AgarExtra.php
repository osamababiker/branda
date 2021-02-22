<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AgarExtra extends Model
{
  protected $table = 'agar_extra';
  protected $fillable = [
    'extra_id',
    'agar_id',
    'b_extra',
    'a_extra',
    'sf_extra',
    'cond_extra'
  ];

  public function agar(){
      return $this->belongsTo(Agar::class,'agar_id');
  }
}
