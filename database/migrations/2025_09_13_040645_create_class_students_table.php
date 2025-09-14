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
        Schema::create('students', function (Blueprint $table) {
            $table->id(); // Primary Key

            $table->string('student_code', 30)->unique()->comment('Unique student ID');
            $table->string('first_name', 50);
            $table->string('last_name', 50);
            $table->enum('gender', ['Male', 'Female', 'Other']);
            $table->date('dob')->nullable();
            $table->string('guardian_name', 100)->nullable();
            $table->string('guardian_phone', 20)->nullable();
            $table->text('address')->nullable();
            $table->date('admission_date')->nullable();
            $table->string('photo', 255)->nullable();
            $table->enum('status', ['Active', 'Inactive', 'Transferred'])->default('Active');

            // Optional: link to class_section (current enrollment)
            $table->unsignedBigInteger('class_section_id')->nullable();

            $table->timestamps();

            // Foreign key for current class_section
            $table->foreign('class_section_id')
                ->references('id')
                ->on('class_sections')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('class_students');
    }
};
