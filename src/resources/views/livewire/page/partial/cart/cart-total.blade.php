<div class="cart-total">
    <div class="section" id="cart-total">
        <div class="total-header">
            <h4>Order Summary</h4>
        </div>

        <div>
            <span>Items</span>
            <span class="data">{{ $items }} items</span>
        </div>
        <div>
            <span>Price</span>
            <span class="data highlight">Rs {{ number_format($total, 2) }}</span>
        </div>
        <div class="mb-0">
            <a href="{{ route("checkout") }}" class="btn w-100 btn-filled">Proceed to checkout</a>
        </div>
    </div>
</div>
