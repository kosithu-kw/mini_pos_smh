<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    public function user(){
        return $this->belongsTo('App\User');
    }
    public function saleitem(){
        return $this->hasMany("App\Saleitem");
    }
}
