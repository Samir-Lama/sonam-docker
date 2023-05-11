<div class="menu-icons">
    <ul>
        <li>
            <button>
                <a href="{{ route("cart") }}">
                    <i class="feather-heart"></i>
                </a>
                @if ($wishlist_count > 0)
                <span class="notification">{{ $wishlist_count }}</span>
                @endif
            </button>
        </li>
        <li>
            <button>
                <a href="{{ route("cart") }}">
                    <i class="feather-shopping-bag"></i>
                </a>
                @if ($cart_count > 0)
                <span class="notification">{{ $cart_count }}</span>
                @endif
            </button>
        </li>
        <li>
            <button>
                <a href="{{ route("profile") }}">
                    <i class="feather-user"></i>
                </a>
            </button>
        </li>
    </ul>
</div>
