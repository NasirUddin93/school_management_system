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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();

            // Foreign Keys
            $table->unsignedBigInteger('student_id')->comment('References students table');
            $table->unsignedBigInteger('student_fee_id')->comment('References student_fees table');

            // Payment Details
            $table->decimal('amount_paid', 10, 2)->comment('Amount paid in this transaction');
            $table->date('payment_date')->comment('Date the payment was made');

            // Payment Method
            $table->enum('payment_method', ['cash', 'card', 'mobile_banking', 'bank_transfer', 'check', 'other'])
                  ->default('cash')
                  ->comment('Payment method used');

            // Transaction Reference
            $table->string('transaction_reference')->nullable()->comment('Receipt number or external transaction ID');

            // Payment Status
            $table->enum('status', ['pending', 'completed', 'failed', 'refunded'])
                  ->default('pending')
                  ->comment('Payment status');

            // Optional notes
            $table->text('remarks')->nullable()->comment('Any extra notes about the payment');

            $table->timestamps();

            /* ===================================================
             * Foreign Key Constraints
             * =================================================== */
            $table->foreign('student_id')
                  ->references('id')->on('students')
                  ->onDelete('cascade');

            $table->foreign('student_fee_id')
                  ->references('id')->on('student_fees')
                  ->onDelete('cascade');

            // Index for fast lookups
            $table->index(['student_id', 'student_fee_id', 'payment_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
