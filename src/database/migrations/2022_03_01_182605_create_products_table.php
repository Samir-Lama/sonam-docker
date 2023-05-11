<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("brand_id")->nullable();
            $table->foreign("brand_id")->references("id")->on("brands")->onDelete("set null");
            $table->string("name");
            $table->string("sku")->unique();
            $table->text("description")->nullable();
            $table->integer("quantity");
            $table->decimal("price", 10, 2);
            $table->decimal("discount", 10, 2)->nullable();
            $table->boolean("featured")->default(false);
            $table->boolean("on_sale")->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
}
