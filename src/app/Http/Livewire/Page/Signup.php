<?php

namespace App\Http\Livewire\Page;

use App\Models\Customer;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Signup extends Component
{
    public $formData;

    protected $rules = [
        "formData.name" => "required",
        "formData.address" => "required",
        "formData.phone" => "required|numeric|digits:10|unique:customers,phone",
        "formData.email" => "required|email|unique:customers,email",
        "formData.password" => "required|confirmed",
    ];

    protected $messages = [
        "formData.name.required" => "Please enter your name.",
        "formData.address.required" => "Please enter your address.",
        "formData.phone.required" => "Please enter your phone number.",
        "formData.phone.numeric" => "Please enter a valid phone number.",
        "formData.phone.digits" => "Please enter a valid phone number.",
        "formData.phone.unique" => "The provided phone number is already in use.",
        "formData.email.required" => "Please enter your email.",
        "formData.email.email" => "Please enter a valid email.",
        "formData.email.unique" => "The provided email is already in use.",
        "formData.password.required" => "Please enter your password.",
        "formData.password.confirmed" => "The passwords do not match.",
    ];

    protected $listeners = [
        "redirect-login" => "redirectLogin"
    ];

    public function render()
    {
        return view('livewire.page.signup');
    }

    public function mount()
    {
        $this->formData = [
            "name" => "",
            "address" => "",
            "phone" => "",
            "email" => "",
            "password" => "",
            "password_confirmation" => "",
        ];
    }

    public function signUp()
    {
        $this->validate();

        unset($this->formData["password_confirmation"]);
        $this->formData["password"] = Hash::make($this->formData["password"]);
        Customer::create($this->formData);

        $this->emit("popup", [
            "message" => "You have successfully signed up. Please login to continue.",
            "trigger" => "redirect-login",
        ]);
    }

    public function redirectLogin()
    {
        return redirect()->route("login");
    }
}
