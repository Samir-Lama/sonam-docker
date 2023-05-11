<div>
    @include("admin.partials.titlebar", ["__page_title" => "Profile"])
    <div class="row">
        <div class="col-md-12 d-flex align-items-stretch grid-margin">
            <div class="row flex-grow">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form class="forms-sample" wire:submit.prevent="updateProfile">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" class="form-control" name="name" id="name" placeholder="Your name" autocomplete="off" wire:model.defer="formData.name">
                                            @error("formData.name")
                                            <small>
                                                <strong class="text-danger">
                                                    {{ $message }}
                                                </strong>
                                            </small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email">Email address</label>
                                            <input type="email" class="form-control" name="email" id="email" placeholder="Enter email" autocomplete="off" wire:model.defer="formData.email">
                                            @error("formData.email")
                                            <small>
                                                <strong class="text-danger">
                                                    {{ $message }}
                                                </strong>
                                            </small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-info py-2">
                                                <span wire:loading>
                                                    @include("admin.partials.loading-svg")
                                                </span>
                                                <span wire:loading.class="button-loading">
                                                    Update profile
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
