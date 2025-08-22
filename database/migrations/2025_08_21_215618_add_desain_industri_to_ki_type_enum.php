<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Add 'desain_industri' to the type ENUM
        DB::statement("ALTER TABLE kekayaan_intelektuals MODIFY COLUMN type ENUM('hak_cipta', 'paten', 'desain_industri') NOT NULL");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Remove 'desain_industri' from the type ENUM (revert to original)
        DB::statement("ALTER TABLE kekayaan_intelektuals MODIFY COLUMN type ENUM('hak_cipta', 'paten') NOT NULL");
    }
};