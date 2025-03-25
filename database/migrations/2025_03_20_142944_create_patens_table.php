<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('patens', function (Blueprint $table) {
            $table->id(); // Default primary key column named 'id'
            $table->unsignedBigInteger('ki_id');
            $table->string('paten_number')->unique();
            $table->date('validity');
            $table->timestamps();

            $table->foreign('ki_id')->references('ki_id')->on('kekayaan_intelektuals')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('patens');
    }
};