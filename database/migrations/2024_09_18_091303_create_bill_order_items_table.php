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
        Schema::create('bill_order_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bill_id'); // Link to the bills table
            $table->unsignedBigInteger('order_id'); // Link to the orders (tables) table
            $table->unsignedBigInteger('menu_id'); // Link to the menu items
            $table->float('price'); // Price of the menu item
            $table->timestamps();
            // Foreign key constraints
            $table->foreign('bill_id')->references('id')->on('bills')->onDelete('cascade');
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->foreign('menu_id')->references('id')->on('menu_items')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bill_order_items');
    }
};
