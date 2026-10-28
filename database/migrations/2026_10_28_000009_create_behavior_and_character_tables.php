<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('student_behavior_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students')->cascadeOnDelete();
            $table->foreignId('academic_year_id')->constrained('academic_years')->cascadeOnDelete();
            $table->integer('initial_demerit_points')->default(100);
            $table->integer('current_demerit_points')->default(100); // Batas 100 s.d 0
            $table->integer('total_merit_points')->default(0);       // Akumulasi positif
            $table->enum('warning_level', ['normal', 'sp1', 'sp2', 'sp3'])->default('normal');
            $table->timestamps();

            $table->unique(['student_id', 'academic_year_id']);
        });

        Schema::create('behavior_categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('school_id')->constrained('schools')->cascadeOnDelete();
            $table->enum('type', ['merit', 'demerit'])->default('merit');
            $table->string('name');
            $table->integer('points'); // Positif untuk merit, poin pemotong untuk demerit
            $table->enum('severity_level', ['ringan', 'sedang', 'berat'])->default('ringan');
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('behavior_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students')->cascadeOnDelete();
            $table->foreignId('teacher_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('category_id')->constrained('behavior_categories')->cascadeOnDelete();
            $table->enum('type', ['merit', 'demerit'])->default('merit');
            $table->integer('points');
            $table->integer('demerit_point_balance_after')->nullable();
            $table->date('incident_date');
            $table->string('title');
            $table->text('notes')->nullable();
            $table->string('evidence_url')->nullable();
            $table->text('action_taken')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('behavior_records');
        Schema::dropIfExists('behavior_categories');
        Schema::dropIfExists('student_behavior_profiles');
    }
};

