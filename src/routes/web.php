<?php

use App\Http\Livewire\Admin\Page\Banner;
use App\Http\Livewire\Page\Cart;
use App\Http\Livewire\Page\Home;
use App\Http\Livewire\Page\Order;
use App\Http\Livewire\Page\OnSale;
use App\Http\Livewire\Page\Signup;
use App\Http\Livewire\Page\Checkout;
use App\Http\Livewire\Page\Featured;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Admin\Page\Login;
use App\Http\Livewire\Admin\Page\Profile;
use App\Http\Livewire\Page\LatestArrivals;
use App\Http\Livewire\Admin\Page\Dashboard;
use App\Http\Livewire\Admin\Page\UpdatePassword;
use App\Http\Livewire\Page\Login as CustomerLogin;
use App\Http\Livewire\Admin\Page\Brands\ListBrands;
use App\Http\Livewire\Admin\Page\Brands\EditAddBrand;
use App\Http\Livewire\Admin\Page\Order as AdminOrder;
use App\Http\Livewire\Page\Profile as CustomerProfile;
use App\Http\Livewire\Admin\Page\Products\ListProducts;
use App\Http\Livewire\Admin\Page\Products\EditAddProduct;
use App\Http\Livewire\Admin\Page\Categories\ListCategories;
use App\Http\Livewire\Admin\Page\Categories\EditAddCategory;
use App\Http\Livewire\Page\Product;

Route::get("/", Home::class)->name("home");
Route::get("latest-arrivals", LatestArrivals::class)->name("latest-arrivals");
Route::get("featured", Featured::class)->name("featured");
Route::get("on-sale", OnSale::class)->name("on-sale");
Route::get("cart", Cart::class)->name("cart");
Route::group(["middleware" => "auth:customer"], function () {
    Route::get("checkout", Checkout::class)->name("checkout");
    Route::get("profile", CustomerProfile::class)->name("profile");
    Route::get("orders", Order::class)->name("orders");
});
Route::get("products/{id}/{product_sku?}", Product::class)->name("product");

Route::get("admin/login", Login::class)->name("admin.login");
Route::get("login", CustomerLogin::class)->name("login");
Route::get("signup", Signup::class)->name("signup");
Route::get("logout", function () {
    Auth::guard("customer")->logout();
    return redirect()->route("login");
})->name("logout");

Route::group(["prefix" => "admin", "as" => "admin.", "middleware" => "auth"], function () {
    Route::get("logout", function () {
        Auth::logout();
        return redirect()->route("admin.login");
    })->name("logout");

    Route::get("/", Dashboard::class)->name("dashboard");
    Route::get("profile", Profile::class)->name("profile");
    Route::get("update-password", UpdatePassword::class)->name("update-password");

    Route::get("products", ListProducts::class)->name("products.list");
    Route::get("products/edit-add/{product_id?}", EditAddProduct::class)->name("products.edit-add");

    Route::get("brands", ListBrands::class)->name("brands.list");
    Route::get("brands/edit-add/{brand_id?}", EditAddBrand::class)->name("brands.edit-add");

    Route::get("categories", ListCategories::class)->name("categories.list");
    Route::get("categories/edit-add/{category_id?}", EditAddCategory::class)->name("categories.edit-add");

    Route::get("orders", AdminOrder::class)->name("orders.list");
    Route::get("banners", Banner::class)->name("banners");
});
