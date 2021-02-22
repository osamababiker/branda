<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contacts extends Model
{
    protected $table = 'contacts';
    protected $fillable = [
      'user_id',
    	'contact_id',
    	'accepted'
    ];
}
