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



@section('titlePage','Danh sách nhân viên')
@section('headTitle','Danh sách nhân viên')
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
<div class="row">
	<div class="col-xl-12">
		<div class="m-content">
			@include('admincp.spamanasys.notifications.notifications')
			<div class="m-portlet m-portlet--mobile">
				<div class="m-portlet__head">
					<div class="m-portlet__head-caption">
						<div class="m-portlet__head-title">
							<h3 class="m-portlet__head-text" id="textTitle">
								Danh sách nhân viên
							</h3>
						</div>
					</div>
				</div>
				<div class="m-portlet__body">
					<!--begin: Search Form -->
					<div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
						<div class="row align-items-center">
							<div class="col-xl-8 order-2 order-xl-1">
								<div class="form-group m-form__group row align-items-center">
									<div class="col-xl-4 order-1 order-xl-2 m--align-left">
									</div>
									<div class="col-md-4">
										<div class="m-input-icon m-input-icon--left">
											<input type="text" class="form-control m-input m-input--solid" placeholder="Tìm kiếm..." id="generalSearch">
											<span class="m-input-icon__icon m-input-icon__icon--left">
												<span>
													<i class="la la-search"></i>
												</span>
											</span>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!--end: Search Form -->
					<!--begin: Datatable -->
					<table class="m-datatable" id="html_table" width="100%">
						<thead>
							<tr>
								<th>
									Mã giảm giá
								</th>
								<th>
									Mô tả
								</th>
								<th>
									Ngày bắt đầu
								</th>
								<th>
									Ngày kết thúc
								</th>
								<th>
									Số tiền giảm
								</th>
								<th>
									Tuỳ chọn
								</th>
							</tr>
						</thead>
						<tbody>
							@foreach($listCoupon as $value)
							<tr>
								<td>
									{{$value->CouponCode}}
								</td>
								<td>
									{{$value->CouponDescription}}
								<td>
									{{date("d-m-Y",strtotime($value->CouponDateStart))}}
								</td>
								<td>
									{{date("d-m-Y",strtotime($value->CouponDateExpired))}}
								</td>
								<td>
									{{number_format($value->CouponValue,0,",",".")." VNĐ"}}
								</td>
								<td>
									<a href="{{ route('spa_showEditCoupon',['id' => $value->CouponId]) }}" class="btn btn-info m-btn m-btn--icon btn-sm m-btn--icon-only  m-btn--pill" title="Chỉnh sửa">
										<i class="la la-folder"></i>
									</a>
									<button class="btn btn-danger m-btn m-btn--icon btn-sm m-btn--icon-only  m-btn--pill" data-toggle="modal" data-target="#modal_del" data-url="{{route('spa_deleteCoupon',['id'=>$value->CouponId])}}" data-title="{{$value->CouponCode}}" title="Xoá">
										<i class="fa fa-close"></i>
									</button>
								</td>
								@endforeach
							</tr>	
				</tbody>
					</table>
				<!--end: Datatable -->
			</div>
		</div>
	</div>


</div>
</div>
<div class="modal fade" id="modal_del" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">
					Xác nhận xoá mã coupons <b><span id="title-md-del"></span></b>
				</h5>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">
					Huỷ
				</button>
				<a class="btn btn-danger" id="at-del">
					Xoá
				</a>
			</div>
		</div>
	</div>
</div>
@endsection

@push('scripts')
<script src="js/javascript.js"></script>
<script src="assets/demo/default/custom/components/datatables/base/html-table.js" type="text/javascript"></script>
@endpush