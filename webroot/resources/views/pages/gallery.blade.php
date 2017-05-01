@extends('layouts.master')

@section('page_title')
Ford Mustangs Gallery
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
            </ul>

            <div class="row">
                <div class="portfolio-items">
                    <div class="portfolio-items apps col-xs-12 col-sm-4 col-md-3">
                        <div class="recent-work-wrap">
                            <img class="img-responsive" src="" alt="Ford Mustangs">
                            <div class="overlay">
                                <div class="recent-work-inner">
                                    <h3><a href="#">GT500</a></h3>
                                    <p>The iconic Ford Mustang GT500</p>
                                    <a class="preview" href="images/portfolio/full/item2.png" rel="prettyPhoto"><i class="fa fa-eye"></i> View</a>
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection