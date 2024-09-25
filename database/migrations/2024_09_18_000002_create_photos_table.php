<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('photos', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Nama judul foto
            $table->text('description')->nullable(); // Deskripsi foto
            $table->string('image_path'); // Path untuk file gambar
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Relasi ke users
            $table->foreignId('category_id')->nullable()->constrained()->onDelete('set null'); // Relasi ke categories
            $table->boolean('is_featured')->default(false); // Apakah foto ditampilkan sebagai unggulan
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('photos');
    }
};
