<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentAddress extends Model
{
    protected $table = 'payment_address';
    protected $fillable = [
      'name',
      'branch',
      'address',
      'account_number'
    ];
}
