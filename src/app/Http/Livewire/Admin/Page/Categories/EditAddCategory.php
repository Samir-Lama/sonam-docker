<?php

namespace App\Http\Livewire\Admin\Page\Categories;

use App\Models\Brand;
use Livewire\Component;
use App\Models\Category;

class EditAddCategory extends Component
{
    public $category;
    public $brands;
    public $formData;

    public $rules = [
        "formData.name" => "required|string|max:255",
        "formData.brand_id" => "required|exists:brands,id",
    ];
    public $messages = [
        "formData.name.required" => "Please enter brand name.",
        "formData.brand_id.required" => "Please select a valid brand.",
        "formData.brand_id.exists" => "Please select a valid brand.",
    ];

    public function render()
    {
        return view('livewire.admin.page.categories.edit-add-category')
            ->extends("admin.layouts.app");
    }

    public function mount()
    {
        $this->formData = [
            "name" => "",
            "brand_id" => "",
        ];
        $this->brands = Brand::oldest("name")->get();

        if (request("category_id")) {
            $this->category = Category::findOrFail(request("category_id"));
            $this->formData = [
                "name" => $this->category->name,
                "brand_id" => $this->category->brand_id,
            ];
        }
    }

    public function create()
    {
        $this->validate();
        Category::create($this->formData);

        session()->flash("popup_message", "Category created successfully");
        return redirect()->route("admin.categories.list");
    }

    public function update()
    {
        $this->validate();
        $this->category->update($this->formData);

        session()->flash("popup_message", "Category updated successfully");
        return redirect()->route("admin.categories.list");
    }
}
