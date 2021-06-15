<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    public function credits(){
        return $this->HasMany('App\Credit');
    }
    public function paids(){
        return $this->HasMany('App\Paid');
    }
  
}
