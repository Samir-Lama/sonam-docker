<?php

namespace App\Http\Livewire\Page\Partial\Cart;

use App\Models\Product;
use Livewire\Component;

class CartItems extends Component
{
    public $products;
    public $quantities;
    public $wishlist_items;
    public $readonly = false;

    public function render()
    {
        return view("livewire.page.partial.cart.cart-items");
    }

    public function mount()
    {
        $this->products = array_map(function ($product) {
            return json_decode($product[0]);
        }, session("cart_items") ?? []);
        $this->loadQuantities();
        $this->loadWishList();
    }

    public function loadQuantities()
    {
        $this->quantities = array_map(function ($product) {
            return $product[0];
        }, session("cart_quantities") ?? []);
    }

    public function loadWishList()
    {
        $this->wishlist_items = array_map(function ($product) {
            return json_decode($product[0])->id;
        }, session("wishlist_items") ?? []);
    }

    public function deleteCart($product_id)
    {
        session()->forget("cart_quantities.{$product_id}");
        session()->forget("cart_items.{$product_id}");
        $this->emit("popup", ["message" => "Product removed from cart."]);
        $this->emit("cartUpdated");
        $this->mount();
    }

    public function addQuantity($product_id)
    {
        $quantity = session("cart_quantities.{$product_id}");
        $quantity[0]++;

        if ($quantity[0] > Product::find($product_id)->quantity) {
            $this->emit("popup", [
                "type" => "error",
                "message" => "Cannot add more than stock."
            ]);
        } else {
            session()->put("cart_quantities.{$product_id}", $quantity);
        }

        $this->emit("cartUpdated");
        $this->mount();
    }

    public function subtractQuantity($product_id)
    {
        $quantity = session("cart_quantities.{$product_id}");
        if ($quantity[0] <= 1) {
            $this->emit("popup", ["type" => "error", "message" => "Cannot decrease quantity."]);
            $this->mount();
            return;
        }
        $quantity[0]--;
        session()->put("cart_quantities.{$product_id}", $quantity);
        $this->emit("cartUpdated");
        $this->mount();
    }

    public function addToWishList($product_id)
    {
        session()->push("wishlist_items." . $product_id, json_encode($this->products[$product_id]));
        $this->emit("addToWishList");
        $this->emit("popup", ["message" => "Product added to wishlist."]);
        $this->mount();
    }

    public function removeWishList($product_id)
    {
        session()->forget("wishlist_items." . $product_id);
        $this->emit("addToWishList");
        $this->emit("popup", ["message" => "Product removed from wishlist."]);
        $this->mount();
    }
}
