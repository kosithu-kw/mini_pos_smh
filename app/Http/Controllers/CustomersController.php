<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\Cash;
use Auth;

class CustomersController extends Controller
{
    /*
    public function postCashPaid(Request $request){
        $cash=$request['amount'];
        $c=new Cash();
        $c->user_id=Auth::User()->id;
        $c->amount=$cash;
        $c->customer_id=$request['customer_id'];
        $c->save();
        return redirect()->back()->with("info","The selected customer has been paid.");

    }
    */
    public function getCustomers(){
        $cus=Customer::get();
        return view ("admin.sales.customers")->with(['cus'=>$cus]);
    }
    public function postAddCustomer(Request $request){
        $this->validate($request,[
            'name'=>'required|unique:customers',
            'phone'=>'required',
            'address'=>'required'
        ]);
        $c=new Customer();
        $c->name=$request['name'];
        $c->phone=$request['phone'];
        $c->address=$request['address'];
        $c->save();
        return redirect()->back()->with('info', 'The new customer has been added.');

    }
    public function getDeleteCustomer($id){
        $c=Customer::where('id', $id)->first();
        $c->delete();
        return redirect()->back()->with('info', 'The selected customer has been deleted.');
    }
    public function postUpdateCustomer(Request $request){
        $id=$request['id'];
        $c=Customer::Where('id',$id)->first();
        $c->name=$request['name'];
        $c->phone=$request['phone'];
        $c->address=$request['address'];
        $c->update();
        return redirect()->back()->with('info', 'The selected customer has been updated.');
    }
    public function getCustomerDetail($id){
        $c=Customer::where('id', $id)->first();
        $credits=$c->credits;
        return view ("admin.sales.customer-detail")->with(['c'=>$c, 'credits'=>$credits]);
    }
}
