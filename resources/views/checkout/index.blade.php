@extends('layouts.app')
@section('content')

<style>
    .checkout-header {
        background: linear-gradient(135deg, var(--tropical-orange), var(--tropical-red));
        color: white;
        padding: 2.5rem;
        border-radius: 1.5rem;
        box-shadow: 0 8px 25px rgba(0,0,0,0.2);
    }

    .order-card {
        border: 3px solid var(--tropical-orange);
        border-radius: 1rem;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }

    .payment-card {
        border: 3px solid var(--tropical-brown);
        border-radius: 1rem;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
</style>

<div class="container py-5">
    <div class="checkout-header text-center mb-5">
        <i class='bx bxs-credit-card display-1 mb-3'></i>
        <h1 class="display-4 fw-bold">Secure Checkout</h1>
        <p class="fs-5 mb-0">Almost there! Complete your tropical burger order 🍔</p>
    </div>

    <div class="row g-5">
        <div class="col-md-8">
            <div class="card order-card mb-4 bg-white">
                <div class="card-header py-3" style="background: linear-gradient(135deg, var(--tropical-orange), var(--tropical-red));">
                    <h4 class="mb-0 text-white fw-bold">
                        <i class='bx bxs-receipt me-2'></i>Your Burger Order
                    </h4>
                </div>
                <div class="card-body p-4">
                    <table class="table table-borderless align-middle mb-0">
                        <thead class="border-bottom">
                            <tr>
                                <th style="color: var(--tropical-brown);">
                                    <i class='bx bxs-burger me-2'></i>Burger
                                </th>
                                <th style="color: var(--tropical-brown);">Price</th>
                                <th style="color: var(--tropical-brown);">Qty</th>
                                <th style="color: var(--tropical-brown);">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cartItems as $item)
                            <tr>
                                <td class="fw-semibold">{{ $item['name'] }}</td>
                                <td style="color: var(--tropical-red);">₱{{ number_format($item['price'], 2) }}</td>
                                <td><span class="badge bg-warning text-dark">{{ $item['quantity'] }}</span></td>
                                <td class="fw-bold" style="color: var(--tropical-orange);">₱{{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="border-top mt-3 pt-3" style="background: linear-gradient(135deg, #FFF8DC, #FFE4B5); margin: 0 -1.5rem -1.5rem; padding: 1.5rem !important;">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-0 fw-bold" style="color: var(--tropical-brown);">
                                <i class='bx bx-calculator me-2'></i>Grand Total:
                            </h5>
                            <h4 class="mb-0 fw-bold" style="color: var(--tropical-red);">₱{{ number_format($total, 2) }}</h4>
                        </div>
                        @if($total >= 500)
                            <div class="alert alert-success mt-3 mb-0 border-0">
                                <i class='bx bxs-truck'></i> <strong>FREE DELIVERY</strong> included!
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card payment-card bg-white">
                <div class="card-header py-3" style="background: linear-gradient(135deg, var(--tropical-brown), #654321);">
                    <h4 class="mb-0 text-white fw-bold">
                        <i class='bx bxs-credit-card me-2'></i>Payment Details
                    </h4>
                </div>
                <div class="card-body p-4">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('checkout.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Payment Method</label>
                            <select name="payment_method" class="form-select" id="payment-method-select" required>
                                <option value="card" selected>Credit / Debit Card</option>
                                <option value="cod">Cash on Delivery</option>
                                <option value="gcash">GCash</option>
                                <option value="paypal">PayPal</option>
                            </select>
                        </div>

                        <div id="card-fields">
                            <div class="mb-3">
                                <label class="form-label">Name on Card</label>
                                <input type="text" class="form-control" name="name">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Card Number</label>
                                <input type="text" class="form-control" name="card" placeholder="1234 5678 9012 3456">
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Expiry Date</label>
                                    <input type="text" class="form-control" name="expiry" placeholder="MM/YY">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">CVV</label>
                                    <input type="text" class="form-control" name="cvv" placeholder="123">
                                </div>
                            </div>
                        </div>

                        <div id="cod-fields" class="d-none">
                            <div class="mb-3">
                                <label class="form-label">Full Name</label>
                                <input type="text" class="form-control" name="cod_name">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Shipping Address</label>
                                <textarea class="form-control" name="cod_address" rows="2"></textarea>
                            </div>
                        </div>

                        <div id="gcash-fields" class="d-none">
                            <div class="mb-3">
                                <label class="form-label">Account Holder Name</label>
                                <input type="text" class="form-control" name="gcash_name">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">GCash Number</label>
                                <input type="text" class="form-control" name="gcash_number">
                            </div>
                        </div>

                        <div id="paypal-fields" class="d-none">
                            <div class="mb-3">
                                <label class="form-label">PayPal Email</label>
                                <input type="email" class="form-control" name="paypal_email">
                            </div>
                        </div>

                        {{-- 🚚 Delivery Schedule --}}
                        <div class="card border-0 mb-4 mt-4" style="border: 2px solid var(--tropical-yellow) !important; border-radius: 1rem; overflow: hidden;">
                            <div class="card-header py-3" style="background: linear-gradient(135deg, #FFD23F, #FFA500);">
                                <h5 class="mb-0 fw-bold text-dark">
                                    <i class='bx bxs-truck me-2'></i>Delivery Options
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="form-check mb-3 p-3 rounded" style="background: #FFF8DC; border: 2px solid var(--tropical-orange);">
                                    <input class="form-check-input" type="radio" name="shipping_option" id="deliver_now" value="now" checked>
                                    <label class="form-check-label fw-semibold" for="deliver_now">
                                        <i class='bx bx-time-five text-danger'></i> Deliver Now (25-35 mins)
                                    </label>
                                </div>
                                <div class="form-check p-3 rounded" style="background: #FFF8DC; border: 2px solid var(--tropical-orange);">
                                    <input class="form-check-input" type="radio" name="shipping_option" id="schedule" value="schedule">
                                    <label class="form-check-label fw-semibold" for="schedule">
                                        <i class='bx bx-calendar text-primary'></i> Schedule for Later
                                    </label>
                                </div>

                                <div id="delivery-date-field" class="mb-3 mt-3 d-none">
                                    <label for="delivery_date" class="form-label fw-semibold">
                                        <i class='bx bx-calendar-check'></i> Select Date & Time
                                    </label>
                                    <input type="date" name="delivery_date" id="delivery_date" class="form-control" 
                                           style="border: 2px solid var(--tropical-orange);">
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn w-100 py-3 fw-bold text-white shadow-lg" 
                                style="background: linear-gradient(135deg, var(--tropical-orange), var(--tropical-red)); border: none; font-size: 1.1rem;">
                            <i class='bx bx-check-circle fs-4 me-2'></i>Place Order Now
                        </button>

                        <div class="text-center mt-3">
                            <small class="text-muted">
                                <i class='bx bx-lock-alt'></i> Secure checkout • Your data is protected
                            </small>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const methodSelect = document.getElementById('payment-method-select');
    const cardFields = document.getElementById('card-fields');
    const codFields = document.getElementById('cod-fields');
    const gcashFields = document.getElementById('gcash-fields');
    const paypalFields = document.getElementById('paypal-fields');

    function updateFields() {
        cardFields.classList.add('d-none');
        codFields.classList.add('d-none');
        gcashFields.classList.add('d-none');
        paypalFields.classList.add('d-none');

        const method = methodSelect.value;
        if (method === 'card') cardFields.classList.remove('d-none');
        if (method === 'cod') codFields.classList.remove('d-none');
        if (method === 'gcash') gcashFields.classList.remove('d-none');
        if (method === 'paypal') paypalFields.classList.remove('d-none');
    }

    methodSelect.addEventListener('change', updateFields);
    window.addEventListener('load', updateFields);

    // Disable unused inputs before submit
    document.querySelector('form').addEventListener('submit', function() {
        if (cardFields.classList.contains('d-none')) {
            cardFields.querySelectorAll('input').forEach(input => input.disabled = true);
        }
        if (codFields.classList.contains('d-none')) {
            codFields.querySelectorAll('input, textarea').forEach(input => input.disabled = true);
        }
        if (gcashFields.classList.contains('d-none')) {
            gcashFields.querySelectorAll('input').forEach(input => input.disabled = true);
        }
        if (paypalFields.classList.contains('d-none')) {
            paypalFields.querySelectorAll('input').forEach(input => input.disabled = true);
        }
    });

    // Handle shipping date toggle
    const deliverNow = document.getElementById('deliver_now');
    const schedule = document.getElementById('schedule');
    const deliveryDateField = document.getElementById('delivery-date-field');

    function toggleDeliveryDate() {
        if (schedule.checked) {
            deliveryDateField.classList.remove('d-none');
        } else {
            deliveryDateField.classList.add('d-none');
        }
    }

    deliverNow.addEventListener('change', toggleDeliveryDate);
    schedule.addEventListener('change', toggleDeliveryDate);
    window.addEventListener('load', toggleDeliveryDate);
</script>

@endsection
