<div>
    @include("admin.partials.titlebar", ["__page_title" => "Categories"])
    <div class="row">
        <div class="col-md-12 d-flex align-items-stretch grid-margin">
            <div class="row flex-grow">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="float-right">
                                <a href="{{ route("admin.categories.edit-add") }}" class="btn btn-primary btn-lg d-flex">
                                    <i class="material-icons-outlined">add</i>
                                    Add Category
                                </a>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>SN</th>
                                            <th>Name</th>
                                            <th>Brand</th>
                                            <th>Created at</th>
                                            <th>Last updated</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($categories as $category)
                                        <tr>
                                            <td>
                                                {{ $loop->iteration }}
                                            </td>
                                            <td>
                                                {{ $category->name }}
                                                <br>
                                                <small>
                                                    {{ $category->products->count() }} products
                                                </small>
                                            </td>
                                            <td>
                                                {{ $category->brand ? $category->brand->name : "N/A" }}
                                            </td>
                                            <td title="{{ $category->created_at }}">
                                                {{ $category->created_at->diffForHumans() }}
                                            </td>
                                            <td title="{{ $category->updated_at }}">
                                                {{ $category->updated_at->diffForHumans() }}
                                            </td>
                                            <td>
                                                <a href="{{ route("admin.categories.edit-add", $category->id) }}" class="btn btn-primary btn-sm">
                                                    Edit
                                                </a>
                                                <button class="btn btn-danger btn-sm" wire:click="$emit('confirmDelete', {{ $category->id }})" wire:loading.attr="disabled">
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
                                    {{ $categories->links() }}
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
    Livewire.on("confirmDelete", function (category_id) {
        Livewire.emit("confirm", {
            "id": category_id,
            "title": "Delete Category",
            "message": "Are you sure you want to delete this Category?",
            "trigger": "deleteCategory"
        });
    });
</script>
@endpush
