@extends('layouts.app')

@section('title', 'Contact Us - Tropical Burger Siquijor')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="text-center mb-5">
                <i class='bx bxs-phone-call display-1 mb-3' style="color: var(--tropical-orange);"></i>
                <h1 class="display-5 fw-bold" style="color: var(--tropical-brown);">Get in Touch</h1>
                <p class="lead" style="color: var(--tropical-orange);">
                    We'd love to hear from you! Questions, feedback, or just want to say hi? Drop us a message!
                </p>
            </div>

            {{-- Contact Details --}}
            <div class="card mb-4 border-0 shadow-lg" style="background: linear-gradient(135deg, #FFF8DC 0%, #FFE4B5 100%); border: 3px solid var(--tropical-orange) !important;">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4" style="color: var(--tropical-brown);">
                        <i class='bx bxs-map me-2' style="color: var(--tropical-orange);"></i>Contact Information
                    </h5>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-3">
                            <i class='bx bxs-envelope fs-5 me-2' style="color: var(--tropical-green);"></i>
                            <strong>Email:</strong> hello@tropicalburger.ph
                        </li>
                        <li class="mb-3">
                            <i class='bx bxs-phone fs-5 me-2' style="color: var(--tropical-green);"></i>
                            <strong>Phone:</strong> +63 912 345 6789
                        </li>
                        <li class="mb-3">
                            <i class='bx bxs-map-pin fs-5 me-2' style="color: var(--tropical-green);"></i>
                            <strong>Address:</strong> Poblacion, Siquijor, Siquijor 6226, Philippines
                        </li>
                        <li class="mb-3">
                            <i class='bx bxs-time fs-5 me-2' style="color: var(--tropical-green);"></i>
                            <strong>Hours:</strong> Monday – Sunday, 10:00 AM – 10:00 PM
                        </li>
                        <li class="mb-0">
                            <i class='bx bxl-facebook-circle fs-5 me-2' style="color: var(--tropical-green);"></i>
                            <strong>Facebook:</strong> @TropicalBurgerSiquijor
                        </li>
                    </ul>
                </div>
            </div>

            {{-- Contact Form --}}
            <div class="card border-0 shadow-lg">
                <div class="card-header py-3" style="background: linear-gradient(135deg, var(--tropical-orange), var(--tropical-red));">
                    <h5 class="mb-0 fw-bold text-white">
                        <i class='bx bxs-message-dots me-2'></i>Send Us a Message
                    </h5>
                </div>
                <div class="card-body p-4">
                    @if(session('success'))
                        <div class="alert alert-success">
                            <i class='bx bx-check-circle me-2'></i>{{ session('success') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('contact.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label fw-semibold">Your Name</label>
                            <input type="text" id="name" name="name" class="form-control" 
                                   placeholder="Enter your name" 
                                   style="border: 2px solid var(--tropical-orange);" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold">Your Email</label>
                            <input type="email" id="email" name="email" class="form-control" 
                                   placeholder="Enter your email" 
                                   style="border: 2px solid var(--tropical-orange);" required>
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label fw-semibold">Message</label>
                            <textarea id="message" name="message" rows="5" class="form-control" 
                                      placeholder="Tell us what's on your mind..." 
                                      style="border: 2px solid var(--tropical-orange);" required></textarea>
                        </div>
                        <button type="submit" class="btn px-5 py-2 fw-bold text-white" 
                                style="background: linear-gradient(135deg, var(--tropical-orange), var(--tropical-red)); border: none;">
                            <i class='bx bxs-send me-2'></i>Send Message
                        </button>
                    </form>
                </div>
            </div>

            {{-- Visit Us Info --}}
            <div class="alert mt-4 border-0" style="background: linear-gradient(135deg, #FFF8DC, #FFE4B5); border-left: 5px solid var(--tropical-orange) !important;">
                <h6 class="fw-bold" style="color: var(--tropical-brown);">
                    <i class='bx bxs-car me-2' style="color: var(--tropical-orange);"></i>How to Find Us
                </h6>
                <p class="mb-0">
                    We're located in the heart of Siquijor town, just a short walk from the pier and main plaza. 
                    Look for our bright tropical-themed signage – you can't miss us! 
                    Free parking available for customers. 🚗🌴
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
