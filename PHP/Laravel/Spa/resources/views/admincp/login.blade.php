<!DOCTYPE html>
<html lang="en" >
	<!-- begin::Head -->
	<head>

		<base href="{{asset('lib/admincp/./')}}">
		<meta charset="utf-8" />
		<title>
			Đăng nhập | 2T Spa
		</title>
		<meta name="description" content="Latest updates and statistic charts">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!--begin::Web font -->
		<!--end::Web font -->
        <!--begin::Base Styles -->
		<link href="assets/vendors/base/vendors.bundle.css" rel="stylesheet" type="text/css" />
		<link href="assets/demo/default/base/style.bundle.css" rel="stylesheet" type="text/css" />
		<!--end::Base Styles -->
		<link rel="shortcut icon" href="assets/demo/default/media/img/logo/favicon.ico" />
	</head>
	<!-- end::Head -->
    <!-- end::Body -->
	<body class="m--skin- m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default"  >

		{{-- Chọn hệ thống --}}
		@if(Auth::check())
		<div class="m-grid m-grid--hor m-grid--root m-page">
			<div class="m-login m-login--singin  m-login--5" id="m_login" style="background-image: url(assets/app/media/img//bg/bg-3.jpg);">
				<div class="m-login__wrapper-1 m-portlet-full-height">
					<div class="m-login__wrapper-1-1">
						<div class="m-login__contanier">
							<div class="m-login__content">
								<div class="m-login__logo">
									<a href="{{$rootURL}}">
										<img src="assets/app/media/img//logos/logo-2.png">
									</a>
								</div>
								<div class="m-login__title">
									<h3>
										2T Spa - Hệ thống quản lý Spa
									</h3>
								</div>
								<div class="m-login__desc">
									<a class="btn btn-outline-danger m-btn m-btn--custom m-btn--outline-2x m-btn--uppercase" href="{{route('spa_showDashBoard')}}">Spa Management</a>
								</div>
							</div>
						</div>
						<div class="m-login__border">
							<div></div>
						</div>
					</div>
				</div>
				<div class="m-login__wrapper-1 m-portlet-full-height">
					<div class="m-login__wrapper-1-1">
						<div class="m-login__contanier">
							<div class="m-login__content">
								<div class="m-login__logo">
									<a href="{{$rootURL}}">
										<img src="assets/app/media/img//logos/logo-2.png">
									</a>
								</div>
								<div class="m-login__title">
									<h3>
										Hệ thống CMS
									</h3>
								</div>
								<div class="m-login__desc">
									<a href="{{route('dashboard')}}" class="btn btn-outline-danger m-btn m-btn--custom m-btn--outline-2x m-btn--uppercase">CMS</a>
								</div>
							</div>
						</div>
						<div class="m-login__border">
							<div></div>
						</div>
					</div>
				</div>
			</div>
		</div>

		@else
		<!-- begin:: Page -->
		<div class="m-grid m-grid--hor m-grid--root m-page">
			<div class="m-login m-login--singin  m-login--5" id="m_login" style="background-image: url(assets/app/media/img//bg/bg-3.jpg);">
				<div class="m-login__wrapper-1 m-portlet-full-height">
					<div class="m-login__wrapper-1-1">
						<div class="m-login__contanier">
							<div class="m-login__content">
								<div class="m-login__logo">
									<a href="{{$rootURL}}">
										<img src="assets/app/media/img//logos/logo-2.png">
									</a>
								</div>
								<div class="m-login__title">
									<h3>
										HỆ THỐNG QUẢN LÝ SPA
									</h3>
									<h3>
										HỆ THỐNG QUẢN TRỊ NỘI DUNG (CMS)
									</h3>
								</div>
								<div class="m-login__desc">
									Phát triển bởi Hưng Thịnh & Khắc Tuấn (SICT - 2018)
								</div>
							</div>
						</div>
						<div class="m-login__border">
							<div></div>
						</div>
					</div>
				</div>
				<div class="m-login__wrapper-2 m-portlet-full-height">
					<div class="m-login__contanier">
						<div class="m-login__signin">
							<div class="m-login__head">
								<h3 class="m-login__title">
									ĐĂNG NHẬP HỆ THỐNG
								</h3>
							</div>
							<form action="{{ route('admincp_Login') }}" method="POST" class="m-login__form m-form" action="">
								{{csrf_field()}}
								@if(count($errors)>0)
								<div class="m-alert m-alert--outline alert alert-danger alert-dismissible" role="alert">
									@if(session('errors_message'))
										<span>{{session('errors_message')}}</span>
									@endif
										<button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
									@foreach($errors->all() as $error)
										<span>{{$error}}.</span><br> 		
									@endforeach
								</div>
								@endif
								<div class="form-group m-form__group">
									<input class="form-control m-input" type="text" placeholder="Tên tài khoản" name="username" autocomplete="off">
								</div>
								<div class="form-group m-form__group">
									<input class="form-control m-input m-login__form-input--last" type="Password" placeholder="Mật khẩu" name="password">
								</div>
								<div class="form-group m-form__group">
									<select class="form-control m-input" style="padding: .65rem 1rem" name="type">
										<option value="spamgmt">Hệ thống quản lý Spa</option>
										<option value="spacms">Hệ thống CMS</option>
									</select>
								</div>
								<div class="row m-login__form-sub">
									<div class="col m--align-left">
										<label class="m-checkbox m-checkbox--focus">
											<input type="checkbox" name="remember">
											Remember me
											<span></span>
										</label>
									</div>
								</div>
								<div class="m-login__form-action">
									<button type="submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air">
										Đăng nhập
									</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		@endif
		<!-- end:: Page -->
    	<!--begin::Base Scripts -->
		<script src="assets/vendors/base/vendors.bundle.js" type="text/javascript"></script>
		<script src="assets/demo/default/base/scripts.bundle.js" type="text/javascript"></script>
		<!--end::Base Scripts -->   
        <!--begin::Page Snippets -->
		{{-- <script src="assets/snippets/pages/user/login.js" type="text/javascript"></script> --}}
		<!--end::Page Snippets -->
	</body>
	<!-- end::Body -->
</html>
