<div>
    @include("admin.partials.titlebar", ["__page_title" => "Update file settings"])

    <div class="row">
        <div class="col-md-12 d-flex align-items-stretch grid-margin">
            <div class="row flex-grow">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{ route("admin.brands.list") }}" class="btn btn-info py-2 mb-3">
                                Brands list
                            </a>
                            <div>
                                <form class="forms-sample" wire:submit.prevent="{{ $brand ? 'update' : 'create' }}">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <input type="text" class="form-control" placeholder="Name" name="name" id="name" wire:model.defer="formData.name">
                                                @error("formData.name")
                                                <small>
                                                    <strong class="text-danger">
                                                        {{ $message }}
                                                    </strong>
                                                </small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-info py-2">
                                                    <span wire:loading>
                                                        @include("admin.partials.loading-svg")
                                                    </span>
                                                    <span wire:loading.class="button-loading">
                                                        {{ $brand ? 'Update' : 'Add' }} Brand
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
</div>
