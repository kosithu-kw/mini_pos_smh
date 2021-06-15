<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paid extends Model
{
    public function user(){
        return $this->belongsTo('App\User');
    }
}
