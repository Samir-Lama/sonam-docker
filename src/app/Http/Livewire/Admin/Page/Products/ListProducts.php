<?php

namespace App\Http\Livewire\Admin\Page\Products;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class ListProducts extends Component
{
    use WithPagination;

    protected $paginationTheme = "bootstrap";
    private $products;
    protected $listeners = ["deleteProduct" => "delete"];

    public function render()
    {
        $this->getProducts();

        return view("livewire.admin.page.products.list-products")
            ->with([
                "products" => $this->products
            ])
            ->extends("admin.layouts.app");
    }

    public function mount()
    {
        $this->getProducts();
    }

    public function getProducts()
    {
        $this->products = Product::latest()->with([
            "brand",
            "categories",
            "images",
        ])->paginate(20);
    }

    public function markFeatured($product_id)
    {
        $product = Product::find($product_id);
        $product->featured = !$product->featured;
        $product->save();

        $this->emit("popup", [
            "message" => "Product featured status changed successfully",
        ]);
        $this->mount();
    }

    public function markOnSale($product_id)
    {
        $product = Product::find($product_id);
        $product->on_sale = !$product->on_sale;
        $product->save();

        $this->emit("popup", [
            "message" => "Product on Sale status changed successfully",
        ]);
        $this->mount();
    }

    public function markLaunchingSoon($product_id)
    {
        $product = Product::find($product_id);
        if ($product->launch_date == null && $product->launching_soon == 0) {
            $this->emit("popup", [
                "type" => "error",
                "message" => "Please set a launching date first.",
            ]);

            return;
        }

        $product->launching_soon = !$product->launching_soon;
        $product->save();

        $this->emit("popup", [
            "message" => "Product launching soon status changed successfully",
        ]);
        $this->mount();
    }

    public function delete($product_id)
    {
        $product = Product::find($product_id);
        $product->delete();

        $this->emit("popup", [
            "message" => "Product deleted successfully",
        ]);
        $this->mount();
    }
}
