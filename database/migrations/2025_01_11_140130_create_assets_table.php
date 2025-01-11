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
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->string('kode_asset');
            $table->unsignedBigInteger('category_barang_id');
            $table->foreign('category_barang_id')->references('id')->on('category_barangs')->onDelete('cascade');
            $table->unsignedBigInteger('lokasi_asset_id');
            $table->foreign('lokasi_asset_id')->references('id')->on('lokasi_assets')->onDelete('cascade');
            $table->string('nama');
            $table->date('tanggal_perolehan');
            $table->string('pengguna');
            $table->integer('volume');
            $table->decimal('harga', 15, 2);
            $table->enum('spesifikasi', ['Sangat Baik', 'Baik', 'Cukup', 'Buruk', 'Sangat Buruk']);
            $table->enum('kualitas', ['Sangat Baik', 'Baik', 'Cukup', 'Buruk', 'Sangat Buruk']);
            $table->integer('masa_manfaat'); // Masa manfaat (dalam tahun)
            $table->integer('pemakaian')->nullable(); // Pemakaian (dalam tahun)
            $table->decimal('penyusutan', 15, 2)->nullable(); // Nilai penyusutan tahunan
            $table->decimal('nilai_asset', 15, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assets');
    }
};
