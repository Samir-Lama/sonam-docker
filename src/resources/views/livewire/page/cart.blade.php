@section("title", "Your cart | LEVEL-UP")

<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="section" id="cart-items">
                <div class="section-header">
                    <h4>Your Cart</h4>
                </div>
                @livewire("page.partial.cart.cart-items")
            </div>
        </div>
        <div class="col-md-4 sticky-parent">
            <div class="sticky">
                @livewire("page.partial.cart.cart-total")
            </div>
        </div>
    </div>
    @if (count(session("wishlist_items") ?? []) > 0)
    <div class="row">
        <div class="col-md-12">
            <div class="section" id="cart-actions">
                <div class="section-header">
                    <h4>Your wishlist</h4>
                </div>
                @livewire("page.partial.cart.wishlist")
            </div>
        </div>
    </div>
    @endif
</div>
