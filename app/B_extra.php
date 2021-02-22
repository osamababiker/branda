<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class B_extra extends Model
{
  protected $table = 'b_extra';
  protected $fillable = [
    'name',
    'status'
  ];
}
