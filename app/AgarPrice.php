<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AgarPrice extends Model
{
  protected $table = 'agar_price';
  protected $fillable = [
    'price_id',
    'agar_id',
    'day',
    'month',
    'currency'
  ];

  public function agar(){
      return $this->belongsTo(Agar::class,'agar_id');
  }

}
