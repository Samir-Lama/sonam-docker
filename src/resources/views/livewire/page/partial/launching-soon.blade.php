<div class="products row">
    @foreach ($products as $product)
    <div class="col-md-3 mb-4">
        <div class="product" data-aos="fade-up">
            <div class="product-image">
                @if ($product->images->count() > 0)
                <img src="{{ Storage::url($product->images->first()->image["path"]) }}" alt="{{ $product->name }}">
                @else
                <img src="{{ asset("assets/images/logo.png") }}" alt="{{ $product->name }}" style="opacity: 0.6; object-fit: contain;">
                @endif
                <div class="date">
                    <span>{{ date("d", strtotime($product->launch_date)) }}</span>
                    {{ date("M", strtotime($product->launch_date)) }}
                </div>
            </div>
            <div class="product-info">
                <h2>{{ $product->name }}</h2>
                <h5>{{ $product->brand->name }} - Launching soon</h5>
            </div>
        </div>
    </div>
    @endforeach
</div>
