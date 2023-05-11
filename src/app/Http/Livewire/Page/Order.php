<?php

namespace App\Http\Livewire\Page;

use App\Models\Order as OrderModel;
use Livewire\Component;

class Order extends Component
{
    public $orders;

    public function render()
    {
        return view('livewire.page.order');
    }

    public function mount()
    {
        $this->orders = OrderModel::where("customer_id", auth("customer")->id())->latest()->get();
    }
}
