@extends('layouts.master')

@section('page_title')
Ford Mustangs UK - The iconic Ford Mustang - Ford Mustangs in the UK - Pictures of Ford Mustangs
@endsection

@section('body_class')
homepage
@endsection

@section('metas')
<meta name="description" value="Ford Mustangs UK - The iconic Ford Mustang pictures and articles about all Ford Mustangs">
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
								<!-- <a class="btn-slide animation animated-item-3" href="#">Read More</a> -->
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
								<h2 class="animation animated-item-2">New Ford Mustang </h2>
								<!-- <a class="btn-slide animation animated-item-3" href="#">Read More</a> -->
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
								<h2 class="animation animated-item-2">The new Ford Mustang Shelby GT350<sup>&reg;</sup></h2>
								<a class="btn-slide animation animated-item-3" href="https://www.facebook.com/pg/fordmustangsuk/photos/?tab=album&album_id=300082700425976" target="_blank">View More Pics on Facebook</a>
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

    <section id="feature" >
        <div class="container">
           <div class="center wow fadeInDown">
                <h2>Ford Mustang Articles</h2>
                <p class="lead">A collection of information articles about the Ford Mustang including historical information, <br />Ford Mustang events and Ford Mustang clubs in the UK.</p>
            </div>

            <div class="row">
                <div class="features">

					@foreach($vars['articles'] as $item)

                    <div class="col-md-4 col-sm-6 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                        <div class="feature-wrap">
                            <i class="fa fa-car"></i>
                            <h2>{{ $item['title'] }}</h2>
                            <h3>{!! substr(strip_tags($item['intro']),0,42) !!}...</h3>
							<a href="{{ $item['link'] }}" class="btn btn-sm btn-primary pull-right">Read more</a>
                        </div>
                    </div><!--/.col-md-4-->

					@endforeach

                </div><!--/.services-->

				<p class="text-center"><a class="btn btn-primary" href="{{ route('article.index') }}">View all Ford Mustang articles</a></p>
            </div><!--/.row-->    
        </div><!--/.container-->
    </section><!--/#feature-->

@endsection

@section('footer')

@endsection