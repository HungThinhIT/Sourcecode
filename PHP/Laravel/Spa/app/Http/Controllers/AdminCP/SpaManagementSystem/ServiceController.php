<?php

namespace App\Http\Controllers\AdminCP\SpaManagementSystem;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\AdminCPModel\SpaManagementSystem\Services;

class ServiceController extends Controller
{
    public function showListService() {
    	$listService = Services::all();
    	return view('admincp.spamanasys.Service.ListService', compact('listService'));
    }

    public function showAddService() {
    	return view('admincp.spamanasys.Service.AddService');
    }

    public function addService(Request $request) {
    	if($request->ajax()) {
    		$this->validate($request,
    			[
    				'servicename'			=>	'required|unique:spams_services,ServicesName',
    				'serviceprice'			=>	'required|numeric|min:0',
    			],
    			[
    				'servicename.required'	=>	'Tên dịch vụ không được để trống',
    				'servicename.unique'	=>	'Dịch vụ đã tồn tại',
    				'serviceprice.required'	=>	'Giá dịch vụ không được để trống',
    				'serviceprice.numeric'	=>	'Giá dịch vụ không hợp lệ',
    				'serviceprice.min'		=>	'Giá dịch vụ không hợp lệ',
    			]
    		);

    		$service = new Services();
    		$service->ServicesName			=	$request->servicename;
    		$service->ServicesDescription	=	$request->servicedescription;
    		$service->ServicesPrice			=	$request->serviceprice;

    		if($service->save() == true) {
    			return response()->json([
    				'status'=>	true,
    				'msg'	=>	'Thêm dịch vụ thành công.'
    			], 200);
    		}
    	}
    }

    public function showEditService($idService) {
    	$service = Services::find($idService);
    	return view('admincp.spamanasys.Service.EditService', compact('service'));
    }

    public function editService(Request $request, $idService) {
    	if($request->ajax()) {
    		$this->validate($request,
    			[
    				'servicename'			=>	'required|unique:spams_services,ServicesName,'.$idService.',ServicesId',
    				'serviceprice'			=>	'required|numeric|min:0',
    			],
    			[
    				'servicename.required'	=>	'Tên dịch vụ không được để trống',
    				'servicename.unique'	=>	'Dịch vụ đã tồn tại',
    				'serviceprice.required'	=>	'Giá dịch vụ không được để trống',
    				'serviceprice.numeric'	=>	'Giá dịch vụ không hợp lệ',
    				'serviceprice.min'		=>	'Giá dịch vụ không hợp lệ',
    			]
    		);

    		$check = Services::where('ServicesId',$idService)->update(array(
    			'ServicesName'			=>	$request->servicename,
    			'ServicesDescription'	=>	$request->servicedescription,
    			'ServicesPrice'			=>	$request->serviceprice,
    		));

    		if($check == true) {
    			return response()->json([
    				'status'	=>	true,
    				'msg'		=>	'Cập nhật thông tin dịch vụ thành công.'
    			], 200);
    		}
    	}
    }

    public function deleteService($idService) {
        $check = Services::find($idService)->delete();
        return back()->with('success_message','Xoá dịch vụ thành công!');
    }
}
