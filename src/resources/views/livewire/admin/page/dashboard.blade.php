<div>
    @include('admin.partials.titlebar', ['__page_title' => 'Dashboard'])

    <div class="row">
        <div class="col-md-12 d-flex align-items-stretch grid-margin">
            <div class="row flex-grow">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body dash-items">
                            <a class="dash-item" href="{{ route("admin.products.list") }}">
                                <div class="title">
                                    <i class="material-icons-outlined">shopping_basket</i>
                                    Products
                                </div>
                                <div class="data">
                                    {{ $products }}
                                </div>
                            </a>
                            <a class="dash-item" href="{{ route("admin.brands.list") }}">
                                <div class="title">
                                    <i class="material-icons-outlined">verified</i>
                                    Brands
                                </div>
                                <div class="data">
                                    {{ $brands }}
                                </div>
                            </a>
                            <a class="dash-item" href="{{ route("admin.categories.list") }}">
                                <div class="title">
                                    <i class="material-icons-outlined">category</i>
                                    Categories
                                </div>
                                <div class="data">
                                    {{ $categories }}
                                </div>
                            </a>
                            <a class="dash-item" href="{{ route("admin.orders.list") }}">
                                <div class="title">
                                    <i class="material-icons-outlined">widgets</i>
                                    Pending Orders
                                </div>
                                <div class="data">
                                    {{ $orders }}
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('style')
    <style>
        .dash-items {
            display: flex;
            flex-wrap: wrap;
            margin-top: 20px;
        }
        .dash-item {
            display: block;
            border: 1px solid #eee;
            padding: 15px 25px;
            margin: 0 5px;
            text-decoration: none;
            color: #333;
            transition: 0.3s all ease;
        }
        .dash-item:hover {
            color: #111;
            text-decoration: none;
            transform: scale(1.1);
        }
        .dash-item .title {
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .dash-item .title i {
            font-size: 18px;
            margin-right: 10px;
            color: #ccc;
        }
        .dash-item .data {
            font-size: 34px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #777;
            margin-top: 10px;
        }
    </style>
@endpush
