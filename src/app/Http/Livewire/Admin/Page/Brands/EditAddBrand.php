<?php

namespace App\Http\Livewire\Admin\Page\Brands;

use App\Models\Brand;
use Livewire\Component;

class EditAddBrand extends Component
{
    public $brand;
    public $formData;

    public $rules = [
        "formData.name" => "required|string|max:255",
    ];
    public $messages = [
        "formData.name.required" => "Please enter brand name.",
    ];

    public function render()
    {
        return view('livewire.admin.page.brands.edit-add-brand')
            ->extends("admin.layouts.app");
    }

    public function mount()
    {
        $this->formData = [
            "name" => ""
        ];

        if (request("brand_id")) {
            $this->brand = Brand::findOrFail(request("brand_id"));
            $this->formData = [
                "name" => $this->brand->name
            ];
        }
    }

    public function create()
    {
        $this->validate();
        Brand::create($this->formData);

        session()->flash("popup_message", "Brand created successfully");
        return redirect()->route("admin.brands.list");
    }

    public function update()
    {
        $this->validate();
        $this->brand->update($this->formData);

        session()->flash("popup_message", "Brand updated successfully");
        return redirect()->route("admin.brands.list");
    }
}
