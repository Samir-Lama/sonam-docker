<?php

namespace App\Http\Livewire\Admin\Page\Categories;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class ListCategories extends Component
{
    use WithPagination;

    protected $paginationTheme = "bootstrap";
    private $categories;
    protected $listeners = ["deleteCategory" => "delete"];

    public function render()
    {
        return view('livewire.admin.page.categories.list-categories')
            ->with([
                "categories" => $this->categories
            ])
            ->extends("admin.layouts.app");
    }

    public function mount()
    {
        $this->getCategories();
    }

    public function getCategories()
    {
        $this->categories = Category::latest()->with([
            "brand",
            "products",
        ])->paginate(20);
    }

    public function delete($category_id)
    {
        $category = Category::whereId($category_id)->with(["products"])->firstOrFail();

        if ($category->products->count() > 0) {
            $this->emit("popup", [
                "type" => "error",
                "message" => "This category has products. Please delete the products first.",
            ]);
            return;
        }

        $category->delete();

        $this->emit("popup", [
            "message" => "Category deleted successfully",
        ]);
        $this->mount();
    }
}
