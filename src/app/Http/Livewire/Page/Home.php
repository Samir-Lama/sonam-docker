<?php

namespace App\Http\Livewire\Page;

use App\Models\Banner;
use App\Models\Product;
use Livewire\Component;

class Home extends Component
{
    public $featured;
    public $banner;

    public function render()
    {
        return view('livewire.page.home');
    }

    public function mount()
    {
        $this->featured = Product::whereFeatured(1)->take(3)->get();
        $this->banner = Banner::first();
    }
}
