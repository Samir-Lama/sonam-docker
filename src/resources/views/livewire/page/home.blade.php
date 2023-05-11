@section("title", "Home | LEVEL-UP")

<div>
    @if ($banner)
    <div class="hero-slider">
        <div class="hero-image" data-aos="fade-in">
            <img src="{{ Storage::url($banner->image["path"]) }}" alt="{{ $banner->title }}">
            <div class="overlay"></div>
        </div>
        <div class="container">
            <div class="hero-text" data-aos="fade-up">
                <div class="info">
                    <h3>{{ $banner->title }}</h3>
                    <p>Discover the latest arrivals.</p>
                    <ul class="indicators">
                        <li class="active"></li>
                        <li></li>
                        <li></li>
                    </ul>
                </div>
                <div class="cta">
                    <a href="#latest-arrivals" class="btn btn-hollow btn-big btn-upper btn-white">Shop now</a>
                </div>
            </div>
        </div>
    </div>
    @endif

    <div class="section" id="latest-arrivals">
        <div class="container">
            <div class="section-header">
                <h4>Latest arrivals</h4>
                <a href="{{ route("latest-arrivals") }}" class="btn bnt-dash">View All</a>
            </div>
            @livewire("page.partial.latest-arrivals", ["take" => 12])
        </div>
    </div>

    <div class="section featured" id="featured">
        <div class="container">
            <div class="products row">
                @foreach ($featured as $product)
                <div class="col-md-4">
                    <div class="product" data-aos="fade-up">
                        <div class="product-image">
                            @if ($product->images->count() > 0)
                            <img src="{{ Storage::url($product->images->first()->image["path"]) }}" alt="{{ $product->name }}" style="background: #fff;">
                            @else
                            <img src="{{ asset("assets/images/logo.png") }}" alt="{{ $product->name }}" style="opacity: 0.6; object-fit: contain; background: #fff;">
                            @endif
                        </div>
                        <div class="product-info">
                            <h2>{{ $product->name }}</h2>
                            <a href="{{ route("latest-arrivals") }}">Shop now</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="section" id="launching-soon">
        <div class="container">
            <div class="section-header">
                <h4>Launching Soon</h4>
                <a href="{{ route("latest-arrivals") }}" class="btn bnt-dash">View All</a>
            </div>
            @livewire("page.partial.launching-soon")
        </div>
    </div>
</div>
