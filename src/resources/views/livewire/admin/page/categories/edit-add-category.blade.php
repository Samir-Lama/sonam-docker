<div>
    @include("admin.partials.titlebar", ["__page_title" => "Update file settings"])

    <div class="row">
        <div class="col-md-12 d-flex align-items-stretch grid-margin">
            <div class="row flex-grow">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{ route("admin.categories.list") }}" class="btn btn-info py-2 mb-3">
                                Categories list
                            </a>
                            <div>
                                <form class="forms-sample" wire:submit.prevent="{{ $category ? 'update' : 'create' }}">
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
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="brand_id">Brand</label>
                                                <select name="brand_id" id="brand_id" class="form-control" wire:model.defer="formData.brand_id">
                                                    <option value="" selected disabled>Select Brand</option>
                                                    @foreach ($brands as $brand)
                                                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error("formData.brand_id")
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
                                                        {{ $category ? 'Update' : 'Add' }} category
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
