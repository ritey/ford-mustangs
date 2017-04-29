@extends('layouts.master')

@section('page_title')
Ford Mustangs
@endsection

@section('body_class')
homepage
@endsection

@section('content')

<section id="main-slider" class="no-margin">
	<div id="header-slider" class="carousel slide" data-ride="carousel">
		<ol class="carousel-indicators">
			<li data-target="#header-slider" data-slide-to="0" class="active"></li>
			<li data-target="#header-slider" data-slide-to="1"></li>
			<li data-target="#header-slider" data-slide-to="2"></li>
		</ol>
		<div class="carousel-inner">

			<div class="item active" style="background-image: url(/images/slider/ford-gt500.jpg)">
				<div class="container">
					<div class="row slide-margin">
						<div class="col-sm-6">
							<div class="carousel-content">
								<h1 class="animation animated-item-1">Ford Mustangs</h1>
								<h2 class="animation animated-item-2">Ford Mustang GT500</h2>
								<a class="btn-slide animation animated-item-3" href="#">Read More</a>
							</div>
						</div>

					</div>
				</div>
			</div><!--/.item-->

			<div class="item" style="background-image: url(/images/slider/ford-mustang-2016.jpg)">
				<div class="container">
					<div class="row slide-margin">
						<div class="col-sm-6">
							<div class="carousel-content">
								<h1 class="animation animated-item-1">Ford Mustangs</h1>
								<h2 class="animation animated-item-2">Accusantium doloremque laudantium totam rem aperiam, eaque ipsa...</h2>
								<a class="btn-slide animation animated-item-3" href="#">Read More</a>
							</div>
						</div>

					</div>
				</div>
			</div><!--/.item-->

			<div class="item" style="background-image: url(images/slider/GT350-fullscreen.jpg)">
				<div class="container">
					<div class="row slide-margin">
						<div class="col-sm-6">
							<div class="carousel-content">
								<h1 class="animation animated-item-1">Ford Mustangs</h1>
								<h2 class="animation animated-item-2">Accusantium doloremque laudantium totam rem aperiam, eaque ipsa...</h2>
								<a class="btn-slide animation animated-item-3" href="#">Read More</a>
							</div>
						</div>

					</div>
				</div>
			</div><!--/.item-->
		</div><!--/.carousel-inner-->
		<a class="prev left carousel-control hidden-xs" href="#header-slider" data-slide="prev">
			<i class="fa fa-chevron-left"></i>
		</a>
		<a class="next right carousel-control hidden-xs" href="#header-slider" data-slide="next">
			<i class="fa fa-chevron-right"></i>
		</a>

	</div><!--/.carousel-->
</section><!--/#main-slider-->

@endsection

@section('footer')

@endsection