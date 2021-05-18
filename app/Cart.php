<?php
namespace App;
use Illuminate\Support\Facades\Session;
use App\Product;
class Cart
{
    public $items;
    public $totalAmount=0;
    public $totalQty=0;
    public function __construct($oldCart)
    {
        if($oldCart){
            $this->items=$oldCart->items;
            $this->totalAmount=$oldCart->totalAmount;
            $this->totalQty=$oldCart->totalQty;
        }else{
            $this->items=null;
        }
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
        
        $storeItem=['qty'=>0, 'amount'=>$salePrice, 'item'=>$item];
        if($this->items){
            if(array_key_exists($id, $this->items)){
                $storeItem=$this->items[$id];
            }
        }
       

        $storeItem['qty']++;
        $storeItem['price']=$salePrice;
        $storeItem['amount'] =$salePrice * $storeItem['qty'];
        $this->items[$id]=$storeItem;
        $this->totalQty++;
        $this->totalAmount += $salePrice;
    }
    public function decreaseOne($id){

        $sp=Session::get("ready_sale");
        if($sp=="normal"){
            $salePrice=$this->items[$id]['item']['sale_price'];
        }elseif($sp=="level_1"){
            $salePrice=$this->items[$id]['item']['sale_price_1'];;
        }else{
            $salePrice=$this->items[$id]['item']['sale_price_2'];
        }

        $this->items[$id]['qty']--;
        $this->items[$id]['amount'] -= $salePrice;
        $this->totalQty--;
        $this->totalAmount -=$salePrice;
        if($this->items[$id]['qty'] <= 0){
            unset($this->items[$id]);
        }
    }
    public function increaseOne($id){
        $sp=Session::get("ready_sale");
        if($sp=="normal"){
            $salePrice=$this->items[$id]['item']['sale_price'];
        }elseif($sp=="level_1"){
            $salePrice=$this->items[$id]['item']['sale_price_1'];;
        }else{
            $salePrice=$this->items[$id]['item']['sale_price_2'];
        }
        $this->items[$id]['qty']++;
        $this->items[$id]['amount'] += $salePrice;
        $this->totalQty++;
        $this->totalAmount +=$salePrice;
    }
    public function remove($id){
        $itemQty=$this->items[$id]['qty'];
        $item=Product::where('id', $id)->first();
        $oldItem=$item->quantity;
        $newItem=$oldItem+$itemQty;
        $item->quantity=$newItem;
        $item->update();
        $newQty=$this->totalQty-$itemQty;
        $this->totalQty=$newQty;
        $itemAmount=$this->items[$id]['amount'];
        $newAmount=$this->totalAmount - $itemAmount;
        $this->totalAmount =$newAmount;
        unset($this->items[$id]);
    }
    public function clearCart(){
        foreach ($this->items as $item){
            $id=$item['item']['id'];
            $pd=Product::whereId($id)->first();
            $pd->quantity=$pd->quantity + $item['qty'];
            $pd->save();
            Session::forget('cart');
        }
    }
}