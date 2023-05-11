@section("title", "Checkout | LEVEL-UP")

<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="section" id="cart-items">
                <div class="section-header">
                    <h4>Your order items</h4>
                </div>
                @livewire("page.partial.cart.cart-items", ["readonly" => true])
            </div>
        </div>
        <div class="col-md-4 sticky-parent">
            <div class="sticky">
                @livewire("page.partial.cart.checkout-info")
            </div>
        </div>
    </div>
</div>
