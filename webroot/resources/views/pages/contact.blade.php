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
                <div class="status alert alert-success" style="display: none"></div>
                <form id="main-contact-form" class="contact-form" name="contact-form" method="post" action="{{ route('contact.send') }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    <div class="col-sm-5 col-sm-offset-1">
                        <div class="form-group">
                            <label>Name *</label>
                            <input type="text" name="name" class="form-control" required="required">
                        </div>
                        <div class="form-group">
                            <label>Email *</label>
                            <input type="email" name="email" class="form-control" required="required">
                        </div>
                        <div class="form-group">
                            <label>Phone</label>
                            <input type="number" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Company Name</label>
                            <input type="text" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <div class="form-group">
                            <label>Subject *</label>
                            <input type="text" name="subject" class="form-control" required="required">
                        </div>
                        <div class="form-group">
                            <label>Message *</label>
                            <textarea name="message" id="message" required="required" class="form-control" rows="8"></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" name="submit" class="btn btn-primary btn-lg" required="required">Submit Message</button>
                        </div>
                    </div>
                </form>
            </div><!--/.row-->
        </div><!--/.container-->
    </section><!--/#contact-page-->
</section>

@endsection

@section('footer')

@endsection