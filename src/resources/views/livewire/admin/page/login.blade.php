<div class="row w-100">
    <div class="col-lg-4 mx-auto">
        <div class="auto-form-wrapper">
            <form action="#" wire:submit.prevent="attemptLogin">
                <div class="form-group">
                    <label class="label" for="email">Email</label>
                    <div class="input-group">
                        <input type="email" class="form-control" placeholder="Email" name="email" id="email" wire:model.defer="formData.email">
                        <div class="input-group-append">
                            <span class="input-group-text">
                                <i class="material-icons-outlined" style="font-size: 16px;">email</i>
                            </span>
                        </div>
                    </div>
                    @error("formData.email")
                    <small>
                        <strong class="text-danger">
                            {{ $message }}
                        </strong>
                    </small>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="label" for="password">Password</label>
                    <div class="input-group">
                        <input type="password" class="form-control" placeholder="Password" name="password" id="password" wire:model.defer="formData.password">
                        <div class="input-group-append">
                            <span class="input-group-text">
                                <i class="material-icons-outlined" style="font-size: 16px;">password</i>
                            </span>
                        </div>
                    </div>
                    @error("formData.password")
                    <small>
                        <strong class="text-danger">
                            {{ $message }}
                        </strong>
                    </small>
                    @enderror
                </div>
                <div class="form-group">
                    <button class="btn btn-primary submit-btn btn-block">
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

@push("style")
<style>
    .form-check .form-check-label .input-helper:after {
        font-family: "Material Icons Outlined";
        content: "check";
    }
</style>
@endpush
