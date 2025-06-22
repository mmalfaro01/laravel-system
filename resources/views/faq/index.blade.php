@extends('layouts.app')

@section('title', 'FAQs')

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <h1 class="display-5 fw-bold text-success">Frequently Asked Questions</h1>
        <p class="text-muted">Find quick answers to common inquiries about our platform, services, and products.</p>
    </div>

    {{-- Search Form --}}
    <div class="row justify-content-center mb-4">
        <div class="col-md-8">
            <form method="GET" action="{{ route('faq.index') }}">
                <div class="input-group shadow-sm">
                    <input type="text" name="search" placeholder="Search FAQs..." value="{{ request('search') }}" class="form-control">
                    <button class="btn btn-outline-success" type="submit"><i class="bi bi-search"></i> Search</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Accordion --}}
    <div class="accordion accordion-flush" id="faqAccordion">
        @forelse ($faqs as $faq)
            <div class="accordion-item border border-success-subtle rounded mb-3 shadow-sm">
                <h2 class="accordion-header" id="heading{{ $faq->id }}">
                    <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapse{{ $faq->id }}" aria-expanded="false" aria-controls="collapse{{ $faq->id }}">
                        <i class="bi bi-question-circle me-2 text-success"></i>{{ $faq->question }}
                    </button>
                </h2>
                <div id="collapse{{ $faq->id }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $faq->id }}"
                     data-bs-parent="#faqAccordion">
                    <div class="accordion-body bg-light">
                        <p class="mb-0">{{ $faq->answer }}</p>
                    </div>
                </div>
            </div>
        @empty
            <div class="alert alert-warning text-center">
                <i class="bi bi-exclamation-circle"></i> No FAQs found.
            </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    @if($faqs->hasPages())
        <div class="mt-4 d-flex justify-content-center">
            {{ $faqs->withQueryString()->links() }}
        </div>
    @endif
</div>
@endsection
