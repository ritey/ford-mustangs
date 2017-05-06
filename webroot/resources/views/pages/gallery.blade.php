@extends('layouts.master')

@section('page_title')
Ford Mustangs Gallery
@endsection

@section('metas')
<meta name="description" value="Ford Mustang Gallery">
@endsection


@section('content')

    <section id="portfolio">
        <div class="container">
            <div class="center">
                <h2>Ford Mustangs Gallery</h2>
                <p class="lead">Welcome to our collection of Ford Mustang pictures. If you'd like your picture to be displayed please send it to dave@coderstudios.com</p>
            </div>

            <ul class="portfolio-filter text-center">
                <li><a class="btn btn-default active" href="#" data-filter="*">All</a></li>
                @foreach($vars['tags'] as $item)
                <li><a class="btn btn-default" href="#" data-filter=".{{ $item }}">{{ $item }}</a></li>
                @endforeach
            </ul>

            <div class="row">
                <div class="portfolio-items">

                    @foreach($vars['pics'] as $img_group)
                        @foreach($img_group  as $img)
                    <div class="portfolio-item {{ $img['tag'] }} col-xs-12 col-sm-4 col-md-3">
                        <div class="recent-work-wrap">
                            <img class="img-responsive" src="{{ $img['file'] }}" alt="Ford Mustangs {{ $img['tag'] }}">
                            <div class="overlay">
                                <div class="recent-work-inner">
                                    <h3><a href="#">{{ $img['tag'] }}</a></h3>
                                    <p>The iconic Ford Mustang {{ $img['tag'] }}</p>
                                    <a class="preview" href="{{ route('gallery.item',['id' => urlencode(str_replace('/','|',substr($img['file'],1,strlen($img['file']))))]) }}"><i class="fa fa-eye"></i> View</a>
                                </div> 
                            </div>
                        </div>
                    </div>
                        @endforeach
                    @endforeach

                </div>
            </div>
        </div>
    </section>
@endsection

@section('footer')
<script type="text/javascript">
$('document').ready(function() {

	// portfolio filter
	$(window).on('load',(function(){'use strict';
		var $portfolio_selectors = $('.portfolio-filter >li>a');
		var $portfolio = $('.portfolio-items');
		$portfolio.isotope({
			itemSelector : '.portfolio-item',
			layoutMode : 'fitRows'
		});

		$portfolio_selectors.on('click', function(){
			$portfolio_selectors.removeClass('active');
			$(this).addClass('active');
			var selector = $(this).attr('data-filter');
			$portfolio.isotope({ filter: selector });
			return false;
		});
	}));

	//goto top
	$('.gototop').click(function(event) {
		event.preventDefault();
		$('html, body').animate({
			scrollTop: $("body").offset().top
		}, 500);
	});

});
</script>
@endsection