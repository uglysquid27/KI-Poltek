<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('konsultans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('hak_cipta_id')->nullable();
            $table->unsignedBigInteger('paten_id')->nullable();
            $table->string('name');
            $table->string('address');
            $table->string('nationality');
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('hak_cipta_id')->references('id')->on('hak_ciptas')->onDelete('cascade');
            $table->foreign('paten_id')->references('id')->on('patens')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('konsultans');
    }
};