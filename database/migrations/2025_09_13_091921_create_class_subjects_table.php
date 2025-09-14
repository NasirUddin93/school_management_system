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
        Schema::create('class_subjects', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('class_section_id')->comment('References class_sections table');
            $table->unsignedBigInteger('subject_id')->comment('References subjects table');
            $table->timestamps();

            // Foreign keys
            $table->foreign('class_section_id')
                ->references('id')
                ->on('class_sections')
                ->onDelete('cascade');

            $table->foreign('subject_id')
                ->references('id')
                ->on('subjects')
                ->onDelete('cascade');

            // Unique combination to avoid duplicate assignment
            $table->unique(['class_section_id', 'subject_id'], 'unique_class_subject');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('class_subjects');
    }
};
