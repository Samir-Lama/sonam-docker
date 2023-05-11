<?php

namespace App\Http\Livewire\Page\Partial\Cart;

use Livewire\Component;

class Wishlist extends Component
{
    public $wishListIds;

    public function render()
    {
        return view('livewire.page.partial.cart.wishlist');
    }

    public function mount()
    {
        $this->wishListIds = array_map(function ($product) {
            return json_decode($product[0])->id;
        }, session("wishlist_items") ?? []);
    }
}
