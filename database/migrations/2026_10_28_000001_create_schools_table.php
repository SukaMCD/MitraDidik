<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('schools', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('npsn', 20)->unique();
            $table->string('address')->nullable();
            $table->string('phone', 30)->nullable();
            $table->string('logo_url')->nullable();
            $table->time('quiet_start')->default('17:00:00'); // Batas awal Jam Tenang guru
            $table->time('quiet_end')->default('07:00:00');   // Batas akhir Jam Tenang guru
            $table->string('timezone')->default('Asia/Jakarta');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('schools');
    }
};

