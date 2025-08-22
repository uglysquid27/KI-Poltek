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
        Schema::create('desain_industris', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ki_id');
            $table->foreign('ki_id')->references('ki_id')->on('kekayaan_intelektuals')->onDelete('cascade');
            // $table->foreignId('user_id')->nullable();

            // Data Desain Industri
            $table->string('judul_desain');
            $table->text('kegunaan');
            $table->json('klaim_desain'); 
            $table->text('uraian_klaim')->nullable(); 

            // Data Pemohon (Applicant)
            $table->string('pemohon_nama'); 
            $table->string('pemohon_jenis');
            $table->string('pemohon_kewarganegaraan')->nullable(); 
            $table->string('pemohon_badan_hukum')->nullable(); 
            $table->text('pemohon_alamat');
            $table->string('pemohon_rt_rw');
            $table->string('pemohon_kelurahan');
            $table->string('pemohon_kecamatan');
            $table->string('pemohon_kota_kabupaten');
            $table->string('pemohon_kodepos');
            $table->string('pemohon_provinsi');

            // Data Pendesain (Designer)
            $table->string('pendesain_nama');
            $table->string('pendesain_kewarganegaraan')->nullable(); ;
            $table->text('pendesain_alamat');
            $table->string('pendesain_rt_rw');
            $table->string('pendesain_kelurahan');
            $table->string('pendesain_kecamatan');
            $table->string('pendesain_kota_kabupaten');
            $table->string('pendesain_kodepos');
            $table->string('pendesain_provinsi');

            // Additional designers (if any)
            $table->json('anggota_pendesain')->nullable(); 

            // Dokumen Unggahan
            $table->string('file_path_gambar_desain');
            $table->json('keterangan_gambar')->nullable(); 
            $table->string('file_path_surat_pernyataan_kepemilikan');
            $table->string('file_path_surat_pengalihan_hak')->nullable();
            $table->string('file_path_ktp_pendesain');
            $table->string('file_path_akta_badan_hukum')->nullable();

            // Pernyataan
            $table->boolean('pernyataan_kebaruan')->default(false);
            $table->boolean('pernyataan_tidak_sengketa')->default(false);
            $table->boolean('pernyataan_pengalihan_hak')->default(false); 

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('desain_industris');
    }
};