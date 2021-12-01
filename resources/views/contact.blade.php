@extends('layout.template')

@section('content')
<!-- Page Header-->
<header class="masthead" style="background-image: url('{{asset('clean-blog/assets/img/contact-bg.jpg')}}')">
    <div class="container position-relative px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <div class="page-heading">
                    <h1>Contact Me</h1>
                    <span class="subheading">Have questions? I have answers.</span>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- Main Content-->
<main class="mb-4">
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">

                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                    {{session('success')}}
                    </div>
                @endif


                <p>Want to get in touch? Fill out the form below to send me a message and I will get back to you as soon as possible!</p>
                <div class="my-5">
                    
                    <form id="contactForm" action="{{route('contact.form')}}" method="post">

                        @csrf

                        <div class="form-floating">
                            <input class="form-control" name="name" id="name" value="{{ old('name') }}" type="text" placeholder="Enter your name..." data-sb-validations="required" />
                            <label for="name">Name</label>
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        </div>
                        <div class="form-floating">
                            <input class="form-control" name="email" id="email" value="{{ old('email') }}" type="email" placeholder="Enter your email..." data-sb-validations="required,email" />
                            <label for="email">Email address</label>
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-floating">
                            <input class="form-control" name="phone" id="phone" value="{{ old('phone') }}"  type="tel" placeholder="Enter your phone number..." data-sb-validations="required" />
                            <label for="phone">Phone Number</label>
                            @error('phone')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-floating">
                            <input class="form-control" name="subject" id="subject" value="{{ old('subject') }}" type="text" placeholder="Enter the subject number..." data-sb-validations="required" />
                            <label for="phone">Subject</label>
                            @error('subject')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-floating">
                            <textarea class="form-control" name="message" id="message" value="{{ old('message') }}" placeholder="Enter your message here..." style="height: 12rem" data-sb-validations="required"></textarea>
                            <label for="message">Message</label>
                            @error('message')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <br />
                        
                        <button class="btn btn-primary text-uppercase" id="submitButton" type="submit">Send</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
<!-- Footer-->
@endsection