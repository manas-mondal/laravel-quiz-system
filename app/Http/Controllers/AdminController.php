<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    function login(Request $r){

        $validation=$r->validate([
            'name'=>'required',
            'password'=>'required'
        ]);
        $admin=Admin::where(['name'=>$r->name,'password'=>$r->password])->first();
        if(!$admin){
            $validation=$r->validate([
                'user'=>'required'
            ],[
                "user.required"=>"User does not exist"
            ]);
        }
        Session::put('admin',$admin);
        return redirect('/dashboard',);
    }
    
    public function dashboard(){
        $admin=Session::get('admin');
        if($admin){
             return view('admin',compact('admin'));
           
        }else{
            return redirect('/admin-login');
        }
       
    }
    
    public function categories(){
        $admin=Session::get('admin');
        if($admin){
             return view('admin-categories',compact('admin'));
           
        }else{
            return redirect('/admin-login');
        }
    }

    public function logout(){
        Session::forget('admin');
        return redirect('/admin-login');
    }
}
