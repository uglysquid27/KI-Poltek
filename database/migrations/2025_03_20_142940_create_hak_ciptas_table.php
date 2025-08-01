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
            Schema::create('hak_ciptas', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('ki_id');
                $table->foreign('ki_id')->references('ki_id')->on('kekayaan_intelektuals')->onDelete('cascade');

                $table->foreignId('user_id')->constrained('users', 'user_id')->onDelete('cascade');

                // Data Karya
                $table->string('judul_karya');
                $table->text('uraian_singkat_ciptaan');
                $table->string('jenis_karya');

                // Data Pencipta Utama
                $table->string('pencipta_nik');
                $table->string('pencipta_nama');
                $table->string('pencipta_email');
                $table->string('pencipta_hp');
                $table->text('pencipta_alamat');
                $table->string('pencipta_kecamatan');
                $table->string('pencipta_kodepos');
                $table->string('pencipta_jurusan');

                // Anggota Berstatus Mahasiswa (disimpan sebagai JSON)
                $table->json('anggota_mahasiswa')->nullable(); 

                // Anggota Pencipta Lain (disimpan sebagai JSON)
                $table->json('anggota_pencipta')->nullable(); 

                // Dokumen Unggahan
                $table->string('file_path_ktp'); 
                $table->string('kota_pengumuman');
                $table->date('tanggal_pengumuman'); 
                $table->string('file_path_ciptaan'); 

                // Pernyataan
                $table->boolean('pernyataan_setuju')->default(false);

                $table->timestamps(); 
            });
        }

        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::dropIfExists('hak_ciptas');
        }
    };
    