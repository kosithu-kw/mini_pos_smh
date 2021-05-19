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
        $storeItem=['qty'=>0, 'amount'=>$item->sale_price, 'item'=>$item];
        if($this->items){
            if(array_key_exists($id, $this->items)){
                $storeItem=$this->items[$id];
            }
        }
        $storeItem['qty']++;
        $storeItem['price']=$item->sale_price;
        $storeItem['amount'] =$item->sale_price * $storeItem['qty'];
        $this->items[$id]=$storeItem;
        $this->totalQty++;
        $this->totalAmount += $item->sale_price;
    }
    public function decreaseOne($id){
        $this->items[$id]['qty']--;
        $this->items[$id]['amount'] -= $this->items[$id]['item']['sale_price'];
        $this->totalQty--;
        $this->totalAmount -=$this->items[$id]['item']['sale_price'];
        if($this->items[$id]['qty'] <= 0){
            unset($this->items[$id]);
        }
    }
    public function increaseOne($id){
        $this->items[$id]['qty']++;
        $this->items[$id]['amount'] += $this->items[$id]['item']['sale_price'];
        $this->totalQty++;
        $this->totalAmount +=$this->items[$id]['item']['sale_price'];
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