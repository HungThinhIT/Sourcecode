@extends('admincp.spamanasys.master')

{{-- MENU BAR --}}

@section('MenuBar_DashBoard','m-menu__item')

@section('MenuBar_TitleBookingForCustomer','m-menu__item m-menu__item--submenu')
@section('MenuBar_BookingForCustomer','m-menu__item')
@section('MenuBar_ListCustomerBooking','m-menu__item')
@section('MenuBar_ListService','m-menu__item')
@section('MenuBar_AddService','m-menu__item')

@section('MenuBar_TitleCustomerMember','m-menu__item m-menu__item--submenu')
@section('MenuBar_AddCustomerMember','m-menu__item')
@section('MenuBar_ListCustomerMember','m-menu__item')

@section('MenuBar_TitleCoupon','m-menu__item m-menu__item--submenu')
@section('MenuBar_AddCoupon','m-menu__item')
@section('MenuBar_ListCoupon','m-menu__item')

@section('MenuBar_TitleCalendar','m-menu__item m-menu__item--submenu m-menu__item--open m-menu__item--expanded')
@section('MenuBar_ShowCalendar','m-menu__item m-menu__item--active')
@section('MenuBar_ListAcceptedCalendar','m-menu__item')

@section('MenuBar_TitleRoomManagement','m-menu__item m-menu__item--submenu')
@section('MenuBar_TypeRoom','m-menu__item')
@section('MenuBar_AddRoom','m-menu__item')
@section('MenuBar_ListStaff','m-menu__item')

@section('MenuBar_TitleStaffManagement','m-menu__item m-menu__item--submenu')
@section('MenuBar_AddStaff','m-menu__item')
@section('MenuBar_ListStaff','m-menu__item')

{{-- END MENU BAR --}}

@section('titlePage','Danh sách đặt lịch')
@section('headTitle','Danh sách đặt lịch')
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
		<a href="{{ route('spa_showCalendar') }}" class="m-nav__link">
			<span class="m-nav__link-text">
				Danh sách khách hàng đặt lịch
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
			@include('admincp.spamanasys.notifications.notifications')
			<!--begin::Form-->
			<div class="m-content">
				<div class="row">
					<div class="col-lg-12">
						<!--begin::Portlet-->
						<div class="m-portlet" id="m_portlet">
							<div class="m-portlet__head">
								<div class="m-portlet__head-caption">
									<div class="m-portlet__head-title">
										<span class="m-portlet__head-icon">
											<i class="flaticon-calendar"></i>
										</span>
										<h3 class="m-portlet__head-text">
											Danh sách đặt lịch
										</h3>
									</div>
								</div>
							</div>
							<div class="m-portlet__body">
								<div id="m_calendar"></div>
							</div>
						</div>
						<!--end::Portlet-->
					</div>
				</div>
			</div>
			<!--end::Form-->

		</div>
	</div>
</div>
<!--end::Portlet-->
@endsection

@push('scripts')
<script src="assets/vendors/custom/fullcalendar/fullcalendar.bundle.js" type="text/javascript"></script>
<script src="assets/vendors/custom/fullcalendar/locale/vi.js" type="text/javascript"></script>

<script type="text/javascript">
	var CalendarListView = {
		init: function() {
			var t = moment().startOf("day"),
			e = t.format("YYYY-MM"),
			i = t.clone().subtract(1, "day").format("YYYY-MM-DD"),
			r = t.format("YYYY-MM-DD"),
			n = t.clone().add(1, "day").format("YYYY-MM-DD");
			$("#m_calendar").fullCalendar({
				header: {
					left: "prev,next today",
					center: "title",
					right: "month,agendaDay,listWeek"
				},
				locale: 'vi',
				defaultView: "listWeek",
				editable: false,
				eventLimit: !0,
				navLinks: !0,
				height: 900,
				events: [
				@foreach($json as $value)
				{
					id: "{{$value->ReservationId}}",
					title: "{{$value->ReservationCustomerName}} {{"[".$value->ReservationStatus."]"}}",
					// url: 'http://google.com/',
					start: "{{$value->ReservationStart}}",
					end: "{{$value->ReservationStart}}",
					description: "{{"Dịch vụ: ".$value->ReservationService}} <br> {{"Mô tả: ".$value->ReservationDescription}}",
					className: "{{$value->ReservationClass}}",
				},
				@endforeach
				],
				eventRender: function(t, e) {
					if(t.className == "m-fc-event--warning") {
						e.hasClass("fc-day-grid-event") ? (e.data("content", t.description), e.data("placement", "top"), mApp.initPopover(e)) : e.hasClass("fc-time-grid-event") ? e.find(".fc-title").append('<div class="fc-description">' + t.description + "</div>") : 0 !== e.find(".fc-list-item-title").lenght && e.find(".fc-list-item-title").append('<div class="fc-description">' + t.description + "</div>").append("<a style='color:white' title='Chấp thuận' href='{{route("spa_acceptCalendar",['id' => ''])}}/"+ t.id +"' class='btn btn-success m-btn m-btn--icon btn-sm m-btn--icon-only'><i class='fa flaticon-user-ok'></i></a> <a style='color:white' title='Loại bỏ' href='{{route("spa_dendyCalendar",['id' => ''])}}/"+ t.id +"' class='btn btn-danger m-btn m-btn--icon btn-sm m-btn--icon-only'><i class='fa flaticon-circle'></i></a>");
					}
					else{
						e.hasClass("fc-day-grid-event") ? (e.data("content", t.description), e.data("placement", "top"), mApp.initPopover(e)) : e.hasClass("fc-time-grid-event") ? e.find(".fc-title").append('<div class="fc-description">' + t.description + "</div>") : 0 !== e.find(".fc-list-item-title").lenght && e.find(".fc-list-item-title").append('<div class="fc-description">' + t.description + "</div>");
					}
					
				},
			})
		}
	};
	jQuery(document).ready(function() {
		CalendarListView.init();
	});
</script>
@endpush

@push('script_header')
<script src="js/jquery-3.3.1.min.js"></script>
@endpush