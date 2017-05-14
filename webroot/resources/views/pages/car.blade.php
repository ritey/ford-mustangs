@extends('layouts.master')

@section('page_title')
{{ $vars['car']['page_title'] or '' }}
@endsection

@section('metas')
<meta name="description" value="{{ $vars['car']['meta_description'] or '' }}">
@endsection

@section('body_class')
homepage
@endsection

@section('content')

    <section id="blog" class="container">
        <div class="center">
            <h2>Ford Mustangs For Sale in the UK</h2>
            <p class="lead">{{ $vars['car']['title'] }}</p>
        </div>

        <div class="blog">
            <div class="row">
                <div class="col-md-8">
                    <div class="blog-item">
                        <img class="img-responsive img-blog" src="{{ $vars['car']['img'] }}" width="600px" alt="" />
                            <div class="row">  
                                <div class="col-xs-12 col-sm-2 text-center">
                                    <div class="entry-meta">
                                        <span id="publish_date">{{ $vars['car']['state'] }}</span>
                                        <span><i class="fa fa-gbp"></i> {{ $vars['car']['price'] }}</span>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-10 blog-content">
                                    
                                    {!! $vars['car']['description'] !!}

                                    @if (count($vars['car']['images']))
                                        <!-- about us slider -->
                                        <div id="about-slider" style="width:90%;">
                                            <div id="carousel-slider" class="carousel slide" data-ride="carousel">
                                                <!-- Indicators -->
                                                <ol class="carousel-indicators visible-xs">
                                                    @foreach($vars['car']['images'] as $img)
                                                    <li data-target="#carousel-slider" data-slide-to="{{ ($loop->iteration-1) }}" class="{{ $loop->iteration == 1 ? 'active' : '' }}"></li>
                                                    @endforeach
                                                </ol>

                                                <div class="carousel-inner">
                                                    @foreach($vars['car']['images'] as $img)
                                                    <div class="item {{ $loop->iteration == 1 ? 'active' : '' }} ">
                                                        <img src="{{ $img }}" class="img-responsive" alt="{{ $loop->iteration }}"> 
                                                    </div>
                                                    @endforeach
                                                </div>
                                                
                                                <a class="left carousel-control hidden-xs" href="#carousel-slider" data-slide="prev">
                                                    <i class="fa fa-angle-left"></i> 
                                                </a>
                                                
                                                <a class=" right carousel-control hidden-xs"href="#carousel-slider" data-slide="next">
                                                    <i class="fa fa-angle-right"></i> 
                                                </a>
                                            </div> <!--/#carousel-slider-->
                                        </div><!--/#about-slider-->
                                    @endif

                                </div>
                            </div>
                        </div><!--/.blog-item-->

                    </div><!--/.col-md-8-->

                <aside class="col-md-4">

                    <div class="widget categories">
                        <div class="row">
                            @include('partials.ads')
                        </div>
                    </div>

                </aside>     

            </div><!--/.row-->

         </div><!--/.blog-->

    </section><!--/#blog-->

@endsection

@section('footer')
<script type="text/javascript">
    $('document').ready(function() {
        $('.carousel').carousel();
    });
</script>
@endsection