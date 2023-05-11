<?php

namespace App\Http\Livewire\Page\Partial\Cart;

use Livewire\Component;

class Cart extends Component
{
    public $cart_items;
    public $wishlist_items;
    public $cart_count;
    public $wishlist_count;

    protected $listeners = [
        "addToCart" => "loadCartItems",
        "addToWishList" => "loadWishListItems",
        "cartUpdated" => "loadCartItems",
    ];

    public function render()
    {
        return view("livewire.page.partial.cart.cart");
    }

    public function mount()
    {
        $this->loadCartItems();
        $this->loadWishListItems();
    }

    public function loadCartItems()
    {
        $this->cart_items = session("cart_items") ?? [];
        $this->cart_count = count($this->cart_items);
    }

    public function loadWishListItems()
    {
        $this->wishlist_items = session("wishlist_items") ?? [];
        $this->wishlist_count = count($this->wishlist_items);
    }
}
