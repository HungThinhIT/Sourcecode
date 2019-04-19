<?php

namespace App\Http\Controllers\AdminCP\SpaManagementSystem;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\AdminCPModel\SpaManagementSystem\Coupon;

class CouponController extends Controller
{
    public function showCoupon(){
    	$listCoupon = Coupon::all();
    	return view('admincp.spamanasys.Coupon.ListCoupon',compact('listCoupon'));
    }    

    public function showAddCoupon(){
    	return view('admincp.spamanasys.Coupon.AddCoupon');
    }


    public function addCoupon(Request $request){
    	if($request->ajax()){
    		$this->validate($request,
    			[
    				'couponCode' => 'required | unique:spams_coupon,CouponCode',
    				'dateStart' => 'required',
    				'dateExpired' => 'required',
    				'couponValue' => 'required | numeric',
    			],[
    				'couponCode.required' => 'Vui lòng nhập mã giảm giá',
    				'couponCode.unique' => 'Mã giảm giá đã tồn tại',
    				'dateStart.required' => 'Vui lòng nhập ngày bắt đầu',
    				'dateExpired.required' => 'Vui lòng nhập ngày kết thúc',
    				'couponValue.required' => 'Vui lòng nhập số tiền giảm',
    				'couponValue.numeric' => 'Số tiền giảm không hợp lệ',
    			]
    		);
    		$coupon = new Coupon();
    		$coupon->CouponCode = $request['couponCode'];
    		// $coupon->CouponDescription = $request['couponDescription'];
    		$coupon->CouponValue = $request['couponValue'];
    		$coupon->CouponDateStart = $request['dateStart'];
    		$coupon->CouponDateExpired = $request['dateExpired'];
    		$coupon->save();
    		return response()->json(array('status' => true,'msg' => "Thêm mã giảm giá thành công"));
    	}
    }

    public function showEditCoupon($idCoupon){
    	$coupon = Coupon::find($idCoupon);
    	return view('admincp.spamanasys.Coupon.EditCoupon',compact('coupon'));
    }

    public function editCoupon($idCoupon, Request $request){
    	if($request->ajax()){
    		$this->validate($request,
    			[
    				'couponCode' => 'required | unique:spams_coupon,CouponCode,'.$idCoupon.",CouponId",
    				'dateStart' => 'required',
    				'dateExpired' => 'required',
    				'couponValue' => 'required | numeric',
    			],[
    				'couponCode.required' => 'Vui lòng nhập mã giảm giá',
    				'couponCode.unique' => 'Mã giảm giá đã tồn tại',
    				'dateStart.required' => 'Vui lòng nhập ngày bắt đầu',
    				'dateExpired.required' => 'Vui lòng nhập ngày kết thúc',
    				'couponValue.required' => 'Vui lòng nhập số tiền giảm',
    				'couponValue.numeric' => 'Số tiền giảm không hợp lệ',
    			]
    		);
    		$coupon = Coupon::find($idCoupon);
    		$coupon->CouponCode = $request['couponCode'];
    		// $coupon->CouponDescription = $request['couponDescription'];
    		$coupon->CouponValue = $request['couponValue'];
    		$coupon->CouponDateStart = $request['dateStart'];
    		$coupon->CouponDateExpired = $request['dateExpired'];
    		$coupon->save();
    		return response()->json(array('status' => true,'msg' => "Cập nhật thành công"));
    	}
    }

    public function deleteCoupon($idCoupon) {
        Coupon::find($idCoupon)->delete();
        return back()->with('success_message','Xoá mã giảm giá thành công!');
    }
}
