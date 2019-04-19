<?php

namespace App\Http\Controllers\AdminCP;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\User;
class AdminCPController extends Controller
{
    public function showProfile(){
    	return view("admincp.spamanasys.profile");
    }

    public function updateProfile($idUser,Request $request){
    	$this->validate($request,
    		[
    			'name' => 'required | min: 1 | max: 30 | unique:admincp_users,name,'.$idUser.',id',
    			'email' => 'required | email | unique:admincp_users,email,'.$idUser.',id',
    			'phonenumber' => 'numeric | unique:admincp_users,phonenumber,'.$idUser.',id',
			],[
				'name.required' => 'Bạn chưa nhập tên tài khoản',
				'name.min' => 'Tên tài khoản phải ít nhất kí tự',
				'name.max' => 'Tên tài khoản chỉ được dài 30 ký tự',
				'name.unique' => 'Tên tài khoản đã tồn tại',
				'email.required' => 'Bạn chưa nhập email',
				'email.email' => 'Địa chỉ email không hợp lệ',
				'email.unique' => 'Địa chỉ Email đã tồn tại',
				'phonenumber.numeric' => "Số điện thoại không hợp lệ",
				'phonenumber.unique' => "Số điện thoại đã tồn tại"
			]);
    	$user = User::find($idUser);
    	$user->name = $request['name'];
    	$user->email = $request['email'];
    	$user->phonenumber = $request['phonenumber'];
    	$user->save();
    	return back()->with("success_message","Cập nhật thành công");
    }

    public function changePassword($idUser,Request $request){
    	$this->validate($request,
    		[
    			'old_password' => 'required',
    			'password' => 'required_with:password_confirmation|confirmed | min:5',
    			'password_confirmation' => 'required'
    		],[
    			'old_password.required' => 'Vui lòng nhập mật khẩu cũ',
    			'password.same' => 'Mật khẩu xác nhận không giống',
    			'password.min' => 'Mật khẩu phải ít nhất 5 ký tự',
    			'password_confirmation.required' => 'Vui lòng nhập mật khẩu xác nhận',
    		]
    	);
    	$user = User::find($idUser);
    	if(Hash::check($request['old_password'],$user->password)){
    		$user->password = Hash::make($request['password']);
    		$user->save();
    		return back()->with('success_message','Thay đổi mật khẩu mới thành công');
    	}else{
    		return back()->withErrors("Mật khẩu cũ không đúng");
    	}

    }
}
