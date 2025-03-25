<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('hak_ciptas', function (Blueprint $table) {
            $table->id(); // Default primary key column named 'id'
            $table->unsignedBigInteger('ki_id');
            $table->string('hak_cipta_number')->unique();
            $table->string('type');
            $table->timestamps();

            $table->foreign('ki_id')->references('ki_id')->on('kekayaan_intelektuals')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('hak_ciptas');
    }
};