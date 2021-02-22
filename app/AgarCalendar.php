<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AgarCalendar extends Model
{
  protected $table = 'agar_calendar';
  protected $fillable = [
    'agar_id',
    'start_date',
    'end_date'
  ];

  public function agar(){
      return $this->belongsTo(Agar::class,'agar_id');
  }
}
