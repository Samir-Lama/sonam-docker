<?php

namespace App\Http\Livewire\Page\Partial;

use App\Models\Product;
use Livewire\Component;

class LatestArrivals extends Component
{
    public $take = 12;
    private $products;
    public $row_size = 3;
    public $cart_items;
    public $wishlist_items;
    public $paginate = false;
    public $relationships;
    public $filters = [];
    public $whereInIds = [];
    public $whereNotInIds = [];
    protected $paginationTheme = "bootstrap";

    protected $listeners = [
        "filterProducts" => "filterProducts",
    ];

    public function render()
    {
        return view("livewire.page.partial.latest-arrivals")->with([
            "products" => $this->products,
        ]);
    }

    public function mount()
    {
        $this->relationships = [
            "brand",
            "categories",
            "images",
        ];
        $this->products = Product::latest()
            ->with($this->relationships)
            ->where("quantity", ">", 0)
            ->where($this->filters);
        if ($this->whereInIds) {
            $this->products = $this->products->whereIn("id", $this->whereInIds);
        }
        if ($this->whereNotInIds) {
            $this->products = $this->products->whereNotIn("id", $this->whereNotInIds);
        }
        if ($this->paginate) {
            $this->products = $this->products->paginate($this->take);
        } else {
            $this->products = $this->products->take($this->take)->get();
        }

        $this->loadCart();
        $this->loadWishlist();
    }

    public function loadCart()
    {
        $this->cart_items = array_map(function ($product) {
            return json_decode($product[0])->id;
        }, session("cart_items") ?? []);
    }

    public function loadWishList()
    {
        $this->wishlist_items = array_map(function ($product) {
            return json_decode($product[0])->id;
        }, session("wishlist_items") ?? []);
    }

    public function addToCart($product_id)
    {
        session()->push(
            "cart_items.{$product_id}",
            json_encode(Product::with($this->relationships)->find($product_id))
        );
        session()->push("cart_quantities.{$product_id}", 1);

        $this->emit("addToCart");
        $this->emit("popup", ["message" => "Product added to cart."]);
        $this->mount();
    }

    public function addToWishList($product_id)
    {
        session()->push(
            "wishlist_items.{$product_id}",
            json_encode(Product::with($this->relationships)->find($product_id))
        );

        $this->emit("addToWishList");
        $this->emit("popup", ["message" => "Product added to wishlist."]);
        $this->mount();
    }

    public function removeWishList($product_id)
    {
        session()->forget("wishlist_items.{$product_id}");

        $this->emit("addToWishList");
        $this->emit("popup", ["message" => "Product removed from wishlist."]);
        $this->mount();
    }

    public function filterProducts($filter)
    {
        $this->products = Product::latest()->with($this->relationships)->where($this->filters);

        if ($this->whereInIds) {
            $this->products = $this->products->whereIn("id", $this->whereInIds);
        }
        if ($filter["brands"]) {
            $this->products = $this->products->whereIn("brand_id", $filter["brands"]);
        }
        if ($filter["categories"]) {
            $this->products = $this->products->whereHas("categories", function ($query) use ($filter) {
                $query->whereIn("id", $filter["categories"]);
            });
        }
        if ($filter["min_price"] || $filter["max_price"]) {
            $this->products = $this->products->whereBetween("price", [
                $filter["min_price"] ?? 0,
                $filter["max_price"] ?? 9999999,
            ]);
        }

        if ($this->paginate) {
            $this->products = $this->products->paginate($this->take);
        } else {
            $this->products = $this->products->take($this->take)->get();
        }
    }
}
