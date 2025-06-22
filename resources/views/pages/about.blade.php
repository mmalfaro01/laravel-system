@extends('layouts.app')

@section('title', 'About Us')

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <h1 class="display-5 fw-bold text-success">About Veggie Shop</h1>
        <p class="text-muted">Fresh. Organic. Local. Grown with care at Siquijor State College.</p>
    </div>

    <div class="row align-items-center mb-5">
        <div class="col-md-6">
            <p>
                <strong>Veggie Shop</strong> is a sustainable e-commerce platform proudly rooted at <strong>Siquijor State College</strong> in Larena, Siquijor.
                We specialize in hydroponically grown produce, connecting student-farmers and local growers with health-conscious consumers.
                Our mission is to promote organic, chemical-free vegetables while supporting local innovation and sustainability.
            </p>
            <p>
                Whether you're a student, faculty member, or local resident, you can purchase fresh vegetables from our
                <strong>on-campus store</strong>—or order online for pickup or delivery!
            </p>
        </div>
        <div class="col-md-6">
            {{-- Embedded Google Map --}}
            <div class="ratio ratio-4x3 rounded shadow-sm">
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d62894.77907899134!2d123.532366229375!3d9.232780377572618!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33ab3e7d6cda6c0b%3A0x62bff1c487e529a2!2sSiquijor%20State%20College!5e0!3m2!1sen!2sph!4v1685121609876!5m2!1sen!2sph" 
                    width="600" 
                    height="450" 
                    style="border:0;" 
                    allowfullscreen="" 
                    loading="lazy" 
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>
    </div>

    <div class="bg-light rounded p-4 shadow-sm mb-5">
        <h4 class="fw-bold text-success">📍 Visit Our On-Campus Store</h4>
        <p class="mb-1">
            You can find us inside the <strong>Hydroponics Research Greenhouse</strong> at Siquijor State College, Larena campus.
        </p>
        <ul class="list-unstyled mb-0">
            <li><i class="bi bi-geo-alt-fill text-success me-2"></i> Larena, Siquijor 6226, Philippines</li>
            <li><i class="bi bi-clock-fill text-success me-2"></i> Monday – Friday, 8:00 AM – 5:00 PM</li>
            <li><i class="bi bi-telephone-fill text-success me-2"></i> (035) 123-4567</li>
        </ul>
    </div>

    <div class="text-center">
        <a href="{{ route('products.index') }}" class="btn btn-success btn-lg px-4">
            Browse Fresh Products
        </a>
    </div>
</div>
@endsection
