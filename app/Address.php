<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
     protected $table = 'address';
     protected $fillable = ['fullname', 'userid', 'phone', 'city', 'state', 'country', 'fullAddress'];
}
