<div class="section" id="filters">
    <div class="filter">
        <div class="heading">
            <h3>Filters</h3>
        </div>
    </div>
    <div class="filter">
        <div class="heading">
            <h4>Brand</h4>
        </div>
        <ul>
            @foreach ($brands as $brand)
            <li>
                <input type="checkbox" id="selected_brands_{{ $brand->id }}" name="selected_brands[]" value="{{ $brand->id }}" wire:model="selected_brands.{{ $brand->id }}">
                <label for="selected_brands_{{ $brand->id }}">
                    <span class="checkbox"></span>
                    <span class="text">{{ $brand->name }} <small>({{ $brand->products->count() }})</small></span>
                </label>
            </li>
            @endforeach
        </ul>
    </div>
    <div class="filter">
        <div class="heading">
            <h4>Category</h4>
        </div>
        <ul>
            @foreach ($categories as $category)
            <li>
                <input type="checkbox" id="selected_categories_{{ $category->id }}" name="selected_categories[]" value="{{ $category->id }}" wire:model="selected_categories.{{ $category->id }}">
                <label for="selected_categories_{{ $category->id }}">
                    <span class="checkbox"></span>
                    <span class="text">{{ $category->name }} <small>({{ $category->products->count() }})</small></span>
                </label>
            </li>
            @endforeach
        </ul>
    </div>
    <div class="filter">
        <div class="heading">
            <h4>Price range</h4>
        </div>
        <div class="range">
            <input type="number" name="min" id="min" placeholder="Min" wire:model.defer="min_price">
            <span>-</span>
            <input type="number" name="max" id="max" placeholder="Max" wire:model.defer="max_price">
            <button wire:click="filterPrice">
                <i class="feather-filter"></i>
            </button>
        </div>
    </div>
</div>
