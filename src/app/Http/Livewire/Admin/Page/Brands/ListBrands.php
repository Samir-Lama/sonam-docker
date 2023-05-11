<?php

namespace App\Http\Livewire\Admin\Page\Brands;

use App\Models\Brand;
use Livewire\Component;
use Livewire\WithPagination;

class ListBrands extends Component
{
    use WithPagination;

    protected $paginationTheme = "bootstrap";
    private $brands;
    protected $listeners = ["deleteBrand" => "delete"];

    public function render()
    {
        $this->getBrands();
        return view('livewire.admin.page.brands.list-brands')
            ->with([
                "brands" => $this->brands
            ])
            ->extends("admin.layouts.app");
    }

    public function mount()
    {
        $this->getBrands();
    }

    public function getBrands()
    {
        $this->brands = Brand::latest()->with([
            "products",
            "categories",
        ])->paginate(20);
    }

    public function delete($brand_id)
    {
        $brand = Brand::whereId($brand_id)->with(["products", "categories"])->firstOrFail();

        if ($brand->products->count() > 0) {
            $this->emit("popup", [
                "type" => "error",
                "message" => "This brand has products. Please delete the products first.",
            ]);
            return;
        }
        if ($brand->categories->count() > 0) {
            $this->emit("popup", [
                "type" => "error",
                "message" => "This brand has categories. Please delete the categories first.",
            ]);
            return;
        }

        $brand->delete();

        $this->emit("popup", [
            "message" => "Brand deleted successfully",
        ]);
        $this->mount();
    }
}
