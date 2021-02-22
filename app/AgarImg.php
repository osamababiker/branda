<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AgarImg extends Model
{
  protected $table = 'agar_img';
  protected $fillable = [
    'img_wide',
    'thumbnail',
    'agar_id'
  ];

  public function agar(){ 
      return $this->belongsTo(Agar::class,'agar_id');
  }
}
