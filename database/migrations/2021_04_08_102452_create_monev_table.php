<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMonevTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monev', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->text('catatan_monev')->nullable();
            $table->date('tanggal_monev')->nullable();
            $table->string('file_monev')->nullable();
            $table->longText('komentar_monev')->nullable();
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
