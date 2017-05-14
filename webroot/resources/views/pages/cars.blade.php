@extends('layouts.master')

@section('page_title')
Ford Mustangs For Sale in the UK
@endsection

@section('metas')
<meta name="description" value="Ford Mustangs For Sale in the UK">
@endsection

@section('body_class')
homepage
@endsection

@section('content')

    <section id="blog" class="container">
        <div class="center">
            <h2>Ford Mustangs For Sale in the UK</h2>
            <p class="lead">A collection of Ford Mustangs available for sale in the UK</p>
        </div>

        <div class="blog">
            <div class="row">
                 <div class="col-md-8">
                    @foreach($vars['cars'] as $item)

                    <div class="blog-item">
                        <div class="row">
                            <div class="col-xs-12 col-sm-2 text-center">
                                <div class="entry-meta">
                                    <span id="publish_date">{{ $item['state'] }}</span>
                                    <span><i class="fa fa-gbp"></i> {{ $item['price'] }}</span>
                                </div>
                            </div>
                                
                            <div class="col-xs-12 col-sm-10 blog-content">
                                <a href="{{ $item['link'] }}"><img class="img-responsive img-blog" src="{{ $item['img'] }}" width="400px" alt="" /></a>
                                <h2><a href="{{ $item['link'] }}">{{ $item['title'] }}</a></h2>
                                <h3>{!! $item['intro'] !!}</h3>
                                <a class="btn btn-primary readmore" href="{{ $item['link'] }}">Read More <i class="fa fa-angle-right"></i></a>
                            </div>
                        </div>    
                    </div><!--/.blog-item-->

                    @endforeach
                        
                </div><!--/.col-md-8-->

                <aside class="col-md-4">

                    <div class="widget categories">
                        <div class="row">
                            @include('partials.ads')
                        </div>
                    </div>
    				
    			</aside>  
            </div><!--/.row-->
        </div>
    </section><!--/#blog-->

@endsection