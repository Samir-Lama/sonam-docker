<div class="row w-100">
    <div class="col-lg-4 mx-auto">
        <div class="auto-form-wrapper">
            <h4 class="text-center mb-4">Login</h4>
            <form action="#" wire:submit.prevent="attemptLogin">
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
                    <button class="btn btn-filled">
                        <span wire:loading>
                            @include("admin.partials.loading-svg")
                        </span>
                        <span wire:loading.remove>
                            Login
                        </span>
                    </button>
                </div>
                <div class="form-group d-flex justify-content-between">
                    <div class="form-check form-check-flat mt-0">
                        <label class="form-check-label" for="remember">
                            <input type="checkbox" class="form-check-input" name="remember" id="remember" wire:model.defer="formData.remember">
                            Keep me signed in
                            <i class="input-helper"></i>
                        </label>
                    </div>
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
