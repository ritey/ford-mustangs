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
                <p><a class="btn btn-primary" href="{{ route('gallery') }}">Back to Ford Mustang Gallery</a></p>
            </div>

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <img style="width:100%" src="/{{ $vars['img'] }}" alt="Ford Mustang" />
                </div>
            </div>
        </div>
    </section>
@endsection