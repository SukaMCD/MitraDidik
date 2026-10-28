<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('school_id')->nullable()->constrained('schools')->nullOnDelete()->after('id');
            $table->enum('role', ['admin', 'teacher', 'guardian'])->default('guardian')->after('school_id');
            $table->string('phone', 30)->nullable()->after('email');
            $table->string('language', 10)->default('id')->after('phone');
            $table->boolean('is_active')->default(true)->after('language');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['school_id']);
            $table->dropColumn(['school_id', 'role', 'phone', 'language', 'is_active']);
        });
    }
};

