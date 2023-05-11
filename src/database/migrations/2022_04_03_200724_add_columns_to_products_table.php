<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToProductsTable extends Migration
{
    public function up(): void
    {
        Schema::table("products", function (Blueprint $table) {
            $table->date("launch_date")->nullable();
            $table->boolean("launching_soon")->default(false);
        });
    }

    public function down(): void
    {
        Schema::table("products", function (Blueprint $table) {
            $table->dropColumn("launch_date");
            $table->dropColumn("launching_soon");
        });
    }
}
