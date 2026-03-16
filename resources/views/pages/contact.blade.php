@extends('layouts.app')

@section('title', 'Contact Us - Tropical Burger Siquijor')

@section('content')
<style>
    .contact-page-title {
        color: var(--burger-white);
        text-shadow: 0 4px 12px rgba(0, 0, 0, 0.6);
    }

    .contact-page-lead {
        color: var(--burger-muted);
    }

    .contact-card,
    .contact-form-card {
        background: var(--burger-dark);
        border-radius: 1.25rem;
        border: 1px solid var(--burger-border);
        box-shadow: 0 18px 40px rgba(0, 0, 0, 0.7);
    }

    .contact-card h5 {
        color: var(--burger-gold);
    }

    .contact-card ul li {
        color: var(--burger-white);
    }

    .contact-card ul li strong {
        color: var(--burger-gold);
    }

    .contact-form-header {
        background: linear-gradient(135deg, var(--burger-orange), #ff6b3d);
        border-bottom: 1px solid var(--burger-border);
        border-radius: 1.25rem 1.25rem 0 0;
    }

    .contact-form-label {
        color: var(--burger-white);
    }

    .contact-highlight {
        background: rgba(243, 154, 18, 0.08);
        border-left: 4px solid var(--burger-orange);
        border-radius: 1rem;
        color: var(--burger-muted);
    }

    .contact-highlight h6 {
        color: var(--burger-gold);
    }
</style>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="text-center mb-5">
                <i class='bx bxs-phone-call display-1 mb-3' style="color: var(--tropical-orange);"></i>
                <h1 class="display-5 fw-bold contact-page-title">Get in Touch</h1>
                <p class="lead contact-page-lead">
                    We'd love to hear from you! Questions, feedback, or just want to say hi? Drop us a message!
                </p>
            </div>

            {{-- Contact Details --}}
            <div class="card mb-4 border-0 contact-card">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4">
                        <i class='bx bxs-map me-2' style="color: var(--burger-orange);"></i>Contact Information
                    </h5>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-3">
                            <i class='bx bxs-envelope fs-5 me-2' style="color: var(--burger-gold);"></i>
                            <strong>Email:</strong> hello@tropicalburger.ph
                        </li>
                        <li class="mb-3">
                            <i class='bx bxs-phone fs-5 me-2' style="color: var(--burger-gold);"></i>
                            <strong>Phone:</strong> +63 912 345 6789
                        </li>
                        <li class="mb-3">
                            <i class='bx bxs-map-pin fs-5 me-2' style="color: var(--burger-gold);"></i>
                            <strong>Address:</strong> Poblacion, Siquijor, Siquijor 6226, Philippines
                        </li>
                        <li class="mb-3">
                            <i class='bx bxs-time fs-5 me-2' style="color: var(--burger-gold);"></i>
                            <strong>Hours:</strong> Monday – Sunday, 10:00 AM – 10:00 PM
                        </li>
                        <li class="mb-0">
                            <i class='bx bxl-facebook-circle fs-5 me-2' style="color: var(--burger-gold);"></i>
                            <strong>Facebook:</strong> @TropicalBurgerSiquijor
                        </li>
                    </ul>
                </div>
            </div>

            {{-- Contact Form --}}
            <div class="card border-0 shadow-lg contact-form-card">
                <div class="card-header py-3 contact-form-header">
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
                            <label for="name" class="form-label fw-semibold contact-form-label">Your Name</label>
                            <input type="text" id="name" name="name" class="form-control"
                                   placeholder="Enter your name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold contact-form-label">Your Email</label>
                            <input type="email" id="email" name="email" class="form-control"
                                   placeholder="Enter your email" required>
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label fw-semibold contact-form-label">Message</label>
                            <textarea id="message" name="message" rows="5" class="form-control"
                                      placeholder="Tell us what's on your mind..." required></textarea>
                        </div>
                        <button type="submit" class="btn px-5 py-2 fw-bold text-white" 
                                style="background: linear-gradient(135deg, var(--burger-orange), #ff6b3d); border: none; border-radius: 999px;">
                            <i class='bx bxs-send me-2'></i>Send Message
                        </button>
                    </form>
                </div>
            </div>

            {{-- Visit Us Info --}}
            <div class="alert mt-4 border-0 contact-highlight">
                <h6 class="fw-bold">
                    <i class='bx bxs-car me-2' style="color: var(--burger-orange);"></i>How to Find Us
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
