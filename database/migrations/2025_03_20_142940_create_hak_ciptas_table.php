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
                $table->id(); // Primary Key default 'id' for hak_ciptas table
                // Tambahkan ki_id sebagai foreign key ke kekayaan_intelektuals
                $table->unsignedBigInteger('ki_id');
                $table->foreign('ki_id')->references('ki_id')->on('kekayaan_intelektuals')->onDelete('cascade');

                $table->foreignId('user_id')->constrained('users', 'user_id')->onDelete('cascade');

                // Data Karya
                $table->string('judul_karya');
                $table->text('uraian_singkat_ciptaan');
                $table->string('jenis_karya'); // Karya Tulis, Karya Seni, etc.

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
                $table->json('anggota_mahasiswa')->nullable(); // Array of objects: [{nama: "", nim: ""}]

                // Anggota Pencipta Lain (disimpan sebagai JSON)
                $table->json('anggota_pencipta')->nullable(); // Array of objects: [{nik: "", nama: "", email: "", hp: "", alamat: "", kecamatan: "", kodepos: ""}]

                // Dokumen Unggahan
                $table->string('file_path_ktp'); // Path to Scan KTP Pencipta PDF
                $table->string('kota_pengumuman');
                $table->date('tanggal_pengumuman'); // Date format (Bulan, Hari, Tahun)
                $table->string('file_path_ciptaan'); // Path to Dokumen Ciptaan (PDF/DOCX)

                // Pernyataan
                $table->boolean('pernyataan_setuju')->default(false);

                $table->timestamps(); // created_at & updated_at
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
    