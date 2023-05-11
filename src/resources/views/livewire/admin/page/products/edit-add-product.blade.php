<div>
    @include("admin.partials.titlebar", ["__page_title" => "Update file settings"])

    <div class="row">
        <div class="col-md-12 d-flex align-items-stretch grid-margin">
            <div class="row flex-grow">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{ route("admin.products.list") }}" class="btn btn-info py-2 mb-3">
                                Products list
                            </a>
                            <div>
                                <form class="forms-sample" wire:submit.prevent="{{ $product ? 'update' : 'create' }}">
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
                                                <label for="sku">SKU</label>
                                                <input type="text" class="form-control" placeholder="SKU" name="sku" id="sku" wire:model.defer="formData.sku">
                                                @error("formData.sku")
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
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="category_ids">Categories <small>(multiple)</small></label>
                                                <select name="category_ids" id="category_ids" class="form-control" wire:model.defer="category_ids" multiple>
                                                    <option value="" selected disabled>Select Categories</option>
                                                    @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error("category_ids")
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
                                                <label for="launch_date">Launch date</label>
                                                <input type="date" class="form-control" placeholder="Launch date" name="launch_date" id="launch_date" wire:model.defer="formData.launch_date">
                                                @error("formData.launch_date")
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
                                                <label for="price">Price</label>
                                                <input type="number" class="form-control" placeholder="Price" name="price" id="price" wire:model.defer="formData.price" step="0.01">
                                                @error("formData.price")
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
                                                <label for="discount">Discount</label>
                                                <input type="number" class="form-control" placeholder="Discount" name="discount" id="discount" wire:model.defer="formData.discount" step="0.01">
                                                @error("formData.discount")
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
                                                <label for="quantity">Quantity</label>
                                                <input type="number" class="form-control" placeholder="quantity" name="quantity" id="quantity" wire:model.defer="formData.quantity" step="1">
                                                @error("formData.quantity")
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
                                                <label for="description">Description</label>
                                                <textarea type="number" class="form-control" placeholder="Description" name="description" id="description" wire:model.defer="formData.description" step="1" rows="5"></textarea>
                                                @error("formData.description")
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
                                                <input class="d-none" type="file" name="images" id="images" wire:model.defer="images" accept="image/png, image/gif, image/jpeg" multiple>
                                                <label for="images" class="w-100">
                                                    <span>Images</span>
                                                    <div class="image-containers {{ $images ? "" : "no-img" }}" wire:loading.class="loading">
                                                        @foreach ($images as $image)
                                                        <img src="{{ $image->temporaryUrl() }}">
                                                        @endforeach
                                                    </div>
                                                </label>
                                                @if ($product_images)
                                                <label for="">
                                                    <span class="mt-3 d-block">Existing images</span>
                                                </label>
                                                <div class="image-containers" wire:loading.class="loading">
                                                    @foreach ($product_images as $image)
                                                    <div class="image-holder">
                                                        <button type="button" class="remove-img" wire:click="$emit('removeImageConfirm', {{ $image["id"] }})">
                                                            <i class="material-icons-outlined">close</i>
                                                        </button>
                                                        <img src="{{ Storage::url($image["image"]["path"]) }}">
                                                    </div>
                                                    @endforeach
                                                </div>
                                                @endif
                                                @error("images")
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
                                                <button type="submit" class="btn btn-info py-2" wire:loading.attr="disabled">
                                                    <span wire:loading>
                                                        @include("admin.partials.loading-svg")
                                                    </span>
                                                    <span wire:loading.class="button-loading">
                                                        {{ $product ? 'Update' : 'Add' }} product
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

@push('style')
<style>
    .image-containers {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        align-items: center;
        margin-top: 15px;
        border: dotted 1px #999;
        min-height: 150px;
        width: 100%;
        position: relative;
        z-index: 2;
    }
    .image-containers.no-img::before {
        content: "Upload product images here";
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: #999;
        z-index: 1;
    }

    .image-containers .image-holder {
        position: relative;
    }
    .image-containers .remove-img {
        position: absolute;
        top: -10px;
        right: -10px;
        z-index: 3;
        font-size: 16px;
        border: none;
        border-radius: 20px;
        height: 30px;
        width: 30px;
        display: flex;
        justify-content: center;
        align-items: center;
        background: #e74c3c;
        color: #fff;
    }
    .image-containers .remove-img i {
        font-size: inherit;
    }

    .image-containers img {
        width: 100px;
        height: 100px;
        margin: 5px;
        object-fit: cover;
        background: #fff;
        border: solid 1px #777;
        position: relative;
        z-index: 2;
        transition: 0.3s all ease;
    }
    .image-containers.loading img {
        opacity: 0.5;
    }
</style>
@endpush

@push('javascript')
<script>
    Livewire.on("removeImageConfirm", function (image_id) {
        Livewire.emit("confirm", {
            "id": image_id,
            "title": "Delete Image",
            "message": "Are you sure you want to delete this image?",
            "trigger": "deleteImage"
        });
    });
</script>
@endpush
