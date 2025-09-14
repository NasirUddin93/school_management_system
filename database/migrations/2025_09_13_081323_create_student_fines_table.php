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
        Schema::create('student_fines', function (Blueprint $table) {
            $table->id();

            // Foreign keys
            $table->unsignedBigInteger('student_id')->comment('References students table');
            $table->unsignedBigInteger('fee_type_id')->nullable()->comment('References fee_types table, optional for categorizing fines');

            // Fine details
            $table->decimal('amount', 10, 2)->default(0.00)->comment('Fine amount imposed');
            $table->date('fine_date')->comment('Date when fine was imposed');
            $table->date('due_date')->nullable()->comment('Due date for paying the fine');

            // Fine reason
            $table->string('reason')->nullable()->comment('Reason for the fine');

            // Fine status
            $table->enum('status', ['unpaid', 'partially_paid', 'paid', 'cancelled'])
                  ->default('unpaid')
                  ->comment('Fine payment status');

            // Optional notes
            $table->text('remarks')->nullable()->comment('Additional notes about the fine');

            $table->timestamps();

            /* ===================================================
             * Foreign Key Constraints
             * =================================================== */
            $table->foreign('student_id')
                  ->references('id')->on('students')
                  ->onDelete('cascade');

            $table->foreign('fee_type_id')
                  ->references('id')->on('fee_types')
                  ->onDelete('set null');

            // Index for faster queries
            $table->index(['student_id', 'fee_type_id', 'fine_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_fines');
    }
};
