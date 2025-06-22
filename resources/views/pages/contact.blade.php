@extends('layouts.app')

@section('title', 'Contact Us')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="text-center mb-5">
                <h1 class="display-5 fw-bold text-success">Get in Touch</h1>
                <p class="text-muted">We'd love to hear from you! Reach out to us with your inquiries, feedback, or support needs.</p>
            </div>

            {{-- Contact Details --}}
            <div class="bg-light p-4 rounded shadow-sm mb-4">
                <h5 class="fw-semibold text-success">📌 Contact Information</h5>
                <ul class="list-unstyled mb-0">
                    <li class="mb-2"><i class="bi bi-envelope-fill text-success me-2"></i> <strong>Email:</strong> support@veggieshop.com</li>
                    <li class="mb-2"><i class="bi bi-telephone-fill text-success me-2"></i> <strong>Phone:</strong> +63 912 345 6789</li>
                    <li class="mb-2"><i class="bi bi-geo-alt-fill text-success me-2"></i> <strong>Address:</strong> Siquijor State College, Larena, Siquijor, Philippines</li>
                    <li class="mb-2"><i class="bi bi-clock-fill text-success me-2"></i> <strong>Hours:</strong> Monday – Friday, 8:00 AM – 5:00 PM</li>
                </ul>
            </div>

            {{-- Contact Form --}}
            <form method="POST" action="{{ route('contact.store') }}">
    @csrf
    <div class="mb-3">
        <label for="name" class="form-label">Your Name</label>
        <input type="text" id="name" name="name" class="form-control" placeholder="Enter your name" required>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Your Email</label>
        <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email" required>
    </div>
    <div class="mb-3">
        <label for="message" class="form-label">Message</label>
        <textarea id="message" name="message" rows="4" class="form-control" placeholder="Write your message..." required></textarea>
    </div>
    <button type="submit" class="btn btn-success px-4">Send Message</button>
</form>

            </div>

           
        </div>
    </div>
</div>
@endsection
