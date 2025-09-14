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
        Schema::create('classes', function (Blueprint $table) {
            $table->id(); // Primary key: BIGINT
            $table->string('name', 50)->unique(); // Class name: Play, Nursery, KG-01, etc.
            $table->unsignedInteger('order_number')->comment('Order of class, 1 for Play, 2 for Nursery, etc.');
            $table->text('description')->nullable()->comment('Optional description of the class');
            $table->timestamps(); // created_at, updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classes');
    }
};
