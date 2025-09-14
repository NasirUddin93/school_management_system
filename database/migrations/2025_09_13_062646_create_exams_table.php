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
        Schema::create('exams', function (Blueprint $table) {
            $table->id();

            $table->string('name', 100)->comment('Exam name, e.g., Midterm, Final');
            $table->text('description')->nullable();
            $table->date('exam_date')->comment('Date of the exam');
            $table->unsignedBigInteger('class_section_id')->comment('Exam assigned to class-section');
            $table->unsignedBigInteger('subject_id')->comment('Exam subject');
            $table->unsignedBigInteger('teacher_assignment_id')->nullable()->comment('Teacher conducting the exam');
            $table->enum('status', ['Scheduled', 'Completed', 'Cancelled'])->default('Scheduled');

            $table->timestamps();

            // Foreign keys
            $table->foreign('class_section_id')->references('id')->on('class_sections')->onDelete('cascade');
            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade');
            $table->foreign('teacher_assignment_id')->references('id')->on('teacher_assignments')->onDelete('set null');

            // Unique exam per class-section and subject
            $table->unique(['class_section_id', 'subject_id', 'exam_date'], 'unique_class_subject_exam');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exams');
    }
};
