<div class="row w-100">
    <div class="col-lg-4 mx-auto">
        <div class="auto-form-wrapper">
            <h4 class="text-center mb-4">Signup</h4>
            <form action="#" wire:submit.prevent="signUp">
                <div class="form-group mb-3">
                    <label class="label" for="name">Name</label>
                    <input type="text" class="form-control" placeholder="Name" name="name" id="name" wire:model.defer="formData.name">
                    @error("formData.name")
                    <small>
                        <strong class="text-danger">
                            {{ $message }}
                        </strong>
                    </small>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label class="label" for="address">Address</label>
                    <input type="text" class="form-control" placeholder="Address" name="address" id="address" wire:model.defer="formData.address">
                    @error("formData.address")
                    <small>
                        <strong class="text-danger">
                            {{ $message }}
                        </strong>
                    </small>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label class="label" for="phone">Phone</label>
                    <input type="tel" class="form-control" maxlength="10" placeholder="Phone" name="phone" id="phone" wire:model.defer="formData.phone">
                    @error("formData.phone")
                    <small>
                        <strong class="text-danger">
                            {{ $message }}
                        </strong>
                    </small>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label class="label" for="email">Email</label>
                    <input type="email" class="form-control" placeholder="Email" name="email" id="email" wire:model.defer="formData.email">
                    @error("formData.email")
                    <small>
                        <strong class="text-danger">
                            {{ $message }}
                        </strong>
                    </small>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label class="label" for="password">Password</label>
                    <input type="password" class="form-control" placeholder="Password" name="password" id="password" wire:model.defer="formData.password">
                    @error("formData.password")
                    <small>
                        <strong class="text-danger">
                            {{ $message }}
                        </strong>
                    </small>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label class="label" for="password_confirmation">Re-enter Password</label>
                    <input type="password" class="form-control" placeholder="Re-enter Password" name="password_confirmation" id="password_confirmation" wire:model.defer="formData.password_confirmation">
                </div>
                <div class="form-group mb-3">
                    <button class="btn btn-filled">
                        <span wire:loading>
                            @include("admin.partials.loading-svg")
                        </span>
                        <span wire:loading.remove>
                            Signup
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('styles')
    <style>
        .auto-form-wrapper {
            background: #fff;
            padding: 25px;
            margin: 25px 0;
            border-radius: 10px;
        }
    </style>
@endpush
