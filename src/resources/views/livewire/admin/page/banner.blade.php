<div>
    @include("admin.partials.titlebar", ["__page_title" => "Update Banner"])

    <div class="row">
        <div class="col-md-12 d-flex align-items-stretch grid-margin">
            <div class="row flex-grow">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div>
                                <form class="forms-sample" wire:submit.prevent="save">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="title">Banner Title</label>
                                                <input type="text" class="form-control" id="title" name="title" placeholder="Banner Title" wire:model.defer="title">
                                                @error("title")
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
                                                <input class="d-none" type="file" name="image" id="image" wire:model.defer="image" accept="image/png, image/gif, image/jpeg">
                                                <label for="image" class="w-100">
                                                    <span>Image</span>
                                                    <div class="image-containers {{ $banner->image || $image ? "" : "no-img" }}" wire:loading.class="loading">
                                                        @if ($image)
                                                            <img src="{{ $image->temporaryUrl() }}">
                                                        @elseif ($banner->image)
                                                            <img src="{{ Storage::url($banner->image["path"]) }}">
                                                        @endif
                                                    </div>
                                                </label>
                                                @error("image")
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
                                                        Update Banner
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
