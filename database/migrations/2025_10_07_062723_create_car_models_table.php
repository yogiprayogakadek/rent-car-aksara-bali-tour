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
        Schema::create('car_models', function (Blueprint $table) {
            $table->id();
            $table->string('car_name', 150); // Nama mobil, contoh: Toyota Avanza
            $table->string('car_type', 100); // Jenis, contoh: MPV, SUV, Sedan
            $table->string('car_brand', 100)->nullable(); // Merek: Toyota, Honda, dll.
            // $table->year('car_year')->nullable(); // Tahun pembuatan
            // $table->string('car_plate', 20)->unique(); // Nomor plat
            $table->integer('car_price'); // harga per hari / per jam
            // $table->enum('status', ['available', 'rented', 'maintenance'])->default('available'); // status mobil
            $table->text('car_description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('car_models');
    }
};
