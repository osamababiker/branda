<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sf_extra extends Model
{
  protected $table = 'sf_extra';
  protected $fillable = [
    'name',
    'status'
  ];
}
