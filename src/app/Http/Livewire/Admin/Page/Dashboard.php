<?php

namespace App\Http\Livewire\Admin\Page;

use App\Models\Brand;
use App\Models\Order;
use App\Models\Product;
use Livewire\Component;
use App\Models\Category;

class Dashboard extends Component
{
    public $products;
    public $brands;
    public $categories;
    public $orders;

    public function render()
    {
        return view("livewire.admin.page.dashboard")
            ->extends("admin.layouts.app");
    }

    public function mount()
    {
        $this->products = Product::all()->count();
        $this->brands = Brand::all()->count();
        $this->categories = Category::all()->count();
        $this->orders = Order::where("status", "paid")->count();
    }
}
