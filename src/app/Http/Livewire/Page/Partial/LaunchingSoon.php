<?php

namespace App\Http\Livewire\Page\Partial;

use App\Models\Product;
use Livewire\Component;

class LaunchingSoon extends Component
{
    public $products;

    public function render()
    {
        return view("livewire.page.partial.launching-soon");
    }

    public function mount()
    {
        $this->products = Product::whereLaunchingSoon(1)->take(4)->get();
    }
}
