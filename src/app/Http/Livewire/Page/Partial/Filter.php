<?php

namespace App\Http\Livewire\Page\Partial;

use App\Models\Brand;
use Livewire\Component;
use App\Models\Category;

class Filter extends Component
{
    public $brands;
    public $categories;

    public $selected_brands = [];
    public $selected_categories = [];
    public $min_price;
    public $max_price;

    public function render()
    {
        return view("livewire.page.partial.filter");
    }

    public function mount()
    {
        $this->brands = Brand::with(["products"])->oldest("name")->get();
        $this->categories = Category::with(["products"])->oldest("name")->get();
    }

    public function updatedSelectedBrands()
    {
        $this->filter();
    }

    public function updatedSelectedCategories()
    {
        $this->filter();
    }

    public function filterPrice()
    {
        if (!$this->min_price && !$this->max_price) {
            return;
        }

        $this->filter();
    }

    public function filter()
    {
        $filter_parameters = [
            "brands" => array_filter($this->selected_brands),
            "categories" => array_filter($this->selected_categories),
            "min_price" => $this->min_price,
            "max_price" => $this->max_price,
        ];

        $this->emit("filterProducts", $filter_parameters);
    }
}
