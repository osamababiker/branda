<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class A_extra extends Model
{
  protected $table = 'a_extra';
  protected $fillable = [
    'name',
    'status'
  ];


}
