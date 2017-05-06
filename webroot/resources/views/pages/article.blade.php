@extends('layouts.master')

@section('page_title')
{{ $vars['article']['page_title'] or '' }}
@endsection

@section('metas')
<meta name="description" value="{{ $vars['article']['meta_description'] or '' }}">
@endsection

@section('body_class')
homepage
@endsection

@section('content')

    <section id="blog" class="container">
        <div class="center">
            <h2>Ford Mustang articles</h2>
            <p class="lead">{{ $vars['article']['title'] }}</p>
        </div>

        <div class="blog">
            <div class="row">
                <div class="col-md-8">
                    <div class="blog-item">
                        <img class="img-responsive img-blog" src="{{ $vars['article']['img'] }}" width="600px" alt="" />
                            <div class="row">  
                                <div class="col-xs-12 col-sm-2 text-center">
                                    <div class="entry-meta">
                                        <span id="publish_date">{{ $vars['article']['date'] }}</span>
                                        <span><i class="fa fa-user"></i> {{ $vars['article']['author'] }}</span>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-10 blog-content">
                                    
                                    {!! $vars['article']['description'] !!}

                                    <!-- <div class="post-tags">
                                        <strong>Tag:</strong> <a href="#">Cool</a> / <a href="#">Creative</a> / <a href="#">Dubttstep</a>
                                    </div> -->

                                </div>
                            </div>
                        </div><!--/.blog-item-->

                    </div><!--/.col-md-8-->

                <aside class="col-md-4">

                </aside>     

            </div><!--/.row-->

         </div><!--/.blog-->

    </section><!--/#blog-->

@endsection