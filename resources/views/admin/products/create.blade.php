@extends('layouts.admin')

@section('title', 'Add Product')

@section('content')
<style>
    .product-form-shell {
        background: linear-gradient(180deg, rgba(243,154,18,0.08), transparent 30%);
        border: 1px solid var(--burger-border);
        border-radius: 1.5rem;
        overflow: hidden;
    }
    .product-form-hero {
        padding: 1.5rem;
        background: linear-gradient(135deg, #1a1a1a 0%, #0f0f0f 100%);
        border-bottom: 1px solid var(--burger-border);
    }
    .product-form-hero h1,
    .product-form-hero p,
    .product-form-hero small {
        margin: 0;
    }
    .hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.45rem;
        padding: 0.4rem 0.75rem;
        border-radius: 999px;
        background: rgba(243,154,18,0.12);
        color: var(--burger-gold);
        font-size: 0.8rem;
        font-weight: 700;
        border: 1px solid rgba(243,154,18,0.25);
    }
    .form-card,
    .preview-card {
        background: var(--burger-dark);
        border: 1px solid var(--burger-border);
        border-radius: 1.25rem;
        height: 100%;
    }
    .form-card .card-body,
    .preview-card .card-body {
        padding: 1.25rem;
    }
    .field-block {
        background: rgba(255,255,255,0.02);
        border: 1px solid rgba(255,255,255,0.06);
        border-radius: 1rem;
        padding: 1rem;
        margin-bottom: 1rem;
    }
    .field-label {
        color: var(--burger-muted);
        font-size: 0.82rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.04em;
        margin-bottom: 0.45rem;
    }
    .preview-stage {
        border: 1px dashed rgba(243,154,18,0.4);
        border-radius: 1rem;
        min-height: 220px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: radial-gradient(circle at top, rgba(243,154,18,0.12), transparent 60%);
        overflow: hidden;
    }
    .preview-stage img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: none;
    }
    .preview-placeholder {
        text-align: center;
        color: var(--burger-muted);
        padding: 2rem 1rem;
    }
    .preview-placeholder i {
        font-size: 3rem;
        color: var(--burger-orange);
        margin-bottom: 0.5rem;
        display: block;
    }
    .action-row {
        display: flex;
        gap: 0.75rem;
        flex-wrap: wrap;
        justify-content: flex-end;
    }
    .action-row .btn {
        border-radius: 999px;
        padding: 0.75rem 1.2rem;
        font-weight: 700;
    }
</style>

<div class="container-fluid py-2">
    <div class="product-form-shell">
        <div class="product-form-hero">
            <div class="d-flex flex-wrap justify-content-between align-items-end gap-3">
                <div>
                    <span class="hero-badge"><i class='bx bx-plus-circle'></i> Product Builder</span>
                    <h1 class="mt-3 mb-2 fw-bold">Add New Product</h1>
                    <p class="text-muted mb-0">Create a menu item with structured details, categorized pricing, and an image preview.</p>
                </div>
                <small class="text-secondary">Same fields, redesigned layout</small>
            </div>
        </div>

        <div class="row g-0">
            <div class="col-lg-8 p-3 p-lg-4">
                <div class="form-card">
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger border-0">
                                <strong class="d-block mb-2">Please fix the following:</strong>
                                <ul class="mb-0 ps-3">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="field-block">
                                <div class="field-label">Product Identity</div>
                                <label for="name" class="form-label text-white fw-semibold">Product Name</label>
                                <input type="text" name="name" class="form-control form-control-lg" value="{{ old('name') }}" placeholder="e.g. Classic Burger" required>
                            </div>

                            <div class="field-block">
                                <div class="field-label">Description</div>
                                <label for="description" class="form-label text-white fw-semibold">Product Description</label>
                                <textarea name="description" rows="6" class="form-control" placeholder="Describe ingredients, taste, or serving details">{{ old('description') }}</textarea>
                            </div>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="field-block h-100 mb-0">
                                        <div class="field-label">Pricing</div>
                                        <label for="price" class="form-label text-white fw-semibold">Price (₱)</label>
                                        <input type="number" step="0.01" name="price" class="form-control form-control-lg" value="{{ old('price') }}" placeholder="0.00" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="field-block h-100 mb-0">
                                        <div class="field-label">Category</div>
                                        <label for="category_id" class="form-label text-white fw-semibold">Product Category</label>
                                        <select name="category_id" id="category_id" class="form-select form-select-lg">
                                            <option value="">Select category</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="field-block mt-3">
                                <div class="field-label">Media</div>
                                <label for="image" class="form-label text-white fw-semibold">Product Image</label>
                                <input type="file" name="image" id="productImageInput" class="form-control form-control-lg">
                                <small class="text-muted d-block mt-2">Recommended: square image, at least 800x800 px.</small>
                            </div>

                            <div class="mt-4 action-row">
                                <a href="{{ route('admin.products.index') }}" class="btn btn-outline-light">Cancel</a>
                                <button type="submit" class="btn btn-warning text-dark">
                                    <i class='bx bx-save'></i> Add Product
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 p-3 p-lg-4 ps-lg-0">
                <div class="preview-card">
                    <div class="card-body">
                        <h5 class="text-white fw-bold mb-2">Live Preview</h5>
                        <p class="text-muted mb-3">This panel shows the product image area and useful creation hints.</p>

                        <div class="preview-stage mb-3">
                            <div class="preview-placeholder" id="imagePlaceholder">
                                <i class='bx bx-image'></i>
                                <div class="fw-semibold text-white">No image selected</div>
                                <small>Select an image to preview it here</small>
                            </div>
                            <img id="imagePreview" alt="Product preview">
                        </div>

                        <div class="field-block mb-3">
                            <div class="field-label">Tip 1</div>
                            <div class="text-white">Use a short, clear product name that matches the menu.</div>
                        </div>
                        <div class="field-block mb-3">
                            <div class="field-label">Tip 2</div>
                            <div class="text-white">Keep descriptions informative and concise for faster scanning.</div>
                        </div>
                        <div class="field-block mb-0">
                            <div class="field-label">Tip 3</div>
                            <div class="text-white">Choose the correct category so the product appears in the right section.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const input = document.getElementById('productImageInput');
    const preview = document.getElementById('imagePreview');
    const placeholder = document.getElementById('imagePlaceholder');

    if (!input || !preview || !placeholder) return;

    input.addEventListener('change', function () {
        const file = this.files && this.files[0];
        if (!file) {
            preview.style.display = 'none';
            placeholder.style.display = 'block';
            return;
        }

        const reader = new FileReader();
        reader.onload = function (e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
            placeholder.style.display = 'none';
        };
        reader.readAsDataURL(file);
    });
});
</script>
@endsection
