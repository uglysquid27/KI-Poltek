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
            $table->foreignId('ki_id')->constrained('kekayaan_intelektuals', 'ki_id')->onDelete('cascade'); 
            $table->foreignId('user_id')->constrained('users', 'user_id')->onDelete('cascade'); 

            $table->string('judul_paten');
            $table->text('abstrak');
            $table->integer('jumlah_klaim');
            $table->string('ketua_inventor_nama');
            $table->text('ketua_inventor_alamat');
            $table->string('ketua_inventor_email');
            $table->string('ketua_inventor_hp');
            $table->string('ketua_inventor_jurusan');
            $table->json('anggota_inventor')->nullable(); 
            $table->string('jenis_paten'); 
            $table->string('file_path_ktp')->nullable(); 
            $table->string('ada_anggota_mahasiswa')->default('Tidak'); 
            $table->json('anggota_mahasiswa')->nullable(); 
            $table->date('tanggal_upload_draft'); 
            $table->string('file_path_draft')->nullable(); 

            $table->timestamps(); 
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
