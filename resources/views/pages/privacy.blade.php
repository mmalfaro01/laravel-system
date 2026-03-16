@extends('layouts.app')

@section('title', 'Privacy Policy - Tropical Burger Siquijor')

@section('content')
<style>
    .privacy-title {
        color: var(--burger-white);
        text-shadow: 0 4px 12px rgba(0, 0, 0, 0.6);
    }

    .privacy-muted {
        color: var(--burger-muted) !important;
    }

    .privacy-card {
        background: var(--burger-dark);
        border-radius: 1.25rem;
        border: 1px solid var(--burger-border);
        box-shadow: 0 18px 40px rgba(0, 0, 0, 0.7);
    }

    .privacy-block {
        background: rgba(243, 154, 18, 0.08);
        border-left: 4px solid var(--burger-orange);
        border-radius: 1rem;
        color: var(--burger-muted);
    }

    .privacy-block h5 {
        color: var(--burger-gold);
    }

    .privacy-accent-green {
        border-left-color: #22c55e;
    }

    .privacy-accent-red {
        border-left-color: #ef4444;
    }

    .privacy-accent-yellow {
        border-left-color: var(--burger-gold);
    }

    .privacy-footer-cta {
        background: linear-gradient(135deg, var(--burger-orange), #ff6b3d);
        border-radius: 1.25rem;
        border: 1px solid var(--burger-border);
    }
</style>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="mb-5 text-center">
                <i class='bx bxs-shield-alt-2 display-1 mb-3' style="color: var(--tropical-orange);"></i>
                <h1 class="fw-bold privacy-title">Privacy Policy</h1>
                <p class="privacy-muted">Last updated: {{ \Carbon\Carbon::now()->format('F d, Y') }}</p>
            </div>

            <div class="card border-0 shadow-lg privacy-card">
                <div class="card-body p-5">
                    <p class="mb-4" style="font-size: 1.1rem;">
                        At <strong>Tropical Burger Siquijor</strong>, your privacy is important to us. This Privacy Policy outlines how we collect, use, and protect your personal information when you order from us online or visit our restaurant.
                    </p>

                    <div class="mb-4 p-3 rounded privacy-block">
                        <h5 class="fw-bold">
                            <i class='bx bxs-user-detail me-2' style="color: var(--burger-orange);"></i>Information We Collect
                        </h5>
                        <ul class="list-unstyled ps-3 mb-0">
                            <li class="mb-2"><i class='bx bx-check text-success me-2'></i> Name and contact details (email, phone number)</li>
                            <li class="mb-2"><i class='bx bx-check text-success me-2'></i> Delivery address (for online orders)</li>
                            <li class="mb-2"><i class='bx bx-check text-success me-2'></i> Order history and preferences</li>
                            <li class="mb-2"><i class='bx bx-check text-success me-2'></i> Payment information (processed securely)</li>
                            <li class="mb-0"><i class='bx bx-check text-success me-2'></i> IP address and device information (for security purposes)</li>
                        </ul>
                    </div>

                    <div class="mb-4 p-3 rounded privacy-block privacy-accent-green">
                        <h5 class="fw-bold">
                            <i class='bx bxs-cog me-2' style="color: #22c55e;"></i>How We Use Your Information
                        </h5>
                        <ul class="list-unstyled ps-3 mb-0">
                            <li class="mb-2"><i class='bx bx-check text-success me-2'></i> To process your orders and manage deliveries</li>
                            <li class="mb-2"><i class='bx bx-check text-success me-2'></i> To provide updates on your order status</li>
                            <li class="mb-2"><i class='bx bx-check text-success me-2'></i> To improve your experience and our services</li>
                            <li class="mb-2"><i class='bx bx-check text-success me-2'></i> To send promotional offers (only with your consent)</li>
                            <li class="mb-0"><i class='bx bx-check text-success me-2'></i> To ensure security and prevent fraudulent activities</li>
                        </ul>
                    </div>

                    <div class="mb-4 p-3 rounded privacy-block privacy-accent-red">
                        <h5 class="fw-bold">
                            <i class='bx bxs-lock-alt me-2' style="color: #ef4444;"></i>Data Protection & Security
                        </h5>
                        <p class="mb-0">
                            We implement appropriate technical and organizational security measures to protect your personal data against unauthorized access, 
                            alteration, disclosure, or destruction. Your payment information is processed through secure, encrypted channels and we never store 
                            your full credit card details on our servers.
                        </p>
                    </div>

                    <div class="mb-4 p-3 rounded privacy-block privacy-accent-yellow">
                        <h5 class="fw-bold">
                            <i class='bx bxs-group me-2' style="color: var(--burger-orange);"></i>Third-Party Sharing
                        </h5>
                        <p class="mb-0">
                            We do not sell, trade, or rent your personal information to third parties. We may share your data only with trusted service providers 
                            (such as delivery partners) who assist us in operating our business and serving you better. These parties are bound by confidentiality 
                            agreements and are not permitted to use your information for any other purpose.
                        </p>
                    </div>

                    <div class="mb-4 p-3 rounded privacy-block privacy-accent-green">
                        <h5 class="fw-bold">
                            <i class='bx bxs-user-check me-2' style="color: #22c55e;"></i>Your Rights
                        </h5>
                        <ul class="list-unstyled ps-3 mb-0">
                            <li class="mb-2"><i class='bx bx-check text-success me-2'></i> <strong>Access:</strong> Request a copy of your personal data</li>
                            <li class="mb-2"><i class='bx bx-check text-success me-2'></i> <strong>Correction:</strong> Request corrections to inaccurate information</li>
                            <li class="mb-2"><i class='bx bx-check text-success me-2'></i> <strong>Deletion:</strong> Request deletion of your personal data</li>
                            <li class="mb-0"><i class='bx bx-check text-success me-2'></i> <strong>Opt-out:</strong> Unsubscribe from promotional emails at any time</li>
                        </ul>
                    </div>

                    <div class="mb-4 p-3 rounded privacy-block">
                        <h5 class="fw-bold">
                            <i class='bx bxs-cookie me-2' style="color: var(--burger-orange);"></i>Cookies
                        </h5>
                        <p class="mb-0">
                            Our website uses cookies to enhance your browsing experience, remember your preferences, and analyze site traffic. 
                            You can control cookie settings through your browser, but please note that disabling cookies may affect the functionality 
                            of certain features.
                        </p>
                    </div>

                    <div class="alert border-0 privacy-footer-cta">
                        <h5 class="fw-bold text-white mb-3">
                            <i class='bx bxs-envelope me-2'></i>Contact Us About Privacy
                        </h5>
                        <p class="text-white mb-2">
                            If you have any questions or concerns about our Privacy Policy or how we handle your data, please don't hesitate to contact us:
                        </p>
                        <p class="text-white mb-0">
                            <strong>Email:</strong> privacy@tropicalburger.ph<br>
                            <strong>Phone:</strong> +63 912 345 6789<br>
                            <strong>Address:</strong> Tropical Burger Siquijor, Poblacion, Siquijor 6226, Philippines
                        </p>
                    </div>

                    <p class="privacy-muted mt-4 small text-center">
                        <i class='bx bx-info-circle me-1'></i>
                        This Privacy Policy may be updated from time to time to reflect changes in our practices or for legal reasons. 
                        Please check this page periodically to stay informed of any updates. Continued use of our services after changes 
                        are posted constitutes acceptance of the updated policy.
                    </p>
                </div>
            </div>

            <div class="text-center mt-4">
                <a href="{{ route('products.index') }}" class="btn btn-lg px-5 py-3 fw-bold text-white shadow-lg" 
                   style="background: linear-gradient(135deg, var(--burger-orange), #ff6b3d); border-radius: 999px; border: none;">
                    <i class='bx bxs-food-menu me-2'></i>Order Now
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
