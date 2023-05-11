<?php

namespace App\Http\Livewire\Admin\Page;

use App\Models\Admin;
use Livewire\Component;

class Profile extends Component
{
    public $formData = [];

    protected $messages = [
        "formData.name.required" => "Please enter your name.",
        "formData.email.required" => "Please enter your email.",
        "formData.email.email" => "Please enter a valid email.",
        "formData.email.unique" => "The provided email is already in use."
    ];

    public function render()
    {
        return view("livewire.admin.page.profile")
            ->extends("admin.layouts.app");
    }

    public function mount()
    {
        $this->formData = [
            "name" => auth()->user()->name,
            "email" => auth()->user()->email
        ];
    }

    public function updateProfile()
    {
        $this->validate([
            "formData.name" => "required",
            "formData.email" => "required|email|unique:admins,email," . auth()->user()->id
        ]);

        Admin::find(auth()->id())->update([
            "name" => $this->formData["name"],
            "email" => $this->formData["email"]
        ]);

        $this->emit("popup", [
            "message" => "Profile updated successfully.",
        ]);
    }
}
