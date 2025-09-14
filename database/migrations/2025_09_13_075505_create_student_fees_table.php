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
        Schema::create('student_fees', function (Blueprint $table) {
            $table->id();

            // Foreign keys
            $table->unsignedBigInteger('student_id')->comment('References students table');
            $table->unsignedBigInteger('fee_structure_id')->nullable()->comment('References fee_structures table');
            $table->unsignedBigInteger('fee_type_id')->comment('References fee_types table directly for flexibility');

            // Fee details
            $table->decimal('amount', 10, 2)->default(0.00)->comment('Base fee amount');
            $table->decimal('late_fine', 10, 2)->default(0.00)->comment('Late fine if paid after due date');
            $table->decimal('total_amount', 10, 2)->default(0.00)->comment('Final payable amount including fines');

            // Dates
            $table->date('due_date')->comment('Fee due date');
            $table->date('paid_date')->nullable()->comment('Actual date fee was paid');

            // Status
            $table->enum('status', ['unpaid', 'partially_paid', 'paid', 'overdue', 'cancelled'])->default('unpaid');

            // Optional notes
            $table->text('remarks')->nullable()->comment('Additional notes about this fee');

            $table->timestamps();

            // Foreign key constraints
            $table->foreign('student_id')
                ->references('id')->on('students')
                ->onDelete('cascade');

            $table->foreign('fee_structure_id')
                ->references('id')->on('fee_structures')
                ->onDelete('set null');

            $table->foreign('fee_type_id')
                ->references('id')->on('fee_types')
                ->onDelete('cascade');

            // Prevent duplicate fee assignments for the same student, fee type, and due date
            $table->unique(['student_id', 'fee_type_id', 'due_date'], 'unique_student_fee');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_fees');
    }
};
