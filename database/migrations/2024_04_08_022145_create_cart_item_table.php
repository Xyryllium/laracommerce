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
        Schema::create('cart_item', function (Blueprint $table) {
            $table->id();
            $table->uuid("session_id");
            $table->unsignedBigInteger("product_id");
            $table->foreign('session_id')->references('id')->on('shopping_session')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products');
            $table->unsignedBigInteger("quantity");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_item');
    }
};
