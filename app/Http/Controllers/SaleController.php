<?php

namespace App\Http\Controllers;

use App\Buyinghistory;
use App\Product;
use App\Sale;
use App\Saleitem;
use DateTime;
use Illuminate\Http\Request;
use App\Cart;
use Illuminate\Support\Facades\Session;
use Auth;

class SaleController extends Controller
{

    public function print($id){
        $sale=Sale::whereId($id)->firstOrFail();
        return view ('admin.sales.print')->with(['sale'=>$sale]);
    }
    public function getReportSaleId($id){
        $sales=Sale::where('id', $id)->get();
        if(count($sales)>0){
            $today=$sales->first()->created_at;
            return view ('admin.sales.report')->with(['sales'=>$sales, 'sale_date'=>$today, 'sale_month'=>null]);
        }else{
            return view ('admin.sales.report')->with(['sales'=>$sales, 'sale_date'=>null, 'sale_month'=>null]);
        }
    }
    public function getReportId(Request $request){
        $id=$request['f_id'];
        $sales=Sale::where('id', $id)->get();
        if(count($sales)>0){
            $today=$sales->first()->created_at;
            return view ('admin.sales.report')->with(['sales'=>$sales, 'sale_date'=>$today, 'sale_month'=>null]);
        }else{
            return view ('admin.sales.report')->with(['sales'=>$sales, 'sale_date'=>null, 'sale_month'=>null]);
        }


    }
    public function getReportMonth(Request $request){
        $today=$request['f_m'];
        $sales=Sale::where('created_at', "LIKE", "%$today%")->OrderBy('id', 'desc')->get();
        return view ('admin.sales.report')->with(['sales'=>$sales, 'sale_date'=>null, 'sale_month'=>$today]);
    }
    public function getReportDate(Request $request){
        $today=$request['f_d'];
        $sales=Sale::where('created_at', "LIKE", "%$today%")->OrderBy('id', 'desc')->get();
        return view ('admin.sales.report')->with(['sales'=>$sales, 'sale_date'=>$today, 'sale_month'=>null]);
    }
    public function getReport(){
        $today=date("Y-m-d");
        $sales=Sale::where('created_at', "LIKE", "%$today%")->OrderBy('id', 'desc')->get();
        return view ('admin.sales.report')->with(['sales'=>$sales, 'sale_date'=>$today, 'sale_month'=>null]);
    }

    public function checkout(){
        $cart=Session::get('cart');
        $totalQty=$cart->totalQty;
        $totalAmount=$cart->totalAmount;
        $sale=new Sale();
        $sale->user_id=Auth::User()->id;
        $sale->totalQty=$totalQty;
        $sale->totalAmount=$totalAmount;
        if(Session::has('paid_cash')){
            $sale->paid_cash=Session::get('paid_cash');
        }
        $sale->save();

        foreach ($cart->items as $item){
            $product_id=$item['item']['id'];
            $item_name=$item['item']['item_name'];
            $qty=$item['qty'];
            $sale_price=$item['item']['sale_price'];
            $buying_price=$item['item']['buying_price'];
            $amount=$item['amount'];
            $sale_id=$sale->id;

            $sale_item=new Saleitem();
            $sale_item->product_id=$product_id;
            $sale_item->quantity=$qty;
            $sale_item->sale_id=$sale_id;
            $sale_item->amount=$amount;
            $sale_item->sale_price=$sale_price;
            $sale_item->item_name=$item_name;
            $sale_item->buying_price=$buying_price;
            $sale_item->user_id=Auth::User()->id;
            $sale_item->save();
        }
        Session::forget('cart');
        Session::forget('paid_cash');
        return redirect()->back()->with('info', "This session have been completed sale.");
    }
    public function checkOutPrint(){

        $cart=Session::get('cart');
        $totalQty=$cart->totalQty;
        $totalAmount=$cart->totalAmount;
        $sale=new Sale();
        $sale->user_id=Auth::User()->id;
        $sale->totalQty=$totalQty;
        $sale->totalAmount=$totalAmount;
        if(Session::has('paid_cash')){
            $sale->paid_cash=Session::get('paid_cash');
        }
        $sale->save();

        foreach ($cart->items as $item){
            $product_id=$item['item']['id'];
           $item_name=$item['item']['item_name'];
           $qty=$item['qty'];
           $sale_price=$item['item']['sale_price'];
           $buying_price=$item['item']['buying_price'];
           $amount=$item['amount'];
           $sale_id=$sale->id;

           $sale_item=new Saleitem();
            $sale_item->product_id=$product_id;
           $sale_item->quantity=$qty;
           $sale_item->sale_id=$sale_id;
           $sale_item->amount=$amount;
           $sale_item->sale_price=$sale_price;
           $sale_item->item_name=$item_name;
           $sale_item->buying_price=$buying_price;
           $sale_item->user_id=Auth::User()->id;
           $sale_item->save();
        }
        Session::forget('cart');
        Session::forget('paid_cash');
        return redirect()->route('print',['id'=>$sale->id])->with('info', "This session have been completed sale.");


    }
    public function cancelCart(){
        $oldCart=Session::get('cart');
        $cart=new Cart($oldCart);
        $cart->clearCart();
        Session::forget('paid_cash');
        return redirect()->back()->with('info', "The sale session have been cancelled.");
    }
    public function getSalePage(){
        $pds=Product::get();
        $carts=Session::has('cart') ? Session::get('cart') : [];
        return view ('admin.sales.sale')->with(['pds'=>$pds, 'carts'=>$carts]);
    }
    public function postPaidCash(Request $request){
        $paid_cash=$request['paid_cash'];
        Session::put('paid_cash', $paid_cash);
       return redirect()->back();

    }
    public function removeItem($id){
        $oldCart=Session::get('cart');
        $cart=new Cart($oldCart);
        $cart->remove($id);
        if(count($cart->items) <=0){
            Session::forget('cart');
        }else{
            Session::put('cart', $cart);
        }
        return redirect()->back()->with('info', "The selected item have been removed.");
    }
    public function increaseCart($id){
        $pd=Product::whereId($id)->first();
        if($pd->quantity <=0){
            return redirect()->back()->with('err', "The selected item is out of stock can't make sale.");
        }
        $oldCart=Session::get('cart');
        $cart=new Cart($oldCart);
        $cart->increaseOne($id);
        Session::put('cart', $cart);
        $pd->decrement('quantity');
        return redirect()->back()->with('info', "The selected item have been increased.");
    }
    public function decreaseCart($id){
        $pd=Product::whereId($id)->first();
        $oldCart=Session::get('cart');
        $cart=new Cart($oldCart);
        $cart->decreaseOne($id);
        if(count($cart->items) <=0){
            Session::forget('cart');
        }else{
            Session::put('cart', $cart);
        }
        $pd->increment('quantity');
        return redirect()->back()->with('info', "The selected item have been decreased.");

    }
    public function postAddCart(Request $request){
        $bc=$request['sale_item'];
        $pd=Product::where('barcode',$bc)->first();

        if(!$pd){
            return redirect()->back()->with('err', "The selected item was not found.");
        }
       if($pd->quantity <=0){
           return redirect()->back()->with('err', "The selected item is out of stock can't make sale.");
       }

        $oldCart=Session::has('cart') ? Session::get('cart') : null;
        $cart=new Cart($oldCart);
        $cart->add($pd, $pd->id);
        Session::put('cart', $cart);
        $pd->decrement('quantity');
        $pd->update();

        if($pd->quantity <=2){
            return redirect()->back()->with('warning', "The selected item is less than 3 qty on stock.");
        }else{
            return redirect()->back()->with('info', 'The selected item have been add to cart.');
        }


    }
    public function postAddCart2(Request $request){
        $bc=$request['sale_item2'];
        $pd=Product::where('item_name',$bc)->first();

        if(!$pd){
            return redirect()->back()->with('err', "The selected item was not found.");
        }
        if($pd->quantity <=0){
            return redirect()->back()->with('err', "The selected item is out of stock can't make sale.");
        }

        $oldCart=Session::has('cart') ? Session::get('cart') : null;
        $cart=new Cart($oldCart);
        $cart->add($pd, $pd->id);
        Session::put('cart', $cart);
        $pd->decrement('quantity');
        $pd->update();

        if($pd->quantity <=2){
            return redirect()->back()->with('warning', "The selected item is less than 3 qty on stock.");
        }else{
            return redirect()->back()->with('info', 'The selected item have been add to cart.');
        }


    }
}
