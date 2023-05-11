<?php

namespace App\Http\Livewire\Admin\Page;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Order as OrderModel;

class Order extends Component
{
    use WithPagination;

    protected $paginationTheme = "bootstrap";
    private $orders;

    public function render()
    {
        return view('livewire.admin.page.order')
            ->with([
                "orders" => $this->orders
            ])
            ->extends("admin.layouts.app");
    }

    public function mount()
    {
        $this->orders = OrderModel::latest()->with(["customer"])->paginate(20);
    }

    public function changeStatus($order_id)
    {
        $order = OrderModel::find($order_id);
        $order->status = $order->status == "paid" ? "delivered" : "paid";
        $order->save();

        $this->emit("popup", [
            "message" => "Status updated successfully.",
        ]);
        $this->mount();
    }
}
