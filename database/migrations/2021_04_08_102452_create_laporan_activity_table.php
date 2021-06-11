<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaporanActivityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporan_activity', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('judul_laporan_activity')->nullable();
            $table->text('catatan_laporan_activity')->nullable();
            $table->date('tanggal_laporan_activity')->nullable();
            $table->string('file_laporan_activity')->nullable();
            $table->string('jenis_laporan')->nullable();
            $table->longText('komentar_laporan_activity')->nullable();
            $table->foreignUuid('kegiatan_uuid')->nullable();
            $table->foreignUuid('dosen_uuid')->nullable();
            $table->foreignUuid('prodi_uuid')->nullable();
            $table->foreignUuid('jurusan_uuid')->nullable();
            $table->timestamps();

            $table->foreign('kegiatan_uuid')->references('uuid')->on('kegiatan')->cascadeOnUpdate()->nullOnDelete();
            $table->foreign('dosen_uuid')->references('uuid')->on('dosen')->cascadeOnUpdate()->nullOnDelete();
            $table->foreign('prodi_uuid')->references('uuid')->on('prodi')->cascadeOnUpdate()->nullOnDelete();
            $table->foreign('jurusan_uuid')->references('uuid')->on('jurusan')->cascadeOnUpdate()->nullOnDelete();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('monev');
    }
}
