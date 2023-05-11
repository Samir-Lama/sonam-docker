<?php

namespace App\Http\Livewire\Page\Partial\Cart;

use Livewire\Component;
use App\Http\Livewire\Page\Order;
use App\Models\Order as OrderModel;
use App\Models\Product;

class CheckoutInfo extends Component
{
    public $total;
    public $shipping = 50;
    public $item_total;
    public $items;
    public $shipping_info;
    public $shipping_popup = true;
    public $final_items = [];

    public $rules = [
        "shipping_info.address" => "required",
        "shipping_info.name" => "required",
        "shipping_info.phone" => "required|numeric|digits:10",
    ];
    public $messages = [
        "shipping_info.address.required" => "Please enter your address",
        "shipping_info.name.required" => "Please enter your name",
        "shipping_info.phone.required" => "Please enter your phone number",
        "shipping_info.phone.numeric" => "Please enter a valid phone number",
        "shipping_info.phone.digits" => "Please enter a valid phone number",
    ];
    protected $listeners = [
        "payment-success" => "paymentSuccess",
        "payment-failed" => "paymentFailed",
        "payment-close" => "paymentClose",
        "payment-redirect" => "paymentRedirect",
    ];

    public function render()
    {
        return view("livewire.page.partial.cart.checkout-info");
    }

    public function mount()
    {
        $this->total = 0;
        $this->items = 0;
        $this->checkLogin();
        $this->shipping_info = [
            "address" => session("shipping_address") ?? null,
            "name" => session("shipping_name") ?? null,
            "phone" => session("shipping_phone") ?? null,
        ];
        $this->checkShipping();

        $this->calculateItems();
        $this->calculateTotal();

        $this->khalti_key = "test_public_key_29d3e5906c1d455eb00a53dbcbc20556";
        $this->khalti_secret = "test_secret_key_8a6bd9d9158d4070a77726935b310f6a";

        $this->payment_preferences = [
            "KHALTI",
        ];

        $this->final_items = array_map(function ($item, $key) {
            return [
                "product" => json_decode($item[0], true),
                "quantity" => session("cart_quantities")[$key][0],
            ];
        }, session("cart_items") ?? [], array_keys(session("cart_items") ?? []));
    }

    public function calculateTotal()
    {
        $this->item_total = 0;

        foreach (session("cart_items") ?? [] as $item) {
            $item = json_decode($item[0]);
            $this->item_total += (float) (($item->price - $item->discount) * session("cart_quantities." . $item->id . ".0"));
        }

        $this->total = $this->item_total + $this->shipping;
    }

    public function calculateItems()
    {
        $this->items = 0;

        foreach (session("cart_quantities") ?? [] as $item) {
            $this->items += (int) $item[0];
        }
    }

    public function checkShipping()
    {
        $this->shipping_popup = !(
            $this->shipping_info["address"]
            && $this->shipping_info["name"]
            && $this->shipping_info["phone"]
        );
    }

    public function checkShippingSession()
    {
        return (
            session("shipping_address")
            && session("shipping_name")
            && session("shipping_phone")
        );
    }

    public function updateShipping()
    {
        $this->validate();
        foreach ($this->shipping_info as $key => $value) {
            session([
                "shipping_" . $key => $value,
            ]);
        }

        $this->checkShipping();
    }

    public function clearShipping()
    {
        foreach ($this->shipping_info as $key => $value) {
            session([
                "shipping_" . $key => null,
            ]);
        }

        $this->mount();
    }

    public function generatePayment()
    {
        $config = [
            "publicKey" => $this->khalti_key,
            "productIdentity" => "1001",
            "productName" => "Order",
            "productUrl" => route("home"),
            "paymentPreference" => $this->payment_preferences,
        ];

        $this->emit("khalti-pay", [
            "config" => $config,
            "amount" => $this->total * 100, // Rs. AMOUNT x 100 paisa
            "successTrigger" => "payment-success",
            "errorTrigger" => "payment-error",
            "closeTrigger" => "payment-close",
        ]);
    }

    public function paymentSuccess()
    {
        OrderModel::create([
            "order_id" => rand(999, 9999) . auth("customer")->user()->id,
            "customer_id" => auth("customer")->user()->id,
            "total" => $this->total,
            "items" => $this->final_items,
            "status" => "paid",
        ]);

        foreach ($this->final_items as $item) {
            $product_id = $item["product"]["id"];
            $product = Product::find($product_id);
            $product->quantity -= $item["quantity"];
            $product->save();
        }

        $this->emit("popup", [
            "message" => "Payment Successful, Thank you for shopping with us!",
            "trigger" => "payment-redirect"
        ]);
    }

    public function paymentRedirect()
    {
        $this->clearCart();
        $this->clearShipping();
        return redirect()->route("orders");
    }

    public function paymentError()
    {
        $this->emit("popup", [
            "type" => "error",
            "message" => "Payment Failed, Please try again!",
        ]);
    }

    public function paymentClose()
    {
        $this->emit("popup", [
            "type" => "warning",
            "message" => "Payment Failed, Please try again!",
        ]);
    }

    public function clearCart()
    {
        session()->forget("cart_items");
        session()->forget("cart_quantities");
    }

    public function checkLogin()
    {
        $customer = auth("customer")->user();
        if ($customer && !$this->checkShippingSession()) {
            session([
                "shipping_address" => $customer->address,
                "shipping_name" => $customer->name,
                "shipping_phone" => $customer->phone,
            ]);
        }
    }
}
