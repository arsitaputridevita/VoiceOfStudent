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
        Schema::create('keluhans', function (Blueprint $table) {
            $table->id();
            $table->string('jenis');
            $table->string('deskripsi');
            $table->unsignedBigInteger('kategori_id');
            $table->unsignedBigInteger('priority_id');
            $table->unsignedInteger('like')->default(0);
            $table->unsignedInteger('dislike')->default(0);
            $table->enum('status', ['proses', 'sedang diproses', 'selesai'])->default('proses');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keluhans');
    }
};
