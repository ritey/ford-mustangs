@extends('layouts.master')

@section('page_title')
Ford Mustang Articles
@endsection

@section('body_class')
homepage
@endsection

@section('content')

    <section id="blog" class="container">
        <div class="center">
            <h2>Mustang articles</h2>
            <p class="lead">A collection of useful information articles about the Ford Mustang</p>
        </div>

        <div class="blog">
            <div class="row">
                 <div class="col-md-8">
                    @foreach($vars['articles'] as $item)

                    <div class="blog-item">
                        <div class="row">
                            <div class="col-xs-12 col-sm-2 text-center">
                                <div class="entry-meta">
                                    <span id="publish_date">{{ $item['date'] }}</span>
                                    <span><i class="fa fa-user"></i> {{ $item['author'] }}</span>
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
                        
                    <!--<ul class="pagination pagination-lg">
                        <li><a href="#"><i class="fa fa-long-arrow-left"></i>Previous Page</a></li>
                        <li class="active"><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#">5</a></li>
                        <li><a href="#">Next Page<i class="fa fa-long-arrow-right"></i></a></li>
                    </ul>--><!--/.pagination-->
                </div><!--/.col-md-8-->

                <aside class="col-md-4">

                    <!--<div class="widget categories">
                        <h3>Categories</h3>
                        <div class="row">
                            <div class="col-sm-6">
                                <ul class="blog_category">
                                    <li><a href="#">Computers <span class="badge">04</span></a></li>
                                    <li><a href="#">Smartphone <span class="badge">10</span></a></li>
                                    <li><a href="#">Gedgets <span class="badge">06</span></a></li>
                                    <li><a href="#">Technology <span class="badge">25</span></a></li>
                                </ul>
                            </div>
                        </div>                     
                    </div><!--/.categories-->
    				
    			</aside>  
            </div><!--/.row-->
        </div>
    </section><!--/#blog-->

@endsection