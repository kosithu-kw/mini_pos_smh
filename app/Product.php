<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    public function buyinghistory(){
        return $this->hasMany("App\Buyinghistory")->orderBy('id', 'desc');
    }
    public function saleitem(){
        return $this->hasMany('App\Saleitem')->orderBy('id', 'desc');
    }
}
