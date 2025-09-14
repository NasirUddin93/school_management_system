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
        Schema::create('teachers', function (Blueprint $table) {
            $table->id(); // Primary key

            // Basic Info
            $table->string('first_name', 50);
            $table->string('last_name', 50)->nullable();
            $table->string('email')->unique();
            $table->string('phone', 20)->nullable();
            $table->string('gender', 10)->nullable(); // Male, Female, Other
            $table->date('date_of_birth')->nullable();

            // Professional Info
            $table->string('qualification')->nullable()->comment('e.g., MSc in Math');
            $table->string('specialization')->nullable()->comment('Subject specialization');
            $table->date('joining_date')->nullable();

            // Address
            $table->string('address')->nullable();
            $table->string('city', 50)->nullable();
            $table->string('state', 50)->nullable();
            $table->string('zip', 20)->nullable();

            // Status
            $table->boolean('is_active')->default(true)->comment('Active or Inactive teacher');

            $table->timestamps(); // created_at, updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};
