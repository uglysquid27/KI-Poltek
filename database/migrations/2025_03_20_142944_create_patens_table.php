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
        Schema::create('patens', function (Blueprint $table) {
            $table->id(); // Primary key for the patens table
            $table->foreignId('ki_id')->constrained('kekayaan_intelektuals', 'ki_id')->onDelete('cascade'); // Foreign key to kekayaan_intelektuals
            $table->foreignId('user_id')->constrained('users', 'user_id')->onDelete('cascade'); // Foreign key to users

            $table->string('judul_paten');
            $table->text('abstrak');
            $table->integer('jumlah_klaim');
            $table->string('ketua_inventor_nama');
            $table->text('ketua_inventor_alamat');
            $table->string('ketua_inventor_email');
            $table->string('ketua_inventor_hp');
            $table->string('ketua_inventor_jurusan');
            $table->json('anggota_inventor')->nullable(); // Store multiple inventor members as JSON
            $table->string('jenis_paten'); // e.g., 'Paten Biasa', 'Paten Sederhana'
            $table->string('file_path_ktp')->nullable(); // Path to the uploaded KTP PDF
            $table->string('ada_anggota_mahasiswa')->default('Tidak'); // 'Ya' or 'Tidak'
            $table->json('anggota_mahasiswa')->nullable(); // Store student members as JSON
            $table->date('tanggal_upload_draft'); // Timestamp Upload Draft Deskripsi dan Gambar Paten
            $table->string('file_path_draft')->nullable(); // Path to the uploaded draft document

            $table->timestamps(); // created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patens');
    }
};
