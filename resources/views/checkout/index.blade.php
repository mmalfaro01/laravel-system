@extends('layouts.app')
@section('content')

<div class="container py-5">
    <div class="mb-5 text-center">
        <h1 class="display-5 fw-bold">Checkout</h1>
        <p class="text-muted">Review your order and complete your purchase.</p>
    </div>

    <div class="row g-5">
        <div class="col-md-8">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">🧾 Order Summary</h4>
                </div>
                <div class="card-body">
                    <table class="table table-borderless align-middle">
                        <thead class="border-bottom">
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Qty</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cartItems as $item)
                            <tr>
                                <td>{{ $item['name'] }}</td>
                                <td>${{ number_format($item['price'], 2) }}</td>
                                <td>{{ $item['quantity'] }}</td>
                                <td>${{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="border-top">
                            <tr>
                                <td colspan="3" class="text-end fw-bold">Total:</td>
                                <td class="text-success fw-bold">${{ number_format($total, 2) }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-dark text-white">
                    <h4 class="mb-0">💳 Payment Info</h4>
                </div>
                <div class="card-body">

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

                        {{-- 🚚 Shipping Schedule --}}
                        <div class="card shadow-sm border-0 mb-4 mt-4">
                            <div class="card-header bg-warning text-dark">
                                <h4 class="mb-0">🚚 Shipping Schedule</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="shipping_option" id="deliver_now" value="now" checked>
                                    <label class="form-check-label" for="deliver_now">
                                        Deliver Now (ASAP)
                                    </label>
                                </div>
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="radio" name="shipping_option" id="schedule" value="schedule">
                                    <label class="form-check-label" for="schedule">
                                        Schedule a Delivery Date
                                    </label>
                                </div>

                                <div id="delivery-date-field" class="mb-3 d-none">
                                    <label for="delivery_date" class="form-label">Select Delivery Date</label>
                                    <input type="date" name="delivery_date" id="delivery_date" class="form-control">
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 py-2">
                            🛒 Place Order
                        </button>
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
