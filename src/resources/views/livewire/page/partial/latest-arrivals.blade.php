<div class="products row">
    @foreach ($products as $product)
    <div class="col-md-{{ $row_size }} mb-4">
        <div class="product">
            <a href="{{ route("product", ["id" => $product->id, "product_sku" => $product->sku]) }}">
                <div class="product-image">
                    @if ($product->images->count() > 0)
                    <img src="{{ Storage::url($product->images->first()->image["path"]) }}" alt="{{ $product->name }}">
                    @else
                    <img src="{{ asset("assets/images/logo.png") }}" alt="{{ $product->name }}" style="opacity: 0.6; object-fit: contain;">
                    @endif
                </div>
                <div class="product-info">
                    <h2>{{ $product->name }}</h2>
                    <h5>{{ $product->categories->implode("name", ", ") }}</h5>
                    @if ($product->discount)
                    <span class="old-price">Rs {{ number_format($product->price, 2) }}</span>
                    @endif
                    <span class="price">Rs {{ number_format($product->price - $product->discount, 2) }}</span>
                </div>
            </a>
            <button class="btn btn-{{ in_array($product->id, $wishlist_items) ? "filled" : "hollow" }} wishlist-btn" wire:click="{{ in_array($product->id, $wishlist_items) ? "removeWishList" : "addToWishList" }}({{ $product->id }})">
                <i class="feather-{{ in_array($product->id, $wishlist_items) ? "x" : "heart" }}"></i>
            </button>
            <div class="cta row g-0">
                <button class="btn btn-filled d-inline addtocart-btn" wire:click="addToCart({{ $product->id }})" {{ in_array($product->id, $cart_items) ? "disabled" : "" }}>
                    <span wire:loading wire:target="addToCart({{ $product->id }})">
                        <i class="feather-more-horizontal"></i>
                    </span>
                    <span wire:loading.remove wire:target="addToCart({{ $product->id }})">
                        <i class="feather-shopping-bag"></i>
                        {{ in_array($product->id, $cart_items) ? "Already in cart" : "Add to cart"}}
                    </span>
                </button>
            </div>
        </div>
    </div>
    @endforeach

    @if ($paginate)
    <div class="pagination">
        {{ $products->links() }}
    </div>
    @endif
</div>

@push('styles')
<style>
    .pagination {
        margin-top: 20px;
        font-size: 14px;
        font-weight: 500;
    }
    .pagination a {
        color: #000;
    }
    .pagination .flex {
        display: flex;
    }
    .pagination .items-center {
        align-items: center;
    }
    .pagination .justify-between {
        justify-content: space-between;
    }
    .pagination .hidden {
        display: none;
    }
</style>
@endpush
