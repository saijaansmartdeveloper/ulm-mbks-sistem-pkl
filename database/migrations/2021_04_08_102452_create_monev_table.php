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
            $table->foreignUuid('magang_uuid')->nullable();
            $table->foreignUuid('prodi_uuid')->nullable();
            $table->foreignUuid('jurusan_uuid')->nullable();
            $table->timestamps();

            // $table->foreign('magang_uuid')->references('uuid')->on('magang')->cascadeOnUpdate()->nullOnDelete();
            // $table->foreign('prodi_uuid')->references('uuid')->on('prodi')->cascadeOnUpdate()->nullOnDelete();
            // $table->foreign('jurusan_uuid')->references('uuid')->on('jurusan')->cascadeOnUpdate()->nullOnDelete();

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
