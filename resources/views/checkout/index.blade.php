@extends('layouts.app')

@section('title', 'Checkout - Tropical Burger')

@section('content')
<style>
    .page-panel { background: var(--burger-dark); border: 1px solid var(--burger-border); border-radius: 1.25rem; overflow: hidden; margin-bottom: 1rem; }
    .page-panel-header { padding: 1rem 1.25rem; border-bottom: 1px solid var(--burger-border); }
    .page-panel-header h2 { font-size: 1.2rem; font-weight: 800; margin: 0; color: var(--burger-white); }
    .page-panel-body { padding: 1rem 1.25rem; color: var(--burger-white); }
    .checkout-table-wrap .table-responsive { background: var(--burger-dark) !important; }
    .checkout-table { color: var(--burger-white); font-size: 0.9rem; background: var(--burger-dark) !important; }
    .checkout-table thead { background: var(--burger-black) !important; }
    .checkout-table thead th { border-color: var(--burger-border); background: var(--burger-black) !important; color: var(--burger-white) !important; font-weight: 700; }
    .checkout-table tbody { background: var(--burger-dark) !important; }
    .checkout-table tbody td { border-color: var(--burger-border); padding: 0.5rem 0.75rem; background: var(--burger-dark) !important; color: var(--burger-white); }
    .checkout-table th, .checkout-table td { border-color: var(--burger-border); padding: 0.5rem 0.75rem; }
    .checkout-total { color: var(--burger-gold); font-weight: 800; }
    .form-label { color: var(--burger-muted); }
    .delivery-block { background: var(--burger-black); border: 1px solid var(--burger-border); border-radius: 0.75rem; padding: 1rem; margin: 1rem 0; }
    .delivery-block .form-check-label { color: var(--burger-white); }
</style>

<div class="container py-3">
    <div class="row g-3">
        <div class="col-lg-8">
            <div class="page-panel">
                <div class="page-panel-header">
                    <h2>Order summary</h2>
                </div>
                <div class="page-panel-body p-0">
                    <div class="table-responsive">
                        <table class="table table-borderless checkout-table mb-0">
                            <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>Price</th>
                                    <th>Qty</th>
                                    <th class="text-end">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cartItems as $item)
                                <tr>
                                    <td>{{ $item['name'] }}</td>
                                    <td>₱{{ number_format($item['price'], 2) }}</td>
                                    <td>{{ $item['quantity'] }}</td>
                                    <td class="text-end checkout-total">₱{{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="px-3 py-2 border-top" style="border-color: var(--burger-border) !important; background: var(--burger-dark); color: var(--burger-muted);">
                        <div class="d-flex justify-content-between align-items-center">
                            <span>Grand total</span>
                            <span class="checkout-total fs-5">₱{{ number_format($total, 2) }}</span>
                        </div>
                        @if($total >= 500)
                            <small class="text-success">Free delivery applied</small>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="page-panel">
                <div class="page-panel-header">
                    <h2>Payment & delivery</h2>
                </div>
                <div class="page-panel-body">
                    @if ($errors->any())
                        <div class="alert alert-danger mb-3">
                            <ul class="mb-0 small">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('checkout.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Payment method</label>
                            <select name="payment_method" class="form-select form-select-sm" id="payment-method-select" required>
                                <option value="card" selected>Card</option>
                                <option value="cod">Cash on delivery</option>
                                <option value="gcash">GCash</option>
                                <option value="paypal">PayPal</option>
                            </select>
                        </div>

                        <div id="card-fields">
                            <div class="mb-2">
                                <label class="form-label">Name on card</label>
                                <input type="text" class="form-control form-control-sm" name="name">
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Card number</label>
                                <input type="text" class="form-control form-control-sm" name="card" placeholder="1234 5678 9012 3456">
                            </div>
                            <div class="row g-2 mb-2">
                                <div class="col-6">
                                    <label class="form-label">Expiry</label>
                                    <input type="text" class="form-control form-control-sm" name="expiry" placeholder="MM/YY">
                                </div>
                                <div class="col-6">
                                    <label class="form-label">CVV</label>
                                    <input type="text" class="form-control form-control-sm" name="cvv" placeholder="123">
                                </div>
                            </div>
                        </div>

                        <div id="cod-fields" class="d-none">
                            <div class="mb-2">
                                <label class="form-label">Full name</label>
                                <input type="text" class="form-control form-control-sm" name="cod_name">
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Address</label>
                                <textarea class="form-control form-control-sm" name="cod_address" rows="2"></textarea>
                            </div>
                        </div>

                        <div id="gcash-fields" class="d-none">
                            <div class="mb-2">
                                <label class="form-label">Account name</label>
                                <input type="text" class="form-control form-control-sm" name="gcash_name">
                            </div>
                            <div class="mb-2">
                                <label class="form-label">GCash number</label>
                                <input type="text" class="form-control form-control-sm" name="gcash_number">
                            </div>
                        </div>

                        <div id="paypal-fields" class="d-none">
                            <div class="mb-2">
                                <label class="form-label">PayPal email</label>
                                <input type="email" class="form-control form-control-sm" name="paypal_email">
                            </div>
                        </div>

                        <div class="delivery-block">
                            <label class="form-label d-block mb-2">Delivery</label>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="shipping_option" id="deliver_now" value="now" checked>
                                <label class="form-check-label" for="deliver_now">Deliver now (25–35 min)</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="shipping_option" id="schedule" value="schedule">
                                <label class="form-check-label" for="schedule">Schedule for later</label>
                            </div>
                            <div id="delivery-date-field" class="mt-2 d-none">
                                <label for="delivery_date" class="form-label">Date</label>
                                <input type="date" name="delivery_date" id="delivery_date" class="form-control form-control-sm">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 mt-2">Place order</button>
                        <small class="d-block text-center text-secondary mt-2">Secure checkout</small>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
(function() {
    var methodSelect = document.getElementById('payment-method-select');
    var cardFields = document.getElementById('card-fields');
    var codFields = document.getElementById('cod-fields');
    var gcashFields = document.getElementById('gcash-fields');
    var paypalFields = document.getElementById('paypal-fields');

    function updatePaymentFields() {
        cardFields.classList.add('d-none');
        codFields.classList.add('d-none');
        gcashFields.classList.add('d-none');
        paypalFields.classList.add('d-none');
        var method = methodSelect.value;
        if (method === 'card') cardFields.classList.remove('d-none');
        if (method === 'cod') codFields.classList.remove('d-none');
        if (method === 'gcash') gcashFields.classList.remove('d-none');
        if (method === 'paypal') paypalFields.classList.remove('d-none');
    }
    methodSelect.addEventListener('change', updatePaymentFields);
    updatePaymentFields();

    var deliverNow = document.getElementById('deliver_now');
    var schedule = document.getElementById('schedule');
    var deliveryDateField = document.getElementById('delivery-date-field');
    function toggleDeliveryDate() {
        deliveryDateField.classList.toggle('d-none', !schedule.checked);
    }
    deliverNow.addEventListener('change', toggleDeliveryDate);
    schedule.addEventListener('change', toggleDeliveryDate);
    toggleDeliveryDate();

    document.querySelector('form').addEventListener('submit', function() {
        [cardFields, codFields, gcashFields, paypalFields].forEach(function(el) {
            if (el.classList.contains('d-none') && el.querySelectorAll) {
                el.querySelectorAll('input, textarea').forEach(function(i) { i.disabled = true; });
            }
        });
    });
})();
</script>
@endsection
