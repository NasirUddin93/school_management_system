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
        Schema::create('teacher_assignments', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('teacher_id')->comment('References teachers table');
            $table->unsignedBigInteger('class_section_id')->comment('References class_sections table');
            $table->unsignedBigInteger('subject_id')->comment('References subjects table');

            $table->enum('status', ['Active', 'Inactive'])->default('Active')->comment('Assignment status');
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('teacher_id')->references('id')->on('teachers')->onDelete('cascade');
            $table->foreign('class_section_id')->references('id')->on('class_sections')->onDelete('cascade');
            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade');

            // Prevent duplicate assignments
            $table->unique(['teacher_id', 'class_section_id', 'subject_id'], 'unique_teacher_assignment');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teacher_assignments');
    }
};
