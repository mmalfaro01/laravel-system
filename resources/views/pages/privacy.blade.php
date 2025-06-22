@extends('layouts.app')

@section('title', 'Privacy Policy')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="mb-4 text-center">
                <h1 class="fw-bold text-success"><i class="bi bi-shield-lock-fill me-2"></i>Privacy Policy</h1>
                <p class="text-muted">Last updated: {{ \Carbon\Carbon::now()->format('F d, Y') }}</p>
            </div>

            <div class="bg-light p-4 rounded shadow-sm">
                <p class="mb-4">
                    At <strong>Veggie Shop</strong>, your privacy is important to us. This Privacy Policy outlines how we collect, use, and protect your personal information.
                </p>

                <h5 class="fw-semibold mt-4"><i class="bi bi-person-lines-fill me-2"></i>Information We Collect</h5>
                <ul class="list-unstyled ps-3">
                    <li><i class="bi bi-dot"></i> Name and contact details (email, phone number)</li>
                    <li><i class="bi bi-dot"></i> Delivery address and billing information</li>
                    <li><i class="bi bi-dot"></i> Order history and preferences</li>
                    <li><i class="bi bi-dot"></i> IP address and device information (for security)</li>
                </ul>

                <h5 class="fw-semibold mt-4"><i class="bi bi-lock-fill me-2"></i>How We Use Your Information</h5>
                <ul class="list-unstyled ps-3">
                    <li><i class="bi bi-dot"></i> To process your orders and manage deliveries</li>
                    <li><i class="bi bi-dot"></i> To improve your shopping experience</li>
                    <li><i class="bi bi-dot"></i> To send order updates, notifications, or promotions</li>
                    <li><i class="bi bi-dot"></i> To ensure security and prevent fraud</li>
                </ul>

                <h5 class="fw-semibold mt-4"><i class="bi bi-shield-check me-2"></i>Data Protection</h5>
                <p>
                    We implement appropriate security measures to safeguard your data. Your personal details are stored securely and are only accessible by authorized personnel.
                </p>

                <h5 class="fw-semibold mt-4"><i class="bi bi-people-fill me-2"></i>Third-Party Sharing</h5>
                <p>
                    We do not sell or rent your personal information. We may share data with trusted third parties only when necessary (e.g., courier services) and only to fulfill your orders.
                </p>

                <h5 class="fw-semibold mt-4"><i class="bi bi-gear-fill me-2"></i>Your Rights</h5>
                <ul class="list-unstyled ps-3">
                    <li><i class="bi bi-dot"></i> Access and review your personal information</li>
                    <li><i class="bi bi-dot"></i> Request correction or deletion of your data</li>
                    <li><i class="bi bi-dot"></i> Opt-out of promotional emails</li>
                </ul>

                <h5 class="fw-semibold mt-4"><i class="bi bi-envelope-at-fill me-2"></i>Contact Us</h5>
                <p>
                    For any privacy concerns or questions, you may reach us at:<br>
                    <strong>Email:</strong> support@veggieshop.com<br>
                    <strong>Phone:</strong> +63 912 345 6789
                </p>

                <p class="text-muted mt-4 small">
                    This policy may be updated from time to time. Please check this page regularly to stay informed of any changes.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
