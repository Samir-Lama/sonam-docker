<div>
    <div class="row w-100">
        <div class="col-8 mx-auto my-4 orders-table">
            <h4>My orders</h4>
            <div class="table table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Order ID</th>
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
                                @foreach ($order->items as $item)
                                <p class="mb-0">{{ $item["product"]["name"] }} x {{ $item["quantity"] }}</p>
                                @endforeach
                            </td>
                            <td>{{ $order->created_at->format("dS F, Y") }}</td>
                            <td>Rs.{{ number_format($order->total, 2) }}</td>
                            <td>
                                <div class="btn btn-sm btn-filled">
                                    {{ ucwords($order->status) }}
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">
                                You have no orders yet.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .orders-table {
        background: #fff;
        padding: 25px;
    }
</style>
@endpush
