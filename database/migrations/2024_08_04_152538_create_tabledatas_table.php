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
        Schema::create('tabledatas', function (Blueprint $table) {
            $table->id();
            $table->string('table_number');
            $table->string('seat_capicity');
            $table->enum('status',['Available','Occupied','Reserved']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tabledatas');
    }
};
