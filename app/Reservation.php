<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
  protected $table = 'reservation';
  protected $fillable = [
    'agar_id',
    'user_id', // reservation sender id
    'reciver_id', // agar owner
    'start_date',
    'end_date',
    'status'
  ];

  public function user(){
      return $this->belongsTo(User::class,'user_id');
  }

  public function agar(){
      return $this->belongsTo(Agar::class,'agar_id');
  }

  public function bill(){
      return $this->hasOne(Bill::class,'reservation_id');
  }

}
