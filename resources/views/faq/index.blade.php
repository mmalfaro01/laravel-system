@extends('layouts.app')

@section('title', 'FAQs - Tropical Burger Siquijor')

@section('content')
<style>
    .faq-title {
        color: var(--burger-white);
        text-shadow: 0 4px 12px rgba(0, 0, 0, 0.6);
    }

    .faq-lead {
        color: var(--burger-muted);
    }

    .faq-highlight {
        background: rgba(243, 154, 18, 0.08);
        border-left: 4px solid var(--burger-orange);
        border-radius: 1rem;
        color: var(--burger-muted);
    }

    .faq-highlight h5 {
        color: var(--burger-gold);
    }

    .faq-accordion-item {
        background: var(--burger-dark);
        border: 1px solid var(--burger-border);
        border-radius: 0.7rem;
        overflow: hidden;
    }

    .faq-accordion-header button {
        background: var(--burger-dark);
        color: var(--burger-white);
    }

    .faq-accordion-header button.collapsed {
        background: var(--burger-black);
        color: var(--burger-muted);
    }

    .faq-accordion-body {
        background: var(--burger-black);
        color: var(--burger-muted);
    }

    .faq-cta-card {
        background: linear-gradient(135deg, var(--burger-orange), #ff6b3d);
        border-radius: 1.25rem;
        border: 1px solid var(--burger-border);
        max-width: 520px;
        margin: 0 auto;
    }

    .faq-cta-card .card-body {
        padding: 1.6rem 2rem;
    }

    .faq-cta-card h3 {
        font-size: 1.35rem;
    }

    .faq-cta-card p {
        font-size: 0.9rem;
        margin-bottom: 1rem;
    }

    .faq-cta-card .btn-lg {
        padding: 0.55rem 1.9rem;
        font-size: 0.9rem;
    }
</style>

<div class="container py-5">
    <div class="text-center mb-5">
        <i class='bx bxs-help-circle display-1 mb-3' style="color: var(--tropical-orange);"></i>
        <h1 class="display-4 fw-bold faq-title">Frequently Asked Questions</h1>
        <p class="lead faq-lead">
            Got questions? We've got answers! 🍔
        </p>
    </div>

    <div class="row justify-content-center mb-5">
        <div class="col-lg-10">
            <div class="alert border-0 faq-highlight">
                <h5 class="fw-bold">
                    <i class='bx bxs-phone me-2' style="color: var(--tropical-orange);"></i>Still have questions?
                </h5>
                <p class="mb-0">
                    Can't find what you're looking for? Feel free to contact us at <strong>+63 912 345 6789</strong> or 
                    <a href="{{ route('contact') }}" style="color: var(--tropical-orange);">send us a message</a>!
                </p>
            </div>
        </div>
    </div>

    {{-- FAQ Accordion --}}
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="accordion" id="faqAccordion">
                @foreach ($faqs as $index => $faq)
                    <div class="accordion-item border-0 shadow-sm mb-3 faq-accordion-item">
                        <h2 class="accordion-header faq-accordion-header" id="heading{{ $index }}">
                            <button class="accordion-button {{ $index > 0 ? 'collapsed' : '' }} fw-semibold" 
                                    type="button" 
                                    data-bs-toggle="collapse"
                                    data-bs-target="#collapse{{ $index }}" 
                                    aria-expanded="{{ $index === 0 ? 'true' : 'false' }}" 
                                    aria-controls="collapse{{ $index }}">
                                <i class='bx bxs-help-circle me-2 fs-4' style="color: var(--burger-orange);"></i>
                                {{ $faq['question'] }}
                            </button>
                        </h2>
                        <div id="collapse{{ $index }}" 
                             class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}" 
                             aria-labelledby="heading{{ $index }}"
                             data-bs-parent="#faqAccordion">
                            <div class="accordion-body faq-accordion-body">
                                <p class="mb-0">
                                    <i class='bx bx-check-circle me-2' style="color: var(--burger-gold);"></i>
                                    {{ $faq['answer'] }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Contact CTA --}}
    <div class="row justify-content-center mt-5">
        <div class="col-lg-8 text-center">
            <div class="card border-0 shadow-lg faq-cta-card">
                <div class="card-body p-5">
                    <h3 class="fw-bold text-white mb-3">
                        <i class='bx bxs-food-menu me-2'></i>Ready to Order?
                    </h3>
                    <p class="text-white mb-4">
                        Explore our delicious tropical burgers and place your order today!
                    </p>
                    <a href="{{ route('products.index') }}" class="btn btn-light btn-lg px-5 py-3 fw-bold shadow-lg" 
                       style="color: var(--tropical-brown);">
                        <i class='bx bxs-burger me-2'></i>View Menu
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
