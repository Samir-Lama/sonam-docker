<?php

namespace App\Http\Livewire\Page\Partial\Cart;

use Livewire\Component;

class CartTotal extends Component
{
    public $total;
    public $items;

    protected $listeners = [
        "cartUpdated" => "mount",
    ];

    public function render()
    {
        return view("livewire.page.partial.cart.cart-total");
    }

    public function mount()
    {
        $this->total = 0;
        $this->items = 0;

        $this->calculateItems();
        $this->calculateTotal();
    }

    public function calculateTotal()
    {
        $this->total = 0;

        foreach (session("cart_items") ?? [] as $item) {
            $item = json_decode($item[0]);
            $this->total += (float) (($item->price - $item->discount) * session("cart_quantities." . $item->id . ".0"));
        }
    }

    public function calculateItems()
    {
        $this->items = 0;

        foreach (session("cart_quantities") ?? [] as $item) {
            $this->items += (int) $item[0];
        }
    }
}
