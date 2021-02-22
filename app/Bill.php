<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $table = 'bill';
    protected $fillable = [
      'user_id',
      'bill_image',
      'reservation_id'
    ];

    public function user(){
      $this->belongsTo(User::class,'user_id');
    }

    public function reservation(){
      $this->belongsTo(Reservation::class,'reservation_id');
    }
}
