<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDosenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dosen', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('nip_dosen', 100)->nullable();
            $table->string('nama_dosen', 100);
            $table->string('email')->unique();
            $table->string('password');
            $table->foreignUuid('prodi_uuid')->nullable();
            $table->foreignUuid('jurusan_uuid')->nullable();
            $table->timestamps();

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
        Schema::dropIfExists('dosen');
    }
}
