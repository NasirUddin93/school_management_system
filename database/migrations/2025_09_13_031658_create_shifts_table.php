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
        Schema::create('shifts', function (Blueprint $table) {
            $table->id(); // Primary Key: BIGINT
            $table->string('name', 50)->unique()->comment('Shift name like Morning, Day');
            $table->time('start_time')->nullable()->comment('Shift start time, optional');
            $table->time('end_time')->nullable()->comment('Shift end time, optional');
            $table->text('description')->nullable()->comment('Additional details about the shift');
            $table->timestamps(); // created_at, updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shifts');
    }
};
