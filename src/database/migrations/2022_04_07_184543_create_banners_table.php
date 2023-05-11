<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBannersTable extends Migration
{
    public function up(): void
    {
        Schema::create("banners", function (Blueprint $table) {
            $table->id();
            $table->string("title");
            $table->text("image")->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists("banners");
    }
}
