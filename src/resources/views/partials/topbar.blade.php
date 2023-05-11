<div class="topbar">
    <div class="heading d-flex">
        <div class="container">
            <a href="{{ route("home") }}" class="branding">
                <img src="{{ asset("assets/images/logo.png") }}" alt="Logo">
                <span>LEVEL-UP</span>
            </a>
            @livewire("page.partial.cart.cart")
        </div>
    </div>
    <div class="navigation" data-aos="fade-in">
        <ul>
            <li>
                <a href="{{ route("home") }}">Home</a>
            </li>
            <li>
                <a href="{{ route("latest-arrivals") }}">latest</a>
            </li>
            <li>
                <a href="{{ route("featured") }}">featured</a>
            </li>
            <li>
                <a href="{{ route("on-sale") }}">sale</a>
            </li>
            @auth("customer")
            <li>
                <a href="{{ route("orders") }}">my orders</a>
            </li>
            <li>
                <a href="{{ route("logout") }}">logout</a>
            </li>
            @endauth
            @guest("customer")
            <li>
                <a href="{{ route("login") }}">login</a>
            </li>
            <li>
                <a href="{{ route("signup") }}">signup</a>
            </li>
            @endguest
    </ul>
    </div>
</div>
