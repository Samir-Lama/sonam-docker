<div>
    @include("admin.partials.titlebar", ["__page_title" => "Products"])
    <div class="row">
        <div class="col-md-12 d-flex align-items-stretch grid-margin">
            <div class="row flex-grow">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="float-right">
                                <a href="{{ route("admin.products.edit-add") }}" class="btn btn-primary btn-lg d-flex">
                                    <i class="material-icons-outlined">add</i>
                                    Add Product
                                </a>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>SN</th>
                                            <th>Name</th>
                                            <th>Price</th>
                                            <th>Created at</th>
                                            <th>Last updated</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($products as $product)
                                        <tr>
                                            <td>
                                                {{ $loop->iteration }}
                                            </td>
                                            <td class="product">
                                                <div class="title">
                                                    {{ $product->name }} <strong>[{{ $product->sku }}]</strong>
                                                </div>
                                                <div class="description">
                                                    <div>
                                                        Brand: {{ $product->brand->name }}
                                                    </div>
                                                    <div>
                                                        Category: {{ $product->categories->implode("name", ", ") }}
                                                    </div>
                                                    <div>
                                                        Images: {{ $product->images->count() }}
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="product">
                                                <div class="title">
                                                    Rs. {{ $product->price }}
                                                </div>
                                                <div class="description">
                                                    <div>
                                                        Discount: {{ $product->discount ? "Rs. {$product->discount}" : "N/A" }}
                                                    </div>
                                                    <div>
                                                        Stock: {{ $product->quantity }} pcs
                                                    </div>
                                                </div>
                                            </td>
                                            <td title="{{ $product->created_at }}">
                                                {{ $product->created_at->diffForHumans() }}
                                            </td>
                                            <td title="{{ $product->updated_at }}">
                                                {{ $product->updated_at->diffForHumans() }}
                                            </td>
                                            <td>
                                                <button class="btn mb-1 btn-{{ $product->featured ? "success" : "danger" }} btn-sm" wire:click="markFeatured({{ $product->id }})" wire:loading.attr="disabled">
                                                    <span wire:loading wire:target="markFeatured({{ $product->id }})">
                                                        @include("admin.partials.loading-svg")
                                                    </span>
                                                    {{ $product->featured ? "" : "Make" }} Featured
                                                </button>
                                                <button class="btn mb-1 btn-{{ $product->on_sale ? "success" : "danger" }} btn-sm" wire:click="markOnSale({{ $product->id }})" wire:loading.attr="disabled">
                                                    <span wire:loading wire:target="markOnSale({{ $product->id }})">
                                                        @include("admin.partials.loading-svg")
                                                    </span>
                                                    {{ $product->on_sale ? "" : "Make" }} on Sale
                                                </button>
                                                <button class="btn mb-1 btn-{{ $product->launching_soon ? "success" : "danger" }} btn-sm" wire:click="markLaunchingSoon({{ $product->id }})" wire:loading.attr="disabled">
                                                    <span wire:loading wire:target="markLaunchingSoon({{ $product->id }})">
                                                        @include("admin.partials.loading-svg")
                                                    </span>
                                                    {{ $product->launching_soon ? "" : "Make" }} Launching soon
                                                </button>

                                                <br>

                                                <a href="{{ route("admin.products.edit-add", $product->id) }}" class="btn btn-primary btn-sm">
                                                    Edit
                                                </a>
                                                <button class="btn btn-danger btn-sm" wire:click="$emit('confirmDelete', {{ $product->id }})" wire:loading.attr="disabled">
                                                    Delete
                                                </button>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="6">No records found.</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                <div class="float-right mt-2">
                                    {{ $products->links() }}
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

@push('javascript')
<script>
    Livewire.on("confirmDelete", function (product_id) {
        Livewire.emit("confirm", {
            "id": product_id,
            "title": "Delete Product",
            "message": "Are you sure you want to delete this product?",
            "trigger": "deleteProduct"
        });
    });
</script>
@endpush
