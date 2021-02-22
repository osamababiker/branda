<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
  protected $table = 'notifications';
  protected $guarded = [];

  public function fromContact()
  {
      return $this->hasOne(User::class, 'id', 'from');
  }
}
