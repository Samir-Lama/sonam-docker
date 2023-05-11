<?php

namespace App\Http\Livewire\Page;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Login extends Component
{
    public $formData;

    protected $rules = [
        "formData.email" => "required|email|exists:customers,email",
        "formData.password" => "required"
    ];

    protected $messages = [
        "formData.email.required" => "Please enter your email.",
        "formData.email.email" => "Please enter a valid email.",
        "formData.email.exists" => "The provided email is invalid.",
        "formData.password.required" => "Please enter your password."
    ];

    public function render()
    {
        return view("livewire.page.login");
    }

    public function mount()
    {
        $this->formData = [
            "email" => "",
            "password" => "",
            "remember" => false
        ];
    }

    public function attemptLogin()
    {
        $this->validate();

        $attempt = Auth::guard("customer")->attempt([
            "email" => $this->formData["email"],
            "password" => $this->formData["password"]
        ], $this->formData["remember"]);

        if (!$attempt) {
            $this->addError("formData.email", "Invalid credentials.");
            return false;
        }

        return redirect()->route("home");
    }
}
