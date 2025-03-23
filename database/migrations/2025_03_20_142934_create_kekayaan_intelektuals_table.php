<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('kekayaan_intelektuals', function (Blueprint $table) {
            $table->id('ki_id');
            $table->enum('type', ['hak_cipta', 'paten']);
            $table->string('title');
            $table->text('description');
            $table->string('category');
            $table->enum('status', [
                'Dalam Proses', 
                'Dibatalkan', 
                'Ditolak', 
                'Dihapus', 
                'Didaftar', 
                'Ditarik kembali', 
                'Berakhir'
            ]);
            $table->date('submission_date');
            $table->date('publication_date')->nullable();
            $table->string('document')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kekayaan_intelektuals');
    }
};