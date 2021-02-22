<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agar extends Model
{
    protected $table = 'agar';
    protected $fillable = [
      'agar_name',
      'type_id',
      'floor_id',
      'geo_loc_id',
      'rooms_number',
      'bathrooms_number',
      'agar_desc',
      'owner_id',
      'status',
      'featured',
      'admin-comments'
    ];

    public function user()
    {
      return $this->belongsTo(User::class,'owner_id');
    }

    public function location(){
        return $this->hasOne(Location::class,'geo_loc_id','geo_loc_id');
    }

    public function type(){
        return $this->hasOne(AgarType::class,'type_id','type_id');
    }

    public function floor(){
        return $this->hasOne(AgarFloor::class,'floor_id','floor_id');
    }

    public function image()
    {
        return $this->hasMany(AgarImg::class,'agar_id');
    } 

    public function price()
    {
        return $this->hasOne(AgarPrice::class,'agar_id');
    }

    public function calendar()
    {
        return $this->hasMany(AgarCalendar::class,'agar_id');
    }

    public function agar_extra()
    {
        return $this->hasOne(AgarExtra::class,'agar_id');
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class,'agar_id');
    }
}
