<?php

namespace App\Http\Livewire\Admin\Page\Products;

use App\Http\Traits\UploadFile;
use App\Models\Brand;
use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use Livewire\WithFileUploads;

class EditAddProduct extends Component
{
    use UploadFile;
    use WithFileUploads;

    public $product;
    public $categories;
    public $brands;
    public $formData;
    public $category_ids;
    public $images;

    protected $listeners = [
        "deleteImage" => "deleteImage",
    ];

    public $rules = [
        "formData.name" => "required|string|max:255",
        "formData.sku" => "required|unique:products,sku",
        "formData.description" => "required",
        "formData.quantity" => "required|numeric",
        "formData.price" => "required|numeric",
        "formData.discount" => "nullable|numeric",
        "formData.brand_id" => "required|exists:brands,id",
        "formData.launch_date" => "nullable|date",
        "formData.launching_soon" => "nullable|boolean",
        "category_ids.*" => "required|exists:categories,id",
        "images.*" => "image|max:1024",
    ];
    public $messages = [
        "formData.name.required" => "Please enter brand name.",
        "formData.sku.required" => "Please enter a SKU.",
        "formData.sku.unique" => "The SKU already exists.",
        "formData.description.required" => "Please enter a description.",
        "formData.quantity.required" => "Please enter a quantity.",
        "formData.quantity.numeric" => "Please enter a valid quantity.",
        "formData.price.required" => "Please enter a price.",
        "formData.price.numeric" => "Please enter a valid price.",
        "formData.discount.numeric" => "Please enter a valid discount.",
        "formData.brand_id.required" => "Please select a valid brand.",
        "formData.brand_id.exists" => "Please select a valid brand.",
        "formData.launch_date.date" => "Please enter a valid launch date.",
        "formData.launching_soon" => "Please enter a valid launching soon.",
        "category_ids.*.required" => "Please select at least one category.",
        "category_ids.*.exists" => "Please select a valid category.",
    ];

    public function render()
    {
        return view("livewire.admin.page.products.edit-add-product")
            ->extends("admin.layouts.app");
    }

    public function mount()
    {
        $this->formData = [
            "name" => "",
            "sku" => "",
            "description" => "",
            "quantity" => "",
            "price" => "",
            "discount" => "",
            "brand_id" => "",
            "launch_date" => "",
        ];
        $this->images = [];
        $this->product_images = [];

        $this->brands = Brand::oldest("name")->get();
        $this->categories = Category::oldest("name")->get();

        if (request("product_id")) {
            $this->product = Product::whereId(request("product_id"))->with(["brand", "categories"])->firstOrFail();

            $this->formData = [
                "name" => $this->product->name,
                "sku" => $this->product->sku,
                "description" => $this->product->description,
                "quantity" => $this->product->quantity,
                "price" => $this->product->price,
                "discount" => $this->product->discount,
                "brand_id" => $this->product->brand_id,
                "launch_date" => $this->product->launch_date,
            ];

            $this->category_ids = $this->product->categories->pluck("id")->toArray();
            $this->product_images = $this->product->images->toArray();
        }
    }

    public function create()
    {
        $this->validate();
        $product = Product::create($this->formData);
        $product->categories()->attach($this->category_ids);
        $this->uploadImages($product);

        session()->flash("popup_message", "Product created successfully");
        return redirect()->route("admin.products.list");
    }

    public function update()
    {
        $this->rules["formData.sku"] .= ",{$this->product->id}";
        $this->validate();
        $this->product->update($this->formData);
        $this->product->categories()->detach();
        $this->product->categories()->attach($this->category_ids);
        $this->uploadImages($this->product);

        session()->flash("popup_message", "Product updated successfully");
        return redirect()->route("admin.products.list");
    }

    public function uploadImages($product)
    {
        if ($this->images) {
            $images = $this->uploadFiles($this->images);
            $product->images()->insert(array_map(function ($image) use ($product) {
                return [
                    "product_id" => $product->id,
                    "position" => 1,
                    "image" => json_encode($image),
                    "created_at" => now(),
                    "updated_at" => now(),
                ];
            }, $images));
        }
    }

    public function deleteImage($image_id)
    {
        $this->product->images()->whereId($image_id)->delete();
        $this->product_images = $this->product->images()->get()->toArray();
    }
}
