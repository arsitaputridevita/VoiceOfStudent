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
        Schema::create('keluhan_controllers', function (Blueprint $table) {
            $table->id();
            $table->string('kategori_id');
            $table->string('deskripsi');
            $table->string('departemen_id');
            $table->string('priority_id');
            $table->enum('status', ['proses', 'sedang diproses', 'selesai'])->default('proses');
            
            $table->timestamps();
            });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keluhan_controllers');
    }
};
