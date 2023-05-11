<div>
    @include("admin.partials.titlebar", ["__page_title" => "Brands"])
    <div class="row">
        <div class="col-md-12 d-flex align-items-stretch grid-margin">
            <div class="row flex-grow">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="float-right">
                                <a href="{{ route("admin.brands.edit-add") }}" class="btn btn-primary btn-lg d-flex">
                                    <i class="material-icons-outlined">add</i>
                                    Add Brand
                                </a>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>SN</th>
                                            <th>Name</th>
                                            <th>Created at</th>
                                            <th>Last updated</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($brands as $brand)
                                        <tr>
                                            <td>
                                                {{ $loop->iteration }}
                                            </td>
                                            <td>
                                                {{ $brand->name }}
                                                <br>
                                                <small>
                                                    {{ $brand->products->count() }} Products
                                                </small>
                                                <br>
                                                <small>
                                                    {{ $brand->categories->count() }} Categories
                                                </small>
                                            </td>
                                            <td title="{{ $brand->created_at }}">
                                                {{ $brand->created_at->diffForHumans() }}
                                            </td>
                                            <td title="{{ $brand->updated_at }}">
                                                {{ $brand->updated_at->diffForHumans() }}
                                            </td>
                                            <td>
                                                <a href="{{ route("admin.brands.edit-add", $brand->id) }}" class="btn btn-primary btn-sm">
                                                    Edit
                                                </a>
                                                <button class="btn btn-danger btn-sm" wire:click="$emit('confirmDelete', {{ $brand->id }})" wire:loading.attr="disabled">
                                                    Delete 
                                                </button>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="5">No records found.</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                <div class="float-right mt-2">
                                    {{ $brands->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('javascript')
<script>
    Livewire.on("confirmDelete", function (brand_id) {
        Livewire.emit("confirm", {
            "id": brand_id,
            "title": "Delete Brand",
            "message": "Are you sure you want to delete this brand?",
            "trigger": "deleteBrand"
        });
    });
</script>
@endpush
