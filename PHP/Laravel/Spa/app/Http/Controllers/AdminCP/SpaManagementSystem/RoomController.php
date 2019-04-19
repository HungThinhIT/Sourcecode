<?php

namespace App\Http\Controllers\AdminCP\SpaManagementSystem;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\AdminCPModel\SpaManagementSystem\Room;
use App\AdminCPModel\SpaManagementSystem\RoomType;
use App\AdminCPModel\SpaManagementSystem\CustomerBooking;


class RoomController extends Controller
{
	public function showListRoom(){
		$listRoom = Room::where("RoomId",">",1)->get();
    	return view('admincp.spamanasys.Room.ListRoom',compact('listRoom'));
	}

    public function showRoomType(){
    	$listRoomType = RoomType::where("RoomTypeId",">",1)->get();
    	return view('admincp.spamanasys.Room.RoomType',compact('listRoomType'));
    }

    public function addRoomType(Request $request){
    	$this->validate($request,
    		[
    			'roomtypename' => 'required | unique:spams_roomtype,RoomTypeName',
    			'roomtypecapacity' => 'required | numeric | min: 1'
    		],
    		[
    			'roomtypename.required' => "Vui lòng nhập vào tên loại phòng",
    			'roomtypename.unique' => "Tên loại phòng đã tồn tại",
    			'roomtypecapacity.required' => "Vui lòng nhập sức chứa",
    			'roomtypecapacity.numeric' => "Sức chứa phải là số",
    			'roomtypecapacity.min' => "Sức chứa phải lớn hơn 0",
    		]);
    		$roomType = new RoomType();
    		$roomType->RoomTypeName = $request['roomtypename'];
    		$roomType->RoomTypeCapacity = $request['roomtypecapacity'];
    		$roomType->save();
    		return response()->json(array('status' => true,'msg' => "Thêm mới loại phòng ".$request['roomtypename']." thành công"));
    }

    public function showEditRoomType($idRoomType){
    	$roomType = RoomType::find($idRoomType);
    	return view("admincp.spamanasys.Room.EditRoomType",compact('roomType'));

    }

    public function editRoomType($idRoomType, Request $request){
    	if($request->ajax()){
    		$this->validate($request,
    			[
    				'roomtypename' => 'required | unique:spams_roomtype,RoomTypeName,'.$idRoomType.',RoomTypeId',
    				'roomtypecapacity' => 'required | numeric | min: 1'
    			],
    			[
    				'roomtypename.required' => "Vui lòng nhập vào tên loại phòng",
    				'roomtypename.unique' => "Tên loại phòng đã tồn tại",
    				'roomtypecapacity.required' => "Vui lòng nhập sức chứa",
    				'roomtypecapacity.numeric' => "Sức chứa phải là số",
    				'roomtypecapacity.min' => "Sức chứa phải lớn hơn 0",
    			]);
    		$roomType = RoomType::find($idRoomType);
    		$roomType->RoomTypeName = $request['roomtypename'];
    		$roomType->RoomTypeCapacity = $request['roomtypecapacity'];
    		$roomType->save();
    		return response()->json(array('status' => true,'msg' => "Cập nhật loại phòng ".$request['roomtypename']." thành công"));
    	}
    }

    public function showAddRoom(){
    	$listRoomType = RoomType::where("RoomTypeId",">",1)->get();
    	return view('admincp.spamanasys.Room.AddRoom',compact('listRoomType'));
    }

    public function addRoom(Request $request){
    	if($request->ajax()){
    		$this->validate($request,[
    			'roomname' => "required | unique:spams_room,RoomName",
    			'roomtype' => "required"
    		],
    		[
    			'roomname.required' => "Vui lòng nhập tên phòng",
    			'roomname.unique' => "Tên phòng đã tồn tại",
    			'roomtype.required' => "Vui lòng chọn loại phòng"
    		]);

    		if(!RoomType::find($request['roomtype'])->exists()){
    			return response()->withErrors("Loại phòng không tồn tại");
    		}else{
	    		$room = new Room();
	    		$room->RoomTypeId = $request['roomtype'];
	    		$room->RoomName = $request['roomname'];
	    		$room->RoomBlank = RoomType::where("RoomTypeId","=",$request['roomtype'])->value("RoomTypeCapacity");
	    		$room->save();
	    		return response()->json(array('status' => true,'msg' => "Tạo phòng ".$request['roomname']." thành công"));
    		}
    	}
    }

    public function showEditRoom($idRoom){
    	$room = Room::find($idRoom);
    	$listRoomType = RoomType::where("RoomTypeId",">",1)->get();
    	return view('admincp.spamanasys.Room.EditRoom',compact('room','listRoomType'));
    }

    public function editRoom(Request $request,$idRoom){
    	if($request->ajax()){
    		$this->validate($request,[
    			'roomname' => "required | unique:spams_room,RoomName,".$idRoom.",RoomId",
    			'roomtype' => "required"
    		],
    		[
    			'roomname.required' => "Vui lòng nhập tên phòng",
    			'roomname.unique' => "Tên phòng đã tồn tại",
    			'roomtype.required' => "Vui lòng chọn loại phòng"
    		]);

    		if(!RoomType::find($request['roomtype'])->exists()){
    			return response()->withErrors("Loại phòng không tồn tại");
    		}else{
	    		$room = Room::find($idRoom);
	    		$room->RoomTypeId = $request['roomtype'];
	    		$room->RoomName = $request['roomname'];
	    		$room->save();
	    		return response()->json(array('status' => true,'msg' => "Cập nhật phòng ".$request['roomname']." thành công"));
    		}
    	}
    }


    public function deleteRoomType($idRoomType) {
        $aRoom = Room::where('RoomTypeId','=',$idRoomType)->get();
        if(count($aRoom) > 0) {
            return back()->withErrors('Vui lòng chuyển những phòng đang sử dụng loại phòng "'.$roomtype->RoomTypeName.'" qua các loại phòng khác để tiếp tục xoá!');
        } else {
            RoomType::find($idRoomType)->delete();
            return back()->with('success_message','Xoá loại phòng thành công!');
        }
    }

    public function deleteRoom($idRoom) {
        $customers = CustomerBooking::where('RoomId','=',$idRoom)->get();
        if(count($customers) > 0) {
            return back()->withErrors('Đang có khách sử dụng dịch vụ, không thể xoá phòng!');
        } else {
            Room::find($idRoom)->delete();
            return back()->with('success_message','Xoá phòng thành công!');
        }
    }

}
