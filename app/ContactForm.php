<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactForm extends Model
{
    protected $table = 'contact_forms';
    protected $fillable = [
      'username',
      'phone',
      'subject',
      'message',
      'is_closed',
      'is_deleted'
    ];
}
