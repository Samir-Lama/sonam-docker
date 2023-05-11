<div>
    @include("admin.partials.titlebar", ["__page_title" => "Update password"])

    <div class="row">
        <div class="col-md-12 d-flex align-items-stretch grid-margin">
            <div class="row flex-grow">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form class="forms-sample" wire:submit.prevent="updatePassword">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="old_password">Old password</label>
                                            <input type="password" class="form-control" name="old_password" id="old_password" placeholder="Your old password" autocomplete="off" wire:model.defer="formData.old_password">
                                            @error("formData.old_password")
                                            <small>
                                                <strong class="text-danger">
                                                    {{ $message }}
                                                </strong>
                                            </small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="password">New password</label>
                                            <input type="password" class="form-control" name="password" id="password" placeholder="Your new password" autocomplete="off" wire:model.defer="formData.password">
                                            @error("formData.password")
                                            <small>
                                                <strong class="text-danger">
                                                    {{ $message }}
                                                </strong>
                                            </small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="password_confirmation">Repeat new password</label>
                                            <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Repeat new password" autocomplete="off" wire:model.defer="formData.password_confirmation">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-info py-2">
                                                <span wire:loading>
                                                    @include("admin.partials.loading-svg")
                                                </span>
                                                <span wire:loading.class="button-loading">
                                                    Update password
                                                </span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push("style")
<style>
    .btn {
        position: relative;
    }
    .button-loading-svg {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
    .button-loading {
        opacity: 0.1;
    }
</style>
@endpush