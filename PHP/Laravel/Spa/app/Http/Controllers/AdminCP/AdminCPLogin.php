<?php

namespace App\Http\Controllers\AdminCP;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminCPLogin extends Controller
{
    public function showLogin(){
		return view("admincp.login");
    }

    public function login(Request $request){
    	$this->validate($request,
    		[
    			'username' => "required",
    			'password' => "required",
    		],[
    			'username.required' => "Vui lòng nhập tên tài khoản",
    			'password.required' => "Vui lòng nhập mật khẩu"
    		]
    	);

    	$login = ['name' => $request['username'], 'password' => $request['password']];
    	if (Auth::attempt($login)) {
            // Authentication passed...
            if($request['type'] == "spamgmt"){
            	return redirect()->route('spa_showDashBoard');
            }
            if($request['type'] == "spacms"){
            	return redirect()->route('dashboard');
            }
            else{
            	return back()->withErrors("Hệ thống không tồn tại");
            }
        }
        else{
        	return back()->withErrors("Sai tài khoản hoặc mật khẩu");
        }
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('admincp_showLogin');
    }
}
