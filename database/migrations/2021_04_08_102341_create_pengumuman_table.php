<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengumumanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengumuman', function (Blueprint $table) {
            $table->id();
            $table->string('judul_pengumuman', 60);
            $table->text('content_pengumuman')->nullable();
            $table->string('jenis_pengumuman')->nullable();
            $table->integer('status_pengumuman')->default(1);
            $table->date('tanggal_pengumuman')->nullable();
            $table->foreignUuid('user_uuid')->nullable();
            $table->foreignUuid('prodi_uuid')->nullable();
            $table->foreignUuid('jurusan_uuid')->nullable();
            $table->timestamps();

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
        Schema::dropIfExists('pengumuman');
    }
}
