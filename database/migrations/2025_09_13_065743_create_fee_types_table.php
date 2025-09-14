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
        Schema::create('fee_types', function (Blueprint $table) {
            $table->id();

            // Fee type name
            $table->string('name', 100)->comment('Type of fee like Tuition Fee, Exam Fee, Late Fine');

            // Description of the fee
            $table->text('description')->nullable();

            // Recurrence type: monthly tuition, one-time, yearly, etc.
            $table->enum('recurrence', ['one_time', 'monthly', 'yearly', 'occasionally'])
                ->default('one_time')
                ->comment('How often this fee is charged');

            // Default amount for this fee type (can be overridden per student if needed)
            $table->decimal('default_amount', 10, 2)->default(0.00);

            // Status to activate or deactivate fee type
            $table->enum('status', ['active', 'inactive'])->default('active');

            $table->timestamps();

            // Unique constraint to avoid duplicate fee type names
            $table->unique('name', 'unique_fee_type_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fee_types');
    }
};
