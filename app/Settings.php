<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    protected $table = 'settings';
    protected $fillable = [
      'site_name',
      'phone_one',
      'phone_two',
      'email_one',
      'email_two',
      'logo',
      'address'
    ];
}
