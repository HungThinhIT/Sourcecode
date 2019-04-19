@extends('spa.master')

@section('title','2T Spa - Giá Dịch vụ')

@section('content')

<div class="container-fluid page-name">
	<div class="container-fluid box-page">
		<div class="container box-title-page">
			<div class="col-sm-6 col-xs-12 title-page">Giá</div>
			<div class="col-sm-6 col-xs-12 full-title-page">Trang chủ / Giá</div>
		</div>
	</div>
</div>

<div class="container-fluid section">
	<div class="container our-service text-center">
		<h2 class="title-os">
			<span>Giá dịch vụ</span>
		</h2>
		<span class="content-os">
			{{$service_hot[0]->description}}
		</span>
	</div>
	<div class="container">
		<div class="col-sm-12 pricing-box">
			<div class="col-xs-10 col-xs-offset-1 col-sm-7 col-sm-offset-0">
				<div>
					<img src="assets/images/services/{{$service_img[rand(0,5)]->image}}" width="100%">
				</div>
			</div>
			<div class="col-xs-10 col-xs-offset-1 col-sm-5 col-sm-offset-0 pricing-service">
				<h3 class="text-center ms-pricing-title">Danh sách giá</h3>
				<div class="ms-pricing-list">
					<div class="ms-pricing-box">
						<ul>
							@foreach($services as $service)
							<li>
								<span class="ms-name-list">
									{{$service->ServicesName}}
								</span>
								<span class="ms-price-list">
									VND {{$service->ServicesPrice}}
								</span>
							</li>
							@endforeach
						</ul>
					</div>
				</div>
				<div class="text-center">
					<a class="btn-book-service" href="{{route('pricing')}}#make-an-appoinment">Tạo đơn hàng</a>
				</div>
			</div>
		</div>
	</div>
	<div class="clear"></div>
</div>

<div class="container-fluid section">
	<div class="container our-service text-center">
		<h2 class="title-os" id="make-an-appoinment">
			Đăng ký dịch vụ
		</h2>
	</div>
	<div class="container appoinment form-contact">
		<form>
			<div class="col-xs-12 none-margin none-padding">
				<div class="col-sm-6 col-xs-12 form-group">
					<input class="form-control" type="text" id="reser_name" name="reser_name" placeholder="Họ tên" >
					<i class="fas fa-user"></i>
				</div>
				<div class="col-sm-6 col-xs-12 form-group">
					<input class="form-control" type="tel" pattern="[0-9]{4} [0-9]{3} [0-9]{3}" id="reser_phone" name="reser_phone" placeholder="Số điện thoại">
					<i class="fas fa-phone"></i>
				</div>
				<div class="col-sm-6 col-xs-12 none-margin" id="reser_name-err"></div>
				<div class="col-sm-6 col-xs-12 none-margin" id="reser_phone-err"></div>
				<div class="clear"></div>
			</div>
       		<div class="col-xs-12 none-margin none-padding">
				<div class="col-sm-6 col-xs-12 form-group">
					<input class="form-control" type="email" id="reser_email" name="reser_email" placeholder="Email">
					<i class="fas fa-envelope"></i>
				</div>
				<div class="col-sm-6 col-xs-12 form-group">
	                <input class="form-control" type="datetime-local" id="reser_date" name="reser_date" min="2018-06-07" max="2018-06-14">
	                <i class="fas fa-calendar"></i>
	       		</div>
				<div class="col-sm-6 col-xs-12 none-margin" id="reser_email-err"></div>
				<div class="col-sm-6 col-xs-12 none-margin" id="reser_date-err"></div>
				<div class="clear"></div>
       		</div>
       		<div class="col-sm-6 col-xs-12 form-group">
				<div class="col-xs-12 form-group none-padding none-margin" data-toggle="modal" data-target="#list-services">
					<input class="form-control" type="text" id="reser_service" name="reser_service" placeholder="Chọn dịch vụ" value="">
				</div>
				<div class="col-xs-12 none-margin" id="reser_service-err"></div>
			</div>
			<div class="col-sm-6 col-xs-12 form-group">
				<select name="reser_gender" id="reser_gender">
					{{-- <option>Giới tính</option> --}}
					<option value="Nam">Nam</option>
					<option value="Nữ">Nữ</option>
					<option value="Khác">Khác</option>
				</select>
				<i class="fas fa-male"></i>
			</div>
			<div class="col-sm-12 col-xs-12 form-group last-fg">
				<textarea class="form-control" type="text" id="reser_message" name="reser_message">
				</textarea>
				<i class="fas fa-paper-plane"></i>
			</div>
			<div class="col-sm-12 col-xs-12 form-group text-right">
				<input type="button" name="submit" data-url="{{route('reservation')}}" id="reser-button" value="Đăng ký">
			</div>
		</form>
	</div>
</div>

<div class="container-fluid section" id="h-service">
	<div class="container">
		<div class="col-sm-12 pricing-box">
			<div class="col-xs-10 col-xs-offset-1 col-sm-7 col-sm-offset-0">
				<div class="wow fadeInLeft">
					<img src="assets/images/services/{{$service_img[rand(0,2)]->image}}" width="100%">
				</div>
			</div>
			<div class="col-xs-10 col-xs-offset-1 col-sm-5 col-sm-offset-0 pricing-service">
				<h3 class="text-center ms-pricing-title">Danh sách giá</h3>
				<div class="ms-pricing-list">
					<div class="ms-pricing-box">
						<ul>
							@foreach($services as $service)
							<li>
								<span class="ms-name-list">
									{{$service->ServicesName}}
								</span>
								<span class="ms-price-list">
									VND {{$service->ServicesPrice}}
								</span>
							</li>
							@endforeach
						</ul>
					</div>
				</div>
				<div class="text-center">
					<a class="btn-book-service" href="{{route('pricing')}}#make-an-appoinment">Tạo đơn hàng</a>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="list-services" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title text-center">
					Chọn dịch vụ
				</h3>
			</div>
			<div class="modal-body">
				@foreach($services as $service)
				<div class="col-xs-8">
					{{$service->ServicesName}}<br/>
				</div>
				<div class="col-xs-4">
					<input type="checkbox" name="check-service" data-msg="{{$service->ServicesName}}" value="{{$service->ServicesId}}"> 
				</div>
				@endforeach
				<div class="clear"></div>
			</div>
			<div class="modal-footer">
				<button type="button" id="button-check-service" class="btn btn-primary" data-dismiss="modal">
					Chọn
				</button>
			</div>
		</div>
	</div>
</div>

@endsection

@push('script')
<script src="assets/js/javascript.js"></script>
<script src="assets/js/reservation.js"></script>
<script src="assets/js/load-page.js"></script>
<script src="assets/dist/wow.js"></script>
<script src="assets/js/owl.carousel.min.js"></script>
<script src="assets/js/carousel-custom.js"></script>
<script src="assets/js/gallery-custom.js"></script>
<script src="assets/js/wow-custom.js"></script>
<script src="assets/js/page-custom.js"></script>
@endpush
