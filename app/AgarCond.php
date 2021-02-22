<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AgarCond extends Model
{
  protected $table = 'cond_extra';
  protected $fillable = [
    'name',
    'status'
  ];

}
