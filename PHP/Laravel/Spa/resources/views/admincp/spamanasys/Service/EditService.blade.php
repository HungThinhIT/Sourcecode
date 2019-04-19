@extends('admincp.spamanasys.master')

{{-- MENU BAR --}}

@section('MenuBar_DashBoard','m-menu__item')

@section('MenuBar_TitleBookingForCustomer','m-menu__item m-menu__item--submenu m-menu__item--open m-menu__item--expanded')
@section('MenuBar_BookingForCustomer','m-menu__item')
@section('MenuBar_ListCustomerBooking','m-menu__item')

@section('MenuBar_AddService','m-menu__item')
@section('MenuBar_ListService','m-menu__item m-menu__item--active')

@section('MenuBar_TitleCustomerMember','m-menu__item m-menu__item--submenu')
@section('MenuBar_AddCustomerMember','m-menu__item')
@section('MenuBar_ListCustomerMember','m-menu__item')

@section('MenuBar_TitleCoupon','m-menu__item m-menu__item--submenu')
@section('MenuBar_AddCoupon','m-menu__item')
@section('MenuBar_ListCoupon','m-menu__item')

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

@section('titlePage','Cập nhật dịch vụ')
@section('headTitle','Cập nhật dịch vụ')

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
								Thông tin dịch vụ
							</h3>
						</div>
					</div>
				</div>
				<!--begin::Form-->
				<form id="frmeditRoom" class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed">
					<div class="m-portlet__body">
						<div class="form-group m-form__group">
							<div class="row">
								<label class="col-lg-2 col-form-label">
									Tên dịch vụ:
								</label>
								<div class="col-lg-3">
									<input type="text" name="servicename" value="{{$service->ServicesName}}" class="form-control m-input">
									<span class="m-form__help servicename-error" style="color: red;font-weight: bold">
									</span>
								</div>
								<label class="col-lg-2 col-form-label">
									Mô tả dịch vụ:
								</label>
								<div class="col-lg-3">
									<input type="text" name="servicedescription" value="{{$service['ServicesDescription']}}" class="form-control m-input">
									<span class="m-form__help servicedescription-error" style="color: red;font-weight: bold">
									</span>
								</div>
							</div>
							<div class="row">
								<label class="col-lg-2 col-form-label">
									Giá dịch vụ:
								</label>
								<div class="col-lg-3">
									<input type="text" name="serviceprice" value="{{$service->ServicesPrice}}" class="form-control m-input">
									<span class="m-form__help serviceprice-error" style="color: red;font-weight: bold">
									</span>
								</div>
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
			url: '{{route('spa_editService',['id'=>$service->ServicesId])}}',
			type: 'POST',
			dataType: 'JSON',
			data:{
				servicename:  $('input[name="servicename"]').val(),
				servicedescription: $('input[name="servicedescription"]').val(),
				serviceprice: $('input[name="serviceprice"]').val(),
			},
			success: function(data){
				if(data.status == true){
					$('.servicename-error').text("");
					$('.servicedescription-error').text("");
					$('.serviceprice-error').text("");
					$('.alert-danger').hide();
					$('.alert-success').show();
					$('.m-alert-success__text').text(data.msg);
				}
			},
			error : function(data){
				$('.alert-success').hide();
				$('.alert-danger').show();
				$('.servicename-error').text("");
				$('.servicedescription-error').text("");
				$('.serviceprice-error').text("");
				$('.servicename-error').text(data.responseJSON.servicename);
				$('.servicedescription-error').text(data.responseJSON.servicedescription);
				$('.serviceprice-error').text(data.responseJSON.serviceprice);
			}
		});
	});
</script>
@endpush

@push('script_header')
<script src="js/jquery-3.3.1.min.js"></script>
@endpush