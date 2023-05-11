<div class="cart-total">
    <div class="section shipping">
        <div class="total-header">
            <h4>Shipping Address</h4>
        </div>

        <div class="location shipping-info">
            <div class="info">
                <i class="feather-map-pin"></i>
                <span>
                    {{ $shipping_info["address"] ?? "N/A"}}
                </span>
            </div>
            <button wire:click="$set('shipping_popup', true)">
                <i class="feather-edit"></i> Edit
            </button>
        </div>

        <div class="name shipping-info">
            <div class="info">
                <i class="feather-user"></i>
                <span>
                    {{ $shipping_info["name"] ?? "N/A" }}
                </span>
            </div>
            <button wire:click="$set('shipping_popup', true)">
                <i class="feather-edit"></i> Edit
            </button>
        </div>

        <div class="phone shipping-info">
            <div class="info">
                <i class="feather-phone"></i>
                <span>
                    {{ $shipping_info["phone"] ?? "N/A" }}
                </span>
            </div>
            <button wire:click="$set('shipping_popup', true)">
                <i class="feather-edit"></i> Edit
            </button>
        </div>
    </div>

    @if ($total > 0)
    <div class="section" id="cart-total">
        <div class="total-header">
            <h4>Order Summary</h4>
        </div>

        <div class="py-0 my-0">
            <span><small>Items</small></span>
            <span class="data"><small>{{ $items }} items</small></span>
        </div>
        <div class="py-0 my-0">
            <span><small>Price</small></span>
            <span class="data"><small>Rs {{ number_format($item_total, 2) }}</small></span>
        </div>
        <div class="py-0 my-0">
            <span><small>Shipping</small></span>
            <span class="data"><small>Rs {{ number_format($shipping, 2) }}</small></span>
        </div>
        <div class="mt-1">
            <span>Sub total</span>
            <span class="data highlight">Rs {{ number_format($total, 2) }}</span>
        </div>
        <div class="mb-0">
            <a href="#" wire:click.prevent="generatePayment" class="btn w-100 btn-filled">Pay with Khalti</a>
        </div>
    </div>
    @endif

    <div class="shipping-form-container {{ $shipping_popup ? "shown" : "" }}">
        <div class="shipping-container">
            <h5 class="mb-3">Shipping info</h5>
            <form wire:submit.prevent="updateShipping">
                <div class="form-group mb-3">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" id="address" wire:model.defer="shipping_info.address" placeholder="Enter your address">
                    @error("shipping_info.address")
                    <small style="color: var(--color-red);">
                        <strong>* {{ $message }}</strong>
                    </small>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" wire:model.defer="shipping_info.name" placeholder="Enter your name">
                    @error("shipping_info.name")
                    <small style="color: var(--color-red);">
                        <strong>* {{ $message }}</strong>
                    </small>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="phone">Phone</label>
                    <input type="tel" class="form-control" id="phone" wire:model.defer="shipping_info.phone" placeholder="Enter your phone">
                    @error("shipping_info.phone")
                    <small style="color: var(--color-red);">
                        <strong>* {{ $message }}</strong>
                    </small>
                    @enderror
                </div>
                <div class="form-group w-100" style="text-align: right;">
                    <button type="button" wire:click="clearShipping" class="btn">Reset</button>
                    <button type="submit" class="btn btn-filled">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://khalti.s3.ap-south-1.amazonaws.com/KPG/dist/2020.12.17.0.0.0/khalti-checkout.iffe.js"></script>
<script>
    Livewire.on("khalti-pay", function (data) {
        var config = data.config;
        config.eventHandler = {
            onSuccess(payload) {
                Livewire.emit(data.successTrigger, payload);
            },
            onError(error) {
                Livewire.emit(data.errorTrigger);
            },
            onClose() {
                Livewire.emit(data.closeTrigger);
            }
        }
        var pay = new KhaltiCheckout(config);
        pay.show({
            amount: data.amount
        });
    });
</script>
@endpush
