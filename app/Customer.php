<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
  public function user()
 {
     return $this->belongsTo(User::class);
 }
 public function address()
    {
        return $this->hasOne(Address::class);
    }
}
