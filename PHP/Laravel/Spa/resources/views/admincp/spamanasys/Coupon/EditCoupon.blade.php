@extends('admincp.spamanasys.master')

{{-- MENU BAR --}}

@section('MenuBar_DashBoard','m-menu__item')

@section('MenuBar_TitleBookingForCustomer','m-menu__item m-menu__item--submenu')
@section('MenuBar_BookingForCustomer','m-menu__item')
@section('MenuBar_ListCustomerBooking','m-menu__item')

@section('MenuBar_AddService','m-menu__item')
@section('MenuBar_ListService','m-menu__item')

@section('MenuBar_TitleCustomerMember','m-menu__item m-menu__item--submenu')
@section('MenuBar_AddCustomerMember','m-menu__item')
@section('MenuBar_ListCustomerMember','m-menu__item')

@section('MenuBar_TitleCoupon','m-menu__item m-menu__item--submenu m-menu__item--open m-menu__item--expanded')
@section('MenuBar_AddCoupon','m-menu__item')
@section('MenuBar_ListCoupon','m-menu__item m-menu__item--active')

@section('MenuBar_TitleCalendar','m-menu__item m-menu__item--submenu')
@section('MenuBar_ShowCalendar','m-menu__item')
@section('MenuBar_ListAcceptedCalendar','m-menu__item')

@section('MenuBar_TitleRoomManagement','m-menu__item m-menu__item--submenu')
@section('MenuBar_TypeRoom','m-menu__item')
@section('MenuBar_AddRoom','m-menu__item')
@section('MenuBar_ListRoom','m-menu__item')

@section('MenuBar_TitleStaffManagement','m-menu__item m-menu__item--submenu')
@section('MenuBar_AddStaff','m-menu__item')
@section('MenuBar_ListStaff','m-menu__item')

{{-- END MENU BAR --}}

@section('titlePage','Cập nhật Mã giảm giá')
@section('headTitle','Cập nhật Mã giảm giá')
@section('typePage')
<ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
	<li class="m-nav__item m-nav__item--home">
		<a href="#" class="m-nav__link m-nav__link--icon">
			<i class="m-nav__link-icon la la-home"></i>
		</a>
	</li>
	<li class="m-nav__separator">
		-
	</li>
	<li class="m-nav__item">
		<a href="{{ route('spa_showDashBoard') }}" class="m-nav__link">
			<span class="m-nav__link-text">
				Bảng điều khiển
			</span>
		</a>
	</li>
	<li class="m-nav__separator">
		-
	</li>
	<li class="m-nav__item">
		<a href="{{ route('spa_showListCoupon') }}" class="m-nav__link">
			<span class="m-nav__link-text">
				Danh sách mã giảm giá
			</span>
		</a>
	</li>
</ul>
@endsection
@section('content')
<!--begin::Portlet-->
<div class="m-content">
	<div class="row">
		<div class="col-xl-12">
			@include('admincp.spamanasys.notifications.notificationsAjax')
			<div class="m-portlet">
				<div class="m-portlet__head">
					<div class="m-portlet__head-caption">
						<div class="m-portlet__head-title">
							<span class="m-portlet__head-icon m--hide">
								<i class="la la-gear"></i>
							</span>
							<h3 class="m-portlet__head-text">
								Thông tin mã giảm giá
							</h3>
						</div>
					</div>
				</div>
				<!--begin::Form-->
				<form id="frmEditCoupon" class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed">
					<div class="m-portlet__body">
						<div class="form-group m-form__group row">
							<label class="col-lg-2 col-form-label">
								Mã Coupon:
							</label>
							<div class="col-lg-3">
								<input type="text" name="couponcode" value="{{$coupon->CouponCode}}" class="form-control m-input">
								<span class="m-form__help couponcode-error" style="color: red;font-weight: bold">
								</span>
							</div>
							<label class="col-lg-2 col-form-label">
								Mô tả:
							</label>
							<div class="col-lg-3">
								<input type="text" name="coupondescription" value="{{$coupon->couponDescription}}" class="form-control m-input">
								<span class="m-form__help coupondescription-error" style="color: red;font-weight: bold">
								</span>
							</div>
						</div>
						<div class="form-group m-form__group row">
							<label class="col-lg-2 col-form-label">
								Ngày bắt đầu:
							</label>
							<div class="col-lg-3">
								<input type="datetime-local" name="datestart" value="{{date("Y-m-d\TH:i",strtotime($coupon->CouponDateStart))}}" min="{{Carbon\Carbon::now()->format("Y-m-d\TH:i")}}" class="form-control m-input">
								<span class="m-form__help datestart-error" style="color: red;font-weight: bold">
								</span>
							</div>
							<label class="col-lg-2 col-form-label">
								Ngày kết thúc:
							</label>
							<div class="col-lg-3">
								<input type="datetime-local" name="dateexpired" value="{{date("Y-m-d\TH:i",strtotime($coupon->CouponDateExpired))}}" min="{{Carbon\Carbon::now()->format("Y-m-d\TH:i")}}" class="form-control m-input">
								<span class="m-form__help dateexpired-error" style="color: red;font-weight: bold">
								</span>
							</div>
						</div>
						<div class="form-group m-form__group row">
							<label class="col-lg-2 col-form-label">
								Số tiền giảm:
							</label>
							<div class="col-lg-3">
								<input type="number" name="couponvalue" value="{{$coupon->CouponValue}}" class="form-control m-input">
								<span class="m-form__help couponvalue-error" style="color: red;font-weight: bold">
								</span>
							</div>
						</div>
					</div>
					<div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
						<div class="m-form__actions m-form__actions--solid">
							<div class="row">
								<div class="col-lg-2"></div>
								<div class="col-lg-10">
									<button type="button" id="submit" class="btn btn-success">
										Cập nhật
									</button>
									<button type="reset" class="btn btn-secondary">
										Làm lại
									</button>
								</div>
							</div>
						</div>
					</div>
				</form>
				<!--end::Form-->
			</div>

		</div>
	</div>
</div>
<!--end::Portlet-->

@endsection

@push('scripts')
<script type="text/javascript">
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	$("#submit").click(function(){
		$.ajax({
			url: '{{ route('spa_editCoupon',['id' => $coupon->CouponId]) }}',
			type: 'POST',
			dataType: 'JSON',
			data:{
				couponCode:  $('input[name="couponcode"]').val(),
				couponDescription:  $('input[name="coupondescription"]').val(),
				dateStart:  $('input[name="datestart"]').val(),
				dateExpired: $('input[name="dateexpired"]').val(),
				couponValue: $('input[name="couponvalue"]').val(),
			},
			success: function(data){
				if(data.status == true){
					$('.alert-danger').hide();
					$('.couponcode-error').text("");
					$('.coupondescription-error').text("");
					$('.datestart-error').text("");
					$('.dateexpired-error').text("");
					$('.couponvalue-error').text("");
					$('.alert-success').show();
					$('.m-alert-success__text').text(data.msg);
				}
			},
			error : function(data){
				$('.alert-success').hide();
				$('.alert-danger').show();
				$('.couponcode-error').text("");
				$('.coupondescription-error').text("");
				$('.datestart-error').text("");
				$('.dateexpired-error').text("");
				$('.couponvalue-error').text("");
				$('.couponcode-error').text(data.responseJSON.couponCode);
				$('.coupondescription-error').text(data.responseJSON.couponDescription);
				$('.datestart-error').text(data.responseJSON.dateStart);
				$('.dateexpired-error').text(data.responseJSON.dateExpired);
				$('.couponvalue-error').text(data.responseJSON.couponValue);
			}
		});
	});
</script>
@endpush

@push('script_header')
<script src="js/jquery-3.3.1.min.js"></script>
@endpush