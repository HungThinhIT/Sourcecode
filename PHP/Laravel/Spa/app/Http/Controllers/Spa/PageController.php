<?php

namespace App\Http\Controllers\Spa;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Spa\Gallery;
use App\Spa\Service;
use App\Spa\ServiceType;
use App\Spa\Blog;
use App\Spa\Slider;
use App\Spa\Post;
use App\Spa\Customer;
use App\Spa\Feedback;
use App\Spa\Comment;
use App\Spa\Reply;
use App\Spa\Reservation;
use Carbon\Carbon;

class PageController extends Controller
{
    public function getIndexPage() {
        // $sliders = Slider::take(6)->get();
        $galleries = Gallery::take(6)->get();
        $blogs = Blog::take(3)->get();
        $services = Service::take(3)->get();
        $sall = Service::all();
        $svs = ServiceType::all();
        $posts = Post::take(3)->get();
        return view('spa.page.index',compact('galleries','blogs','services','posts','svs','sall'));
    }

    public function getReservationPage() {
        $services = ServiceType::all();
        $images = Gallery::take(2)->get();
        return view('spa.page.contact',compact('services', 'images'));
    }

    public function getServicesPage() {
        $galleries = Gallery::take(8)->get();
        $services = Service::all();
        $sliders = Slider::all();
        $svs = ServiceType::all();
        $id = rand(2,4);
        $service_hot = Blog::find($id)->get();
        return view('spa.page.services',compact('galleries','services','sliders','service_hot','svs'));
    }

    public function getPricingPage() {
        $service_img = Service::all();
        $services = ServiceType::all();
        $id = rand(2,4);
        $service_hot = Blog::find($id)->get();
        return view('spa.page.pricing',compact('services','service_hot','service_img'));
    }

    public function getBlogPage() {
        $blog = Blog::all();
        $posts = Post::paginate(3);
        $sliders = Slider::all();
        return view('spa.page.blog',compact('blog','posts','sliders'));
    }

    public function getGalleryPage() {
        $services = ServiceType::all();
        $galleries = Gallery::all();
        $id = rand(2,4);
        $service_hot = Blog::find($id)->get();
        return view('spa.page.gallery',compact('galleries','service_hot','services'));
    }

    public function getSignInPage() {
        return view('spa.page.login');
    }

    public function getSignUpPage() {
        return view('spa.page.registration');
    }

    public function getServiceSinglePage($id) {
        $service = Service::find($id);
        $services = Service::paginate(3);
        return view('spa.page.single_service',compact('service','services'));
    }

    public function getPostSinglePage($id) {
        $post = Post::find($id);
        $allComments = Comment::where('post_id',$id)->get();
        $comments = Comment::where('post_id',$id)->orderBy('id','desc')->take(4)->get();
        // $comments = Comment::where('post_id',$id)->get();
        $replies = Reply::all();
        if(count($allComments)>count($comments)) {
            $id_comment = 0;
            foreach($comments as $comment) {
                $id_comment = $comment->id;
            }
            return view('spa.page.single_post',compact('post','comments','replies','allComments','id_comment'));
        } else {
            $id_comment = 0;
            return view('spa.page.single_post',compact('post','comments','replies','allComments','id_comment'));
        }
    }

    public function sendSessionRequestReservation(){
        return session()->put('newReservation',"newReservation has been book");
    }

    public function postReservationPage(Request $req) {
        if($req->ajax()) {
            $dt = Carbon::tomorrow();
            $date_end = $dt->addWeek();
            $tomorrow = $dt->tomorrow();

            $this->validate($req,
              [
                  'reser_name'      =>  'required',
                  'reser_phone'     =>  'required',
                  'reser_email'     =>  'required|email',
                  'reser_date'      =>  'required|date|before:'.$date_end.'|after:'.$tomorrow,
                  'reser_service'   =>  'required',
                  'reser_gender'    =>  'required',
              ],
              [
                  'required'            =>':attribute không được để trống.',
                  'email'               =>':attribute không đúng định dạng.',
                  'date'                =>':attribute không đúng định dạng.',
                  'reser_date.before'   =>'Ngày sử dụng không vượt quá 1 tuần kể từ thời gian đặt.',
                  'reser_date.after'    =>'Ngày sử dụng phải cách 1 ngày kể từ ngày đặt.',
              ],
              [
                  'reser_name'      =>  'Họ Tên',
                  'reser_phone'     =>  'Số điện thoại',
                  'reser_email'     =>  'Email',
                  'reser_date'      =>  'Ngày đặt',
                  'reser_service'   =>  'Dịch vụ',
                  'reser_gender'    =>  'Giới tính',
              ]
            );
            $cus = new Reservation();
            $cus->ReservationCustomerName = $req->reser_name;
            $cus->ReservationCustomerPhoneNumber = $req->reser_phone;
            $cus->ReservationCustomerEmail = $req->reser_email;
            $cus->ReservationStart = $req->reser_date;
            $cus->ReservationService = $req->reser_service;
            $cus->ReservationCustomerGender = $req->reser_gender;
            $cus->ReservationDescription = $req->reser_message;
            $cus->ReservationClass = 'm-fc-event--warning';
            $cus->ReservationStatus = 'pending';
            if($cus->save() == true) {
                $this->sendSessionRequestReservation();
                return response()->json([
                    'success' => 'Đặt lịch thành công, bạn sẽ nhận được xác nhận từ nhân viên trong thời gian sớm nhất!'
                ], 200);
            } else {
                return response()->withErrors();
            }
        }
    }
	
	public function getSessionReservation(){
		if(session()->has('newReservation')){
				session()->forget('newReservation');
				return 1;
			}else{
				return 0;
		}
	}
}
