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
    Schema::create('attendances', function (Blueprint $table) {
            $table->id();

            // Link to enrollment (student in a specific class/section/year)
            $table->unsignedBigInteger('enrollment_id')->comment('References enrollments table');

            // Optional: if you want to track teacher and subject for that attendance
            $table->unsignedBigInteger('teacher_assignment_id')->nullable()->comment('References teacher_assignments table');

            // Date of attendance
            $table->date('attendance_date');

            // Status: Present, Absent, Late, Excused
            $table->enum('status', ['Present', 'Absent', 'Late', 'Excused'])->default('Present');

            // Optional notes
            $table->text('remarks')->nullable();

            $table->timestamps();

            // Foreign key constraints
            $table->foreign('enrollment_id')
                ->references('id')->on('enrollments')
                ->onDelete('cascade');

            $table->foreign('teacher_assignment_id')
                ->references('id')->on('teacher_assignments')
                ->onDelete('set null');

            // Ensure one attendance per student per day per subject
            $table->unique(['enrollment_id', 'teacher_assignment_id', 'attendance_date'], 'unique_attendance');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
