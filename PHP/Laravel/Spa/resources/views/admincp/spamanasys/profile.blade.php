@extends('admincp.spamanasys.master')

{{-- MENU BAR --}}

@section('MenuBar_DashBoard','m-menu__item m-menu__item--active')

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

@section('MenuBar_TitleRoomManagement','m-menu__item m-menu__item--submenu')
@section('MenuBar_TypeRoom','m-menu__item')
@section('MenuBar_AddRoom','m-menu__item')
@section('MenuBar_ListRoom','m-menu__item')

@section('MenuBar_TitleStaffManagement','m-menu__item m-menu__item--submenu')
@section('MenuBar_AddStaff','m-menu__item')
@section('MenuBar_ListStaff','m-menu__item')

{{-- END MENU BAR --}}



@section('titlePage','Tài khoản')
@section('headTitle','Tài khoản')


@section('content')
<div class="m-content">
	<div class="row">
		<div class="col-xl-3 col-lg-4">
			<div class="m-portlet m-portlet--full-height  ">
				<div class="m-portlet__body">
					<div class="m-card-profile">
						<div class="m-card-profile__title m--hide">
							Your Profile
						</div>
						<div class="m-card-profile__pic">
							<div class="m-card-profile__pic-wrapper">
								<img src="assets/app/media/img/users/user4.jpg" alt="">
							</div>
						</div>
						<div class="m-card-profile__details">
							<span class="m-card-profile__name">
								{{Auth::user()->name}}
							</span>
							<a href="{{$rootURL}}" class="m-card-profile__email m-link">
								{{Auth::user()->email}}
							</a>
						</div>
					</div>

					<div class="m-portlet__body-separator"></div>
				</div>
			</div>
		</div>
		<div class="col-xl-9 col-lg-8">
			@include('admincp.spamanasys.notifications.notifications')
			<div class="m-portlet m-portlet--full-height m-portlet--tabs  ">
				<div class="m-portlet__head">
					<div class="m-portlet__head-tools">
						<ul class="nav nav-tabs m-tabs m-tabs-line   m-tabs-line--left m-tabs-line--primary" role="tablist">
							<li class="nav-item m-tabs__item">
								<a class="nav-link m-tabs__link active" data-toggle="tab" href="#m_user_profile_tab_1" role="tab">
									<i class="flaticon-share m--hide"></i>
									Cập nhật thông tin
								</a>
							</li>
							<li class="nav-item m-tabs__item">
								<a class="nav-link m-tabs__link" data-toggle="tab" href="#m_user_profile_tab_2" role="tab">
									Thay đổi mật khẩu
								</a>
							</li>
						</ul>
					</div>
				</div>
				<div class="tab-content">
					<div class="tab-pane active" id="m_user_profile_tab_1">
						<form action="{{ route('admincp_updateProfile',['id' => Auth::user()->id]) }}" method="POST" class="m-form m-form--fit m-form--label-align-right">
							{{csrf_field()}}
							<div class="m-portlet__body">
								<div class="form-group m-form__group row">
									<label for="example-text-input" class="col-2 col-form-label">
										Tên tài khoản
									</label>
									<div class="col-7">
										<input class="form-control m-input" name="name" type="text" value="{{Auth::user()->name}}">
									</div>
								</div>
								<div class="form-group m-form__group row">
									<label for="example-text-input" class="col-2 col-form-label">
										Email
									</label>
									<div class="col-7">
										<input class="form-control m-input" name="email" type="email" value="{{Auth::user()->email}}">
									</div>
								</div>
								<div class="form-group m-form__group row">
									<label for="example-text-input" class="col-2 col-form-label">
										Số điện thoại
									</label>
									<div class="col-7">
										<input class="form-control m-input" name="phonenumber" type="text" value="{{Auth::user()->phonenumber}}">
									</div>
								</div>
							</div>
							<div class="m-portlet__foot m-portlet__foot--fit">
								<div class="m-form__actions">
									<div class="row">
										<div class="col-2"></div>
										<div class="col-7">
											<button type="submit" class="btn btn-accent m-btn m-btn--air m-btn--custom">
												Cập nhật
											</button>
											&nbsp;&nbsp;
											<button type="reset" class="btn btn-secondary m-btn m-btn--air m-btn--custom">
												Cancel
											</button>
										</div>
									</div>
								</div>
							</div>
						</form>
					</div>
					<div class="tab-pane" id="m_user_profile_tab_2" aria-expanded="false">
						<form action="{{ route('admincp_changePassword',['id' => Auth::user()->id]) }}" method="POST" class="m-form m-form--fit m-form--label-align-right">
							{{csrf_field()}}
							<div class="m-portlet__body">
								<div class="form-group m-form__group row">
									<label for="example-text-input" class="col-2 col-form-label">
										Mật khẩu cũ
									</label>
									<div class="col-7">
										<input name="old_password" class="form-control m-input" type="password" value="">
									</div>
								</div>
								<div class="form-group m-form__group row">
									<label for="example-text-input" class="col-2 col-form-label">
										Mật khẩu mới
									</label>
									<div class="col-7">
										<input name="password" class="form-control m-input" type="password" value="">
									</div>
								</div>
								<div class="form-group m-form__group row">
									<label for="example-text-input" class="col-2 col-form-label">
										Xác nhận mật khẩu mới
									</label>
									<div class="col-7">
										<input name="password_confirmation" class="form-control m-input" type="password" value="">
									</div>
								</div>
								<div class="m-portlet__foot m-portlet__foot--fit">
									<div class="m-form__actions">
										<div class="row">
											<div class="col-2"></div>
											<div class="col-7">
												<button type="submit" class="btn btn-accent m-btn m-btn--air m-btn--custom">
													Đổi mật khẩu
												</button>
												&nbsp;&nbsp;
												<button type="reset" class="btn btn-secondary m-btn m-btn--air m-btn--custom">
													Cancel
												</button>
											</div>
										</div>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection

@push('scripts')

@endpush

@push('script_header')
<script src="js/jquery-3.3.1.min.js"></script>
@endpush