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
      Schema::create('fee_structures', function (Blueprint $table) {
            $table->id();

            // Foreign keys
            $table->unsignedBigInteger('fee_type_id')->comment('References fee_types table');
            $table->unsignedBigInteger('class_id')->comment('References classes table');
            $table->unsignedBigInteger('section_id')->nullable()->comment('Optional reference to sections table');
            $table->unsignedBigInteger('shift_id')->nullable()->comment('Optional reference to shifts table');

            // Fee amount
            $table->decimal('amount', 10, 2)->default(0.00)->comment('Standard fee amount for this structure');

            // Effective date to allow future fee changes
            $table->date('effective_date')->comment('Date when this fee structure becomes active');

            // Status for activation
            $table->enum('status', ['active', 'inactive'])->default('active');

            $table->timestamps();

            // Foreign key constraints
            $table->foreign('fee_type_id')
                ->references('id')->on('fee_types')
                ->onDelete('cascade');

            $table->foreign('class_id')
                ->references('id')->on('classes')
                ->onDelete('cascade');

            $table->foreign('section_id')
                ->references('id')->on('sections')
                ->onDelete('set null');

            $table->foreign('shift_id')
                ->references('id')->on('shifts')
                ->onDelete('set null');

            // Prevent duplicate structures for same fee type, class, section, and shift
            $table->unique(['fee_type_id', 'class_id', 'section_id', 'shift_id', 'effective_date'], 'unique_fee_structure');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fee_structures');
    }
};
