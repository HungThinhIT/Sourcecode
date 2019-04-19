<footer class="container-fluid footer-spa">
	<div class="container">
		<div class="col-sm-4 col-xs-12">
			<div class="footer-title">liên hệ</div>
			<div class="footer-line"></div>
			<div>
				{{-- <span>
					This is Photoshop's version of Lorem impsum. Proin gra vi da nibh vel velit a uctor aliquet.
				</span> --}}
				<span>
					<i class="fas fa-map-marker-alt"></i>
					<span>
						Ngũ Hành Sơn, Đà Nẵng
					</span>
				</span>
				<span>
					<i class="fas fa-phone"></i>
					<span>
						Tư vấn - 0261 657 6 657
					</span>
				</span>
				<span>
					<i class="fas fa-globe-asia"></i>
					<a href="https://khactuan.info">2tspa.info</a>
				</span>
				<span>
					<i class="fa fa-envelope"></i>
					<a href="mailto:khactuan@info.com">2tspa@info.com</a>
				</span>
			</div>
		</div>
		<div class="col-sm-4 col-xs-12">
			<div class="footer-title">bộ sưu tập</div>
			<div class="footer-line"></div>
			<div class="footer-img">
				@foreach($sliders as $slider)
				<div class="col-xs-4 ffirst-img">
					<img src="assets/images/sliders/{{$slider->image}}" width="100%">
					<div class="fimg-eff"></div>
				</div>
				@endforeach
			</div>
		</div>
		<div class="col-sm-4 col-xs-12">
			<div class="footer-title">danh sách trang</div>
			<div class="footer-line"></div>
			<div class="footer-link">
				<div class="col-xs-6">
					<ul>
						<li>
							<i class="fas fa-angle-right"></i>
							<a href="{{route('home')}}">Trang chủ</a>
						</li>
						<li>
							<i class="fas fa-angle-right"></i>
							<a href="{{route('services')}}">Dịch vụ</a>
						</li>
						<li>
							<i class="fas fa-angle-right"></i>
							<a href="{{route('pricing')}}">Giá</a>
						</li>
					</ul>
				</div>
				<div class="col-xs-6">
					<ul>
						<li>
							<i class="fas fa-angle-right"></i>
							<a href="{{route('gallery')}}">Bộ sưu tập</a>
						</li>
						<li>
							<i class="fas fa-angle-right"></i>
							<a href="{{route('blog')}}">Blog</a>
						</li>
						<li>
							<i class="fas fa-angle-right"></i>
							<a href="{{route('contact')}}">Đặt lịch</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="text-center copy-right-spa">
		<span>
			Copyright &copy; 2018.<br/>
			Designed by Khắc Tuấn & Hưng Thịnh
		</span>
	</div>
</footer>