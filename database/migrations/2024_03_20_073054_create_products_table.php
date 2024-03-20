<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->unsignedBigInteger("category_id");
            $table->unsignedBigInteger("inventory_id");
            $table->foreign('category_id')->references('id')->on('product_category');
            $table->foreign('inventory_id')->references('id')->on('product_inventory');
            $table->float('price');
            $table->unsignedBigInteger("discount_id");
            $table->foreign('discount_id')->references('id')->on('discount');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product');
    }
};
