<?php

namespace App\Http\Controllers;

use App\Buyinghistory;
use App\Product;
use App\Sale;
use App\Saleitem;
use DateTime;
use Illuminate\Http\Request;
use App\Cart;
use App\Credit;
use App\Customer;
use Illuminate\Support\Facades\Session;
use Auth;
use App\Paid;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    public function postSaleTo(Request $request){
        $sale_to=$request['sale_to'];
        Session::put('ready_sale', $sale_to);
        return redirect()->back();
    }
    public function CancelSaleTo(){
        if(Session::has('cart')){
            return $this->cancelCart();
        }else{
            Session::forget('ready_sale');
            return redirect()->back();
        }
    }

    public function print($id){
        $sale=Sale::whereId($id)->firstOrFail();
        $customer=$sale->customer;
        $credits=$customer->credits->where('sale_id', "<=", $id);
        //dd($credits);
        $last_credit=Credit::where('sale_id', $id)->first();
        //dd($credits);
       return view ('admin.sales.print')->with(['sale'=>$sale, 'credits'=>$credits,'last_credit'=>$last_credit ]);
    }
    public function getReportPrint($id){
        $sale=Sale::whereId($id)->firstOrFail();
        $customer=$sale->customer;
        $credits=$customer->credits->where('sale_id', "<=", $id);
        //dd($credits);
        $last_credit=Credit::where('sale_id', $id)->first();
        //dd($credits);
       return view ('admin.sales.report-print')->with(['sale'=>$sale, 'credits'=>$credits,'last_credit'=>$last_credit ]);
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

    public function getSaleQtyAction(Request $request){
        $item_qty=$request['sale_qty'];   
        
        $item_id=$request['item_id'];
               

        $oldCart=Session::has('cart') ? Session::get('cart') : null;
        $pd=Product::where('id', $item_id)->first();     

        if( (($pd->quantity + $oldCart->items[$item_id]['item_qty']) - $request['sale_qty'] ) < 0 ){
            return redirect()->back()->with('warning', "Please check your available stock item.");
        }   

        $cart=new Cart($oldCart);
        $cart->itemQtyAction($item_id, $item_qty);         

        
        if($oldCart->items[$item_id]['item_qty'] > 0){
           
            $old_item_qty=$oldCart->items[$item_id]['item_qty'] + $pd->quantity;
            $new_item_qty=$old_item_qty - $item_qty;
            $pd->quantity=$new_item_qty;
        }else{
           $pd->quantity=$pd->quantity - $item_qty;
           
        }
        $pd->update();
       
        
        Session::put('cart', $cart);
               
        if($pd->quantity <=1){
            return redirect()->back()->with('warning', "The selected item is less than 2 qty on stock.");
        }else{
            return redirect()->back();
        }
       

    }

    public function checkout(){
        $paid_cash=Session::get('paid_cash');
        $customer=Session::get('customer');
        if(($customer=="default_customer") && ($paid_cash<=0)){
            return redirect()->back()->with('warning', "Default customer should paid cash.");
        }

        $cart=Session::get('cart');
        $total=0;
        $item_total_qty=0;
        if(Session::has('cart')){
            foreach(Session::get('cart')->items as $i){
                $item_amount=$i['item_amount'];
                $total += $item_amount;
                $item_total_qty += $i['item_qty'];
            }
        }     
        
        $discount=Session::get('discount');

        $sale=new Sale();
        $sale->user_id=Auth::User()->id;
        $sale->totalQty=$item_total_qty;
        $sale->sale_type=Session::get("ready_sale");
        $sale->discount=$discount;
        $sale->re_paid=Session::get('re_paid');

        $sale->totalAmount=$total;
        if(Session::has('paid_cash')){
            $sale->paid_cash=Session::get('paid_cash');
        }
        if(Session::has('customer')){
            $name=Session::get('customer');
            $c=Customer::where('name', $name)->first();
            $sale->customer_id=$c->id;
        }
        $sale->save();

        $credit=$total - (Session::get("paid_cash") + $discount);
       // dd($credit);
            if(Session::has('customer')){
                $name=Session::get('customer');
                $c=Customer::where('name', $name)->first();
                $cus_id=$c->id;
                $sale_id=$sale->id;
                $totalCredit=abs($credit);

                $cre=new Credit();
                $cre->customer_id=$cus_id;
                $cre->sale_id=$sale_id;
                $cre->paid_cash=Session::get('paid_cash');
                $cre->discount=$discount;
                $cre->total_amount=$total;
                $cre->re_paid=Session::get('re_paid');
                $cre->credit_amount=Session::has('new_credit') ? Session::get('new_credit') : 0;
                $cre->save();
            }       

            DB::table('paids')->where('ready_use', "=", "0")->update(["ready_use"=>"1"]);

        

        foreach ($cart->items as $item){
            $product_id=$item['item']['id'];
            $item_name=$item['item']['item_name'];
            $item_qty=$item['item_qty'];
            if(Session::get('ready_sale')=="normal")
                { 
                   $pack_sale_price=$item['item']['sale_price']; 
                   $item_sale_price=$item['item']['sale_price'];
                } elseif(Session::get('ready_sale')=="level_1") {
                    $pack_sale_price= $item['item']['sale_price_1']; 
                    $item_sale_price=$item['item']['sale_price_1'];
                } else {
                    $pack_sale_price= $item['item']['sale_price_2'];
                    $item_sale_price=$item['item']['sale_price_2'];
                } ;
            $buying_price=$item['item']['buying_price'];
            $item_amount=$item['item_amount'];
            $sale_id=$sale->id;

            $sale_item=new Saleitem();
            $sale_item->product_id=$product_id;
            $sale_item->sale_id=$sale_id;
            $sale_item->item_name=$item_name;
            $sale_item->buying_price=$buying_price;
            $sale_item->sale_price=$item_sale_price;
            $sale_item->quantity=$item_qty ? $item_qty : 0;
            $sale_item->amount=$item_amount;
            $sale_item->user_id=Auth::User()->id;
            $sale_item->save();
        }
        Session::forget('cart');
        Session::forget('paid_cash');
        Session::forget('customer');
        Session::forget('discount');
        return redirect()->back()->with('info', "This session have been completed sale.");
        
    
    }
    public function checkOutPrint(){

        $paid_cash=Session::get('paid_cash');
        $customer=Session::get('customer');
        if(($customer=="default_customer") && ($paid_cash<=0)){
            return redirect()->back()->with('warning', "Default customer should paid cash.");
        }

        $cart=Session::get('cart');
        $total=0;
        $item_total_qty=0;
        if(Session::has('cart')){
            foreach(Session::get('cart')->items as $i){
                $item_amount=$i['item_amount'];
                $total += $item_amount;
                $item_total_qty += $i['item_qty'];
            }
        }     
        
        $discount=Session::get('discount');

        $sale=new Sale();
        $sale->user_id=Auth::User()->id;
        $sale->totalQty=$item_total_qty;
        $sale->sale_type=Session::get("ready_sale");
        $sale->discount=$discount;
        $sale->totalAmount=$total;
        $sale->re_paid=Session::get('re_paid');
        if(Session::has('paid_cash')){
            $sale->paid_cash=Session::get('paid_cash');
        }
        if(Session::has('customer')){
            $name=Session::get('customer');
            $c=Customer::where('name', $name)->first();
            $sale->customer_id=$c->id;
        }
        $sale->save();

        $credit=$total - (Session::get("paid_cash") + $discount);
       // dd($credit);
            if(Session::has('customer')){
                $name=Session::get('customer');
                $c=Customer::where('name', $name)->first();
                $cus_id=$c->id;
                $sale_id=$sale->id;
                $totalCredit=abs($credit);

                $cre=new Credit();
                $cre->customer_id=$cus_id;
                $cre->sale_id=$sale_id;
                $cre->paid_cash=Session::get('paid_cash');
                $cre->discount=$discount;
                $cre->total_amount=$total;
                $cre->re_paid=Session::get('re_paid');
                $cre->credit_amount=Session::has('new_credit') ? Session::get('new_credit') : 0;
                $cre->save();
            }      
            
            DB::table('paids')->where('ready_use', "=", "0")->update(["ready_use"=>"1"]);
        

        foreach ($cart->items as $item){
            $product_id=$item['item']['id'];
            $item_name=$item['item']['item_name'];
            $item_qty=$item['item_qty'];
            if(Session::get('ready_sale')=="normal")
                { 
                   $pack_sale_price=$item['item']['sale_price']; 
                   $item_sale_price=$item['item']['sale_price'];
                } elseif(Session::get('ready_sale')=="level_1") {
                    $pack_sale_price= $item['item']['sale_price_1']; 
                    $item_sale_price=$item['item']['sale_price_1'];
                } else {
                    $pack_sale_price= $item['item']['sale_price_2'];
                    $item_sale_price=$item['item']['sale_price_2'];
                } ;
            $buying_price=$item['item']['buying_price'];
            $item_amount=$item['item_amount'];
            $sale_id=$sale->id;

            $sale_item=new Saleitem();
            $sale_item->product_id=$product_id;
            $sale_item->sale_id=$sale_id;
            $sale_item->item_name=$item_name;
            $sale_item->buying_price=$buying_price;
            $sale_item->sale_price=$item_sale_price;
            $sale_item->quantity=$item_qty ? $item_qty : 0;
            $sale_item->amount=$item_amount;
            $sale_item->user_id=Auth::User()->id;
            $sale_item->save();
        }
        Session::forget('cart');
        Session::forget('paid_cash');
        Session::forget('customer');
        Session::forget('discount');

        return redirect()->route('print',['id'=>$sale->id])->with('info', "This session have been completed sale.");


    }
    public function cancelCart(){
        $oldCart=Session::get('cart');
        $items=$oldCart->items;
        foreach($items as $i){

            $item_id=$i['item']['id'];
            $pd=Product::whereId($item_id)->first();
         
        if($oldCart->items[$item_id]['item_qty'] > 0){
           
            $old_item_qty=$oldCart->items[$item_id]['item_qty'] + $pd->quantity;
            $new_item_qty=$old_item_qty;
            $pd->quantity=$new_item_qty;
        }
       
        $pd->update();
        }
          
      
        $cart=new Cart($oldCart);
        $cart->clearCart();
        Session::forget('paid_cash');
        Session::forget('customer');
        Session::forget('discount');
        return redirect()->back()->with('info', "The sale session have been cancelled.");
        
    }
    public function getSalePage(){
        $pds=Product::get();
        $cus=Customer::get();
        $carts=Session::has('cart') ? Session::get('cart') : [];
        if(!Session::has('paid_cash')){
            Session::put('paid_cash', 0);
        }
        if(!Session::has('customer')){
            Session::put('customer', 'default_customer');
        }
        if(!Session::has('discount')){
            Session::put('discount', 0);
        }

       
        $ses_cus=Session::get('customer');
        $nowCus=Customer::where('name', $ses_cus)->first();

        $nowCusOldCredit=$nowCus->credits;
        $rePaid=$nowCus->paids;


    
        $total=0;
        if(Session::has('cart')){
            foreach(Session::get('cart')->items as $i){
              
                $total += $i['item_amount'];
            }
        }       
        Session::put('total', $total);

        return view ('admin.sales.sale')->with(['pds'=>$pds, 'carts'=>$carts, 'cus'=>$cus, 'cusOldCredit'=>$nowCusOldCredit,'rePaids'=>$rePaid]);
    }
    public function postChangeCustomer(Request $request){
        $c=$request['customer'];
        $customer=Customer::where('name', $c)->first();
        if(!$customer){
            return redirect()->back()->with('warning', "The selected customer not found.");
        }
        Session::put("customer", $c);
        return redirect()->back();
    }
    public function postPaidCash(Request $request){
        $paid_cash=$request['paid_cash'];       

        $oldCart=Session::get('cart');
        $total=0;
        foreach($oldCart->items as $i){
            $total += $i['item_amount'];

        }

        $ses_cus=Session::get('customer');
        $customer=Customer::where('name', $ses_cus)->first();
        $credit=$customer->credits;
        $oldCredit=$oldCredit=($credit->sum('total_amount') - ($credit->sum('paid_cash') + $credit->sum('discount')));

        if($paid_cash > ($total + $oldCredit)){
            Session::put('paid_cash', ($total + $oldCredit));
        }else{
            Session::put('paid_cash', $paid_cash);
        }   
        return redirect()->back();     
        

    }
    public function removeItem($item_id){
        $oldCart=Session::get('cart');
        $cart=new Cart($oldCart);
        $pd=Product::whereId($item_id)->first();
         
        if($oldCart->items[$item_id]['item_qty'] > 0){
           
            $old_item_qty=$oldCart->items[$item_id]['item_qty'] + $pd->quantity;
            $new_item_qty=$old_item_qty;
            $pd->quantity=$new_item_qty;
        }else{
           $pd->quantity=$pd->quantity;
           
        }    
        $pd->update(); 

        $cart->remove($item_id);
        if(count($cart->items) <=0){
            Session::forget('cart');
            Session::forget('discount');
            Session::forget('paid_cash');
            Session::forget('customer');
        }else{
            Session::put('cart', $cart);
        }
        return redirect()->back()->with('info', "The selected item have been removed.");     
        
        
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
       $pd->quantity=$pd->quantity -1;
       $pd->update();

       $oldCart=Session::has('cart') ? Session::get('cart') : null;
       $cart=new Cart($oldCart);
       $cart->add($pd, $pd->id);
       Session::put('cart', $cart);
      

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
        $pd->quantity=$pd->quantity -1;
        $pd->update();

        $oldCart=Session::has('cart') ? Session::get('cart') : null;
        $cart=new Cart($oldCart);
        $cart->add($pd, $pd->id);
        Session::put('cart', $cart);
       

        if($pd->quantity <=2){
            return redirect()->back()->with('warning', "The selected item is less than 3 qty on stock.");
        }else{
            return redirect()->back()->with('info', 'The selected item have been add to cart.');
        }

        
    }

    public function postDiscountCash(Request $request){
        $discount=$request['discount_cash'];
        $paidNow=Session::get('paid_cash');;
        $oldCart=Session::get('cart');
        $total=0;
        foreach($oldCart->items as $i){
            $total += $i['item_amount'];

        }

        $ses_cus=Session::get('customer');
        $customer=Customer::where('name', $ses_cus)->first();
        $credit=$customer->credits;
        $oldCredit=($credit->sum('total_amount') - ($credit->sum('paid_cash') + $credit->sum('discount')));


        $newCredit=($oldCredit + $total) - $paidNow;

        if($discount > $newCredit){
            Session::put('discount', $newCredit);
        }else{
            Session::put('discount', $discount);
        }
        
       // dd($newCredit);
        
        return redirect()->back();
    }
}
