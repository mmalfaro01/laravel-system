@extends('layouts.app')

@section('title', 'FAQs - Tropical Burger Siquijor')

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <i class='bx bxs-help-circle display-1 mb-3' style="color: var(--tropical-orange);"></i>
        <h1 class="display-4 fw-bold" style="color: var(--tropical-brown);">Frequently Asked Questions</h1>
        <p class="lead" style="color: var(--tropical-orange);">
            Got questions? We've got answers! 🍔
        </p>
    </div>

    <div class="row justify-content-center mb-5">
        <div class="col-lg-10">
            <div class="alert border-0" style="background: linear-gradient(135deg, #FFF8DC, #FFE4B5); border-left: 5px solid var(--tropical-orange) !important;">
                <h5 class="fw-bold" style="color: var(--tropical-brown);">
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
                    <div class="accordion-item border-0 shadow-sm mb-3" style="border: 2px solid var(--tropical-orange) !important; border-radius: 0.5rem; overflow: hidden;">
                        <h2 class="accordion-header" id="heading{{ $index }}">
                            <button class="accordion-button {{ $index > 0 ? 'collapsed' : '' }} fw-semibold" 
                                    type="button" 
                                    data-bs-toggle="collapse"
                                    data-bs-target="#collapse{{ $index }}" 
                                    aria-expanded="{{ $index === 0 ? 'true' : 'false' }}" 
                                    aria-controls="collapse{{ $index }}"
                                    style="background: linear-gradient(135deg, #FFF8DC, #FFE4B5); color: var(--tropical-brown);">
                                <i class='bx bxs-help-circle me-2 fs-4' style="color: var(--tropical-orange);"></i>
                                {{ $faq['question'] }}
                            </button>
                        </h2>
                        <div id="collapse{{ $index }}" 
                             class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}" 
                             aria-labelledby="heading{{ $index }}"
                             data-bs-parent="#faqAccordion">
                            <div class="accordion-body" style="background: white;">
                                <p class="mb-0">
                                    <i class='bx bx-check-circle me-2' style="color: var(--tropical-green);"></i>
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
            <div class="card border-0 shadow-lg" style="background: linear-gradient(135deg, var(--tropical-orange), var(--tropical-red));">
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
