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
        Schema::create('enrollments', function (Blueprint $table) {
            $table->id(); // Primary Key

            // Foreign keys
            $table->unsignedBigInteger('student_id')->comment('References students table');
            $table->unsignedBigInteger('class_section_id')->comment('References class_sections table');
            $table->unsignedBigInteger('academic_year_id')->comment('References academic_years table');

            // Additional attributes
            $table->integer('roll_number')->nullable()->comment('Roll number for student in that class');
            $table->date('enrollment_date')->nullable()->comment('Date of enrollment');
            $table->enum('status', ['Active', 'Completed', 'Promoted', 'Transferred', 'Dropped'])->default('Active');

            $table->timestamps();

            // Foreign Key Constraints
            $table->foreign('student_id')
                ->references('id')
                ->on('students')
                ->onDelete('cascade');

            $table->foreign('class_section_id')
                ->references('id')
                ->on('class_sections')
                ->onDelete('cascade');

            $table->foreign('academic_year_id')
                ->references('id')
                ->on('academic_years')
                ->onDelete('cascade');

            // Unique constraint to avoid duplicate enrollment for the same year
            $table->unique(['student_id', 'academic_year_id'], 'unique_student_year');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enrollments');
    }
};
