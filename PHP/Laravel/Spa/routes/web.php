<?php
use Illuminate\Support\Facades\Hash;

Route::get('/has/{id}',function($id){
	return Hash::make($id);
});
Route::group(['namespace'=>'Spa'], function() {
	Route::get('', 'PageController@getIndexPage')->name('home');
	Route::get('/reservation', 'PageController@getReservationPage')->name('contact');
	Route::get('/service', 'PageController@getServicesPage')->name('services');
	Route::get('/pricing', 'PageController@getPricingPage')->name('pricing');
	Route::get('/blog', 'PageController@getBlogPage')->name('blog');
	Route::get('/gallery', 'PageController@getGalleryPage')->name('gallery');
	Route::get('/post/{id}','PageController@getPostSinglePage')->name('post-single');
	Route::get('/service/{id}','PageController@getServiceSinglePage')->name('service-single');
	Route::post('/feedback','FeedbackController@postFeedbackPage')->name('feedback');
	Route::post('/comment','CommentController@postCommentPage')->name('comment');
	Route::get('/comment/{id}/{idpost}','CommentController@getCommentPage')->name('load-comment');
	Route::post('/reply','ReplyController@postReplyPage')->name('reply');
	Route::post('/reservation','PageController@postReservationPage')->name('reservation');
	Route::get('/getssreservation','PageController@getSessionReservation')->name('getSSreservation');

});

Route::group(['prefix' => 'admincp'],function(){
	
	Route::post('updateprofile/{id}','AdminCP\AdminCPController@updateProfile')->name('admincp_updateProfile');
	Route::post('changepassword/{id}','AdminCP\AdminCPController@changePassword')->name('admincp_changePassword');


	Route::get('/','AdminCP\AdminCPLogin@showLogin')->name('admincp_showLogin');
	Route::get('/login','AdminCP\AdminCPLogin@showLogin')->name('admincp_showLogin');
	Route::post('/login','AdminCP\AdminCPLogin@login')->name('admincp_Login');
	Route::get('/logout','AdminCP\AdminCPLogin@logout')->name('admincp_logout');

	Route::group(['prefix' => 'spamgmt','middleware' => 'admincp'],function(){
		Route::get('profile','AdminCP\AdminCPController@showProfile')->name('admincp_showProfile');

		Route::get('/','AdminCP\SpaManagementSystem\DashboardController@showDashBoard')->name('spa_showDashBoard');
		Route::get('/dashboard','AdminCP\SpaManagementSystem\DashboardController@showDashBoard')->name('spa_showDashBoard');
		Route::get('/jsonliststaff','AdminCP\SpaManagementSystem\DashboardController@responseJsonListStaff')->name('spa_responseJsonListStaff');
		Route::get('ajaxviewroom','AdminCP\SpaManagementSystem\DashboardController@ajaxViewRoom')->name('spa_DashboardAjaxViewRoom');

		Route::group(['prefix' => 'booking'],function(){
			Route::get('/booking','AdminCP\SpaManagementSystem\BookingForCustomerController@showBooking')->name('spa_showBooking');
			Route::get('ajaxservices','AdminCP\SpaManagementSystem\BookingForCustomerController@ajaxPriceServices')->name('spams_ajaxPriceServices');
			Route::get('/searchcusmember','AdminCP\SpaManagementSystem\BookingForCustomerController@searchCustomerMember')->name('spa_searchCusMemBook');
			Route::get('/jsoninfocusmember/{id}','AdminCP\SpaManagementSystem\BookingForCustomerController@jsonShowInfoCusMember')->name('jsonShowInfoCusMember');
			Route::post('/bookingCustomer','AdminCP\SpaManagementSystem\BookingForCustomerController@bookingCustomer')->name('spa_BookingCustomer');
			Route::post('/bookingCustomerMember','AdminCP\SpaManagementSystem\BookingForCustomerController@bookingCustomerMember')->name('spa_BookingCustomerMember');
			Route::get('/tablesearchcusmember','AdminCP\SpaManagementSystem\BookingForCustomerController@searchTableCustomerMember')->name('spa_searchTableCusMemBook');
		});
		
		
		Route::get('apidata','AdminCP\SpaManagementSystem\CustomerBookingController@showCustomer2')->name('spa_jsda1');



		Route::group(['prefix' => 'sessiontable'],function(){
			Route::get('/getsstablecustomer','AdminCP\SpaManagementSystem\SessionTableHandleController@getSessionCustomer')->name('spa_getSessionCustomer');
			Route::get('/getsstablestaff','AdminCP\SpaManagementSystem\SessionTableHandleController@getSessionStaff')->name('spa_getSessionStaff');
		});

		Route::group(['prefix' => 'customerbooking'],function(){
			Route::get('/customer','AdminCP\SpaManagementSystem\CustomerBookingController@showCustomer')->name('spa_showCustomer');
			Route::get('/cancel/{id}','AdminCP\SpaManagementSystem\CustomerBookingController@cancelCustomer')->name('spa_cancelCustomer');
			Route::get('/detailcustomer/{id}','AdminCP\SpaManagementSystem\CustomerBookingController@showDetail')->name('spa_showDetailCustomer');
			Route::get('/frmDetail/{id}','AdminCP\SpaManagementSystem\CustomerBookingController@showFormEditDetail')->name('spa_showfrmEditDetail');
			Route::post('/editcustomer','AdminCP\SpaManagementSystem\CustomerBookingController@editCustomer')->name('spa_editCustomer');
		});

		
		Route::group(['prefix' => 'checkout'],function(){
			Route::get('/checkout/{id}','AdminCP\SpaManagementSystem\CheckoutController@showCheckout')->name('spa_showCheckout');
			Route::get('/applycoupon','AdminCP\SpaManagementSystem\CheckoutController@applyCoupon')->name('spa_ApplyCoupon');
			Route::get('/getstockvalue','AdminCP\SpaManagementSystem\CheckoutController@getStockValueCoupon')->name('spa_getStockMoneyValue');
			Route::post('/checkoutcus/{id}','AdminCP\SpaManagementSystem\CheckoutController@checkout')->name('spa_checkout');
			Route::get('/checkoutcus/{id}','AdminCP\SpaManagementSystem\CheckoutController@redirectCheckoutCus');
			Route::get('/invoice/{member}/{id}','AdminCP\SpaManagementSystem\CheckoutController@printInvoice')->name('spa_printInvoice');
			Route::post('/showratingstaff/{id}','AdminCP\SpaManagementSystem\CheckoutController@showRatingStaff')->name('spa_showRatingStaff');
			Route::get('/getinfostaff/{id}','AdminCP\SpaManagementSystem\CheckoutController@getInforStaff')->name('spa_getinforstaff');
			Route::post('/setratingstaff/{id}','AdminCP\SpaManagementSystem\CheckoutController@setRatingStaff')->name('spa_setRatingStaff');
		});

		Route::group(['prefix' => 'customermember'],function(){
			Route::get('/addmember','AdminCP\SpaManagementSystem\CustomerMemberController@showAddCustomerMember')->name('spa_showAddMember');
			Route::post('/addmember','AdminCP\SpaManagementSystem\CustomerMemberController@addCustomerMember')->name('spa_addMember');
			Route::get('/listmember','AdminCP\SpaManagementSystem\CustomerMemberController@showListCustomerMember')->name('spa_showListCustomerMember');
			Route::get('/editmember/{id}','AdminCP\SpaManagementSystem\CustomerMemberController@showEditCustomerMember')->name('spa_showEditCustomerMember');
			Route::post('/editmember/{id}','AdminCP\SpaManagementSystem\CustomerMemberController@editCustomerMember')->name('spa_editCustomerMember');
			Route::get('/deletemember/{id}','AdminCP\SpaManagementSystem\CustomerMemberController@deleteCustomerMember')->name('spa_deleteCustomerMember');
		});

		Route::group(['prefix' => 'staff'],function(){
			Route::get('/addstaff','AdminCP\SpaManagementSystem\StaffController@showAddStaff')->name('spa_showAddStaff');
			Route::post('/addstaff','AdminCP\SpaManagementSystem\StaffController@addStaff')->name('spa_addStaff');
			Route::get('/liststaff','AdminCP\SpaManagementSystem\StaffController@showListStaff')->name('spa_showListStaff');
			Route::get('/editstaff/{id}','AdminCP\SpaManagementSystem\StaffController@showEditStaff')->name('spa_showEditStaff');
			Route::post('/editStaff/{id}','AdminCP\SpaManagementSystem\StaffController@editStaff')->name('spa_editStaff');
			Route::get('/deletestaff/{id}','AdminCP\SpaManagementSystem\StaffController@deleteStaff')->name('spa_deleteStaff');
		});

		Route::group(['prefix' => 'room'],function(){
			Route::get('/roomtype','AdminCP\SpaManagementSystem\RoomController@showRoomType')->name('spa_showRoomType');
			Route::post('/addroomtype','AdminCP\SpaManagementSystem\RoomController@addRoomType')->name('spa_addRoomType');
			Route::get('/editroomtype/{id}','AdminCP\SpaManagementSystem\RoomController@showEditRoomType')->name('spa_showEditRoomType');
			Route::post('/editroomtype/{id}','AdminCP\SpaManagementSystem\RoomController@editRoomType')->name('spa_editRoomType');
			Route::get('/listroom','AdminCP\SpaManagementSystem\RoomController@showListRoom')->name('spa_showListRoom');
			Route::get('/addroom','AdminCP\SpaManagementSystem\RoomController@showAddRoom')->name('spa_showAddRoom');
			Route::post('/addroom','AdminCP\SpaManagementSystem\RoomController@addRoom')->name('spa_addRoom');
			Route::get('/editroom/{id}','AdminCP\SpaManagementSystem\RoomController@showEditRoom')->name('spa_showEditRoom');
			Route::post('editroom/{id}','AdminCP\SpaManagementSystem\RoomController@editRoom')->name('spa_editRoom');
			Route::get('/deleteroomtype/{id}','AdminCP\SpaManagementSystem\RoomController@deleteRoomType')->name('spa_deleteRoomType');
			Route::get('/deleteroom/{id}','AdminCP\SpaManagementSystem\RoomController@deleteRoom')->name('spa_deleteRoom');
		});

		Route::group(['prefix' => 'coupon'],function(){
			Route::get('','AdminCP\SpaManagementSystem\CouponController@showCoupon')->name('spa_showListCoupon');
			Route::get('/add','AdminCP\SpaManagementSystem\CouponController@showAddCoupon')->name('spa_showAddCoupon');
			Route::post('/add','AdminCP\SpaManagementSystem\CouponController@addCoupon')->name('spa_addCoupon');
			Route::get('edit/{id}','AdminCP\SpaManagementSystem\CouponController@showEditCoupon')->name('spa_showEditCoupon');
			Route::post('edit/{id}','AdminCP\SpaManagementSystem\CouponController@editCoupon')->name('spa_editCoupon');
			Route::get('delete/{id}','AdminCP\SpaManagementSystem\CouponController@deleteCoupon')->name('spa_deleteCoupon');
		});

		Route::group(['prefix' => 'calendar'],function(){
			Route::get('','AdminCP\SpaManagementSystem\CalendarController@showCalendar')->name('spa_showCalendar');
			Route::get('/acceptedlist','AdminCP\SpaManagementSystem\CalendarController@showListAccepted')->name('spa_showAcceptedList');
			Route::get('/getajaxjsondata','AdminCP\SpaManagementSystem\CalendarController@getAjaxJsonCalendar')->name('spa_getAjaxJsonCalendar');
			Route::get('/accept/{id}','AdminCP\SpaManagementSystem\CalendarController@acceptCalendar')->name('spa_acceptCalendar');
			Route::get('/dendy/{id}','AdminCP\SpaManagementSystem\CalendarController@dendyCalendar')->name('spa_dendyCalendar');
			Route::get('/delete/{id}','AdminCP\SpaManagementSystem\CalendarController@deleteCalendar')->name('spa_deleteCalendar');
		});

		Route::group(['prefix' => 'service'], function() {
			Route::get('/list','AdminCP\SpaManagementSystem\ServiceController@showListService')->name('spa_showListService');
			Route::get('/addservice','AdminCP\SpaManagementSystem\ServiceController@showAddService')->name('spa_showAddService');
			Route::post('/addservice','AdminCP\SpaManagementSystem\ServiceController@addService')->name('spa_addService');
			Route::get('/editservice/{id}','AdminCP\SpaManagementSystem\ServiceController@showEditService')->name('spa_showEditService');
			Route::post('/editservice/{id}','AdminCP\SpaManagementSystem\ServiceController@editService')->name('spa_editService');
			Route::get('/deleteservice/{id}','AdminCP\SpaManagementSystem\ServiceController@deleteService')->name('spa_deleteService');
		});
	});

	Route::group(['prefix'=>'spacms','middleware' => 'admincp'], function() {
		Route::group(['prefix'=>''], function() {
			Route::get('/', 'Spacms\SpacmsController@getDashboard')->name('dashboard');
			Route::post('gdetail', 'Spacms\SpacmsController@postGDetail')->name('gallery-detail');
			Route::post('pdetail', 'Spacms\SpacmsController@postPDetail')->name('post-detail');
			Route::post('bdetail', 'Spacms\SpacmsController@postBDetail')->name('blog-detail');
			Route::post('sdetail', 'Spacms\SpacmsController@postSDetail')->name('service-detail');

			Route::post('gdetail/{id}', 'Spacms\SpacmsController@postNextGDetail')->name('next-gallery-detail');
			Route::post('pdetail/{id}', 'Spacms\SpacmsController@postNextPDetail')->name('next-post-detail');
			Route::post('bdetail/{id}', 'Spacms\SpacmsController@postNextBDetail')->name('next-blog-detail');
			Route::post('sdetail/{id}', 'Spacms\SpacmsController@postNextSDetail')->name('next-service-detail');

			Route::post('gdetail/{pre}/{next}', 'Spacms\SpacmsController@postPreGDetail')->name('pre-gallery-detail');
			Route::post('pdetail/{pre}/{next}', 'Spacms\SpacmsController@postPrePDetail')->name('pre-post-detail');
			Route::post('bdetail/{pre}/{next}', 'Spacms\SpacmsController@postPreBDetail')->name('pre-blog-detail');
			Route::post('sdetail/{pre}/{next}', 'Spacms\SpacmsController@postPreSDetail')->name('pre-service-detail');
			Route::post('rt', 'Spacms\SpacmsController@postRT')->name('rt');
		});

		Route::group(['prefix'=>'gallery'], function() {
			Route::get('/','Spacms\GallerycmsController@getGalleryCms')->name('gallery-cms');
			Route::get('/add','Spacms\GallerycmsController@getAddGallery')->name('get-add-gallery');
			Route::post('/add','Spacms\GallerycmsController@postAddGalleryCms')->name('add-gallery');
			Route::get('/delete/{id}','Spacms\GallerycmsController@deleteGalleryCms')->name('delete-gallery');
			Route::post('/edited','Spacms\GallerycmsController@postEditedGalleryCms')->name('edited-gallery');
			Route::get('/edit/{id}','Spacms\GallerycmsController@getEditGalleryCms')->name('edit-gallery');
		});

		Route::group(['prefix'=>'post'], function() {
			Route::get('/','Spacms\PostcmsController@getPostCms')->name('post-cms');
			Route::get('/add','Spacms\PostcmsController@getAddPostCms')->name('get-add-post');
			Route::post('/add','Spacms\PostcmsController@postAddPostCms')->name('post-add-post');
			Route::get('/edit/{id}','Spacms\PostcmsController@getEditPostCms')->name('get-edit-post');
			Route::post('/edit/{id}','Spacms\PostcmsController@postEditPostCms')->name('post-edit-post');
			Route::get('/delete/{id}','Spacms\PostcmsController@getDeletePostCms')->name('get-delete-post');
		});

		Route::group(['prefix'=>'blog'], function() {
			Route::get('/','Spacms\BlogcmsController@getBlogCms')->name('blog-cms');
			Route::get('/add','Spacms\BlogcmsController@getAddBlogCms')->name('get-add-blog');
			Route::post('/add','Spacms\BlogcmsController@postAddBlogCms')->name('post-add-blog');
			Route::get('/edit/{id}','Spacms\BlogcmsController@getEditBlogCms')->name('get-edit-blog');
			Route::post('/edit/{id}','Spacms\BlogcmsController@postEditBlogCms')->name('post-edit-blog');
			Route::get('/delete/{id}','Spacms\BlogcmsController@getDeleteBlogCms')->name('get-delete-blog');
		});

		Route::group(['prefix'=>'service'], function() {
			Route::get('/','Spacms\ServicecmsController@getServiceCms')->name('service-cms');
			Route::get('/add','Spacms\ServicecmsController@getAddServiceCms')->name('get-add-service');
			Route::post('/add','Spacms\ServicecmsController@postAddServiceCms')->name('post-add-service');
			Route::get('/edit/{id}','Spacms\ServicecmsController@getEditServiceCms')->name('get-edit-service');
			Route::post('/edit/{id}','Spacms\ServicecmsController@postEditServiceCms')->name('post-edit-service');
			Route::get('/delete/{id}','Spacms\ServicecmsController@getDeleteServiceCms')->name('get-delete-service');
			Route::get('/sync','Spacms\ServicecmsController@getSyncServiceCms')->name('get-sync-service');
		});

		Route::group(['prefix'=>'slider'], function() {
			Route::get('/','Spacms\SlidercmsController@getSliderCms')->name('slider-cms');
			Route::get('/add', 'Spacms\SlidercmsController@getAddSliderCms')->name('get-add-slider');
			Route::post('/add', 'Spacms\SlidercmsController@postAddSliderCms')->name('post-add-slider');
			Route::get('delete/{id}', 'Spacms\SlidercmsController@getDeleteSliderCms')->name('get-delete-slider');
		});

		Route::group(['prefix'=>'comment'], function() {
			Route::get('/','Spacms\CommentcmsController@getCommentCms')->name('comment-cms');
			Route::post('/detail','Spacms\CommentcmsController@postDetailCommentCms')->name('detail-comment-cms');
		});

		Route::group(['prefix'=>'feedback'], function() {
			Route::get('/','Spacms\FeedbackcmsController@getFeedbackCms')->name('feedback-cms');
		});
	});
});

