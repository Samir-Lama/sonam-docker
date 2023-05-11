<div>
    @include("admin.partials.titlebar", ["__page_title" => "Orders"])
    <div class="row">
        <div class="col-md-12 d-flex align-items-stretch grid-margin">
            <div class="row flex-grow">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Order ID</th>
                                            <th>Customer</th>
                                            <th>Items</th>
                                            <th>Date</th>
                                            <th>Total</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($orders as $order)
                                        <tr>
                                            <td>#{{ $order->order_id }}</td>
                                            <td>
                                                {{ $order->customer->name }}
                                                <br>
                                                <small>
                                                    {{ $order->customer->phone }}
                                                    <br>
                                                    {{ $order->customer->address }}
                                                </small>
                                            </td>
                                            <td>
                                                @foreach ($order->items as $item)
                                                <p class="mb-0">{{ $item["product"]["name"] }} x {{ $item["quantity"] }}</p>
                                                @endforeach
                                            </td>
                                            <td>{{ $order->created_at->format("dS F, Y") }}</td>
                                            <td>Rs.{{ number_format($order->total, 2) }}</td>
                                            <td>
                                                <div class="btn btn-sm btn-{{ $order->status == "paid" ? "danger" : "success" }}" wire:click="changeStatus({{ $order->id }})">
                                                    {{ ucwords($order->status) }}
                                                </div>
                                            </td>
                                        @empty
                                        <tr>
                                            <td colspan="6">No records found.</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                <div class="float-right mt-2">
                                    {{ $orders->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push("style")
<style>
    .product .description {
        margin-top: 10px;
        font-size: 12px;
        color: #999;
    }
</style>
@endpush
