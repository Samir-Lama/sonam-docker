<?php

namespace App\Http\Livewire\Page;

use Livewire\Component;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;

class Profile extends Component
{
    public $formData;

    public function render()
    {
        return view('livewire.page.profile');
    }

    public function mount()
    {
        $user = auth("customer")->user();
        $this->formData = [
            "name" => $user->name,
            "email" => $user->email,
            "phone" => $user->phone,
            "address" => $user->address,
            "password" => "",
            "password_confirmation" => ""
        ];
    }

    public function updateProfile()
    {
        $user = Customer::find(auth("customer")->id());

        $this->validate([
            "formData.name" => "required",
            "formData.email" => "required|email|unique:customers,email,{$user->id}",
            "formData.phone" => "required|numeric|digits:10",
            "formData.address" => "required",
        ], [
            "formData.name.required" => "Please enter your name.",
            "formData.email.required" => "Please enter your email.",
            "formData.email.email" => "Please enter a valid email.",
            "formData.email.unique" => "This email is already registered.",
            "formData.phone.required" => "Please enter your phone number.",
            "formData.phone.numeric" => "Please enter a valid phone number.",
            "formData.phone.digits" => "Please enter a valid phone number.",
            "formData.address.required" => "Please enter your address.",
        ]);

        unset($this->formData["password"]);
        unset($this->formData["password_confirmation"]);
        $user = $user->update($this->formData);

        $this->emit("popup", [
            "message" => "Profile updated successfully."
        ]);
    }

    public function updatePassword()
    {
        $user = Customer::find(auth("customer")->id());

        $this->validate([
            "formData.password" => "required|confirmed",
        ], [
            "formData.password.required" => "Please enter your password.",
            "formData.password.confirmed" => "Passwords do not match.",
        ]);

        unset($this->formData["password_confirmation"]);
        $this->formData["password"] = Hash::make($this->formData["password"]);
        $user = $user->update($this->formData);

        $this->emit("popup", [
            "message" => "Password updated successfully."
        ]);

        $this->mount();
    }
}
