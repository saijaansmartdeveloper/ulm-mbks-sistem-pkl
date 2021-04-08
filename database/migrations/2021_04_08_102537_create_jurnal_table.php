<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJurnalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jurnal', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->text('catatan_jurnal')->nullable();
            $table->string('file_image_jurnal')->nullable();
            $table->string('file_dokumen_jurnal')->nullable();
            $table->date('tanggal_jurnal')->nullable();
            $table->string('status_jurnal')->default('submit');
            $table->date('tanggal_verifikasi_jurnal')->nullable();
            $table->string('komentar_jurnal')->nullable();
            $table->foreignUuid('magang_uuid')->nullable();
            $table->timestamps();

            $table->foreign('magang_uuid')->references('uuid')->on('magang')->cascadeOnUpdate()->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jurnal');
    }
}
