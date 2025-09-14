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
        Schema::create('exam_results', function (Blueprint $table) {
            $table->id();

            // Foreign keys
            $table->unsignedBigInteger('exam_id')->comment('References exams table');
            $table->unsignedBigInteger('enrollment_id')->comment('References enrollments table (student in class)');
            $table->unsignedBigInteger('subject_id')->comment('References subjects table');

            // Marks and grade
            $table->decimal('marks_obtained', 5, 2)->default(0)->comment('Marks obtained by student');
            $table->decimal('total_marks', 5, 2)->comment('Total marks for the exam');
            $table->string('grade', 5)->nullable()->comment('Calculated grade like A, B, C, etc.');
            $table->boolean('is_passed')->default(true)->comment('Pass/Fail status');

            // Optional remarks
            $table->text('remarks')->nullable();

            $table->timestamps();

            // Foreign key constraints
            $table->foreign('exam_id')
                ->references('id')->on('exams')
                ->onDelete('cascade');

            $table->foreign('enrollment_id')
                ->references('id')->on('enrollments')
                ->onDelete('cascade');

            $table->foreign('subject_id')
                ->references('id')->on('subjects')
                ->onDelete('cascade');

            // Unique record per student per exam per subject
            $table->unique(['exam_id', 'enrollment_id', 'subject_id'], 'unique_exam_result');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exam_results');
    }
};
