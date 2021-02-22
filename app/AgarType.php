<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AgarType extends Model
{
  protected $table = 'agar_type';
  protected $fillable = [
    'type_name',
    'status'
  ];

  public function agar(){
      return $this->belongsTo(Agar::class,'type_id');
  }
}
