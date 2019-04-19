<?php

namespace App\Http\Controllers\AdminCP\SpaManagementSystem;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\AdminCPModel\SpaManagementSystem\Reservation;
use Carbon\Carbon;
class CalendarController extends Controller
{
    public function showCalendar(){
    	$json = $this->getjsonCalendar();
        // var_dump($json);
        // die();
    	return view('admincp.spamanasys.Calendar.Calendar',compact('json'));
    }

    public function showListAccepted(){
    	$listReservation = Reservation::where("ReservationStatus","accepted")->get();
        foreach ($listReservation as $key => $value) {
            $value->ReservationService = substr($value->ReservationService,0, -2);
            $value->ReservationService = str_replace(["[","]"]," ", $value->ReservationService);
            $value->ReservationService = str_replace(";",", ", $value->ReservationService);
            // $value->ReservationService = explode(";", $value->ReservationService);
        }
    	return view('admincp.spamanasys.Calendar.AcceptedListReservation',compact('listReservation'));
    }

    public function getjsonCalendar(){
    	// $jsonData = Reservation::where("ReservationStatus","pending")->orWhere("ReservationStatus","accepted")->get();
    	$jsonData = Reservation::all();
    	foreach ($jsonData as $key => $value) {
    		if($value->ReservationStatus == "pending"){
    			$value->ReservationStatus = "Chờ xác nhận";
    		}
    		if($value->ReservationStatus == "accepted"){
    			$value->ReservationStatus = "Đã xác nhận";
    		}
    		if($value->ReservationStatus == "dendy"){
    			$value->ReservationStatus = "Đã từ chối";
    		}
            $jsonData[$key]['Services'] =  str_replace(";","", $value->ReservationService);
            $value->ReservationService = substr($value->ReservationService,0, -2);
            $value->ReservationService = str_replace(["[","]"]," ", $value->ReservationService);
            $value->ReservationService = str_replace(";",", ", $value->ReservationService);
            // $value->ReservationService = explode(";", $value->ReservationService);
    	}
    	return $jsonData;
    }

    public function getAjaxJsonCalendar(Request $request){
        if($request->ajax()){
            $jsonData = Reservation::take(10)->orderBy("ReservationId", "desc")->get();
            foreach ($jsonData as $key => $value) {
                if($value->ReservationStatus == "pending"){
                    $value->ReservationStatus = "Chờ xác nhận";
                    $value->ReservationClass = "m-badge--warning";
                }
                if($value->ReservationStatus == "accepted"){
                    $value->ReservationStatus = "Đã xác nhận";
                    $value->ReservationClass = "m-badge--success";
                }
                if($value->ReservationStatus == "dendy"){
                    $value->ReservationStatus = "Đ từ chối";
                    $value->ReservationClass = "m-badge--danger";
                }
                $jsonData[$key]['datetime'] =  $value->updated_at->diffForHumans();
            }

            return response()->json($jsonData);
        }
    }

    public function acceptCalendar($idReservation){
    	$reservation = Reservation::find($idReservation);
    	$reservation->ReservationStatus = "accepted";
    	$reservation->ReservationClass = "m-fc-event--success";
    	$reservation->save();
    	return back()->with('success_message','Xác nhận thành công');
    }

    public function dendyCalendar($idReservation){
    	$reservation = Reservation::find($idReservation);
    	$reservation->ReservationStatus = "dendy";
    	$reservation->ReservationClass = "m-fc-event--danger";
    	$reservation->save();
    	return back()->with('success_message','Từ chối thành công');
    }

    public function deleteCalendar($idReservation) {
        Reservation::find($idReservation)->delete();
        return back()->with('success_message','Xoá lịch hẹn thành công!');
    }

}
