<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('beranda', function (Blueprint $table) {
            $table->id();
            $table->string('judul_hero')->nullable();
            $table->text('deskripsi_hero')->nullable();
            $table->string('gambar_hero')->nullable();
            $table->string('judul_about')->nullable();
            $table->text('deskripsi_about')->nullable();
            $table->string('gambar_about')->nullable();
            $table->string('link_whatsapp')->nullable();
            $table->string('link_maps')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('beranda');
    }
};