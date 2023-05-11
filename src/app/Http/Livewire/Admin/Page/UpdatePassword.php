<?php

namespace App\Http\Livewire\Admin\Page;

use App\Models\Admin;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;

class UpdatePassword extends Component
{
    public $formData = [];

    protected $rules = [
        "formData.old_password" => "required",
        "formData.password" => "required|confirmed"
    ];

    protected $messages = [
        "formData.old_password.required" => "Please enter your old password.",
        "formData.password.required" => "Please enter your new password.",
        "formData.password.confirmed" => "New passwords do not match."
    ];

    public function render()
    {
        return view("livewire.admin.page.update-password")
            ->extends("admin.layouts.app");
    }

    public function mount()
    {
        $this->formData = [
            "old_password" => "",
            "password" => "",
            "password_confirmation" => ""
        ];
    }

    public function updatePassword()
    {
        $this->validate();

        if (!Hash::check($this->formData["old_password"], auth()->user()->password)) {
            $this->addError("formData.old_password", "Invalid old password.");
            return false;
        }

        Admin::find(auth()->id())->update([
            "password" => bcrypt($this->formData["password"])
        ]);

        $this->reset();
        $this->emit("popup", [
            "message" => "Password updated successfully.",
        ]);
    }
}
