<?php
namespace App;
use Illuminate\Support\Facades\Session;
use App\Product;
class Cart
{
    public $items;
    public function __construct($oldCart)
    {
        if($oldCart){
            $this->items=$oldCart->items;
        }else{
            $this->items=null;
        }
    }


    public function itemQtyAction($id, $item_qty){
        $sp=Session::get("ready_sale");
        if($sp=="normal"){
            $salePrice=$this->items[$id]['item']['sale_price'];
        }elseif($sp=="level_1"){
            $salePrice=$this->items[$id]['item']['sale_price_1'];;
        }else{
            $salePrice=$this->items[$id]['item']['sale_price_2'];
        }
        $this->items[$id]['item_qty']= $item_qty;
        $this->items[$id]['item_amount'] = $salePrice * $item_qty;

    }

    public function add($item, $id){

        $sp=Session::get("ready_sale");
        if($sp=="normal"){
            $salePrice=$item->sale_price;
        }elseif($sp=="level_1"){
            $salePrice=$item->sale_price_1;
        }else{
            $salePrice=$item->sale_price_2;
        }
        
        $storeItem=['item_qty'=>1,  'item_amount'=>$salePrice, 'item'=>$item];
        if($this->items){
            if(array_key_exists($id, $this->items)){
                $storeItem=$this->items[$id];
            }
        }  
        
        $this->items[$id]=$storeItem;
    }

    public function remove($id){        
        unset($this->items[$id]);
    }
    public function clearCart(){
        Session::forget('cart');
    }
    
   
}