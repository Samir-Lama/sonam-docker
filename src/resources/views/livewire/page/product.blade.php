@section("title", "{$product->name} | LEVEL-UP")

<div>
    <div class="container product-container">
        <div class="row bg-white my-3 py-3 px-4 pb-5">
            <div class="col-md-4">
                @if ($product->images->count() > 0)
                <section class="splide" id="main-carousel" aria-label="Splide Basic HTML Example" data-splide='{"type":"loop","perPage":1}'>
                    <div class="splide__track">
                        <ul class="splide__list">
                            @foreach ($product->images as $image)
                            <li class="splide__slide">
                                <div class="splide__slide__container">
                                    <img src="{{ Storage::url($image->image["path"]) }}" alt="{{ $product->name }}">
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </section>
                <section class="splide mt-2" id="thumbnail-carousel" aria-label="Splide Basic HTML Example" data-splide='{"type":"loop","perPage":1}'>
                    <div class="splide__track">
                        <ul class="splide__list">
                            @foreach ($product->images as $image)
                            <li class="splide__slide">
                                <img src="{{ Storage::url($image->image["path"]) }}" alt="{{ $product->name }}">
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </section>
                @endif
                {{-- <div class="product-image">
                    @if ($product->images->count() > 0)
                    <img src="{{ Storage::url($product->images->first()->image["path"]) }}" alt="{{ $product->name }}">
                    @else
                    <img src="{{ asset("assets/images/logo.png") }}" alt="{{ $product->name }}" style="opacity: 0.6; object-fit: contain;">
                    @endif
                </div> --}}
            </div>
            <div class="col-md-8">
                <div class="product-name">
                    <h2>{{ $product->name }}</h2>
                </div>
                <div class="product-categories my-2">
                    <span>
                        Brand: {{ $product->brand->name }}
                    </span>
                    <span>
                        Category: {{ $product->categories->implode("name", ", ") }}
                    </span>
                </div>
                <div class="product-price mb-3">
                    <span class="price">Rs {{ number_format($product->price - $product->discount, 2) }}</span>
                    @if ($product->discount)
                    <span class="old-price">Rs {{ number_format($product->price, 2) }}</span>
                    @endif
                </div>
                <div class="product-desc mb-3">
                    <p>{!! nl2br($product->description) !!}</p>
                </div>
                <button class="btn btn-filled d-inline addtocart-btn px-5" wire:click="addToCart" {{ in_array($product->id, $cart_items) ? "disabled" : "" }}>
                    <span wire:loading wire:target="addToCart">
                        <i class="feather-more-horizontal"></i>
                    </span>
                    <span wire:loading.remove wire:target="addToCart">
                        <i class="feather-shopping-bag"></i>
                        {{ in_array($product->id, $cart_items) ? "Already in cart" : "Add to cart"}}
                    </span>
                </button>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-12">
                <div class="section" id="cart-actions">
                    <div class="section-header">
                        <h4>Recommended Products</h4>
                    </div>
                    @livewire("page.partial.latest-arrivals", ["row_size" => "3", "take" => "4", "whereNotInIds" => [$product->id], "filters" => ["brand_id" => $product->brand_id]])
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.1/dist/css/splide.min.css">
<script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.1/dist/js/splide.min.js"></script>
<style>
    .product-container .product-image img {
        width: 100%;
        max-height: 350px;
        object-fit: contain;
    }
    .product-container .product-name h2 {
        font-size: 1.5rem;
        font-weight: 600;
    }
    .product-container .product-categories span {
        font-size: 0.9rem;
        font-weight: 400;
        display: block;
        color: var(--color-grey);
    }
    .product-container .product-price .price {
        font-size: 1.5rem;
        font-weight: 600;
        color: var(--color-red);
        display: block;
    }
    .product-container .product-price .old-price {
        font-size: 0.9rem;
        font-weight: 400;
        color: var(--color-grey);
        text-decoration: line-through;
        display: block;
    }
    .product-container .product-desc {
        padding: 10px 20px;
        background: var(--color-lightest-grey);
        border-radius: 4px;
    }
    .product-container .product-desc p {
        font-size: 0.9rem;
        font-weight: 400;
        color: var(--color-grey);
        line-height: 1.5;
    }
    .product-container button {
        border-radius: 8px;
    }
    .splide__slide img {
        width: 100%;
        height: auto;
        object-fit: contain;
    }
</style>
@endpush

@push('scripts')
<script>
    var main = new Splide('.splide', {
        type      : 'slide',
        rewind    : false,
        pagination: false,
        arrows    : false,
    });
    var thumbnails = new Splide('#thumbnail-carousel', {
        type        : 'loop',
        clones      : 1,
        fixedWidth  : 80,
        fixedHeight : 80,
        gap         : 10,
        rewind      : false,
        pagination  : false,
        isNavigation: true,
        arrows      : false,
    });

    main.sync(thumbnails);
    main.mount();
    thumbnails.mount();
</script>
@endpush
