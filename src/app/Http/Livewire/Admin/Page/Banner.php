<?php

namespace App\Http\Livewire\Admin\Page;

use App\Models\Banner as BannerModel;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Http\Traits\UploadFile;

class Banner extends Component
{
    use UploadFile;
    use WithFileUploads;

    public $title;
    public $banner;
    public $image;

    public function render()
    {
        return view('livewire.admin.page.banner')
            ->extends("admin.layouts.app");
    }

    public function mount()
    {
        $this->banner = BannerModel::firstOrCreate([], [
            "title" => "Banner",
            "image" => null,
        ]);

        $this->title = $this->banner->title;
    }

    public function save()
    {
        $this->validate([
            "title" => "required",
            "image" => "nullable|image|max:1024",
        ]);

        $this->banner->title = $this->title;

        if ($this->image) {
            $this->banner->image = $this->uploadFile($this->image);
        }

        $this->banner->save();

        $this->emit("popup", ["message" => "Banner updated."]);
    }
}
