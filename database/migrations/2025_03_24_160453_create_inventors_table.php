<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('inventors', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('paten_id'); // Foreign key to patens table
            $table->string('name');
            $table->string('address');
            $table->string('nationality');
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('paten_id')->references('id')->on('patens')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventors');
    }
};
