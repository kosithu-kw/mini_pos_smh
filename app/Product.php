<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    public function buyinghistory(){
        return $this->hasMany("App\Buyinghistory")->orderBy('id', 'desc');
    }
}
