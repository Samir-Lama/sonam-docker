<?php

namespace App\Http\Livewire\Page;

use App\Models\Product as ProductModel;
use Livewire\Component;
use Illuminate\Http\Request;

class Product extends Component
{
    public $product_id;
    public $product;
    public $cart_items;

    public function render()
    {
        return view('livewire.page.product');
    }

    public function mount(Request $request)
    {
        $this->product_id = $request->id;

        $this->loadProduct();
        $this->loadCart();
    }

    public function loadProduct()
    {
        $this->product = ProductModel::with([
            "brand",
            "categories",
            "images"
        ])->findOrFail($this->product_id);
    }

    public function loadCart()
    {
        $this->cart_items = array_map(function ($product) {
            return json_decode($product[0])->id;
        }, session("cart_items") ?? []);
    }

    public function addToCart()
    {
        session()->push(
            "cart_items.{$this->product->id}",
            json_encode($this->product)
        );
        session()->push("cart_quantities.{$this->product->id}", 1);

        $this->emit("addToCart");
        $this->emit("popup", ["message" => "Product added to cart."]);
        $this->loadCart();
    }
}
