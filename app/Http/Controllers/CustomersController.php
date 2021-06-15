<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\Paid;
use Auth;

class CustomersController extends Controller
{
    public function postCashPaid(Request $request){
       $this->validate($request,[
           'amount'=>'required'
       ]);
       
        $customer=Customer::where('id', $request['customer_id'])->first();
        $credits=$customer->credits;
        $oldTotalAmount=0;
        $oldPaidAmount=0;
        $oldDiscount=0;
        $oldRepaid=0;
        foreach($credits as $c){
          
                $oldTotalAmount += $c->total_amount;
                $oldPaidAmount +=$c->paid_cash;
                $oldDiscount += $c->discount;
                $oldRepaid += $c->re_paid;
           
        }     
        
        $oldCredit=$oldTotalAmount - ( $oldPaidAmount + $oldDiscount + $oldRepaid);       

        $pre_cash=$request['amount'];
        if($pre_cash > $oldCredit){
            $cash=$oldCredit;
        }else{
            $cash=$request['amount'];
        }
        $c=new Paid();
        $c->user_id=Auth::User()->id;
        $c->amount=$cash;
        $c->customer_id=$request['customer_id'];
        $c->ready_use=false;
        $c->save();
        return redirect()->back()->with("info","The selected customer has been paid.");

    }
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

        $credits=$c->credits->sum('credit_amount');

        if($credits > 0){
            return redirect()->back()->with('warning', "The selected customer has credit and cannot delete.");
        }



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
        $paids=$c->paids;
        return view ("admin.sales.customer-detail")->with(['c'=>$c, 'credits'=>$credits, 'paids'=>$paids]);
    }
}
