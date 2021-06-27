<?php

namespace App\Http\Controllers;

use App\Buyinghistory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Product;
use Auth;

class ProductController extends Controller
{
    public function postUpdateOldItem(Request $request){
        $this->validate($request,[
            'item_name'=>'required|exists:products',
            'buying_price'=>'required',
            'sale_price'=>'required',
            'sale_price_1'=>'required',
            'sale_price_2'=>'required',
            'quantity'=>'required',
           // 'buying_date'=>'required'
        ]);
        $id=$request['id'];
        $pd=Product::whereId($id)->firstOrFail();
        $pd->barcode=$request['barcode'];
        $pd->buying_price=$request['buying_price'];
        $pd->sale_price=$request['sale_price'];
        $pd->sale_price_1=$request['sale_price_1'];
        $pd->sale_price_2=$request['sale_price_2'];
        $pd->quantity=$pd->quantity + $request['quantity'];
        $pd->save();

        $bHis=new Buyinghistory();
        $bHis->item_name=$request['item_name'];
        $bHis->buying_price=$request['buying_price'];
        $bHis->sale_price=$request['sale_price'];
        $bHis->sale_price_1=$request['sale_price_1'];
        $bHis->sale_price_2=$request['sale_price_2'];
        $bHis->quantity=$request['quantity'];
        $bHis->user_id=Auth::User()->id;
        $bHis->buying_date=$request['buying_date'];
        $bHis->product_id=$pd->id;
        $bHis->save();
        return redirect()->route('product.all')->with('info', 'The buying item have been updated.');


    }
    public function getUpdateOldItem($id){
        $pd=Product::whereId($id)->firstOrFail();
        return view ('admin.products.buy-old-product')->with(['pd'=>$pd]);
    }
    public function postUpdateItem(Request $request){
        $this->validate($request,[
            'barcode'=>'required',
            'item_name'=>'required',
            'buying_price'=>'required',
            'sale_price'=>'required',
            'sale_price_1'=>'required',
            'sale_price_2'=>'required',
            'quantity'=>'required'
        ]);
        $id=$request['id'];
        $pd=Product::whereId($id)->firstOrFail();
        $pd->barcode=$request['barcode'];
        $pd->item_name=$request['item_name'];
        $pd->buying_price=$request['buying_price'];
        $pd->sale_price=$request['sale_price'];
        $pd->sale_price_1=$request['sale_price_1'];
        $pd->sale_price_2=$request['sale_price_2'];
        $pd->quantity=$request['quantity'];
        $pd->update();
        return redirect()->route('product.all')->with('info', "The selected item have been updated.");
    }
    public function getEditItem($id){
        $pd=Product::whereId($id)->firstOrFail();
        return view ('admin.products.edit')->with(['pd'=>$pd]);
    }
    public function getShowItem($id){
        $pd=Product::whereId($id)->firstOrFail();
        $his=$pd->buyinghistory;

        return view('admin.products.show')->with(['pd'=>$pd,'his'=>$his]);
    }
    public function getPrintBarcode(Request $request){
        $barcode_item=$request['barcode_item'];

        $ids=$request['id'];
        $pd=Product::whereIn('id', $ids)->get();
        return view ('admin.products.print-barcode')->with(['pds'=>$pd,'barcode_item'=>$barcode_item]);
    }
    public function getProducts(){
        $pds=Product::OrderBy('id', 'desc')->with('buyinghistory')->paginate("25");
        return view ('admin.products.products')->with(['pds'=>$pds]);
    }
    public function getSearchProducts(Request $request){
        $search_item=$request['search_item'];
        $pds=Product::where('item_name', "LIKE", "%$search_item%")->orWhere('barcode', $search_item)
        ->OrderBy('id', 'desc')->with('buyinghistory')->paginate("25");
        return view ('admin.products.products')->with(['pds'=>$pds]);
    }
    public function getNewProduct(){
        return view ('admin.products.new-product');
    }
    public function postNewProduct(Request $request){
        $this->validate($request,[
            //'barcode'=>'required|unique:products',
           'item_name'=>'required|unique:products',
           'buying_price'=>'required',
           'sale_price'=>'required',
           'sale_price_1'=>"required",
           'sale_price_2'=>"required",
           'quantity'=>'required',
           // 'buying_date'=>'required'
        ]);
        $p=new Product();
        $p->item_name=$request['item_name'];
        $p->buying_price=$request['buying_price'];
        $p->sale_price=$request['sale_price'];
        $p->sale_price_1=$request['sale_price_1'];
        $p->sale_price_2=$request['sale_price_2'];
        $p->quantity=$request['quantity'];
        if($request['barcode']){
            $p->barcode=$request['barcode'];
        }else{
            $p->barcode=rand(0, 9999999);
        }
        $p->save();



        $bHis=new Buyinghistory();
        $bHis->item_name=$request['item_name'];
        $bHis->buying_price=$request['buying_price'];
        $bHis->sale_price=$request['sale_price'];
        $bHis->sale_price_1=$request['sale_price_1'];
        $bHis->sale_price_2=$request['sale_price_2'];
        $bHis->quantity=$request['quantity'];
        $bHis->user_id=Auth::User()->id;

        if($request['buying_date']){
            $bHis->buying_date=$request['buying_date'];
        }else{
            $bHis->buying_date=Carbon::now();
        }

        $bHis->product_id=$p->id;
        $bHis->save();

        return redirect()->back()->with('info', 'The new item have been created.');
    }
    public function getRemoveItem($id){
        $pd=Product::whereId($id)->first();
        $sale_item=$pd->saleitem->count('id');
        if($sale_item > 0){
            return redirect()->back()->with('warning', "The selected item could not delete.");
        }
        $pd->delete();
        return redirect()->back()->with('info', 'The selected item have been deleted.');
    }
}
