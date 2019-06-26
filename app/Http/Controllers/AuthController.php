<?php

namespace App\Http\Controllers;

use App\Userlogin;
use Illuminate\Http\Request;
use Auth;

class AuthController extends Controller
{
    public function getLogin(){
        return view ('auth.login');
    }
    public function postLogin(Request $request){
        $this->validate($request,[
            'name'=>'required|exists:users',
            'password'=>'required'
        ]);
        $name=$request['name'];
        $password=$request['password'];
        if(Auth::attempt(['name'=>$name, 'password'=>$password])){
            $u=new Userlogin();
            $u->user_id=Auth::user()->id;
            $u->user_state="login";
            $u->save();
            if(Auth::User()->hasRole('Cashier')){
                return redirect()->route('sale');
            }
            return redirect()->route('dashboard');

        }else{
            return redirect()->back()->with('error','User login failed.');
        }
    }
    public function getLogout(){
        $u=new Userlogin();
        $u->user_id=Auth::user()->id;
        $u->user_state="logout";
        $u->save();

        Auth::logout();
        return redirect()->route('login');
    }
}
