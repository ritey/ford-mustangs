@extends('layouts.master')

@section('page_title')
Ford Mustangs
@endsection

@section('body_class')
homepage
@endsection

@section('content')

<section id="contact-info">

    <section id="contact-page">
        <div class="container">
            <div class="center">
                <h2>Contact Ford Mustangs</h2>
                <p class="lead">Note: we are NOT Ford Motor Company. Contact <a href="http://www.ford.co.uk/Footer/ContactUs" target="_blank">Ford UK</a> </p>
            </div>
            <div class="row contact-wrap">
                <div class="status alert alert-success">
                    Thanks, we've got your message and will be in touch soon. <a href="{{ route('home') }}">Continue</a>.
                </div>
            </div><!--/.row-->
        </div><!--/.container-->
    </section><!--/#contact-page-->
</section>

@endsection

@section('footer')

@endsection