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
        Schema::create('class_sections', function (Blueprint $table) {
            $table->id(); // Primary Key

            // Foreign keys
            $table->unsignedBigInteger('class_id')->comment('References classes table');
            $table->unsignedBigInteger('section_id')->comment('References sections table');
            $table->unsignedBigInteger('shift_id')->comment('References shifts table');

            // Optional fields
            $table->integer('capacity')->nullable()->comment('Maximum number of students in this section');
            $table->text('description')->nullable()->comment('Additional info about this class-section');

            $table->timestamps();

            // Relationships
            $table->foreign('class_id')->references('id')->on('classes')->onDelete('cascade');
            $table->foreign('section_id')->references('id')->on('sections')->onDelete('cascade');
            $table->foreign('shift_id')->references('id')->on('shifts')->onDelete('cascade');

            // Ensure unique combination of class, section, and shift
            $table->unique(['class_id', 'section_id', 'shift_id'], 'unique_class_section_shift');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('class_sections');
    }
};
