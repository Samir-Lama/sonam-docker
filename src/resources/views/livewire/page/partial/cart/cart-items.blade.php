<div class="cart-items">
    @forelse ($products as $product)
    <div class="item">
        <a href="{{ route("product", ["id" => $product->id, "product_sku" => $product->sku]) }}" class="info">
            <div class="image">
                @if (count($product->images) > 0)
                <img src="{{ Storage::url($product->images[0]->image->path) }}" alt="{{ $product->name }}">
                @else
                <img src="{{ asset("assets/images/logo.png") }}" alt="{{ $product->name }}" style="opacity: 0.6;">
                @endif
            </div>
            <div class="product-info">
                <span>
                    {{ $product->name }}
                </span>
                <span class="series">
                    {{ collect($product->categories)->implode("name", ", ") }}
                </span>
                <span class="quantity">
                    {{ $product->quantity }} item(s) in stock.
                </span>
            </div>
        </a>
        <div class="price">
            <div class="price-info">
                @if (!$readonly)
                <div>
                    <button wire:click="{{ in_array($product->id, $wishlist_items) ? "removeWishList" : "addToWishList" }}({{ $product->id }})">
                        <i class="feather-{{ in_array($product->id, $wishlist_items) ? "x" : "heart" }}"></i>
                    </button>
                    <button wire:click="deleteCart({{ $product->id }})">
                        <i class="feather-trash"></i>
                    </button>
                </div>
                @endif
                <span>
                    <span>
                        Rs {{ number_format($product->price - $product->discount, 2) }}
                    </span>
                    @if ($product->discount > 0)
                    <span class="discount">
                        <div class="old-price">Rs {{ number_format($product->price, 2) }}</div>
                        <div class="percent">-{{ ceil(($product->discount / $product->price) * 100) }}%</div>
                    </span>
                    @endif
                </span>
            </div>
            <div class="quantity">
                @if (!$readonly)
                <button>
                    <i class="feather-minus" wire:click="subtractQuantity({{ $product->id }})"></i>
                </button>
                @endif
                <span class="{{ $readonly ? 'readonly' : 'updatable' }}">
                    {{ $quantities[$product->id] }}
                </span>
                @if (!$readonly)
                <button>
                    <i class="feather-plus" wire:click="addQuantity({{ $product->id }})"></i>
                </button>
                @endif
            </div>
        </div>
    </div>
    @empty
    <h5>No items in cart</h5>
    @endforelse
</div>
