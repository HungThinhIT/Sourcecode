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

@section('MenuBar_TitleCoupon','m-menu__item m-menu__item--submenu')
@section('MenuBar_AddCoupon','m-menu__item')
@section('MenuBar_ListCoupon','m-menu__item')

@section('MenuBar_TitleCalendar','m-menu__item m-menu__item--submenu')
@section('MenuBar_ShowCalendar','m-menu__item')
@section('MenuBar_ListAcceptedCalendar','m-menu__item')

@section('MenuBar_TitleRoomManagement','m-menu__item m-menu__item--submenu m-menu__item--open m-menu__item--expanded')
@section('MenuBar_TypeRoom','m-menu__item m-menu__item--active')
@section('MenuBar_AddRoom','m-menu__item')
@section('MenuBar_ListRoom','m-menu__item')


@section('MenuBar_TitleStaffManagement','m-menu__item m-menu__item--submenu')
@section('MenuBar_AddStaff','m-menu__item')
@section('MenuBar_ListStaff','m-menu__item')

{{-- END MENU BAR --}}

@section('titlePage','Loại phòng')
@section('headTitle','Loại phòng')
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
		<a href="{{ route('spa_showRoomType') }}" class="m-nav__link">
			<span class="m-nav__link-text">
				Tuỳ chỉnh loại phòng
			</span>
		</a>
	</li>
</ul>
@endsection
@section('content')
<div class="m-content">
	<!--Begin::Main Portlet-->
	<div class="row">
		<div class="col-xl-6">
			@include('admincp.spamanasys.notifications.notificationsAjax')
			<!--begin:: Widgets/Best Sellers-->
			<div class="m-portlet m-portlet--full-height " >
				<div class="m-portlet__head">
					<div class="m-portlet__head-caption">
						<div class="m-portlet__head-title">
							<h3 class="m-portlet__head-text">
								TẠO MỚI LOẠI PHÒNG
							</h3>
						</div>
					</div>
				</div>
				<form id="addRoomType" class="m-form m-form--fit m-form--label-align-right">	
					<div class="m-portlet__body">
						<div class="form-group m-form__group">
							<label>
								Tên loại phòng
							</label>
							<input name="roomtypename" type="text" class="form-control m-input">
							<span class="m-form__help roomtypename-error" style="color: red;font-weight: bold"></span>
						</div>
						<div class="form-group m-form__group">
							<label>
								Sức chứa
							</label>
							<input name="roomtypecapacity" type="number" class="form-control m-input">
							<span class="m-form__help roomtypecapacity-error" style="color: red;font-weight: bold">
								</span>
						</div>
					</div>
					<div class="m-portlet__foot m-portlet__foot--fit">
						<div class="m-form__actions">
							<button type="button" id="submit" class="btn btn-primary">
								Tạo mới
							</button>
							<button type="reset" class="btn btn-secondary">
								Làm lại
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
		<!--end:: Widgets/Best Sellers-->
		<div class="col-xl-6">
			<!--begin:: Widgets/Authors Profit-->
			<div class="m-portlet">
			@include('admincp.spamanasys.notifications.notifications')
				<div class="m-portlet__head">
					<div class="m-portlet__head-caption">
						<div class="m-portlet__head-title">
							<h3 class="m-portlet__head-text">
								DANH SÁCH LOẠI PHÒNG
							</h3>
						</div>
					</div>
				</div>
				<div class="m-portlet__body">
					<table class="m-datatable" id="html_table" width="100%">
						<thead>
							<tr>
								<th>
									Tên loại phòng
								</th>
								<th>
									Sức chứa
								</th>
								<th>
									Tuỳ chọn
								</th>
							</tr>
						</thead>
						<tbody>
							@foreach($listRoomType as $value)
							<tr>
								<td>
									{{$value->RoomTypeName}}
								</td>
								<td>
									{{$value->RoomTypeCapacity}}
								</td>
								<td>
									<a href="{{ route('spa_showEditRoomType',['id' => $value->RoomTypeId]) }}" class="btn btn-info m-btn m-btn--icon btn-sm m-btn--icon-only  m-btn--pill" title="Chỉnh sửa">
										<i class="la la-folder"></i>
									</a>
									<button class="btn btn-danger m-btn m-btn--icon btn-sm m-btn--icon-only  m-btn--pill" data-toggle="modal" data-target="#modal_del" data-url="{{route('spa_deleteRoomType',['id'=>$value->RoomTypeId])}}" data-title="{{$value->RoomTypeName}}" title="Xoá">
										<i class="fa fa-close"></i>
									</button>
								</td>
							</tr>	
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
			<!--end:: Widgets/Authors Profit-->
		</div>
	</div>
</div>
<div class="modal fade" id="modal_del" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">
					Xác nhận xoá loại phòng <b><span id="title-md-del"></span></b>
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
<script type="text/javascript">
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	$("#submit").click(function(){
		$.ajax({
			url: '{{ route('spa_addRoomType') }}',
			type: 'POST',
			dataType: 'JSON',
			data:{
				roomtypename:  $('input[name="roomtypename"]').val(),
				roomtypecapacity:  $('input[name="roomtypecapacity"]').val(),
			},
			success: function(data){
				if(data.status == true){
					$('.roomtypename-error').text("");
					$('.roomtypecapacity-error').text("");
					$('.alert-danger').hide();
					$('.alert-success').show();
					$('.m-alert-success__text').text(data.msg);
					$("#addRoomType")[0].reset();
				}
			},
			error : function(data){
				$('.alert-success').hide();
				$('.alert-danger').show();
				$('.roomtypename-error').text("");
				$('.roomtypecapacity-error').text("");
				$('.roomtypename-error').text(data.responseJSON.roomtypename);
				$('.roomtypecapacity-error').text(data.responseJSON.roomtypecapacity);
			}
		});
	});
</script>
<script src="js/javascript.js"></script>
<script src="assets/demo/default/custom/components/datatables/base/html-table.js" type="text/javascript"></script>
@endpush

@push('script_header')
	<script src="js/jquery-3.3.1.min.js"></script>
@endpush