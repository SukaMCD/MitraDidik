<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('school_id')->constrained('schools')->cascadeOnDelete();
            $table->foreignId('class_id')->constrained('classes')->cascadeOnDelete();
            $table->string('nis', 30);
            $table->string('nisn', 30)->nullable();
            $table->string('full_name');
            $table->string('gclass_student_email')->nullable(); // Email untuk pemetaan Google Classroom
            $table->date('birth_date')->nullable();
            $table->string('photo_url')->nullable();
            $table->timestamps();

            $table->unique(['school_id', 'nis']);
        });

        Schema::create('student_guardians', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students')->cascadeOnDelete();
            $table->foreignId('guardian_id')->constrained('users')->cascadeOnDelete();
            $table->enum('relation', ['ayah', 'ibu', 'wali'])->default('wali');
            $table->boolean('is_primary')->default(true);
            $table->timestamps();

            $table->unique(['student_id', 'guardian_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_guardians');
        Schema::dropIfExists('students');
    }
};

