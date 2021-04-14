<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMagangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('magang', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->date('mulai_magang')->nullable();
            $table->integer('lama_magang')->nullable();
            $table->date('akhir_magang')->nullable();
            $table->string('file_laporan_magang')->nullable();
            $table->string('file_jurnal_magang')->nullable();
            $table->string('file_sk_magang')->nullable();
            $table->integer('status_magang')->default(0);
            $table->foreignUuid('dosen_uuid')->nullable();
            $table->foreignUuid('mitra_uuid')->nullable();
            $table->foreignUuid('mahasiswa_uuid')->nullable();
            $table->foreignUuid('user_uuid')->nullable();
            $table->foreignUuid('prodi_uuid')->nullable();
            $table->foreignUuid('jurusan_uuid')->nullable();
            $table->timestamps();

            $table->foreign('mitra_uuid')->references('uuid')->on('mitra')->cascadeOnUpdate()->nullOnDelete();
            $table->foreign('dosen_uuid')->references('uuid')->on('dosen')->cascadeOnUpdate()->nullOnDelete();
            $table->foreign('mahasiswa_uuid')->references('uuid')->on('mahasiswa')->cascadeOnUpdate()->nullOnDelete();
            $table->foreign('user_uuid')->references('uuid')->on('users')->cascadeOnUpdate()->nullOnDelete();

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
        Schema::dropIfExists('magang');
    }
}
